<?php

namespace App\Http\Middleware;

use Closure;
use Auth;
use response;
use Illuminate\Http\Request;

class Roles
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        $user = Auth::user();
        if ($user->role == 'admin'){
            return $next($request);
        }

        return $this->unauthorized();
    }

    private function unauthorized($message = null){
        // return response()->json([
        //     'message' => $message ? $message : 'You are unauthorized to access this resource',
        //     'success' => false
        // ], 401);
        return response(view('admin.errorPages.403'));
    }
}
