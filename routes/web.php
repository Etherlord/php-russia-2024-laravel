<?php

declare(strict_types=1);

use App\Http\ApiV1\Authenticate\AuthenticateController;
use App\Http\ApiV1\SendTaskToConsumer\SendTaskToConsumerController;
use App\Http\ApiV1\UploadFile\UploadFileController;
use App\Http\ApiV1\Welcome\WelcomeController;
use App\Infrastructure\Jwt\TymonJWTAuthIntegration\JwtMiddleware;
use Illuminate\Support\Facades\Route;

Route::get('/', static fn() => view('welcome'));
Route::get('/api/v1/welcome', WelcomeController::class);
Route::post('/api/v1/authenticate', AuthenticateController::class);

Route::middleware([JwtMiddleware::class])->group(static function (): void {
    Route::post('/api/v1/upload-file', UploadFileController::class);
    Route::post('/api/v1/send-task-to-consumer', SendTaskToConsumerController::class);
});
