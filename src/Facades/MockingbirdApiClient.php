<?php

namespace Lasselehtinen\MockingbirdApiClient\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @see \Lasselehtinen\MockingbirdApiClient\MockingbirdApiClient
 */
class MockingbirdApiClient extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return \Lasselehtinen\MockingbirdApiClient\MockingbirdApiClient::class;
    }
}
