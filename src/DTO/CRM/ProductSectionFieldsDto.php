<?php

declare(strict_types=1);

namespace Codex\Bitrix24\DTO\CRM;

use Codex\Bitrix24\DTO\AbstractFieldsDto;

final class ProductSectionFieldsDto extends AbstractFieldsDto
{
    public function __construct(
        public readonly string $name,
        public readonly ?int $parentId = null,
        public readonly ?int $sort = null,
        public readonly ?string $xmlId = null,
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
            'PARENT_ID' => $this->parentId,
            'SORT' => $this->sort,
            'XML_ID' => $this->xmlId,
        ];

        return $this->finalizeFields($fields);
    }
}
