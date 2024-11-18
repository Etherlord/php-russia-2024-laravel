<?php

declare(strict_types=1);

namespace App\Infrastructure\S3\Console;

use App\Infrastructure\S3\Storage\S3FileStorage;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Config;

final class S3SetupCommand extends Command
{
    /**
     * @var string
     */
    protected $signature = 's3:setup';

    public function __construct(
        private readonly S3FileStorage $storage,
    ) {
        parent::__construct();
    }

    public function handle(): void
    {
        $bucketName = Config::get('app.s3-bucket-name');
        \assert(\is_string($bucketName));

        if (!$this->storage->isBucketExist($bucketName)) {
            $this->storage->createBucket($bucketName);
        }
    }
}
