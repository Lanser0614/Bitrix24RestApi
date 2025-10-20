<?php

declare(strict_types=1);

namespace Doniyor\Bitrix24\DTO\CRM\Response;

use Doniyor\Bitrix24\DTO\AbstractResponseDto;

final class ProductData extends AbstractResponseDto
{
    /**
     * @param array<string, mixed> $extra
     */
    public function __construct(
        public readonly int $id,
        public readonly string $name,
        public readonly ?float $price = null,
        public readonly ?string $currencyId = null,
        public readonly ?int $sectionId = null,
        public readonly ?bool $active = null,
        array $extra = [],
    ) {
        parent::__construct($extra);
    }
}
