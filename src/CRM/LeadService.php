<?php

declare(strict_types=1);

namespace Codex\Bitrix24\CRM;

class LeadService extends AbstractCrmService
{
    protected function entityName(): string
    {
        return 'lead';
    }
}
