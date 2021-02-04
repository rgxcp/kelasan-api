<?php

namespace App\Http\Middleware;

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
        $classroomLeader = $request->classroom->user_id == $request->user()->id;

        if (!$classroomLeader) {
            return response()->json([
                'status' => 'Failed',
                'message' => 'Forbidden'
            ], 403);
        }

        return $next($request);
    }
}
