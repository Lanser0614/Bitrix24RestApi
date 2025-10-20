<?php

declare(strict_types=1);

namespace Doniyor\Bitrix24\DTO\CRM\Response;

use Doniyor\Bitrix24\DTO\AbstractResponseDto;

final class InvoiceData extends AbstractResponseDto
{
    /**
     * @param array<string, mixed> $extra
     */
    public function __construct(
        public readonly int $id,
        public readonly string $orderTopic,
        public readonly ?string $statusId = null,
        public readonly ?float $price = null,
        public readonly ?string $currency = null,
        public readonly ?int $responsibleId = null,
        public readonly ?int $dealId = null,
        public readonly ?int $contactId = null,
        public readonly ?int $companyId = null,
        array $extra = [],
    ) {
        parent::__construct($extra);
    }
}
