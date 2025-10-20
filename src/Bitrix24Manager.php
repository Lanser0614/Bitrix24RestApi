<?php

declare(strict_types=1);

namespace Doniyor\Bitrix24;

use Doniyor\Bitrix24\CRM\CrmManager;

class Bitrix24Manager
{
    private Bitrix24Client $client;

    private ?CrmManager $crm = null;

    public function __construct(Bitrix24Client $client)
    {
        $this->client = $client;
    }

    public function client(): Bitrix24Client
    {
        return $this->client;
    }

    /**
     * @param array<string, mixed> $payload
     * @return array<mixed>
     */
    public function call(string $method, array $payload = [], string $httpMethod = 'POST'): array
    {
        return $this->client->call($method, $payload, $httpMethod);
    }

    public function crm(): CrmManager
    {
        if ($this->crm === null) {
            $this->crm = new CrmManager($this->client);
        }

        return $this->crm;
    }
}
