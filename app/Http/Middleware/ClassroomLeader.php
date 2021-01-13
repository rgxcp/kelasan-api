<?php

namespace App\Http\Middleware;

use App\Models\Classroom;
use Closure;
use Illuminate\Http\Request;

class ClassroomLeader
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        $classroom = Classroom::findOrFail($request->route('classroom_id'));

        $classLeader = $classroom->leader == $request->user()->id;

        if (!$classLeader) {
            return response()->json([
                'status' => 'Failed',
                'reason' => 'Unauthorized'
            ]);
        }

        return $next($request->merge([
            'classroom' => $classroom
        ]));
    }
}
