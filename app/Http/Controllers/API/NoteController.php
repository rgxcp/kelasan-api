<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\CreateNoteRequest;
use App\Http\Requests\UpdateNoteRequest;
use App\Models\Classroom;
use App\Models\Note;

class NoteController extends Controller
{
    public function detail(Classroom $classroom, Note $note)
    {
        return response()->json([
            'status' => 'Success',
            'result' => $note
                ->load([
                    'user',
                    'noteAttachments.user'
                ])
        ]);
    }

    public function timelines(Classroom $classroom, Note $note)
    {
        return response()->json([
            'status' => 'Success',
            'result' => $note
                ->noteTimelines()
                ->with('user')
                ->orderByDesc('id')
                ->paginate(30)
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

    public function update(UpdateNoteRequest $request, Classroom $classroom, Note $note)
    {
        $note->update($request->all());

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
