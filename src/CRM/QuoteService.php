<?php

declare(strict_types=1);

namespace Codex\Bitrix24\CRM;

class QuoteService extends AbstractCrmService
{
    protected function entityName(): string
    {
        return 'quote';
    }
}
