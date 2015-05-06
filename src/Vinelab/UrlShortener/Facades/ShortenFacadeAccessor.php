<?php
namespace Vinelab\UrlShortener\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * Class ShortenFacadeAccessor the Facade Accessor of the Shorten Facade
 *
 * @category Facade
 * @package  Vinelab\UrlShortener\Facades
 * @author   Mahmoud Zalt <mahmoud@vinelab.com>
 */
class ShortenFacadeAccessor extends Facade
{

    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'vinelab.shorten';
    }
}
