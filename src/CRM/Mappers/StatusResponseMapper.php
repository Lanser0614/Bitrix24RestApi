<?php

declare(strict_types=1);

namespace Doniyor\Bitrix24\CRM\Mappers;

use Doniyor\Bitrix24\DTO\CRM\Response\StatusData;
use Doniyor\Bitrix24\Exceptions\Bitrix24Exception;

/**
 * @implements ResponseMapperInterface<StatusData>
 */
final class StatusResponseMapper extends AbstractCrmResponseMapper implements ResponseMapperInterface
{
    public function map(array $payload): StatusData
    {
        $data = $this->extractResult($payload);

        if (!isset($data['ID'], $data['ENTITY_ID'], $data['STATUS_ID'], $data['NAME'])) {
            throw new Bitrix24Exception('Status payload missing required fields.');
        }

        return new StatusData(
            id: (int) $data['ID'],
            entityId: (string) $data['ENTITY_ID'],
            statusId: (string) $data['STATUS_ID'],
            name: (string) $data['NAME'],
            sort: $this->intOrNull($data['SORT'] ?? null),
            color: isset($data['COLOR']) ? (string) $data['COLOR'] : null,
            semantics: isset($data['SEMANTICS']) ? (string) $data['SEMANTICS'] : null,
            extra: $data,
        );
    }
}
