<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    public function detail(User $user)
    {
    }

    public function assignments()
    {
    }

    public function classrooms()
    {
    }

    public function subjects()
    {
    }

    public function signUp(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'full_name' => 'required|string|max:30',
            'email' => 'required|email|max:50|unique:users,email',
            'password' => 'required|string|min:8'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'Failed',
                'reasons' => $validator->errors()
            ]);
        }

        $user = User::create([
            'full_name' => $request->full_name,
            'email' => $request->email,
            'password' => Hash::make($request->password)
        ]);

        $token = $user->createToken('bearer');

        $collection = collect([
            'user' => $user,
            'token' => $token
        ]);

        return response()->json([
            'status' => 'Success',
            'result' => $collection
        ]);
    }

    public function signIn(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required|string'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'Failed',
                'reasons' => $validator->errors()
            ]);
        }

        $user = User::where('email', $request->email)->firstOrFail();

        if (!Hash::check($request->password, $user->password)) {
            return response()->json([
                'status' => 'Failed',
                'reason' => 'Unauthorized'
            ]);
        }

        $token = $user->createToken('bearer');

        $collection = collect([
            'user' => $user,
            'token' => $token
        ]);

        return response()->json([
            'status' => 'Success',
            'result' => $collection
        ]);
    }

    public function update(Request $request)
    {
        $user = $request->user();

        $validator = Validator::make($request->all(), [
            'full_name' => 'required|string|max:30',
            'email' => 'required|email|max:50|unique:users,email,' . $user->id
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'Failed',
                'reasons' => $validator->errors()
            ]);
        }

        $user->update([
            'full_name' => $request->full_name,
            'email' => $request->email
        ]);

        return response()->json([
            'status' => 'Success',
            'result' => $user
        ]);
    }

    public function changePassword(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'new_password' => 'required|string|min:8',
            'confirm_password' => 'required|string|min:8|same:new_password'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'Failed',
                'reasons' => $validator->errors()
            ]);
        }

        $request->user()->update([
            'password' => Hash::make($request->confirm_password)
        ]);

        return response()->json([
            'status' => 'Success'
        ]);
    }

    public function signOut(Request $request)
    {
        $request->user()->currentAccessToken()->delete();

        return response()->json([
            'status' => 'Success'
        ]);
    }

    public function signOutAll(Request $request)
    {
        $request->user()->tokens()->delete();

        return response()->json([
            'status' => 'Success'
        ]);
    }
}
