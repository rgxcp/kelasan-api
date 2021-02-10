<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\SignInRequest;
use App\Http\Requests\SignUpRequest;
use App\Http\Requests\UpdatePasswordRequest;
use App\Http\Requests\UpdateProfileRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function show(Request $request)
    {
        return response()->json([
            'status' => 'Success',
            'result' => $request
                ->user()
                ->loadCount('classrooms')
        ]);
    }

    public function assignments(Request $request)
    {
        return response()->json([
            'status' => 'Success',
            'result' => $request->state
                ? $request
                ->user()
                ->assignments()
                ->whereHas('assignmentStatus', function ($query) use ($request) {
                    $query->where('state', $request->state);
                })
                ->orderByDesc('deadline')
                ->paginate(30)
                : $request
                ->user()
                ->assignments()
                ->with('assignmentStatus')
                ->orderByDesc('deadline')
                ->paginate(30)
        ]);
    }

    public function classrooms(Request $request)
    {
        return response()->json([
            'status' => 'Success',
            'result' => $request
                ->user()
                ->classrooms()
                ->withCount([
                    'assignmentStatuses as uncompleted_assignments_count' => function ($query) use ($request) {
                        $query->where([
                            'user_id' => $request->user()->id,
                            'state' => 'UNCOMPLETED'
                        ]);
                    },
                    'assignmentStatuses as doing_assignments_count' => function ($query) use ($request) {
                        $query->where([
                            'user_id' => $request->user()->id,
                            'state' => 'DOING'
                        ]);
                    },
                    'assignmentStatuses as completed_assignments_count' => function ($query) use ($request) {
                        $query->where([
                            'user_id' => $request->user()->id,
                            'state' => 'COMPLETED'
                        ]);
                    }
                ])
                ->orderBy('name')
                ->paginate(30)
        ]);
    }

    public function notes(Request $request)
    {
        return response()->json([
            'status' => 'Success',
            'result' => $request
                ->user()
                ->notes()
                ->with('classroom')
                ->orderByDesc('updated_at')
                ->paginate(30)
        ]);
    }

    public function subjects(Request $request)
    {
        return response()->json([
            'status' => 'Success',
            'result' => $request
                ->user()
                ->subjects()
                ->with('classroom')
                ->withCount([
                    'assignmentStatuses as uncompleted_assignments_count' => function ($query) use ($request) {
                        $query->where([
                            'user_id' => $request->user()->id,
                            'state' => 'UNCOMPLETED'
                        ]);
                    },
                    'assignmentStatuses as doing_assignments_count' => function ($query) use ($request) {
                        $query->where([
                            'user_id' => $request->user()->id,
                            'state' => 'DOING'
                        ]);
                    },
                    'assignmentStatuses as completed_assignments_count' => function ($query) use ($request) {
                        $query->where([
                            'user_id' => $request->user()->id,
                            'state' => 'COMPLETED'
                        ]);
                    }
                ])
                ->orderBy('name')
                ->paginate(30)
        ]);
    }

    public function signUp(SignUpRequest $request)
    {
        $user = User::create($request->except('device'));

        return response()->json([
            'status' => 'Success',
            'result' => $user
                ->makeVisible('email')
                ->append('token')
        ], 201);
    }

    public function signIn(SignInRequest $request)
    {
        if (!Auth::attempt($request->except('device'))) {
            return response()->json([
                'status' => 'Failed',
                'message' => 'Unauthorized'
            ], 401);
        }

        return response()->json([
            'status' => 'Success',
            'result' => $request
                ->user()
                ->makeVisible('email')
                ->append('token')
        ]);
    }

    public function update(UpdateProfileRequest $request)
    {
        $request->user()->update($request->all());

        return response()->json([
            'status' => 'Success',
            'result' => $request
                ->user()
                ->makeVisible('email')
        ]);
    }

    public function changePassword(UpdatePasswordRequest $request)
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
