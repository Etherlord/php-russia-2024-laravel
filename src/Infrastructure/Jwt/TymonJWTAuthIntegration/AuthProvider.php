<?php

declare(strict_types=1);

namespace App\Infrastructure\Jwt\TymonJWTAuthIntegration;

use Tymon\JWTAuth\Contracts\Providers\Auth;

final class AuthProvider implements Auth
{
    public function byCredentials(array $credentials): bool
    {
        return true;
    }

    public function byId($id): bool
    {
        return true;
    }

    public function user(): User
    {
        return new User();
    }
}
