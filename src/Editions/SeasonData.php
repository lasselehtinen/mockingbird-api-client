<?php

namespace Lasselehtinen\MockingbirdApiClient\Editions;

use Spatie\LaravelData\Data;

class SeasonData extends Data
{
    public function __construct(
        public int $year,
        public string $period,
    ) {}
}
