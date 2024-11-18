<?php

declare(strict_types=1);

namespace App\Infrastructure\S3;

use App\Infrastructure\S3\Command\UploadFileToS3Handler;
use App\Infrastructure\S3\Storage\S3FileStorage;
use Aws\S3\S3Client;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\ServiceProvider;
use Psr\Container\ContainerExceptionInterface;
use Psr\Container\NotFoundExceptionInterface;

final class S3ServiceProvider extends ServiceProvider
{
    /**
     * @throws ContainerExceptionInterface
     * @throws NotFoundExceptionInterface
     */
    public function register(): void
    {
        $httpVerifyS3 = true;

        if (Config::get('app.env') === 'local') {
            $httpVerifyS3 = false;
        }

        $this->app->singleton(S3Client::class, static fn(Application $_app) => new S3Client([
            'region' => Config::get('app.s3-region'),
            'endpoint' => Config::get('app.s3-endpoint'),
            'use_path_style_endpoint' => true,
            'credentials' => [
                'key' => Config::get('app.s3-user'),
                'secret' => Config::get('app.s3-password'),
            ],
            'http' => [
                'verify' => $httpVerifyS3,
            ],
        ]));

        $s3Client = $this->app->get(S3Client::class);
        \assert($s3Client instanceof S3Client);
        $this->app->singleton(S3FileStorage::class, static fn(Application $_app) => new S3FileStorage($s3Client));
        $s3FileStorage = $this->app->get(S3FileStorage::class);
        \assert($s3FileStorage instanceof S3FileStorage);
        $this->app->singleton(UploadFileToS3Handler::class, static fn(Application $_app) => new UploadFileToS3Handler($s3FileStorage));
    }
}
