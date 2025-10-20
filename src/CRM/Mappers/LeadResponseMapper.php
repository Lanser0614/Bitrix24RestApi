<?php

declare(strict_types=1);

namespace Doniyor\Bitrix24\CRM\Mappers;

use Doniyor\Bitrix24\DTO\CRM\Response\LeadData;
use Doniyor\Bitrix24\Exceptions\Bitrix24Exception;

/**
 * @implements ResponseMapperInterface<LeadData>
 */
final class LeadResponseMapper extends AbstractCrmResponseMapper implements ResponseMapperInterface
{
    public function map(array $payload): LeadData
    {
        $data = $this->extractResult($payload);

        if (!isset($data['ID'], $data['TITLE'])) {
            throw new Bitrix24Exception('Lead payload missing required fields.');
        }

        return new LeadData(
            id: (int) $data['ID'],
            title: (string) $data['TITLE'],
            name: isset($data['NAME']) ? (string) $data['NAME'] : null,
            lastName: isset($data['LAST_NAME']) ? (string) $data['LAST_NAME'] : null,
            statusId: isset($data['STATUS_ID']) ? (string) $data['STATUS_ID'] : null,
            sourceId: isset($data['SOURCE_ID']) ? (string) $data['SOURCE_ID'] : null,
            assignedById: $this->intOrNull($data['ASSIGNED_BY_ID'] ?? null),
            phones: $this->mapMultiField($data['PHONE'] ?? []),
            emails: $this->mapMultiField($data['EMAIL'] ?? []),
            extra: $data,
        );
    }
}
