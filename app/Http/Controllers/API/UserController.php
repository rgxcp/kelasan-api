<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\ChangePasswordRequest;
use App\Http\Requests\SignInRequest;
use App\Http\Requests\SignUpRequest;
use App\Http\Requests\UpdateProfileRequest;
use App\Models\User;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function detail(Request $request)
    {
        return response()->json([
            'status' => 'Success',
            'result' => $request
                ->user()
                ->makeVisible('email')
                ->loadCount([
                    'assignmentStatuses as uncompleted_assignments_count' => function ($query) {
                        $query->where('state', 'UNCOMPLETED');
                    },
                    'assignmentStatuses as doing_assignments_count' => function ($query) {
                        $query->where('state', 'DOING');
                    },
                    'assignmentStatuses as completed_assignments_count' => function ($query) {
                        $query->where('state', 'COMPLETED');
                    }
                ])
        ]);
    }

    public function assignments(Request $request)
    {
        // TODO: Find a better solution
        if ($request->state != null && $request->state != 'UNCOMPLETED') {
            return response()->json([
                'status' => 'Success',
                'result' => $request
                    ->user()
                    ->assignments()
                    ->whereHas('assignmentStatus', function (Builder $query) use ($request) {
                        $query->where([
                            'user_id' => $request->user()->id,
                            'state' => $request->state
                        ]);
                    })
                    ->with([
                        'classroom',
                        'subject',
                        'user',
                        'assignmentStatus' => function ($query) use ($request) {
                            $query->where('user_id', $request->user()->id);
                        }
                    ])
                    ->orderBy('deadline')
                    ->paginate(30)
            ]);
        }

        return response()->json([
            'status' => 'Success',
            'result' => $request
                ->user()
                ->assignments()
                ->whereDoesntHave('assignmentStatus', function (Builder $query) use ($request) {
                    $query->where('user_id', $request->user()->id);
                })
                ->with([
                    'classroom',
                    'subject',
                    'user',
                    'assignmentStatus' => function ($query) use ($request) {
                        $query->where('user_id', $request->user()->id);
                    }
                ])
                ->orderBy('deadline')
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
                ->with('user')
                ->orderBy('name')
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
