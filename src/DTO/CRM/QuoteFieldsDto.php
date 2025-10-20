<?php

declare(strict_types=1);

namespace Doniyor\Bitrix24\DTO\CRM;

use Doniyor\Bitrix24\DTO\AbstractFieldsDto;

final class QuoteFieldsDto extends AbstractFieldsDto
{
    public function __construct(
        public readonly string $title,
        public readonly ?int $dealId = null,
        public readonly ?int $contactId = null,
        public readonly ?int $companyId = null,
        public readonly ?float $opportunity = null,
        public readonly ?string $currencyId = null,
        public readonly ?string $comments = null,
        public readonly ?string $statusId = null,
        public readonly ?string $stageId = null,
        public readonly ?string $beginDate = null,
        public readonly ?string $closeDate = null,
        public readonly ?int $assignedById = null,
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
            'DEAL_ID' => $this->dealId,
            'CONTACT_ID' => $this->contactId,
            'COMPANY_ID' => $this->companyId,
            'OPPORTUNITY' => $this->opportunity,
            'CURRENCY_ID' => $this->currencyId,
            'COMMENTS' => $this->comments,
            'STATUS_ID' => $this->statusId,
            'STAGE_ID' => $this->stageId,
            'BEGINDATE' => $this->beginDate,
            'CLOSEDATE' => $this->closeDate,
            'ASSIGNED_BY_ID' => $this->assignedById,
        ];

        return $this->finalizeFields($fields);
    }
}
