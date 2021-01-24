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

        !$assignmentStatus
            ? AssignmentStatus::create($request->all())
            : $assignmentStatus->update($request->all());

        return response()->json([
            'status' => 'Success'
        ]);
    }
}
