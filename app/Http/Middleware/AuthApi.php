<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Symfony\Component\HttpFoundation\Response;

class AuthApi
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $credentials = config('admin_credentials');

        $authHeader = $request->header('Authorization');


        if (!$authHeader || !preg_match('/Basic\s+(.*)$/i', $authHeader, $matches)) {
            return response()->json(['message' => 'Unauthorized'], 401, ['WWW-Authenticate' => 'Basic']);
        }

        [$username, $password] = explode(':', base64_decode($matches[1]), 2);

        if (!isset($credentials[$username]) || !Hash::check($password, $credentials[$username])) {
            return response()->json(['message' => 'Unauthorized'], 401, ['WWW-Authenticate' => 'Basic']);
        }

        return $next($request);
    }
}
