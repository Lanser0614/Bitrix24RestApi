<?php

declare(strict_types=1);

namespace Doniyor\Bitrix24\DTO\CRM\Response;

use Doniyor\Bitrix24\DTO\AbstractResponseDto;

final class RequisiteData extends AbstractResponseDto
{
    /**
     * @param array<string, mixed> $address
     * @param array<string, mixed> $extra
     */
    public function __construct(
        public readonly int $id,
        public readonly int $entityTypeId,
        public readonly int $entityId,
        public readonly int $presetId,
        public readonly string $name,
        public readonly ?bool $active = null,
        public readonly ?string $rqInn = null,
        public readonly ?string $rqOgrn = null,
        public readonly ?string $rqKpp = null,
        public readonly ?string $rqCompanyName = null,
        public readonly array $address = [],
        array $extra = [],
    ) {
        parent::__construct($extra);
    }
}
