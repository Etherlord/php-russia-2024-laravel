<?php

declare(strict_types=1);

namespace App\Infrastructure\Jwt\TymonJWTAuthIntegration;

use Illuminate\Http\Request;
use Tymon\JWTAuth\Exceptions\JWTException;
use Tymon\JWTAuth\Facades\JWTAuth;

final readonly class JwtMiddleware
{
    public function handle(Request $request, \Closure $next): mixed
    {
        try {
            JWTAuth::parseToken()->authenticate();
        } catch (JWTException) {
            return response()->json(['error' => 'Token not valid'], 401);
        }

        return $next($request);
    }
}
