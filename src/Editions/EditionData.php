<?php

namespace Lasselehtinen\MockingbirdApiClient\Editions;

use Carbon\Carbon;
use Lasselehtinen\MockingbirdApiClient\Casts\NonEmptyTextsCast;
use Spatie\LaravelData\Attributes\DataCollectionOf;
use Spatie\LaravelData\Attributes\MapInputName;
use Spatie\LaravelData\Attributes\WithCast;
use Spatie\LaravelData\Casts\DateTimeInterfaceCast;
use Spatie\LaravelData\Data;
use Spatie\LaravelData\DataCollection;

class EditionData extends Data
{
    public function __construct(
        #[MapInputName('productId')]
        public string $id,

        #[MapInputName('editionIdLegacy')]
        public int $legacyId,

        #[MapInputName('Title')]
        public string $title,

        #[MapInputName('Ean')]
        public int $ean,

        #[MapInputName('publishingHouse.name')]
        public string $publishingHouse,

        #[MapInputName('brand.name')]
        public string $brand,

        public BindingCodeData $bindingCode,

        #[DataCollectionOf(ContributorData::class)]
        public DataCollection $contributors,

        public CostCenterData $costCenter,

        public SeasonData $season,

        #[MapInputName('governingCode.name')]
        public string $governingCode,

        #[DataCollectionOf(AwardData::class)]
        public DataCollection $awards,

        public array $keywords,

        #[MapInputName('mainGroup.name')]
        public string $mainGroup,

        #[MapInputName('subgroup.name')]
        public string $subGroup,

        #[MapInputName('measurements.depth')]
        public float $depth,

        #[MapInputName('measurements.height')]
        public float $height,

        #[MapInputName('measurements.weight')]
        public float $weight,

        #[MapInputName('measurements.width')]
        public float $width,

        #[DataCollectionOf(LanguageData::class)]
        public DataCollection $languages,

        #[DataCollectionOf(LanguageData::class)]
        public DataCollection $originalLanguages,

        public int $pages,

        #[DataCollectionOf(PriceData::class)]
        public DataCollection $prices,

        #[MapInputName('prohibitTextAndDataMining')]
        public bool $textAndDataMiningProhibited,

        #[WithCast(DateTimeInterfaceCast::class, format: 'Y-m-d\TH:i:s')]
        public Carbon $publishingDate,

        public int $stockBalance,

        public string $technicalProductionTypeName,

        #[MapInputName('vat')]
        public float $vatPercentage,

        #[WithCast(NonEmptyTextsCast::class)]
        #[DataCollectionOf(TextData::class)]
        public DataCollection $texts,

        /** TODO
         *
         * assets
         */
    ) {}
}
