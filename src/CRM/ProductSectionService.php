<?php

declare(strict_types=1);

namespace Codex\Bitrix24\CRM;

class ProductSectionService extends AbstractCrmService
{
    protected function entityName(): string
    {
        return 'productsection';
    }
}
