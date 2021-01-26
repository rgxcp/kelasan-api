<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\CreateSubjectRequest;
use App\Http\Requests\RenameSubjectRequest;
use App\Models\Classroom;
use App\Models\Subject;
use Illuminate\Http\Request;

class SubjectController extends Controller
{
    public function detail(Classroom $classroom, Subject $subject)
    {
        return response()->json([
            'status' => 'Success',
            'result' => $subject
                ->load('createdBy')
                ->loadCount('assignments')
        ]);
    }

    public function assignments(Request $request, Classroom $classroom, Subject $subject)
    {
        return response()->json([
            'status' => 'Success',
            'result' => $subject
                ->assignments()
                ->with([
                    'createdBy',
                    'assignmentStatus' => function ($query) use ($request) {
                        $query->where('user_id', $request->user()->id);
                    }
                ])
                ->orderBy('deadline')
                ->paginate(30)
        ]);
    }

    public function create(CreateSubjectRequest $request, Classroom $classroom)
    {
        $subject = Subject::firstOrCreate($request->all());

        return response()->json([
            'status' => 'Success',
            'result' => $subject
        ], 201);
    }

    public function rename(RenameSubjectRequest $request, Classroom $classroom, Subject $subject)
    {
        $subject->update($request->all());

        return response()->json([
            'status' => 'Success',
            'result' => $subject
        ]);
    }

    public function delete(Classroom $classroom, Subject $subject)
    {
        $subject->delete();

        return response()->json([
            'status' => 'Success'
        ]);
    }
}
