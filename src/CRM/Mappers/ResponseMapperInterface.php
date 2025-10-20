<?php

declare(strict_types=1);

namespace Doniyor\Bitrix24\CRM\Mappers;

/**
 * @template T of object
 */
interface ResponseMapperInterface
{
    /**
     * @param array<string, mixed> $payload
     * @return T
     */
    public function map(array $payload): object;
}
