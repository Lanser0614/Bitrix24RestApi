<?php

declare(strict_types=1);

namespace Doniyor\Bitrix24\Facades;

use Doniyor\Bitrix24\Bitrix24Manager;
use Illuminate\Support\Facades\Facade;

/**
 * @method static \Doniyor\Bitrix24\CRM\CrmManager crm()
 * @method static \Doniyor\Bitrix24\Bitrix24Client client()
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
