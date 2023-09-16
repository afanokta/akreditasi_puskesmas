<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class isVerifyEmail
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (Auth::user()->email_verified_at == null) {
            return response()->json([
                'status' => 403,
                'message' => 'email anda harus diverifikasi'
            ], 403);
        }
        return $next($request);
    }
}
