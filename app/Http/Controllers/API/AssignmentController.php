<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreAssignmentRequest;
use App\Http\Requests\UpdateAssignmentRequest;
use App\Models\Assignment;
use App\Models\Classroom;
use Illuminate\Http\Request;

class AssignmentController extends Controller
{
    public function show(Classroom $classroom, Assignment $assignment)
    {
        $assignment->classroom = $classroom;

        return response()->json([
            'status' => 'Success',
            'result' => $assignment
                ->load([
                    'subject',
                    'user',
                    'assignmentStatus',
                    'assignmentImages.user'
                ])
                ->loadCount([
                    'assignmentStatuses as uncompleted_users_count' => function ($query) {
                        $query->where('state', 'UNCOMPLETED');
                    },
                    'assignmentStatuses as doing_users_count' => function ($query) {
                        $query->where('state', 'DOING');
                    },
                    'assignmentStatuses as completed_users_count' => function ($query) {
                        $query->where('state', 'COMPLETED');
                    }
                ])
        ]);
    }

    public function statuses(Request $request, Classroom $classroom, Assignment $assignment)
    {
        return response()->json([
            'status' => 'Success',
            'result' => $request->state
                ? $assignment
                ->assignmentStatuses()
                ->where('state', $request->state)
                ->with('user')
                ->orderByDesc('updated_at')
                ->paginate(30)
                : $assignment
                ->assignmentStatuses()
                ->with('user')
                ->orderBy('state')
                ->orderByDesc('updated_at')
                ->paginate(30)
        ]);
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

    public function store(StoreAssignmentRequest $request, Classroom $classroom)
    {
        $assignment = $classroom->assignments()->create($request->except('images'));

        return response()->json([
            'status' => 'Success',
            'result' => $request->hasFile('images')
                ? $assignment->load('assignmentImages')
                : $assignment
        ], 201);
    }

    public function update(UpdateAssignmentRequest $request, Classroom $classroom, Assignment $assignment)
    {
        $assignment->update($request->except('images'));

        return response()->json([
            'status' => 'Success',
            'result' => $request->hasFile('images')
                ? $assignment->load('assignmentImages')
                : $assignment
        ]);
    }

    public function destroy(Classroom $classroom, Assignment $assignment)
    {
        $assignment->delete();

        return response()->json([
            'status' => 'Success'
        ]);
    }
}
