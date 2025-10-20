<?php

declare(strict_types=1);

namespace Doniyor\Bitrix24\CRM;

class CurrencyService extends AbstractCrmService
{
    protected function entityName(): string
    {
        return 'currency';
    }
}
