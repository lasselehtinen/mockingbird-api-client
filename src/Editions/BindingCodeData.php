<?php

namespace Lasselehtinen\MockingbirdApiClient\Editions;

use Lasselehtinen\MockingbirdApiClient\Exceptions\UnsupportedBindingCode;
use Spatie\LaravelData\Data;

class BindingCodeData extends Data
{
    public function __construct(
        public string $id,
        public string $name,
        public string $onixCodelistValue,
    ) {}

    public static function fromApi(array $data): self
    {
        return new self(
            id: $data['id'],
            name: $data['name'],
            onixCodelistValue: match ($data['id']) {
                'BB' => 'BB',
                default => throw new UnsupportedBindingCode(
                    "Onix codelistmapping for binding code {$data['id']} does not exist"
                ),
            },
        );
    }
}
