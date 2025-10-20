<?php

declare(strict_types=1);

namespace Doniyor\Bitrix24\CRM\Mappers;

use Doniyor\Bitrix24\DTO\CRM\Response\ActivityData;
use Doniyor\Bitrix24\Exceptions\Bitrix24Exception;

/**
 * @implements ResponseMapperInterface<ActivityData>
 */
final class ActivityResponseMapper extends AbstractCrmResponseMapper implements ResponseMapperInterface
{
    public function map(array $payload): ActivityData
    {
        $data = $this->extractResult($payload);

        if (!isset($data['ID'], $data['SUBJECT'])) {
            throw new Bitrix24Exception('Activity payload missing required fields.');
        }

        return new ActivityData(
            id: (int) $data['ID'],
            subject: (string) $data['SUBJECT'],
            typeId: isset($data['TYPE_ID']) ? (string) $data['TYPE_ID'] : null,
            providerId: isset($data['PROVIDER_ID']) ? (string) $data['PROVIDER_ID'] : null,
            completed: $this->boolOrNull($data['COMPLETED'] ?? null),
            responsibleId: $this->intOrNull($data['RESPONSIBLE_ID'] ?? null),
            ownerId: $this->intOrNull($data['OWNER_ID'] ?? null),
            ownerTypeId: isset($data['OWNER_TYPE_ID']) ? (string) $data['OWNER_TYPE_ID'] : null,
            startTime: isset($data['START_TIME']) ? (string) $data['START_TIME'] : null,
            endTime: isset($data['END_TIME']) ? (string) $data['END_TIME'] : null,
            direction: isset($data['DIRECTION']) ? (string) $data['DIRECTION'] : null,
            communications: is_array($data['COMMUNICATIONS'] ?? null) ? $data['COMMUNICATIONS'] : [],
            extra: $data,
        );
    }
}
