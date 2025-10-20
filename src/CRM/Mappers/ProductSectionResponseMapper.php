<?php

declare(strict_types=1);

namespace Doniyor\Bitrix24\CRM\Mappers;

use Doniyor\Bitrix24\DTO\CRM\Response\ProductSectionData;
use Doniyor\Bitrix24\Exceptions\Bitrix24Exception;

/**
 * @implements ResponseMapperInterface<ProductSectionData>
 */
final class ProductSectionResponseMapper extends AbstractCrmResponseMapper implements ResponseMapperInterface
{
    public function map(array $payload): ProductSectionData
    {
        $data = $this->extractResult($payload);

        if (!isset($data['ID'], $data['NAME'])) {
            throw new Bitrix24Exception('Product section payload missing required fields.');
        }

        return new ProductSectionData(
            id: (int) $data['ID'],
            name: (string) $data['NAME'],
            parentId: $this->intOrNull($data['PARENT_ID'] ?? null),
            sort: $this->intOrNull($data['SORT'] ?? null),
            extra: $data,
        );
    }
}
