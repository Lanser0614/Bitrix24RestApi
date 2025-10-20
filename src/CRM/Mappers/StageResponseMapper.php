<?php

declare(strict_types=1);

namespace Doniyor\Bitrix24\CRM\Mappers;

use Doniyor\Bitrix24\DTO\CRM\Response\StageData;
use Doniyor\Bitrix24\Exceptions\Bitrix24Exception;

/**
 * @implements ResponseMapperInterface<StageData>
 */
final class StageResponseMapper extends AbstractCrmResponseMapper implements ResponseMapperInterface
{
    public function map(array $payload): StageData
    {
        $data = $this->extractResult($payload);

        if (!isset($data['ID'], $data['STAGE_ID'], $data['NAME'])) {
            throw new Bitrix24Exception('Stage payload missing required fields.');
        }

        return new StageData(
            id: (int) $data['ID'],
            stageId: (string) $data['STAGE_ID'],
            name: (string) $data['NAME'],
            categoryId: $this->intOrNull($data['CATEGORY_ID'] ?? null),
            sort: $this->intOrNull($data['SORT'] ?? null),
            semantics: isset($data['SEMANTICS']) ? (string) $data['SEMANTICS'] : null,
            color: isset($data['COLOR']) ? (string) $data['COLOR'] : null,
            extra: $data,
        );
    }
}
