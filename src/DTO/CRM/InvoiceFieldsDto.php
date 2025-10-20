<?php

declare(strict_types=1);

namespace Doniyor\Bitrix24\DTO\CRM;

use Doniyor\Bitrix24\DTO\AbstractFieldsDto;

final class InvoiceFieldsDto extends AbstractFieldsDto
{
    public function __construct(
        public readonly string $orderTopic,
        public readonly ?string $statusId = null,
        public readonly ?float $price = null,
        public readonly ?string $currency = null,
        public readonly ?int $responsibleId = null,
        public readonly ?int $dealId = null,
        public readonly ?int $contactId = null,
        public readonly ?int $companyId = null,
        public readonly ?string $comments = null,
        public readonly ?string $billDate = null,
        public readonly ?string $payBefore = null,
        public readonly ?int $personTypeId = null,
        public readonly ?int $myCompanyId = null,
        array $extra = [],
    ) {
        parent::__construct($extra);
    }

    /**
     * @return array<string, mixed>
     */
    public function toArray(): array
    {
        $fields = [
            'ORDER_TOPIC' => $this->orderTopic,
            'STATUS_ID' => $this->statusId,
            'PRICE' => $this->price,
            'CURRENCY' => $this->currency,
            'RESPONSIBLE_ID' => $this->responsibleId,
            'UF_DEAL_ID' => $this->dealId,
            'UF_CONTACT_ID' => $this->contactId,
            'UF_COMPANY_ID' => $this->companyId,
            'COMMENTS' => $this->comments,
            'DATE_BILL' => $this->billDate,
            'DATE_PAY_BEFORE' => $this->payBefore,
            'PERSON_TYPE_ID' => $this->personTypeId,
            'MYCOMPANY_ID' => $this->myCompanyId,
        ];

        return $this->finalizeFields($fields);
    }
}
