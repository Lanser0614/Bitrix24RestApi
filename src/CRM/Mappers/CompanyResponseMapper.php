<?php

declare(strict_types=1);

namespace Doniyor\Bitrix24\CRM\Mappers;

use Doniyor\Bitrix24\DTO\CRM\Response\CompanyData;
use Doniyor\Bitrix24\Exceptions\Bitrix24Exception;

/**
 * @implements ResponseMapperInterface<CompanyData>
 */
final class CompanyResponseMapper extends AbstractCrmResponseMapper implements ResponseMapperInterface
{
    public function map(array $payload): CompanyData
    {
        $data = $this->extractResult($payload);

        if (!isset($data['ID'], $data['TITLE'])) {
            throw new Bitrix24Exception('Company payload missing required fields.');
        }

        return new CompanyData(
            id: (int) $data['ID'],
            title: (string) $data['TITLE'],
            companyType: isset($data['COMPANY_TYPE']) ? (string) $data['COMPANY_TYPE'] : null,
            industry: isset($data['INDUSTRY']) ? (string) $data['INDUSTRY'] : null,
            rating: isset($data['RATING']) ? (string) $data['RATING'] : null,
            revenue: $this->floatOrNull($data['REVENUE'] ?? null),
            currencyId: isset($data['CURRENCY_ID']) ? (string) $data['CURRENCY_ID'] : null,
            assignedById: $this->intOrNull($data['ASSIGNED_BY_ID'] ?? null),
            phones: $this->mapMultiField($data['PHONE'] ?? []),
            emails: $this->mapMultiField($data['EMAIL'] ?? []),
            ims: $this->mapMultiField($data['IM'] ?? []),
            web: $this->mapMultiField($data['WEB'] ?? []),
            extra: $data,
        );
    }
}
