<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\CreateNoteRequest;
use App\Models\Classroom;
use App\Models\Note;
use App\Models\NoteTimeline;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class NoteController extends Controller
{
    public function detail(Classroom $classroom, Note $note)
    {
        return response()->json([
            'status' => 'Success',
            'result' => $note->load([
                'createdBy'
            ])
        ]);
    }

    public function timeline(Classroom $classroom, Note $note)
    {
        $timeline = NoteTimeline::with('user')
            ->where('note_id', $note->id)
            ->orderByDesc('id')
            ->paginate(30);

        return response()->json([
            'status' => 'Success',
            'result' => $timeline
        ]);
    }

    public function create(CreateNoteRequest $request, Classroom $classroom)
    {
        $note = Note::create($request->all());

        return response()->json([
            'status' => 'Success',
            'result' => $note
        ], 201);
    }

    public function update(Request $request, Classroom $classroom, Note $note)
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
        $note->delete();

        return response()->json([
            'status' => 'Success'
        ]);
    }
}
