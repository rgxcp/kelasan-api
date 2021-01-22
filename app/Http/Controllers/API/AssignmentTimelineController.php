<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Assignment;
use App\Models\AssignmentTimeline;
use App\Models\Classroom;

class AssignmentTimelineController extends Controller
{
    public function __invoke(Classroom $classroom, Assignment $assignment)
    {
        $timeline = AssignmentTimeline::with('user')
            ->where('assignment_id', $assignment->id)
            ->orderByDesc('id')
            ->paginate(30);

        return response()->json([
            'status' => 'Success',
            'result' => $timeline
        ]);
    }
}
