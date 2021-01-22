<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\ChangePasswordRequest;
use App\Http\Requests\SignInRequest;
use App\Http\Requests\SignUpRequest;
use App\Http\Requests\UpdateProfileRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function detail(Request $request)
    {
        return response()->json([
            'status' => 'Success',
            'result' => $request->user()->makeVisible('email')->append([
                'total_uncompleted_assignment',
                'total_doing_assignment',
                'total_completed_assignment'
            ])
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
        $user = User::create($request->except('device'));

        return response()->json([
            'status' => 'Success',
            'result' => $user->makeVisible('email')->append('token')
        ], 201);
    }

    public function signIn(SignInRequest $request)
    {
        if (!Auth::attempt($request->except('device'))) {
            return response()->json([
                'status' => 'Failed',
                'reason' => 'Unauthorized'
            ], 401);
        }

        return response()->json([
            'status' => 'Success',
            'result' => $request->user()->makeVisible('email')->append('token')
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

    public function changePassword(ChangePasswordRequest $request)
    {
        $request->user()->update($request->only('password'));

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
