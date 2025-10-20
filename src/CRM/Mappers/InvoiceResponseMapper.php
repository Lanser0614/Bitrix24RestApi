<?php

declare(strict_types=1);

namespace Doniyor\Bitrix24\CRM\Mappers;

use Doniyor\Bitrix24\DTO\CRM\Response\InvoiceData;
use Doniyor\Bitrix24\Exceptions\Bitrix24Exception;

/**
 * @implements ResponseMapperInterface<InvoiceData>
 */
final class InvoiceResponseMapper extends AbstractCrmResponseMapper implements ResponseMapperInterface
{
    public function map(array $payload): InvoiceData
    {
        $data = $this->extractResult($payload);

        if (!isset($data['ID'], $data['ORDER_TOPIC'])) {
            throw new Bitrix24Exception('Invoice payload missing required fields.');
        }

        return new InvoiceData(
            id: (int) $data['ID'],
            orderTopic: (string) $data['ORDER_TOPIC'],
            statusId: isset($data['STATUS_ID']) ? (string) $data['STATUS_ID'] : null,
            price: $this->floatOrNull($data['PRICE'] ?? null),
            currency: isset($data['CURRENCY']) ? (string) $data['CURRENCY'] : null,
            responsibleId: $this->intOrNull($data['RESPONSIBLE_ID'] ?? null),
            dealId: $this->intOrNull($data['UF_DEAL_ID'] ?? $data['DEAL_ID'] ?? null),
            contactId: $this->intOrNull($data['UF_CONTACT_ID'] ?? null),
            companyId: $this->intOrNull($data['UF_COMPANY_ID'] ?? null),
            extra: $data,
        );
    }
}
