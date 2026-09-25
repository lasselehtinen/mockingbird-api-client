<?php

namespace Lasselehtinen\MockingbirdApiClient\Editions;

use Lasselehtinen\MockingbirdApiClient\MockingbirdApiClient;

class EditionService
{
    public function __construct(
        protected MockingbirdApiClient $client,
    ) {}

    public function get(string $id): EditionData
    {
        $response = $this->client->get(
            "/v1/Edition/{$id}"
        );

        return EditionData::from($response);
    }
}
