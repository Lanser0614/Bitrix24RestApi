<?php

declare(strict_types=1);

namespace Doniyor\Bitrix24\CRM\Mappers;

use Doniyor\Bitrix24\DTO\CRM\Response\DealData;
use Doniyor\Bitrix24\Exceptions\Bitrix24Exception;

/**
 * @implements ResponseMapperInterface<DealData>
 */
final class DealResponseMapper extends AbstractCrmResponseMapper implements ResponseMapperInterface
{
    public function map(array $payload): DealData
    {
        $data = $this->extractResult($payload);

        if (!isset($data['ID'], $data['TITLE'])) {
            throw new Bitrix24Exception('Deal payload missing required fields.');
        }

        return new DealData(
            id: (int) $data['ID'],
            title: (string) $data['TITLE'],
            stageId: isset($data['STAGE_ID']) ? (string) $data['STAGE_ID'] : null,
            opportunity: $this->floatOrNull($data['OPPORTUNITY'] ?? null),
            currencyId: isset($data['CURRENCY_ID']) ? (string) $data['CURRENCY_ID'] : null,
            categoryId: $this->intOrNull($data['CATEGORY_ID'] ?? null),
            contactId: $this->intOrNull($data['CONTACT_ID'] ?? null),
            companyId: $this->intOrNull($data['COMPANY_ID'] ?? null),
            assignedById: $this->intOrNull($data['ASSIGNED_BY_ID'] ?? null),
            extra: $data,
        );
    }
}
