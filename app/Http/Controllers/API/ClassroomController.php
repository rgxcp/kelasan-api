<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
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

    public function assignments()
    {
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

    public function create(Request $request)
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

        $randomString = bin2hex(random_bytes(5));
        $invitationCode = substr($randomString, 0, 3)
            . '-'
            . substr($randomString, 3, 4)
            . '-'
            . substr($randomString, 7, 3);

        $classroom = Classroom::create([
            'leader' => $request->user()->id,
            'name' => $request->name,
            'invitation_code' => $invitationCode
        ])->makeVisible('invitation_code');

        $classMember = ClassMember::create([
            'classroom_id' => $classroom->id,
            'user_id' => $classroom->leader,
            'role' => 'LEADER'
        ]);

        $collection = collect([
            'classroom' => $classroom,
            'class_member' => $classMember
        ]);

        return response()->json([
            'status' => 'Success',
            'result' => $collection
        ]);
    }

    public function join(Request $request)
    {
        $classMember = ClassMember::create([
            'classroom_id' => $request->classroom_id,
            'user_id' => $request->user()->id,
            'role' => 'STUDENT'
        ]);

        return response()->json([
            'status' => 'Success',
            'result' => $classMember
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
