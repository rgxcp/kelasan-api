<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\SignInRequest;
use App\Http\Requests\SignUpRequest;
use App\Http\Requests\UpdateProfileRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    public function detail(Request $request)
    {
        return response()->json([
            'status' => 'Success',
            'result' => $request->user()
        ]);
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

    public function signUp(SignUpRequest $request)
    {
        $user = User::create($request->all());

        $token = $user->createToken('bearer');

        $collection = collect([
            'user' => $user->makeVisible('email'),
            'token' => $token
        ]);

        return response()->json([
            'status' => 'Success',
            'result' => $collection
        ], 201);
    }

    public function signIn(SignInRequest $request)
    {
        if (!Auth::attempt($request->all())) {
            return response()->json([
                'status' => 'Failed',
                'reason' => 'Unauthorized'
            ], 401);
        }

        $token = $request->user()->createToken('bearer');

        $collection = collect([
            'user' => $request->user()->makeVisible('email'),
            'token' => $token
        ]);

        return response()->json([
            'status' => 'Success',
            'result' => $collection
        ]);
    }

    public function update(UpdateProfileRequest $request)
    {
        $request->user()->update($request->all());

        return response()->json([
            'status' => 'Success',
            'result' => $request->user()->makeVisible('email')
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
