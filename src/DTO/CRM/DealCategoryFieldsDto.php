<?php

declare(strict_types=1);

namespace Doniyor\Bitrix24\DTO\CRM;

use Doniyor\Bitrix24\DTO\AbstractFieldsDto;

final class DealCategoryFieldsDto extends AbstractFieldsDto
{
    public function __construct(
        public readonly string $name,
        public readonly ?int $sort = null,
        public readonly ?bool $isLocked = null,
        public readonly ?string $code = null,
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
            'SORT' => $this->sort,
            'IS_LOCKED' => $this->isLocked,
            'CODE' => $this->code,
        ];

        return $this->finalizeFields($fields);
    }
}
