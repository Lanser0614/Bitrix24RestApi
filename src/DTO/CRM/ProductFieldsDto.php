<?php

declare(strict_types=1);

namespace Doniyor\Bitrix24\DTO\CRM;

use Doniyor\Bitrix24\DTO\AbstractFieldsDto;

final class ProductFieldsDto extends AbstractFieldsDto
{
    public function __construct(
        public readonly string $name,
        public readonly ?bool $active = null,
        public readonly ?float $price = null,
        public readonly ?string $currencyId = null,
        public readonly ?int $sectionId = null,
        public readonly ?string $description = null,
        public readonly ?int $sort = null,
        public readonly ?int $measure = null,
        public readonly ?string $vatId = null,
        public readonly ?bool $vatIncluded = null,
        public readonly ?string $xmlId = null,
        array $extra = [],
    ) {
        parent::__construct($extra);
    }

    /**
     * @return array<string, mixed>
     */
    public function toArray(): array
    {
        $fields = [
            'NAME' => $this->name,
            'ACTIVE' => $this->active,
            'PRICE' => $this->price,
            'CURRENCY_ID' => $this->currencyId,
            'SECTION_ID' => $this->sectionId,
            'DESCRIPTION' => $this->description,
            'SORT' => $this->sort,
            'MEASURE' => $this->measure,
            'VAT_ID' => $this->vatId,
            'VAT_INCLUDED' => $this->vatIncluded,
            'XML_ID' => $this->xmlId,
        ];

        return $this->finalizeFields($fields);
    }
}
