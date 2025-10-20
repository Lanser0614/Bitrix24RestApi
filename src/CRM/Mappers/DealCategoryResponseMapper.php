<?php

declare(strict_types=1);

namespace Doniyor\Bitrix24\CRM\Mappers;

use Doniyor\Bitrix24\DTO\CRM\Response\DealCategoryData;
use Doniyor\Bitrix24\Exceptions\Bitrix24Exception;

/**
 * @implements ResponseMapperInterface<DealCategoryData>
 */
final class DealCategoryResponseMapper extends AbstractCrmResponseMapper implements ResponseMapperInterface
{
    public function map(array $payload): DealCategoryData
    {
        $data = $this->extractResult($payload);

        if (!isset($data['ID'], $data['NAME'])) {
            throw new Bitrix24Exception('Deal category payload missing required fields.');
        }

        return new DealCategoryData(
            id: (int) $data['ID'],
            name: (string) $data['NAME'],
            sort: $this->intOrNull($data['SORT'] ?? null),
            isLocked: $this->boolOrNull($data['IS_LOCKED'] ?? null),
            code: isset($data['CODE']) ? (string) $data['CODE'] : null,
            extra: $data,
        );
    }
}
