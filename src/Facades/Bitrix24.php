<?php

declare(strict_types=1);

namespace Codex\Bitrix24\Facades;

use Codex\Bitrix24\Bitrix24Manager;
use Illuminate\Support\Facades\Facade;

/**
 * @method static \Codex\Bitrix24\CRM\CrmManager crm()
 * @method static \Codex\Bitrix24\Bitrix24Client client()
 *
 * @see Bitrix24Manager
 */
class Bitrix24 extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return 'bitrix24';
    }
}
