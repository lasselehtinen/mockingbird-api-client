<?php

namespace Lasselehtinen\MockingbirdApiClient\Editions;

use Spatie\LaravelData\Data;

class ContributorRoleData extends Data
{
    public function __construct(
        public int $id,
        public string $name,
    ) {}
}
