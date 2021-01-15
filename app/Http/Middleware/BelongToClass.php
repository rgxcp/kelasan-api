<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class BelongToClass
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
        $resource = $request->route()->parameterNames[1];
        $belongToClass = $request->$resource->classroom_id == $request->classroom->id;

        if (!$belongToClass) {
            return response()->json([
                'status' => 'Failed',
                'reason' => 'Unauthorized'
            ]);
        }

        return $next($request);
    }
}
