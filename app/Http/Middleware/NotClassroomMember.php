<?php

namespace App\Http\Middleware;

use App\Models\ClassMember;
use App\Models\Classroom;
use Closure;
use Illuminate\Http\Request;

class NotClassroomMember
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
        $classroom = Classroom::where('invitation_code', $request->invitation_code)->firstOrFail();

        $classMember = ClassMember::where([
            'classroom_id' => $classroom->id,
            'user_id' => $request->user()->id
        ])->exists();

        if ($classMember) {
            return response()->json([
                'status' => 'Failed',
                'reason' => 'Already Class Member'
            ]);
        }

        return $next($request->merge([
            'classroom_id' => $classroom->id
        ]));
    }
}
