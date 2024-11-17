<?php

declare(strict_types=1);

namespace App\Http\ApiV1\Welcome;

use App\Feature\Welcome\GetWelcomeMessage;
use Illuminate\Http\JsonResponse;
use Illuminate\Routing\Controller;

final class WelcomeController extends Controller
{
    public function __invoke(): JsonResponse
    {
        return new JsonResponse((new GetWelcomeMessage())->handle());
    }
}
