<?php

declare(strict_types=1);

namespace Codex\Bitrix24\DTO\CRM;

use Codex\Bitrix24\DTO\AbstractFieldsDto;

final class CompanyFieldsDto extends AbstractFieldsDto
{
    /**
     * @param array<int, array<string, string>> $phones
     * @param array<int, array<string, string>> $emails
     * @param array<int, array<string, string>> $ims
     * @param array<int, array<string, string>> $web
     * @param array<string, mixed> $extra
     */
    public function __construct(
        public readonly string $title,
        public readonly ?string $companyType = null,
        public readonly ?string $industry = null,
        public readonly ?string $rating = null,
        public readonly ?string $currencyId = null,
        public readonly ?float $revenue = null,
        public readonly ?string $employees = null,
        public readonly ?int $assignedById = null,
        public readonly ?string $comments = null,
        public readonly ?string $address = null,
        public readonly ?string $address2 = null,
        public readonly ?string $addressCity = null,
        public readonly ?string $addressRegion = null,
        public readonly ?string $addressProvince = null,
        public readonly ?string $addressCountry = null,
        public readonly array $phones = [],
        public readonly array $emails = [],
        public readonly array $ims = [],
        public readonly array $web = [],
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
            'COMPANY_TYPE' => $this->companyType,
            'INDUSTRY' => $this->industry,
            'RATING' => $this->rating,
            'CURRENCY_ID' => $this->currencyId,
            'REVENUE' => $this->revenue,
            'EMPLOYEES' => $this->employees,
            'ASSIGNED_BY_ID' => $this->assignedById,
            'COMMENTS' => $this->comments,
            'ADDRESS' => $this->address,
            'ADDRESS_2' => $this->address2,
            'ADDRESS_CITY' => $this->addressCity,
            'ADDRESS_REGION' => $this->addressRegion,
            'ADDRESS_PROVINCE' => $this->addressProvince,
            'ADDRESS_COUNTRY' => $this->addressCountry,
        ];

        if ($this->phones !== []) {
            $fields['PHONE'] = $this->phones;
        }

        if ($this->emails !== []) {
            $fields['EMAIL'] = $this->emails;
        }

        if ($this->ims !== []) {
            $fields['IM'] = $this->ims;
        }

        if ($this->web !== []) {
            $fields['WEB'] = $this->web;
        }

        return $this->finalizeFields($fields);
    }
}
