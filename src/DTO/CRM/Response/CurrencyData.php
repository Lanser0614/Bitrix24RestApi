<?php

declare(strict_types=1);

namespace Doniyor\Bitrix24\DTO\CRM\Response;

use Doniyor\Bitrix24\DTO\AbstractResponseDto;

final class CurrencyData extends AbstractResponseDto
{
    /**
     * @param array<string, mixed> $extra
     */
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
}
