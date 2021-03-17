<?php

namespace KiranAjudiya\laravelCDN\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * Class CdnFacadeAccessor.
 *
 * @category Facade Accessor
 *
 * @author  Kiran Ajudiya <ajudiyabalam@gmail.com>
 */
class CdnFacadeAccessor extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'CDN';
    }
}
