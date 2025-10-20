<?php

declare(strict_types=1);

namespace Doniyor\Bitrix24\CRM\Mappers;

use Doniyor\Bitrix24\DTO\CRM\Response\ProductData;
use Doniyor\Bitrix24\Exceptions\Bitrix24Exception;

/**
 * @implements ResponseMapperInterface<ProductData>
 */
final class ProductResponseMapper extends AbstractCrmResponseMapper implements ResponseMapperInterface
{
    public function map(array $payload): ProductData
    {
        $data = $this->extractResult($payload);

        if (!isset($data['ID'], $data['NAME'])) {
            throw new Bitrix24Exception('Product payload missing required fields.');
        }

        return new ProductData(
            id: (int) $data['ID'],
            name: (string) $data['NAME'],
            price: $this->floatOrNull($data['PRICE'] ?? null),
            currencyId: isset($data['CURRENCY_ID']) ? (string) $data['CURRENCY_ID'] : null,
            sectionId: $this->intOrNull($data['SECTION_ID'] ?? null),
            active: $this->boolOrNull($data['ACTIVE'] ?? null),
            extra: $data,
        );
    }
}
