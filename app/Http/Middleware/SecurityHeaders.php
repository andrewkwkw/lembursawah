<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class SecurityHeaders
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $response = $next($request);

        if (method_exists($response, 'header')) {
            if (app()->environment('production')) {
                $response->header('Content-Security-Policy', "default-src 'self'; script-src 'self' 'unsafe-inline' 'unsafe-eval' https://unpkg.com; style-src 'self' 'unsafe-inline' https://fonts.googleapis.com; font-src 'self' data: https://fonts.gstatic.com; img-src 'self' data: blob: https:; frame-src https://www.google.com; connect-src 'self';");
            } else {
                $response->header('Content-Security-Policy', "default-src 'self' 'unsafe-inline' 'unsafe-eval' blob: http://localhost:* ws://localhost:* http://127.0.0.1:* ws://127.0.0.1:* https://unpkg.com https://fonts.googleapis.com https://fonts.gstatic.com data: https:;");
            }
            
            $response->header('X-Content-Type-Options', 'nosniff');
            $response->header('X-Frame-Options', 'SAMEORIGIN');
            $response->header('X-XSS-Protection', '1; mode=block');
        }

        return $response;
    }
}
