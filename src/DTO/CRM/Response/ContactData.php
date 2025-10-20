<?php

declare(strict_types=1);

namespace Doniyor\Bitrix24\DTO\CRM\Response;

use Doniyor\Bitrix24\DTO\AbstractResponseDto;

/**
 * @phpstan-type MultiField array<int, array{value: string, type: string}>
 */
final class ContactData extends AbstractResponseDto
{
    /**
     * @param MultiField $phones
     * @param MultiField $emails
     * @param MultiField $ims
     * @param MultiField $web
     * @param array<string, mixed> $extra
     */
    public function __construct(
        public readonly int $id,
        public readonly string $name,
        public readonly ?string $lastName = null,
        public readonly ?string $secondName = null,
        public readonly ?string $post = null,
        public readonly ?int $assignedById = null,
        public readonly ?int $companyId = null,
        public readonly array $phones = [],
        public readonly array $emails = [],
        public readonly array $ims = [],
        public readonly array $web = [],
        array $extra = [],
    ) {
        parent::__construct($extra);
    }
}
