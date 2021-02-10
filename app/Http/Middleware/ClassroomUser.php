<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class ClassroomUser
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
        $classroomUser = $request
            ->classroom
            ->classroomUsers()
            ->where('user_id', $request->user()->id)
            ->exists();

        if (!$classroomUser) {
            return response()->json([
                'status' => 'Failed',
                'message' => 'Forbidden'
            ], 403);
        }

        return $next($request);
    }
}
