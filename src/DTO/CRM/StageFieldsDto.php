<?php

declare(strict_types=1);

namespace Doniyor\Bitrix24\DTO\CRM;

use Doniyor\Bitrix24\DTO\AbstractFieldsDto;

final class StageFieldsDto extends AbstractFieldsDto
{
    public function __construct(
        public readonly string $name,
        public readonly string $stageId,
        public readonly ?int $categoryId = null,
        public readonly ?int $sort = null,
        public readonly ?string $semantics = null,
        public readonly ?string $color = null,
        array $extra = [],
    ) {
        parent::__construct($extra);
    }

    /**
     * @return array<string, mixed>
     */
    public function toArray(): array
    {
        $fields = [
            'NAME' => $this->name,
            'STAGE_ID' => $this->stageId,
            'CATEGORY_ID' => $this->categoryId,
            'SORT' => $this->sort,
            'SEMANTICS' => $this->semantics,
            'COLOR' => $this->color,
        ];

        return $this->finalizeFields($fields);
    }
}
