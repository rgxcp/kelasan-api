<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreNoteRequest;
use App\Http\Requests\UpdateNoteRequest;
use App\Models\Classroom;
use App\Models\Note;

class NoteController extends Controller
{
    public function show(Classroom $classroom, Note $note)
    {
        $note->classroom = $classroom;

        return response()->json([
            'status' => 'Success',
            'result' => $note->load([
                'user',
                'noteImages.user'
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

    public function store(StoreNoteRequest $request, Classroom $classroom)
    {
        $note = $classroom->notes()->create($request->except('images'));

        return response()->json([
            'status' => 'Success',
            'result' => $request->hasFile('images')
                ? $note->load('noteImages')
                : $note
        ], 201);
    }

    public function update(UpdateNoteRequest $request, Classroom $classroom, Note $note)
    {
        $note->update($request->except('images'));

        return response()->json([
            'status' => 'Success',
            'result' => $request->hasFile('images')
                ? $note->load('noteImages')
                : $note
        ]);
    }

    public function destroy(Classroom $classroom, Note $note)
    {
        $note->delete();

        return response()->json([
            'status' => 'Success'
        ]);
    }
}
