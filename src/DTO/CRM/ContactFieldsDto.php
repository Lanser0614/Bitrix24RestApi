<?php

declare(strict_types=1);

namespace Doniyor\Bitrix24\DTO\CRM;

use Doniyor\Bitrix24\DTO\AbstractFieldsDto;

final class ContactFieldsDto extends AbstractFieldsDto
{
    /**
     * @param array<int, array<string, string>> $phones
     * @param array<int, array<string, string>> $emails
     * @param array<int, array<string, string>> $ims
     * @param array<int, array<string, string>> $web
     * @param array<string, mixed> $extra
     */
    public function __construct(
        public readonly string $name,
        public readonly ?string $lastName = null,
        public readonly ?string $secondName = null,
        public readonly ?string $honorific = null,
        public readonly ?string $birthdate = null,
        public readonly ?string $post = null,
        public readonly ?int $assignedById = null,
        public readonly ?string $typeId = null,
        public readonly ?string $sourceId = null,
        public readonly ?int $companyId = null,
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
            'NAME' => $this->name,
            'LAST_NAME' => $this->lastName,
            'SECOND_NAME' => $this->secondName,
            'HONORIFIC' => $this->honorific,
            'BIRTHDATE' => $this->birthdate,
            'POST' => $this->post,
            'ASSIGNED_BY_ID' => $this->assignedById,
            'TYPE_ID' => $this->typeId,
            'SOURCE_ID' => $this->sourceId,
            'COMPANY_ID' => $this->companyId,
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
