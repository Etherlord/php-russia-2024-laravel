<?php

declare(strict_types=1);

namespace App\Http\ApiV1\SendTaskToConsumer;

use App\Feature\Job\Producer\SendTaskToConsumer;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Spiral\RoadRunner\Jobs\Exception\JobsException;

final class SendTaskToConsumerController extends Controller
{
    /**
     * @throws JobsException
     */
    public function __invoke(Request $request): JsonResponse
    {
        $request->validate([
            'message' => 'required|alpha:ascii',
        ]);

        $message = $request->post('message');
        \assert(\is_string($message));

        (new SendTaskToConsumer())->handle($message);

        return new JsonResponse();
    }
}
