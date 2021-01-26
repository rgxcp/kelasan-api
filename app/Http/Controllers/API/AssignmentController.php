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
            'result' => $assignment
                ->load([
                    'subject',
                    'createdBy',
                    'assignmentAttachments.uploadedBy'
                ])
                ->loadCount([
                    'assignmentStatuses as uncompleted_class_members_count' => function ($query) {
                        $query->where('state', 'UNCOMPLETED');
                    },
                    'assignmentStatuses as doing_class_members_count' => function ($query) {
                        $query->where('state', 'DOING');
                    },
                    'assignmentStatuses as completed_class_members_count' => function ($query) {
                        $query->where('state', 'COMPLETED');
                    }
                ])
        ]);
    }

    public function status(Classroom $classroom, Assignment $assignment)
    {
    }

    public function timelines(Classroom $classroom, Assignment $assignment)
    {
        return response()->json([
            'status' => 'Success',
            'result' => $assignment
                ->assignmentTimelines()
                ->with('user')
                ->orderByDesc('id')
                ->paginate(30)
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

    public function update(UpdateAssignmentRequest $request, Classroom $classroom, Assignment $assignment)
    {
        $assignment->update($request->all());

        return response()->json([
            'status' => 'Success',
            'result' => $assignment
        ]);
    }

    public function delete(Classroom $classroom, Assignment $assignment)
    {
        $assignment->delete();

        return response()->json([
            'status' => 'Success'
        ]);
    }
}
