<?php

namespace App\Http\Middleware;

use Closure;
use Session;

class UnAuthorized
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (!session::has('user_account')) {
            return redirect('/');
        }
        return $next($request);
    }
}
