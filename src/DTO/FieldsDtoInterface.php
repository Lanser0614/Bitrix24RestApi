<?php

declare(strict_types=1);

namespace Doniyor\Bitrix24\DTO;

/**
 * Represents a payload of CRM fields for Bitrix24 requests.
 */
interface FieldsDtoInterface
{
    /**
     * @return array<string, mixed>
     */
    public function toArray(): array;
}
