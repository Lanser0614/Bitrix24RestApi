<?php

declare(strict_types=1);

namespace Doniyor\Bitrix24\DTO\CRM\Response;

use Doniyor\Bitrix24\DTO\AbstractResponseDto;

final class DealData extends AbstractResponseDto
{
    /**
     * @param array<string, mixed> $extra
     */
    public function __construct(
        public readonly int $id,
        public readonly string $title,
        public readonly ?string $stageId = null,
        public readonly ?float $opportunity = null,
        public readonly ?string $currencyId = null,
        public readonly ?int $categoryId = null,
        public readonly ?int $contactId = null,
        public readonly ?int $companyId = null,
        public readonly ?int $assignedById = null,
        array $extra = [],
    ) {
        parent::__construct($extra);
    }
}
