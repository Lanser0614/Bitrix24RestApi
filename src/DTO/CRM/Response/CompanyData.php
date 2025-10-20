<?php

declare(strict_types=1);

namespace Doniyor\Bitrix24\DTO\CRM\Response;

use Doniyor\Bitrix24\DTO\AbstractResponseDto;

/**
 * @phpstan-type MultiField array<int, array{value: string, type: string}>
 */
final class CompanyData extends AbstractResponseDto
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
        public readonly string $title,
        public readonly ?string $companyType = null,
        public readonly ?string $industry = null,
        public readonly ?string $rating = null,
        public readonly ?float $revenue = null,
        public readonly ?string $currencyId = null,
        public readonly ?int $assignedById = null,
        public readonly array $phones = [],
        public readonly array $emails = [],
        public readonly array $ims = [],
        public readonly array $web = [],
        array $extra = [],
    ) {
        parent::__construct($extra);
    }
}
