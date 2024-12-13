<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EnsureWebNoneAuth
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // redirect to bpard if user's has logged in
        $session = $request->session();
        if (!$session->has("user_id")) {
            return $next($request);
        }
        return redirect()->intended("board");
    }
}
