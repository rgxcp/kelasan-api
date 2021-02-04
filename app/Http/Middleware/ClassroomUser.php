<?php

namespace App\Http\Middleware;

use App\Models\ClassroomUser as ClassroomUserModel;
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
        $classroomUser = ClassroomUserModel::where([
            'classroom_id' => $request->classroom->id,
            'user_id' => $request->user()->id
        ])->exists();

        if (!$classroomUser) {
            return response()->json([
                'status' => 'Failed',
                'reason' => 'Forbidden'
            ], 403);
        }

        return $next($request);
    }
}
