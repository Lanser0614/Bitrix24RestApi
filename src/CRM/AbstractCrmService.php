<?php

declare(strict_types=1);

namespace Codex\Bitrix24\CRM;

use Codex\Bitrix24\Bitrix24Client;
use Codex\Bitrix24\DTO\FieldsDtoInterface;

abstract class AbstractCrmService
{
    protected Bitrix24Client $client;

    public function __construct(Bitrix24Client $client)
    {
        $this->client = $client;
    }

    abstract protected function entityName(): string;

    protected function method(string $action): string
    {
        return sprintf('crm.%s.%s', $this->entityName(), $action);
    }

    /**
     * @param array<mixed> $response
     * @return mixed
     */
    protected function extractResult(array $response)
    {
        return $response['result'] ?? $response;
    }

    /**
     * @param FieldsDtoInterface $fields
     * @param array<string, mixed> $params
     * @return mixed
     */
    public function add(FieldsDtoInterface $fields, array $params = [])
    {
        $response = $this->client->call($this->method('add'), [
            'fields' => $fields->toArray(),
            'params' => $params,
        ]);

        return $this->extractResult($response);
    }

    /**
     * @return array<mixed>
     */
    public function get(int $id): array
    {
        $response = $this->client->call($this->method('get'), [
            'id' => $id,
        ]);

        $result = $this->extractResult($response);

        return is_array($result) ? $result : ['result' => $result];
    }

    /**
     * @param FieldsDtoInterface $fields
     */
    public function update(int $id, FieldsDtoInterface $fields): bool
    {
        $response = $this->client->call($this->method('update'), [
            'id' => $id,
            'fields' => $fields->toArray(),
        ]);

        return (bool) $this->extractResult($response);
    }

    public function delete(int $id): bool
    {
        $response = $this->client->call($this->method('delete'), [
            'id' => $id,
        ]);

        return (bool) $this->extractResult($response);
    }

    /**
     * @param array<string, mixed> $filter
     * @param array<string, string> $order
     * @param array<int, string> $select
     * @return array<string, mixed>
     */
    public function list(array $filter = [], array $order = [], array $select = [], int|string|null $start = null): array
    {
        $payload = [
            'filter' => $filter,
            'order' => $order,
            'select' => $select,
        ];

        if ($start !== null) {
            $payload['start'] = $start;
        }

        return $this->client->call($this->method('list'), $payload);
    }

    /**
     * @return array<string, mixed>
     */
    public function fields(): array
    {
        $response = $this->client->call($this->method('fields'));

        $result = $this->extractResult($response);

        return is_array($result) ? $result : ['result' => $result];
    }
}
