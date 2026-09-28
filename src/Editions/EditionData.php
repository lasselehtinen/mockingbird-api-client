<?php

namespace Lasselehtinen\MockingbirdApiClient\Editions;

use Carbon\Carbon;
use Exception;
use Lasselehtinen\MockingbirdApiClient\Casts\NonEmptyTextsCast;
use Spatie\LaravelData\Attributes\Computed;
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

        #[MapInputName('ean')]
        public ?int $gtin,

        #[MapInputName('publishingHouse.name')]
        public string $publishingHouse,

        #[MapInputName('brand.name')]
        public string $brand,

        public BindingCodeData $bindingCode,

        #[DataCollectionOf(ContributorData::class)]
        public DataCollection $contributors,

        public CostCenterData $costCenter,

        public ?SeasonData $season,

        #[MapInputName('governingCode.name')]
        public string $governingCode,

        #[DataCollectionOf(AwardData::class)]
        public DataCollection $awards,

        public array $keywords,

        public ?MainGroupData $mainGroup,

        #[MapInputName('subgroup')]
        public ?SubGroupData $subGroup,

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

        public ?int $pages,

        #[DataCollectionOf(PriceData::class)]
        public DataCollection $prices,

        #[MapInputName('prohibitTextAndDataMining')]
        public bool $textAndDataMiningProhibited,

        #[WithCast(DateTimeInterfaceCast::class, format: 'Y-m-d\TH:i:s')]
        public Carbon $publishingDate,

        public ?int $stockBalance,

        public ?string $technicalProductionTypeName,

        #[MapInputName('vat')]
        public float $vatPercentage,

        #[WithCast(NonEmptyTextsCast::class)]
        #[DataCollectionOf(TextData::class)]
        public DataCollection $texts,

        #[Computed]
        public ?string $internalTitle,
        /** TODO
         *
         * assets
         */
    ) {
        $this->internalTitle = $this->resolveInternalTitle();
    }

    private function resolveInternalTitle(): string
    {
        $bindingCodeMapping = [
            'Podcast' => 'podcast',
            'Hardback' => 'kirja',
            'Saddle-stitched' => 'kirja',
            'Paperback' => 'kirja',
            'Spiral bound' => 'kirja',
            'Flex' => 'kirja',
            'Pocket book' => 'pokkari',
            'Trade paperback or "Jättipokkari"' => 'kirja',
            'Board book' => 'kirja',
            'Downloadable audio file' => 'ä-kirja',
            'CD' => 'cd',
            'MP3-CD' => 'cd',
            'Other audio format' => 'muu audio',
            'Picture-and-audio book' => 'kä-kirja',
            'ePub2' => 'e-kirja',
            'ePub3' => 'e-kirja',
            'Application' => 'sovellus',
            'Kit' => 'paketti',
            'Miscellaneous' => 'muu',
            'Pre-recorded digital audio player' => 'kirjastosoitin',
            'PDF' => 'pdf',
            'Calendar (Hardback)' => 'kalenteri',
            'Calendar (Paperback)' => 'kalenteri',
            'Calendar (Other)' => 'kalenteri',
            'Marketing material' => 'mark. materiaali',
            'Multiple-component retail product' => 'moniosainen',
        ];

        if (array_key_exists($this->bindingCode->name, $bindingCodeMapping) === false) {
            throw new Exception('Could not map binding code for internal title. Binding code: '.$this->bindingCode->name);
        }

        $format = $bindingCodeMapping[$this->bindingCode->name];

        /*
        if (isset($this->product->activePrint->ebookHasAudioFile) && $this->product->activePrint->ebookHasAudioFile === true) {
            $format = 'eä-kirja';
        }*/

        // Space reserved for format + one space
        $spaceForFormat = mb_strlen($format) + 1;

        return trim(mb_substr($this->title, 0, 50 - $spaceForFormat)).' '.$format;
    }
}
