<?php

namespace App\Http\Middleware;

use App\Models\ClassMember;
use Closure;
use Illuminate\Http\Request;

class ClassroomMember
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
        $classMember = ClassMember::where([
            'classroom_id' => $request->route('classroom_id'),
            'user_id' => $request->user()->id
        ])->exists();

        if (!$classMember) {
            return response()->json([
                'status' => 'Failed',
                'reason' => 'Unauthorized'
            ]);
        }

        return $next($request);
    }
}
