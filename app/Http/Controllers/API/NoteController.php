<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Classroom;
use App\Models\Note;
use App\Models\NoteTimeline;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class NoteController extends Controller
{
    public function detail(Note $note)
    {
    }

    public function timeline()
    {
    }

    public function create(Request $request, $classroom_id)
    {
        $validator = Validator::make($request->all(), [
            'detail' => 'required|string'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'Failed',
                'reasons' => $validator->errors()
            ]);
        }

        $note = Note::create([
            'classroom_id' => $classroom_id,
            'created_by' => $request->user()->id,
            'detail' => $request->detail
        ]);

        NoteTimeline::create([
            'classroom_id' => $classroom_id,
            'note_id' => $note->id,
            'user_id' => $request->user()->id
        ]);

        return response()->json([
            'status' => 'Success',
            'result' => $note
        ]);
    }

    public function update(Request $request, Classroom $classroom, Note $note)
    {
        $belongToClass = $note->classroom_id == $classroom->id;

        if (!$belongToClass) {
            return response()->json([
                'status' => 'Failed',
                'reason' => 'Unauthorized'
            ]);
        }

        $validator = Validator::make($request->all(), [
            'detail' => 'required|string'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'Failed',
                'reasons' => $validator->errors()
            ]);
        }

        $note->update([
            'detail' => $request->detail
        ]);

        NoteTimeline::create([
            'classroom_id' => $classroom->id,
            'note_id' => $note->id,
            'user_id' => $request->user()->id,
            'type' => 'UPDATED'
        ]);

        return response()->json([
            'status' => 'Success',
            'result' => $note
        ]);
    }

    public function delete(Classroom $classroom, Note $note)
    {
        $belongToClass = $note->classroom_id == $classroom->id;

        if (!$belongToClass) {
            return response()->json([
                'status' => 'Failed',
                'reason' => 'Unauthorized'
            ]);
        }

        $note->delete();

        return response()->json([
            'status' => 'Success'
        ]);
    }
}
