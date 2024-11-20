<?php

declare(strict_types=1);

namespace App\Feature\Job\Consumer;

use Illuminate\Console\Command;
use Psr\Log\LoggerInterface;
use Spiral\RoadRunner\Jobs\Consumer;
use Spiral\RoadRunner\Jobs\Exception\ReceivedTaskException;
use Spiral\RoadRunner\Jobs\Exception\SerializationException;
use Spiral\RoadRunner\Jobs\Task\ReceivedTaskInterface;

final class ConsumerCommand extends Command
{
    /**
     * @var string
     */
    protected $signature = 'consume';

    public function __construct(
        private readonly LoggerInterface $logger,
    ) {
        parent::__construct();
    }

    /**
     * @throws SerializationException
     * @throws ReceivedTaskException
     */
    public function handle(): void
    {
        $consumer = new Consumer();

        /** @var ReceivedTaskInterface $task */
        while ($task = $consumer->waitTask()) {
            try {
                $name = $task->getName();
                $payload = $task->getPayload();

                match ($name) {
                    'ping' => $this->logger->info(\sprintf('PONG = %s', $payload)),
                    default => $this->logger->info('Unknown command')
                };

                $task->ack();
            } catch (\Throwable $e) {
                $task->requeue($e);
            }
        }
    }
}
