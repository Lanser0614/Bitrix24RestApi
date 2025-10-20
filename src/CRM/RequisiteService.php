<?php

declare(strict_types=1);

namespace Doniyor\Bitrix24\CRM;

class RequisiteService extends AbstractCrmService
{
    protected function entityName(): string
    {
        return 'requisite';
    }
}
