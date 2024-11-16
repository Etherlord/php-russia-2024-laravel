<?php

declare(strict_types=1);

use ComposerUnused\ComposerUnused\Configuration\Configuration;
use ComposerUnused\ComposerUnused\Configuration\NamedFilter;

return static fn(Configuration $config): Configuration => $config
    ->addNamedFilter(NamedFilter::fromString('laravel/octane'))
    ->addNamedFilter(NamedFilter::fromString('spiral/roadrunner-cli'))
    ->addNamedFilter(NamedFilter::fromString('spiral/roadrunner-http'))
;
