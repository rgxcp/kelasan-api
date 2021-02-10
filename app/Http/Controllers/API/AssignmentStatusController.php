<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\UpdateAssignmentStatusRequest;
use App\Models\Assignment;
use App\Models\Classroom;

class AssignmentStatusController extends Controller
{
    public function __invoke(UpdateAssignmentStatusRequest $request, Classroom $classroom, Assignment $assignment)
    {
        $assignment->assignmentStatus()->update($request->all());

        return response()->json([
            'status' => 'Success'
        ]);
    }
}
