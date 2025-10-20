<?php

declare(strict_types=1);

namespace Doniyor\Bitrix24\CRM;

class GenericCrmService extends AbstractCrmService
{
    private string $entityName;

    public function __construct(string $entityName, \Doniyor\Bitrix24\Bitrix24Client $client)
    {
        $this->entityName = strtolower($entityName);

        parent::__construct($client);
    }

    protected function entityName(): string
    {
        return $this->entityName;
    }
}
