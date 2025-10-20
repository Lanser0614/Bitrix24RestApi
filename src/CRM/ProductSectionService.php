<?php

declare(strict_types=1);

namespace Doniyor\Bitrix24\CRM;

class ProductSectionService extends AbstractCrmService
{
    protected function entityName(): string
    {
        return 'productsection';
    }
}
