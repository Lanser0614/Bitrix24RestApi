<?php

declare(strict_types=1);

namespace Doniyor\Bitrix24\DTO\CRM;

use Doniyor\Bitrix24\DTO\AbstractFieldsDto;

/**
 * Strongly typed fields DTO for CRM leads.
 */
final class LeadFieldsDto extends AbstractFieldsDto
{
    /**
     * @param array<int, array<string, string>> $phones
     * @param array<int, array<string, string>> $emails
     * @param array<string, mixed> $extra
     */
    public function __construct(
        public readonly string $title,
        public readonly ?string $name = null,
        public readonly ?string $lastName = null,
        public readonly ?string $secondName = null,
        public readonly ?string $companyTitle = null,
        public readonly ?string $statusId = null,
        public readonly ?string $sourceId = null,
        public readonly ?int $assignedById = null,
        public readonly ?string $comments = null,
        public readonly array $phones = [],
        public readonly array $emails = [],
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
            'NAME' => $this->name,
            'LAST_NAME' => $this->lastName,
            'SECOND_NAME' => $this->secondName,
            'COMPANY_TITLE' => $this->companyTitle,
            'STATUS_ID' => $this->statusId,
            'SOURCE_ID' => $this->sourceId,
            'ASSIGNED_BY_ID' => $this->assignedById,
            'COMMENTS' => $this->comments,
        ];

        if ($this->phones !== []) {
            $fields['PHONE'] = $this->phones;
        }

        if ($this->emails !== []) {
            $fields['EMAIL'] = $this->emails;
        }

        return $this->finalizeFields($fields);
    }
}
