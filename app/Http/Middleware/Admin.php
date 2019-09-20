<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class Admin
{
    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (Auth::user()->is_admin == 0) {
            return response()->json([
                "code"    => 403,
                "message" => "你不是管理员",
                "data"    => [],
            ], 403);
        }

        return $next($request);
    }
}
