<?php

declare(strict_types=1);

namespace Doniyor\Bitrix24\Exceptions;

use Throwable;

class Bitrix24RequestException extends Bitrix24Exception
{
    public function __construct(string $message, int $code = 0, ?Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}
