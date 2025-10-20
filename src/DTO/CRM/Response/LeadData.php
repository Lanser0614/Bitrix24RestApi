<?php

declare(strict_types=1);

namespace Doniyor\Bitrix24\DTO\CRM\Response;

use Doniyor\Bitrix24\DTO\AbstractResponseDto;

/**
 * @phpstan-type MultiField array<int, array{value: string, type: string}>
 */
final class LeadData extends AbstractResponseDto
{
    /**
     * @param MultiField $phones
     * @param MultiField $emails
     * @param array<string, mixed> $extra
     */
    public function __construct(
        public readonly int $id,
        public readonly string $title,
        public readonly ?string $name = null,
        public readonly ?string $lastName = null,
        public readonly ?string $statusId = null,
        public readonly ?string $sourceId = null,
        public readonly ?int $assignedById = null,
        public readonly array $phones = [],
        public readonly array $emails = [],
        array $extra = [],
    ) {
        parent::__construct($extra);
    }
}
