<?php

use Lasselehtinen\MockingbirdApiClient\Editions\AwardData;
use Lasselehtinen\MockingbirdApiClient\Editions\ContributorData;
use Lasselehtinen\MockingbirdApiClient\Editions\ContributorRoleData;
use Lasselehtinen\MockingbirdApiClient\Editions\EditionService;
use Lasselehtinen\MockingbirdApiClient\Editions\LanguageData;
use Lasselehtinen\MockingbirdApiClient\Editions\PriceData;
use Lasselehtinen\MockingbirdApiClient\Editions\TextData;
use Lasselehtinen\MockingbirdApiClient\MockingbirdApiClient;
use Spatie\LaravelData\DataCollection;

it('can authenticate and fetch token from the API', function () {
    $client = app(MockingbirdApiClient::class);
    $reflection = new ReflectionClass($client);
    $method = $reflection->getMethod('accessToken');

    $token = $method->invoke($client);

    expect($token)
        ->toBeString()
        ->not->toBeEmpty();
})->group('integration');

it('can fetch edition data correctly', function () {
    $edition = app(EditionService::class)->get('1ca73850-96c2-4ac3-8b98-44d35c9378d1');

    expect($edition->id)->toBe('1ca73850-96c2-4ac3-8b98-44d35c9378d1');
    expect($edition->legacyId)->toBeInt()->toBe(244940);
    expect($edition->title)->toBe('Murtuneet mielet');
    expect($edition->gtin)->toBeInt()->toBe(9789510374665);
    expect($edition->bindingCode->id)->toBe('BB');
    expect($edition->bindingCode->name)->toBe('Hardback');
    expect($edition->bindingCode->onixCodelistValue)->toBe('BB');
    expect($edition->brand)->toBe('WSOY');
    expect($edition->costCenter->id)->toBeInt()->toBe(313);
    expect($edition->costCenter->name)->toBe('WSOY - Tietokirjat');
    expect($edition->governingCode)->toBe('Sold out');
    expect($edition->keywords)->toContain('traumat', 'mielenterveys');

    expect($edition->awards)->toBeInstanceOf(DataCollection::class)
        ->and($edition->awards)->toHaveCount(1)
        ->and($edition->awards->first())->toBeInstanceOf(AwardData::class)
        ->and($edition->awards->first()->name)->toBe('Tieto-Finlandia-palkinto');

    expect($edition->contributors)->toBeInstanceOf(DataCollection::class)
        ->and($edition->contributors)->toHaveCount(5)
        ->and($edition->contributors->first())->toBeInstanceOf(ContributorData::class)
        ->and($edition->contributors->first()->firstName)->toBe('Anssi')
        ->and($edition->contributors->first()->lastName)->toBe('Mäkinen')
        ->and($edition->contributors->first()->fullName)->toBe('Anssi Mäkinen')
        ->and($edition->contributors->first()->role)->toBeInstanceOf(ContributorRoleData::class)
        ->and($edition->contributors->first()->role->name)->toBe('Project Manager')
        ->and($edition->contributors->first()->role->id)->toBeInt()->toBe(326);

    expect($edition->languages)->toBeInstanceOf(DataCollection::class)
        ->and($edition->languages)->toHaveCount(1)
        ->and($edition->languages->first())->toBeInstanceOf(LanguageData::class)
        ->and($edition->languages->first()->iso639LanguageCode)->toBe('fin')
        ->and($edition->languages->first()->name)->toBe('Finnish');

    expect($edition->mainGroup->name)->toBe('Tietokirjallisuus');
    expect($edition->mainGroup->id)->toBeInt()->toBe(7);
    expect($edition->subGroup->name)->toBe('Historia');
    expect($edition->subGroup->id)->toBeInt()->toBe(4);
    expect($edition->depth)->toBeFloat()->toBe(37.0000);
    expect($edition->height)->toBeFloat()->toBe(218.0000);
    expect($edition->weight)->toBeFloat()->toBe(0.6150);
    expect($edition->width)->toBeFloat()->toBe(140.000);
    expect($edition->originalLanguages)->toBeEmpty();
    expect($edition->pages)->toBeInt()->toBe(475);

    expect($edition->prices)->toBeInstanceOf(DataCollection::class)
        ->and($edition->prices)->toHaveCount(4)
        ->and($edition->prices->first())->toBeInstanceOf(PriceData::class)
        ->and($edition->prices->first()->value)->toBeFloat()->toBe(41.32)
        ->and($edition->prices->first()->currency)->toBe('EUR')
        ->and($edition->prices->first()->type)->toBe('PublisherRetailPrice')
        ->and($edition->prices->first()->onixCodelistValue)->toBe('41');

    expect($edition->textAndDataMiningProhibited)->toBeFalse();
    expect($edition->publishingDate->format('Y-m-d'))->toBe('2013-08-15');
    expect($edition->publishingHouse)->toBe('WSOY');

    expect($edition->season->period)->toBe('Autumn');
    expect($edition->season->year)->toBeInt()->toBe(2013);

    expect($edition->stockBalance)->toBe(0);
    expect($edition->technicalProductionTypeName)->toBe('BBF Generic');

    expect($edition->vatPercentage)->toBeFloat()->toBe(0.1350);

    expect($edition->texts)->toBeInstanceOf(DataCollection::class)
        ->and($edition->texts)->toHaveCount(4)
        ->and($edition->texts->first())->toBeInstanceOf(TextData::class)
        ->and($edition->texts->first()->text)->toContain('Aseiden vaiettua moni veteraani heräsi öisiin painajaisiinsa.');

})->group('integration');
