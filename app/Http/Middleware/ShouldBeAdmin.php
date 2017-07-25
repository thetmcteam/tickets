<?php

namespace App\Http\Middleware;

use Closure;

class ShouldBeAdmin
{
    public function handle($request, Closure $next)
    {
        if ($request->user()->isAdmin()) {
            return $next($request);
        }

        if ($request->ajax()) {
            return response('Unauthorized.', 401);
        }

        return redirect()->route('tickets');
    }
}
