<?php

declare(strict_types=1);

namespace Doniyor\Bitrix24\CRM;

class LeadService extends AbstractCrmService
{
    protected function entityName(): string
    {
        return 'lead';
    }
}
