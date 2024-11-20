<?php

declare(strict_types=1);

use App\Feature\Job\Consumer\ConsumerCommand;
use App\Infrastructure\S3\Console\S3SetupCommand;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Foundation\Http\Middleware\ValidateCsrfToken;
use Illuminate\Session\Middleware\StartSession;
use Illuminate\View\Middleware\ShareErrorsFromSession;

$app = Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__ . '/../routes/web.php',
        commands: __DIR__ . '/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(static function (Middleware $middleware): void {
        $middleware->web(remove: [
            StartSession::class,
            ShareErrorsFromSession::class,
            ValidateCsrfToken::class,
        ]);
    })
    ->withExceptions(static function (Exceptions $exceptions): void {

    })
    ->withCommands([
        S3SetupCommand::class,
        ConsumerCommand::class,
    ])
    ->create()
;

$app->useAppPath($app->basePath('src'));

return $app;
