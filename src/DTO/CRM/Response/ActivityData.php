<?php

declare(strict_types=1);

namespace Doniyor\Bitrix24\DTO\CRM\Response;

use Doniyor\Bitrix24\DTO\AbstractResponseDto;

final class ActivityData extends AbstractResponseDto
{
    /**
     * @param array<int, array<string, mixed>> $communications
     * @param array<string, mixed> $extra
     */
    public function __construct(
        public readonly int $id,
        public readonly string $subject,
        public readonly ?string $typeId = null,
        public readonly ?string $providerId = null,
        public readonly ?bool $completed = null,
        public readonly ?int $responsibleId = null,
        public readonly ?int $ownerId = null,
        public readonly ?string $ownerTypeId = null,
        public readonly ?string $startTime = null,
        public readonly ?string $endTime = null,
        public readonly ?string $direction = null,
        public readonly array $communications = [],
        array $extra = [],
    ) {
        parent::__construct($extra);
    }
}
