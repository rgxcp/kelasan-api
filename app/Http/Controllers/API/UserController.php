<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    public function signIn()
    {
    }

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
            'full_name' => $request['full_name'],
            'email' => $request['email'],
            'password' => Hash::make($request['password'])
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

    public function update(Request $request, User $user)
    {
    }

    public function signOut()
    {
    }
}
