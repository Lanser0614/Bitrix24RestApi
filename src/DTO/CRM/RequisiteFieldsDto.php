<?php

declare(strict_types=1);

namespace Codex\Bitrix24\DTO\CRM;

use Codex\Bitrix24\DTO\AbstractFieldsDto;

final class RequisiteFieldsDto extends AbstractFieldsDto
{
    /**
     * @param array<string, mixed> $address
     * @param array<string, mixed> $extra
     */
    public function __construct(
        public readonly int $entityTypeId,
        public readonly int $entityId,
        public readonly int $presetId,
        public readonly string $name,
        public readonly ?bool $active = null,
        public readonly ?string $rqInn = null,
        public readonly ?string $rqOgrn = null,
        public readonly ?string $rqKpp = null,
        public readonly ?string $rqCompanyName = null,
        public readonly array $address = [],
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
            'ENTITY_TYPE_ID' => $this->entityTypeId,
            'ENTITY_ID' => $this->entityId,
            'PRESET_ID' => $this->presetId,
            'NAME' => $this->name,
            'ACTIVE' => $this->active,
            'RQ_INN' => $this->rqInn,
            'RQ_OGRN' => $this->rqOgrn,
            'RQ_KPP' => $this->rqKpp,
            'RQ_COMPANY_NAME' => $this->rqCompanyName,
        ];

        if ($this->address !== []) {
            $fields['ADDRESS'] = $this->address;
        }

        return $this->finalizeFields($fields);
    }
}
