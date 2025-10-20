<?php

declare(strict_types=1);

namespace Codex\Bitrix24\DTO\CRM;

use Codex\Bitrix24\DTO\AbstractFieldsDto;

final class StatusFieldsDto extends AbstractFieldsDto
{
    public function __construct(
        public readonly string $entityId,
        public readonly string $statusId,
        public readonly string $name,
        public readonly ?int $sort = null,
        public readonly ?string $color = null,
        public readonly ?string $semantics = null,
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
            'ENTITY_ID' => $this->entityId,
            'STATUS_ID' => $this->statusId,
            'NAME' => $this->name,
            'SORT' => $this->sort,
            'COLOR' => $this->color,
            'SEMANTICS' => $this->semantics,
        ];

        return $this->finalizeFields($fields);
    }
}
