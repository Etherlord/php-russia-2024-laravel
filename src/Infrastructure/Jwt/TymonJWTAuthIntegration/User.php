<?php

declare(strict_types=1);

namespace App\Infrastructure\Jwt\TymonJWTAuthIntegration;

use Tymon\JWTAuth\Contracts\JWTSubject;

final class User implements JWTSubject
{
    public function getJWTIdentifier(): string
    {
        return 'api';
    }

    public function getJWTCustomClaims(): array
    {
        return [];
    }
}
