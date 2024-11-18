<?php

declare(strict_types=1);

namespace App\Http\ApiV1\UploadFile;

use App\Infrastructure\S3\Command\UploadFileToS3Handler;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use Illuminate\Routing\Controller;

final class UploadFileController extends Controller
{
    public function __construct(
        private readonly UploadFileToS3Handler $uploadFileToS3Handler,
    ) {
    }

    public function __invoke(Request $request): JsonResponse
    {
        $file = $request->file('file');
        \assert($file instanceof UploadedFile);

        return new JsonResponse([
            'url' => $this->uploadFileToS3Handler->handle($file),
        ]);
    }
}
