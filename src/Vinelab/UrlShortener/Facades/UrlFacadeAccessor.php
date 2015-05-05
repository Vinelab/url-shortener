<?php
namespace Vinelab\UrlShortener\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * Class UrlFacadeAccessor the Facade Accessor of the Url Facade
 *
 * @category Facade
 * @package  Vinelab\UrlShortener\Facades
 * @author   Mahmoud Zalt <mahmoud@vinelab.com>
 */
class UrlFacadeAccessor extends Facade
{

    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'vinelab.url';
    }
}
