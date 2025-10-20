<?php

declare(strict_types=1);

namespace Doniyor\Bitrix24\DTO;

abstract class AbstractResponseDto
{
    /**
     * @param array<string, mixed> $extra
     */
    public function __construct(
        protected array $extra = [],
    ) {
    }

    /**
     * @return array<string, mixed>
     */
    public function extra(): array
    {
        return $this->extra;
    }
}
