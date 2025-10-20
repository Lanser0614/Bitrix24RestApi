<?php

declare(strict_types=1);

namespace Doniyor\Bitrix24\DTO\CRM;

use Doniyor\Bitrix24\DTO\AbstractFieldsDto;

final class CurrencyFieldsDto extends AbstractFieldsDto
{
    public function __construct(
        public readonly string $currency,
        public readonly ?float $amount = null,
        public readonly ?int $amountCnt = null,
        public readonly ?bool $base = null,
        public readonly ?int $sort = null,
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
            'CURRENCY' => $this->currency,
            'AMOUNT' => $this->amount,
            'AMOUNT_CNT' => $this->amountCnt,
            'BASE' => $this->base,
            'SORT' => $this->sort,
        ];

        return $this->finalizeFields($fields);
    }
}
