<?php

declare(strict_types=1);

namespace Codex\Bitrix24\CRM;

class GenericCrmService extends AbstractCrmService
{
    private string $entityName;

    public function __construct(string $entityName, \Codex\Bitrix24\Bitrix24Client $client)
    {
        $this->entityName = strtolower($entityName);

        parent::__construct($client);
    }

    protected function entityName(): string
    {
        return $this->entityName;
    }
}
