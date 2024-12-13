<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Models\Users;

class EnsureWebAuth
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // redirect to login if user's has not logged in
        $session = $request->session();
        if ($session->has("user_id")) {
            $user = Users::where("id", $session->get("user_id"))->get();
            if ($user && $user->count() == 1) {
                return $next($request);
            }
            // user has been deleted
            $session->session()->invalidate();
        }
        return redirect()->intended("login");
    }
}
