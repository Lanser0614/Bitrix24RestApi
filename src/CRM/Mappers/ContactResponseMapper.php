<?php

declare(strict_types=1);

namespace Doniyor\Bitrix24\CRM\Mappers;

use Doniyor\Bitrix24\DTO\CRM\Response\ContactData;
use Doniyor\Bitrix24\Exceptions\Bitrix24Exception;

/**
 * @implements ResponseMapperInterface<ContactData>
 */
final class ContactResponseMapper extends AbstractCrmResponseMapper implements ResponseMapperInterface
{
    public function map(array $payload): ContactData
    {
        $data = $this->extractResult($payload);

        if (!isset($data['ID'], $data['NAME'])) {
            throw new Bitrix24Exception('Contact payload missing required fields.');
        }

        return new ContactData(
            id: (int) $data['ID'],
            name: (string) $data['NAME'],
            lastName: isset($data['LAST_NAME']) ? (string) $data['LAST_NAME'] : null,
            secondName: isset($data['SECOND_NAME']) ? (string) $data['SECOND_NAME'] : null,
            post: isset($data['POST']) ? (string) $data['POST'] : null,
            assignedById: $this->intOrNull($data['ASSIGNED_BY_ID'] ?? null),
            companyId: $this->intOrNull($data['COMPANY_ID'] ?? null),
            phones: $this->mapMultiField($data['PHONE'] ?? []),
            emails: $this->mapMultiField($data['EMAIL'] ?? []),
            ims: $this->mapMultiField($data['IM'] ?? []),
            web: $this->mapMultiField($data['WEB'] ?? []),
            extra: $data,
        );
    }
}
