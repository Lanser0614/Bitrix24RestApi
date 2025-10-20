<?php

declare(strict_types=1);

namespace Doniyor\Bitrix24\CRM;

class InvoiceService extends AbstractCrmService
{
    protected function entityName(): string
    {
        return 'invoice';
    }
}
