<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\CreateClassroomRequest;
use App\Http\Requests\JoinClassroomRequest;
use App\Models\Assignment;
use App\Models\ClassMember;
use App\Models\Classroom;
use App\Models\Note;
use App\Models\Subject;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ClassroomController extends Controller
{
    public function detail(Classroom $classroom)
    {
        return response()->json([
            'status' => 'Success',
            'result' => $classroom->load([
                'leader'
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
        $assignments = Assignment::with([
            'createdBy', 'subject'
        ])->where('classroom_id', $classroom->id)
            ->orderBy('deadline')
            ->paginate(30);

        return response()->json([
            'status' => 'Success',
            'result' => $assignments
        ]);
    }

    public function members(Classroom $classroom)
    {
        $members = ClassMember::with('user')
            ->where('classroom_id', $classroom->id)
            ->paginate(30);

        return response()->json([
            'status' => 'Success',
            'result' => $members
        ]);
    }

    public function notes(Classroom $classroom)
    {
        $notes = Note::with('createdBy')
            ->where('classroom_id', $classroom->id)
            ->orderByDesc('updated_at')
            ->paginate(30);

        return response()->json([
            'status' => 'Success',
            'result' => $notes
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

    public function rename(Request $request, Classroom $classroom)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:20'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'Failed',
                'reasons' => $validator->errors()
            ]);
        }

        $classroom->update([
            'name' => $request->name
        ]);

        return response()->json([
            'status' => 'Success',
            'result' => $classroom
        ]);
    }
}
