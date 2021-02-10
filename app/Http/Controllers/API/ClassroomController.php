<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\JoinClassroomRequest;
use App\Http\Requests\StoreClassroomRequest;
use App\Http\Requests\UpdateClassroomRequest;
use App\Models\Classroom;
use Illuminate\Http\Request;

class ClassroomController extends Controller
{
    public function show(Request $request, Classroom $classroom)
    {
        return response()->json([
            'status' => 'Success',
            'result' => $classroom
                ->load('user')
                ->loadCount([
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
                    },
                    'notes',
                    'subjects',
                    'users'
                ])
        ]);
    }

    public function invitationCode(Classroom $classroom)
    {
        return response()->json([
            'status' => 'Success',
            'result' => $classroom->only('invitation_code')
        ]);
    }

    public function assignments(Request $request, Classroom $classroom)
    {
        return response()->json([
            'status' => 'Success',
            'result' => $request->state
                ? $classroom
                ->assignments()
                ->whereHas('assignmentStatus', function ($query) use ($request) {
                    $query->where('state', $request->state);
                })
                ->orderByDesc('deadline')
                ->paginate(30)
                : $classroom
                ->assignments()
                ->with('assignmentStatus')
                ->orderByDesc('deadline')
                ->paginate(30)
        ]);
    }

    public function notes(Classroom $classroom)
    {
        return response()->json([
            'status' => 'Success',
            'result' => $classroom
                ->notes()
                ->orderByDesc('updated_at')
                ->paginate(30)
        ]);
    }

    public function subjects(Request $request, Classroom $classroom)
    {
        return response()->json([
            'status' => 'Success',
            'result' => $classroom
                ->subjects()
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

    public function users(Classroom $classroom)
    {
        return response()->json([
            'status' => 'Success',
            'result' => $classroom
                ->users()
                ->orderBy('pivot_role')
                ->orderBy('full_name')
                ->paginate(30)
        ]);
    }

    public function store(StoreClassroomRequest $request)
    {
        $classroom = Classroom::create($request->all());

        return response()->json([
            'status' => 'Success',
            'result' => $classroom->makeVisible('invitation_code')
        ], 201);
    }

    public function join(JoinClassroomRequest $request)
    {
        $classroom = Classroom::firstWhere('invitation_code', $request->invitation_code);

        $classroom->classroomUsers()->firstOrCreate([
            'user_id' => $request->user()->id
        ]);

        return response()->json([
            'status' => 'Success',
            'result' => $classroom
        ]);
    }

    public function update(UpdateClassroomRequest $request, Classroom $classroom)
    {
        $classroom->update($request->all());

        return response()->json([
            'status' => 'Success',
            'result' => $classroom
        ]);
    }

    public function destroy(Classroom $classroom)
    {
        $classroom->delete();

        return response()->json([
            'status' => 'Success'
        ]);
    }
}
