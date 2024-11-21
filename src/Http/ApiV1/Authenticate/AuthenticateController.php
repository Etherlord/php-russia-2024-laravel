<?php

declare(strict_types=1);

namespace App\Http\ApiV1\Authenticate;

use App\Feature\Authenticate\Authenticate;
use Illuminate\Http\JsonResponse;
use Illuminate\Routing\Controller;

final class AuthenticateController extends Controller
{
    public function __invoke(): JsonResponse
    {
        return new JsonResponse((new Authenticate())->handle());
    }
}
