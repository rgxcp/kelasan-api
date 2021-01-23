<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\CreateAssignmentRequest;
use App\Http\Requests\UpdateAssignmentRequest;
use App\Models\Assignment;
use App\Models\Classroom;

class AssignmentController extends Controller
{
    public function detail(Classroom $classroom, Assignment $assignment)
    {
        return response()->json([
            'status' => 'Success',
            'result' => $assignment->load([
                'subject',
                'createdBy',
                'assignmentAttachments.uploadedBy'
            ])->append([
                'total_uncompleted_member',
                'total_doing_member',
                'total_completed_member'
            ])
        ]);
    }

    public function status()
    {
    }

    public function create(CreateAssignmentRequest $request, Classroom $classroom)
    {
        $assignment = Assignment::create($request->all());

        return response()->json([
            'status' => 'Success',
            'result' => $assignment
        ], 201);
    }

    public function update(UpdateAssignmentRequest $request, Classroom $classroom, Assignment $assignment)
    {
        $assignment->update($request->all());

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
