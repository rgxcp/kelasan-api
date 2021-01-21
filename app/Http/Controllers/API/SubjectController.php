<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\CreateSubjectRequest;
use App\Http\Requests\RenameSubjectRequest;
use App\Models\Assignment;
use App\Models\Classroom;
use App\Models\Subject;

class SubjectController extends Controller
{
    public function detail(Classroom $classroom, Subject $subject)
    {
        return response()->json([
            'status' => 'Success',
            'result' => $subject->load([
                'createdBy'
            ])
        ]);
    }

    public function assignments(Classroom $classroom, Subject $subject)
    {
        $assignments = Assignment::with([
            'createdBy', 'subject'
        ])->where([
            'classroom_id' => $classroom->id,
            'subject_id' => $subject->id
        ])->orderBy('deadline')
            ->paginate(30);

        return response()->json([
            'status' => 'Success',
            'result' => $assignments
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
