<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\CreateSubjectRequest;
use App\Models\Assignment;
use App\Models\Classroom;
use App\Models\Subject;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

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

    public function rename(Request $request, Classroom $classroom, Subject $subject)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:50'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'Failed',
                'reasons' => $validator->errors()
            ]);
        }

        $subject->update([
            'name' => $request->name
        ]);

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
