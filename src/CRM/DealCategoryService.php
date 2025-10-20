<?php

declare(strict_types=1);

namespace Codex\Bitrix24\CRM;

class DealCategoryService extends AbstractCrmService
{
    protected function entityName(): string
    {
        return 'dealcategory';
    }
}
