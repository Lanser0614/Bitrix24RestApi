<?php

declare(strict_types=1);

namespace Doniyor\Bitrix24\CRM\Mappers;

use Doniyor\Bitrix24\DTO\CRM\Response\CurrencyData;
use Doniyor\Bitrix24\Exceptions\Bitrix24Exception;

/**
 * @implements ResponseMapperInterface<CurrencyData>
 */
final class CurrencyResponseMapper extends AbstractCrmResponseMapper implements ResponseMapperInterface
{
    public function map(array $payload): CurrencyData
    {
        $data = $this->extractResult($payload);

        if (!isset($data['CURRENCY'])) {
            throw new Bitrix24Exception('Currency payload missing required fields.');
        }

        return new CurrencyData(
            currency: (string) $data['CURRENCY'],
            amount: $this->floatOrNull($data['AMOUNT'] ?? null),
            amountCnt: $this->intOrNull($data['AMOUNT_CNT'] ?? null),
            base: $this->boolOrNull($data['BASE'] ?? null),
            sort: $this->intOrNull($data['SORT'] ?? null),
            extra: $data,
        );
    }
}
