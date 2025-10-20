<?php

declare(strict_types=1);

namespace Doniyor\Bitrix24\DTO\CRM\Response;

use Doniyor\Bitrix24\DTO\AbstractResponseDto;

final class ProductSectionData extends AbstractResponseDto
{
    /**
     * @param array<string, mixed> $extra
     */
    public function __construct(
        public readonly int $id,
        public readonly string $name,
        public readonly ?int $parentId = null,
        public readonly ?int $sort = null,
        array $extra = [],
    ) {
        parent::__construct($extra);
    }
}
