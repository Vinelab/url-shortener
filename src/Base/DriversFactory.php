<?php
namespace Vinelab\UrlShortener\Base;

use Vinelab\UrlShortener\Exceptions\MissingConfigurationException;
use Vinelab\UrlShortener\Exceptions\UnsupportedDriverException;

/**
 * Responsible of initializing objects based on the default driver name.
 *
 * The class can be accessed statically or normally
 * static example: $driver = DriversFactory::make($driverName, $driverParameters);
 * normal example: $driver = (new DriversFactory())->make($driverName, $driverParameters);
 *
 * @category Factory Class (for Drivers)
 * @package  Vinelab\Cdn
 * @author   Mahmoud Zalt <mahmoud@vinelab.com>
 */
class DriversFactory
{

    /**
     * the namespace of the drivers
     */
    const DRIVERS_NAMESPACE = "Vinelab\\UrlShortener\\Drivers\\";

    /**
     * initialize the driver instance and return it
     *
     * @param $name       driver name to be initialized
     * @param $parameters parameters to be passed to the driver constructor
     * @param $httpClient
     *
     * @return \Vinelab\UrlShortener\Drivers\Vinelab\UrlShortener\Contracts\DriverInterface
     */
    public static function make($name, $parameters, $httpClient = null)
    {
        if (!$name) {
            throw new MissingConfigurationException("The config file is missing the (Default Driver Name)");
        }

        // prepare the full driver class name
        $driver_class = self::DRIVERS_NAMESPACE . ucwords($name);

        if (!class_exists($driver_class)) {
            throw new UnsupportedDriverException("The driver ($name) is not supported.");
        }

        // initialize the driver object and pass the parameters to it's constructor
        $driver_object = new $driver_class($parameters, $httpClient);

        return $driver_object;
    }

}
