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
        $classLeader = $request->classroom->leader
            == $request->user()->id;

        if (!$classLeader) {
            return response()->json([
                'status' => 'Failed',
                'reason' => 'Forbidden'
            ], 403);
        }

        return $next($request);
    }
}
