<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\CreateAssignmentRequest;
use App\Models\Assignment;
use App\Models\AssignmentTimeline;
use App\Models\Classroom;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class AssignmentController extends Controller
{
    public function detail(Classroom $classroom, Assignment $assignment)
    {
        return response()->json([
            'status' => 'Success',
            'result' => $assignment->load([
                'subject.createdBy', 'createdBy'
            ])
        ]);
    }

    public function status()
    {
    }

    public function timeline(Classroom $classroom, Assignment $assignment)
    {
        $timeline = AssignmentTimeline::with('user')
            ->where('assignment_id', $assignment->id)
            ->orderByDesc('id')
            ->paginate(30);

        return response()->json([
            'status' => 'Success',
            'result' => $timeline
        ]);
    }

    public function create(CreateAssignmentRequest $request, Classroom $classroom)
    {
        $assignment = Assignment::create($request->all());

        return response()->json([
            'status' => 'Success',
            'result' => $assignment
        ], 201);
    }

    public function update(Request $request, Classroom $classroom, Assignment $assignment)
    {
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
        $assignment->delete();

        return response()->json([
            'status' => 'Success'
        ]);
    }
}
