<?php

declare(strict_types=1);

namespace App\Infrastructure\S3\Command;

use App\Infrastructure\S3\Storage\S3FileStorage;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Config;

final readonly class UploadFileToS3
{
    public function __construct(
        private S3FileStorage $storage,
    ) {
    }

    public function handle(UploadedFile $file): string
    {
        $bucketName = Config::get('app.s3-bucket-name');
        \assert(\is_string($bucketName));

        $this->storage->upload(
            bucket: $bucketName,
            filename: $file->getClientOriginalName(),
            fileContent: $file->getContent(),
        );

        return $this
            ->storage
            ->getPermanentDownloadUrl($bucketName, $file->getClientOriginalName())
            ?? 'file not found'
        ;
    }
}
