<?php

declare(strict_types=1);

namespace App\Feature\Welcome;

use Illuminate\Support\Facades\Config;

final readonly class GetWelcomeMessage
{
    public function handle(): string
    {
        return Config::get('app.welcome-message');
    }
}
