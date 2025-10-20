<?php

declare(strict_types=1);

namespace Doniyor\Bitrix24\DTO\CRM;

use Doniyor\Bitrix24\DTO\AbstractFieldsDto;

final class ActivityFieldsDto extends AbstractFieldsDto
{
    /**
     * @param array<int, array<string, mixed>> $communications
     * @param array<string, mixed> $extra
     */
    public function __construct(
        public readonly string $subject,
        public readonly ?string $typeId = null,
        public readonly ?string $providerId = null,
        public readonly ?bool $completed = null,
        public readonly ?int $responsibleId = null,
        public readonly ?int $ownerId = null,
        public readonly ?string $ownerTypeId = null,
        public readonly ?string $startTime = null,
        public readonly ?string $endTime = null,
        public readonly ?string $description = null,
        public readonly ?int $priority = null,
        public readonly ?string $direction = null,
        public readonly array $communications = [],
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
            'SUBJECT' => $this->subject,
            'TYPE_ID' => $this->typeId,
            'PROVIDER_ID' => $this->providerId,
            'COMPLETED' => $this->completed,
            'RESPONSIBLE_ID' => $this->responsibleId,
            'OWNER_ID' => $this->ownerId,
            'OWNER_TYPE_ID' => $this->ownerTypeId,
            'START_TIME' => $this->startTime,
            'END_TIME' => $this->endTime,
            'DESCRIPTION' => $this->description,
            'PRIORITY' => $this->priority,
            'DIRECTION' => $this->direction,
        ];

        if ($this->communications !== []) {
            $fields['COMMUNICATIONS'] = $this->communications;
        }

        return $this->finalizeFields($fields);
    }
}
