<?php

declare(strict_types=1);

use App\Http\ApiV1\UploadFile\UploadFileController;
use App\Http\ApiV1\Welcome\WelcomeController;
use Illuminate\Support\Facades\Route;

Route::get('/', static fn() => view('welcome'));
Route::get('/api/v1/welcome', WelcomeController::class);
Route::post('/api/v1/upload-file', UploadFileController::class);
