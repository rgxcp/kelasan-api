<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Classroom;
use App\Models\Note;
use App\Models\NoteTimeline;

class NoteTimelineController extends Controller
{
    public function __invoke(Classroom $classroom, Note $note)
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
}
