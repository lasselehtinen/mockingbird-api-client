<?php

namespace Lasselehtinen\MockingbirdApiClient\Editions;

use Spatie\LaravelData\Data;

class TextData extends Data
{
    public function __construct(
        public string $text,
    ) {}
}
