<?php

namespace Lasselehtinen\MockingbirdApiClient\Editions;

use Spatie\LaravelData\Attributes\Computed;
use Spatie\LaravelData\Data;

class SeasonData extends Data
{
    #[Computed]
    public string $name;

    public function __construct(
        public ?int $year,
        public ?string $period,
    ) {
        $this->name = match (true) {
            $this->year === null => null,
            $this->period === null => $this->year,
            $this->period === 'Spring' => "{$this->year}/1",
            $this->period === 'Autumn' => "{$this->year}/2",
            default => "{$this->year}/{$this->period}",
        };
    }
}
