<?php

declare(strict_types=1);

namespace Codex\Bitrix24\Exceptions;

class Bitrix24ApiException extends Bitrix24Exception
{
    protected string $bitrixErrorCode;

    /** @var array<mixed> */
    protected array $payload;

    /**
     * @param string $message
     * @param string $bitrixErrorCode
     * @param array<mixed> $payload
     */
    public function __construct(string $message, string $bitrixErrorCode, array $payload = [])
    {
        parent::__construct($message);

        $this->bitrixErrorCode = $bitrixErrorCode;
        $this->payload = $payload;
    }

    public function getBitrixErrorCode(): string
    {
        return $this->bitrixErrorCode;
    }

    /**
     * @return array<mixed>
     */
    public function getPayload(): array
    {
        return $this->payload;
    }
}
