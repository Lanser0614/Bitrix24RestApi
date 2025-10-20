<?php

declare(strict_types=1);

namespace Doniyor\Bitrix24\CRM\Mappers;

use Doniyor\Bitrix24\DTO\CRM\Response\RequisiteData;
use Doniyor\Bitrix24\Exceptions\Bitrix24Exception;

/**
 * @implements ResponseMapperInterface<RequisiteData>
 */
final class RequisiteResponseMapper extends AbstractCrmResponseMapper implements ResponseMapperInterface
{
    public function map(array $payload): RequisiteData
    {
        $data = $this->extractResult($payload);

        if (!isset($data['ID'], $data['ENTITY_TYPE_ID'], $data['ENTITY_ID'], $data['PRESET_ID'], $data['NAME'])) {
            throw new Bitrix24Exception('Requisite payload missing required fields.');
        }

        return new RequisiteData(
            id: (int) $data['ID'],
            entityTypeId: (int) $data['ENTITY_TYPE_ID'],
            entityId: (int) $data['ENTITY_ID'],
            presetId: (int) $data['PRESET_ID'],
            name: (string) $data['NAME'],
            active: $this->boolOrNull($data['ACTIVE'] ?? null),
            rqInn: isset($data['RQ_INN']) ? (string) $data['RQ_INN'] : null,
            rqOgrn: isset($data['RQ_OGRN']) ? (string) $data['RQ_OGRN'] : null,
            rqKpp: isset($data['RQ_KPP']) ? (string) $data['RQ_KPP'] : null,
            rqCompanyName: isset($data['RQ_COMPANY_NAME']) ? (string) $data['RQ_COMPANY_NAME'] : null,
            address: is_array($data['ADDRESS'] ?? null) ? $data['ADDRESS'] : [],
            extra: $data,
        );
    }
}
