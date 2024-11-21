<?php

declare(strict_types=1);

namespace App\Feature\Authenticate;

use App\Infrastructure\Jwt\TymonJWTAuthIntegration\User;
use Tymon\JWTAuth\Facades\JWTAuth;

final readonly class Authenticate
{
    public function handle(): string
    {
        return JWTAuth::fromUser(
            new User(),
        );
    }
}
