<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\CreateClassroomRequest;
use App\Http\Requests\JoinClassroomRequest;
use App\Http\Requests\RenameClassroomRequest;
use App\Models\ClassMember;
use App\Models\Classroom;
use App\Models\Subject;

class ClassroomController extends Controller
{
    public function detail(Classroom $classroom)
    {
        return response()->json([
            'status' => 'Success',
            'result' => $classroom->load('leader')->append([
                'total_assignment',
                'total_class_member',
                'total_note',
                'total_subject'
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

    public function assignments(Classroom $classroom)
    {
        return response()->json([
            'status' => 'Success',
            'result' => $classroom
                ->assignments()
                ->with(['createdBy', 'subject'])
                ->orderBy('deadline')
                ->paginate(30)
        ]);
    }

    public function members(Classroom $classroom)
    {
        return response()->json([
            'status' => 'Success',
            'result' => $classroom
                ->classMembers()
                ->with('user')
                ->paginate(30)
        ]);
    }

    public function notes(Classroom $classroom)
    {
        return response()->json([
            'status' => 'Success',
            'result' => $classroom
                ->notes()
                ->with('createdBy')
                ->orderByDesc('updated_at')
                ->paginate(30)
        ]);
    }

    public function subjects(Classroom $classroom)
    {
        $subjects = Subject::with('createdBy')
            ->where('classroom_id', $classroom->id)
            ->orderBy('name')
            ->paginate(30);

        return response()->json([
            'status' => 'Success',
            'result' => $subjects
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

        ClassMember::firstOrCreate([
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
