<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\ChangeAssignmentStatusRequest;
use App\Models\Assignment;
use App\Models\AssignmentStatus;
use App\Models\Classroom;

class AssignmentStatusController extends Controller
{
    public function __invoke(ChangeAssignmentStatusRequest $request, Classroom $classroom, Assignment $assignment)
    {
        $assignmentStatus = AssignmentStatus::where([
            'classroom_id' => $classroom->id,
            'assignment_id' => $assignment->id
        ])->first();

        if (!$assignmentStatus && $request->state != 'UNCOMPLETED') {
            AssignmentStatus::create($request->all());
        }

        if ($assignmentStatus && $request->state != 'UNCOMPLETED') {
            $assignmentStatus->update($request->all());
        }

        if ($assignmentStatus) {
            $assignmentStatus->forceDelete();
        }

        return response()->json([
            'status' => 'Success'
        ]);
    }
}
