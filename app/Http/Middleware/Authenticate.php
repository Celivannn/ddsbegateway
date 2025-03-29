<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Contracts\Auth\Factory as Auth;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Log;

class Authenticate
{
    protected $auth;

    public function __construct(Auth $auth)
    {
        $this->auth = $auth;
    }

    public function handle($request, Closure $next, $guard = null)
    {
        // Log Authorization Header
        Log::info('Received Authorization Header:', [
            'Authorization' => $request->header('Authorization') ?? 'None'
        ]);

        // Check if Authorization Header is missing
        if (!$request->hasHeader('Authorization')) {
            Log::warning('Unauthorized request - No Authorization header found.');
            return response()->json(['error' => 'Unauthorized - No Authorization header'], 401);
        }

        // Check if user is authenticated using Laravel's guard
        if ($this->auth->guard($guard)->guest()) {
            Log::warning('Unauthorized request - Invalid token.');
            return response()->json(['error' => 'Unauthorized - Invalid token'], 401);
        }

        return $next($request);
    }
}
