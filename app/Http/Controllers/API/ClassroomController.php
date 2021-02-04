<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\CreateClassroomRequest;
use App\Http\Requests\JoinClassroomRequest;
use App\Http\Requests\RenameClassroomRequest;
use App\Models\Classroom;
use App\Models\ClassroomUser;
use Illuminate\Http\Request;

class ClassroomController extends Controller
{
    public function detail(Classroom $classroom)
    {
        return response()->json([
            'status' => 'Success',
            'result' => $classroom
                ->load('user')
                ->loadCount([
                    'assignments',
                    'classroomUsers',
                    'notes',
                    'subjects'
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
            'result' => $classroom
                ->assignments()
                ->with([
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

    public function notes(Classroom $classroom)
    {
        return response()->json([
            'status' => 'Success',
            'result' => $classroom
                ->notes()
                ->with('user')
                ->orderByDesc('updated_at')
                ->paginate(30)
        ]);
    }

    public function subjects(Classroom $classroom)
    {
        return response()->json([
            'status' => 'Success',
            'result' => $classroom
                ->subjects()
                ->with('user')
                ->withCount('assignments')
                ->orderBy('name')
                ->paginate(30)
        ]);
    }

    public function users(Classroom $classroom)
    {
        return response()->json([
            'status' => 'Success',
            'result' => $classroom
                ->classroomUsers()
                ->with('user')
                ->paginate(30)
        ]);
    }

    public function create(CreateClassroomRequest $request)
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

        ClassroomUser::firstOrCreate([
            'classroom_id' => $classroom->id,
            'user_id' => $request->user()->id
        ]);

        return response()->json([
            'status' => 'Success'
        ]);
    }

    public function rename(RenameClassroomRequest $request, Classroom $classroom)
    {
        $classroom->update($request->all());

        return response()->json([
            'status' => 'Success',
            'result' => $classroom
        ]);
    }
}
