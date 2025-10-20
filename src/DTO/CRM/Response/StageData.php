<?php

declare(strict_types=1);

namespace Doniyor\Bitrix24\DTO\CRM\Response;

use Doniyor\Bitrix24\DTO\AbstractResponseDto;

final class StageData extends AbstractResponseDto
{
    /**
     * @param array<string, mixed> $extra
     */
    public function __construct(
        public readonly int $id,
        public readonly string $stageId,
        public readonly string $name,
        public readonly ?int $categoryId = null,
        public readonly ?int $sort = null,
        public readonly ?string $semantics = null,
        public readonly ?string $color = null,
        array $extra = [],
    ) {
        parent::__construct($extra);
    }
}
