<?php

declare(strict_types=1);

namespace Codex\Bitrix24\DTO;

class GenericFieldsDto implements FieldsDtoInterface
{
    /** @var array<string, mixed> */
    private array $fields;

    /**
     * @param array<string, mixed> $fields
     */
    public function __construct(array $fields)
    {
        $this->fields = $fields;
    }

    /**
     * @return array<string, mixed>
     */
    public function toArray(): array
    {
        return $this->fields;
    }
}
