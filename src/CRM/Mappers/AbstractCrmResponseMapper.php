<?php

declare(strict_types=1);

namespace Doniyor\Bitrix24\CRM\Mappers;

use Doniyor\Bitrix24\Exceptions\Bitrix24Exception;

abstract class AbstractCrmResponseMapper
{
    /**
     * @param array<string, mixed> $payload
     * @return array<string, mixed>
     */
    protected function extractResult(array $payload): array
    {
        $result = $payload['result'] ?? $payload;

        if (!is_array($result)) {
            throw new Bitrix24Exception('Unexpected CRM response payload.');
        }

        return $result;
    }

    /**
     * @param array<int, array<string, mixed>> $items
     * @return array<int, array{value: string, type: string}>
     */
    protected function mapMultiField(array $items): array
    {
        $mapped = [];

        foreach ($items as $item) {
            if (!isset($item['VALUE'])) {
                continue;
            }

            $mapped[] = [
                'value' => (string) $item['VALUE'],
                'type' => isset($item['VALUE_TYPE']) ? (string) $item['VALUE_TYPE'] : 'WORK',
            ];
        }

        return $mapped;
    }

    /**
     * @param mixed $value
     */
    protected function boolOrNull($value): ?bool
    {
        if ($value === null) {
            return null;
        }

        if (is_bool($value)) {
            return $value;
        }

        if (is_numeric($value)) {
            return (bool) $value;
        }

        if (is_string($value)) {
            $normalized = strtolower($value);

            if ($normalized === 'y' || $normalized === 'yes' || $normalized === 'true') {
                return true;
            }

            if ($normalized === 'n' || $normalized === 'no' || $normalized === 'false') {
                return false;
            }
        }

        return null;
    }

    /**
     * @param mixed $value
     */
    protected function floatOrNull($value): ?float
    {
        if ($value === null || $value === '') {
            return null;
        }

        if (is_numeric($value)) {
            return (float) $value;
        }

        return null;
    }

    /**
     * @param mixed $value
     */
    protected function intOrNull($value): ?int
    {
        if ($value === null || $value === '') {
            return null;
        }

        if (is_numeric($value)) {
            return (int) $value;
        }

        return null;
    }
}
