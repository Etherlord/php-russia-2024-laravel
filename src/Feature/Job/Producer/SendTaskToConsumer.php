<?php

declare(strict_types=1);

namespace App\Feature\Job\Producer;

use Illuminate\Support\Facades\Config;
use Spiral\Goridge\RPC\RPC;
use Spiral\RoadRunner\Jobs\Exception\JobsException;
use Spiral\RoadRunner\Jobs\Jobs;

final readonly class SendTaskToConsumer
{
    /**
     * @throws JobsException
     */
    public function handle(string $message): void
    {
        $rrRpc = Config::get('app.rr-rpc');
        \assert(\is_string($rrRpc) && $rrRpc !== '');
        $rrJobQueue = Config::get('app.rr-job-queue');
        \assert(\is_string($rrJobQueue) && $rrJobQueue !== '');

        $jobs = new Jobs(RPC::create($rrRpc));
        $queue = $jobs->connect($rrJobQueue);
        $task = $queue->create(
            name: 'ping',
            payload: $message,
        );

        $queue->dispatch($task);
    }
}
