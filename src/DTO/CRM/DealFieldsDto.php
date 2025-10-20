<?php

declare(strict_types=1);

namespace Codex\Bitrix24\DTO\CRM;

use Codex\Bitrix24\DTO\AbstractFieldsDto;

final class DealFieldsDto extends AbstractFieldsDto
{
    public function __construct(
        public readonly string $title,
        public readonly ?string $typeId = null,
        public readonly ?int $categoryId = null,
        public readonly ?string $stageId = null,
        public readonly ?float $opportunity = null,
        public readonly ?string $currencyId = null,
        public readonly ?int $assignedById = null,
        public readonly ?int $contactId = null,
        public readonly ?int $companyId = null,
        public readonly ?string $comments = null,
        public readonly ?string $beginDate = null,
        public readonly ?string $closeDate = null,
        public readonly ?string $sourceId = null,
        public readonly ?string $sourceDescription = null,
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
            'TITLE' => $this->title,
            'TYPE_ID' => $this->typeId,
            'CATEGORY_ID' => $this->categoryId,
            'STAGE_ID' => $this->stageId,
            'OPPORTUNITY' => $this->opportunity,
            'CURRENCY_ID' => $this->currencyId,
            'ASSIGNED_BY_ID' => $this->assignedById,
            'CONTACT_ID' => $this->contactId,
            'COMPANY_ID' => $this->companyId,
            'COMMENTS' => $this->comments,
            'BEGINDATE' => $this->beginDate,
            'CLOSEDATE' => $this->closeDate,
            'SOURCE_ID' => $this->sourceId,
            'SOURCE_DESCRIPTION' => $this->sourceDescription,
        ];

        return $this->finalizeFields($fields);
    }
}
