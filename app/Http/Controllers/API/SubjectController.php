<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Classroom;
use App\Models\Subject;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class SubjectController extends Controller
{
    public function detail(Subject $subject)
    {
    }

    public function assignments()
    {
    }

    public function create(Request $request, $classroom_id)
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

        $subject = Subject::create([
            'classroom_id' => $classroom_id,
            'created_by' => $request->user()->id,
            'name' => $request->name
        ]);

        return response()->json([
            'status' => 'Success',
            'result' => $subject
        ]);
    }

    public function rename(Request $request, Classroom $classroom, Subject $subject)
    {
        $belongToClass = $subject->classroom_id == $classroom->id;

        if (!$belongToClass) {
            return response()->json([
                'status' => 'Failed',
                'reason' => 'Unauthorized'
            ]);
        }

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
        $belongToClass = $subject->classroom_id == $classroom->id;

        if (!$belongToClass) {
            return response()->json([
                'status' => 'Failed',
                'reason' => 'Unauthorized'
            ]);
        }

        $subject->delete();

        return response()->json([
            'status' => 'Success'
        ]);
    }
}
