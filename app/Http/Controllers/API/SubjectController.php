<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreSubjectRequest;
use App\Http\Requests\UpdateSubjectRequest;
use App\Models\Classroom;
use App\Models\Subject;
use Illuminate\Http\Request;

class SubjectController extends Controller
{
    public function show(Request $request, Classroom $classroom, Subject $subject)
    {
        $subject->classroom = $classroom;

        return response()->json([
            'status' => 'Success',
            'result' => $subject
                ->load('user')
                ->loadCount([
                    'assignmentStatuses as uncompleted_assignments_count' => function ($query) use ($request) {
                        $query->where([
                            'user_id' => $request->user()->id,
                            'state' => 'UNCOMPLETED'
                        ]);
                    },
                    'assignmentStatuses as doing_assignments_count' => function ($query) use ($request) {
                        $query->where([
                            'user_id' => $request->user()->id,
                            'state' => 'DOING'
                        ]);
                    },
                    'assignmentStatuses as completed_assignments_count' => function ($query) use ($request) {
                        $query->where([
                            'user_id' => $request->user()->id,
                            'state' => 'COMPLETED'
                        ]);
                    }
                ])
        ]);
    }

    public function assignments(Request $request, Classroom $classroom, Subject $subject)
    {
        return response()->json([
            'status' => 'Success',
            'result' => $request->state
                ? $subject
                ->assignments()
                ->whereHas('assignmentStatus', function ($query) use ($request) {
                    $query->where('state', $request->state);
                })
                ->orderByDesc('deadline')
                ->paginate(30)
                : $subject
                ->assignments()
                ->with('assignmentStatus')
                ->orderByDesc('deadline')
                ->paginate(30)
        ]);
    }

    public function store(StoreSubjectRequest $request, Classroom $classroom)
    {
        $subject = $classroom->subjects()->firstOrCreate($request->all());

        return response()->json([
            'status' => 'Success',
            'result' => $subject
        ], 201);
    }

    public function update(UpdateSubjectRequest $request, Classroom $classroom, Subject $subject)
    {
        $subject->update($request->all());

        return response()->json([
            'status' => 'Success',
            'result' => $subject
        ]);
    }

    public function destroy(Classroom $classroom, Subject $subject)
    {
        $subject->delete();

        return response()->json([
            'status' => 'Success'
        ]);
    }
}
