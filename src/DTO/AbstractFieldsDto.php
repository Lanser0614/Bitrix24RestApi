<?php

declare(strict_types=1);

namespace Doniyor\Bitrix24\DTO;

abstract class AbstractFieldsDto implements FieldsDtoInterface
{
    /** @var array<string, mixed> */
    protected array $extra;

    /**
     * @param array<string, mixed> $extra
     */
    public function __construct(array $extra = [])
    {
        $this->extra = $extra;
    }

    /**
     * @param array<string, mixed> $extra
     */
    public function withExtra(array $extra): static
    {
        $clone = clone $this;
        $clone->extra = array_merge($this->extra, $extra);

        return $clone;
    }

    /**
     * @param array<string, mixed> $fields
     * @return array<string, mixed>
     */
    protected function finalizeFields(array $fields): array
    {
        foreach ($fields as $key => $value) {
            if ($value === null) {
                unset($fields[$key]);
            }
        }

        return array_merge($fields, $this->extra);
    }
}
