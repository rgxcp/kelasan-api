<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Assignment;
use App\Models\AssignmentTimeline;
use App\Models\Classroom;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class AssignmentController extends Controller
{
    public function detail(Assignment $assignment)
    {
    }

    public function status()
    {
    }

    public function timeline()
    {
    }

    public function create(Request $request, $classroom_id)
    {
        $validator = Validator::make($request->all(), [
            'subject_id' => 'required|integer|exists:subjects,id',
            'detail' => 'required|string',
            'type' => 'in:INDIVIDUAL,GROUP',
            'start' => 'date',
            'deadline' => 'date|after:start'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'Failed',
                'reasons' => $validator->errors()
            ]);
        }

        $assignment = Assignment::create([
            'classroom_id' => $classroom_id,
            'subject_id' => $request->subject_id,
            'created_by' => $request->user()->id,
            'detail' => $request->detail,
            'type' => $request->type ?: 'INDIVIDUAL',
            'start' => $request->start,
            'deadline' => $request->deadline
        ]);

        AssignmentTimeline::create([
            'classroom_id' => $classroom_id,
            'assignment_id' => $assignment->id,
            'user_id' => $request->user()->id
        ]);

        return response()->json([
            'status' => 'Success',
            'result' => $assignment
        ]);
    }

    public function update(Request $request, Classroom $classroom, Assignment $assignment)
    {
        $belongToClass = $assignment->classroom_id == $classroom->id;

        if (!$belongToClass) {
            return response()->json([
                'status' => 'Failed',
                'reason' => 'Unauthorized'
            ]);
        }

        $validator = Validator::make($request->all(), [
            'subject_id' => 'required|integer|exists:subjects,id',
            'detail' => 'required|string',
            'type' => 'required|in:INDIVIDUAL,GROUP',
            'start' => 'date',
            'deadline' => 'date|after:start'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'Failed',
                'reasons' => $validator->errors()
            ]);
        }

        $assignment->update([
            'subject_id' => $request->subject_id,
            'created_by' => $request->user()->id,
            'detail' => $request->detail,
            'type' => $request->type,
            'start' => $request->start,
            'deadline' => $request->deadline
        ]);

        AssignmentTimeline::create([
            'classroom_id' => $classroom->id,
            'assignment_id' => $assignment->id,
            'user_id' => $request->user()->id,
            'type' => 'UPDATED'
        ]);

        return response()->json([
            'status' => 'Success',
            'result' => $assignment
        ]);
    }

    public function changeStatus()
    {
    }

    public function delete(Classroom $classroom, Assignment $assignment)
    {
        $belongToClass = $assignment->classroom_id == $classroom->id;

        if (!$belongToClass) {
            return response()->json([
                'status' => 'Failed',
                'reason' => 'Unauthorized'
            ]);
        }

        $assignment->delete();

        return response()->json([
            'status' => 'Success'
        ]);
    }
}
