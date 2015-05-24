<?php
namespace Vinelab\UrlShortener\Base;

/**
 * Class Handler is the abstract class for all the API's of the package.
 * Every API (accessible by users) must extend from this Handler.
 *
 * @category API Abstract
 * @package  Vinelab\UrlShortener\Base
 * @author   Mahmoud Zalt <mahmoud@vinelab.com>
 */
abstract class Handler
{

    /**
     * Instance of the default driver
     *
     * @var \Vinelab\UrlShortener\Contracts\DriverInterface
     */
    protected $driver;

    /**
     * @param \Vinelab\UrlShortener\Base\PackageManager $manager
     */
    public function __construct(PackageManager $manager)
    {
        // initialize driver instance (based on the configuration input collected from the package manager)
        $driver = DriversFactory::make(
            $manager->getDriverName(),
            $manager->getDriverParameters(),
            $manager->getHttpClient()
        );

        $this->setDriver($driver);
    }

    /**
     * @return \Vinelab\UrlShortener\Contracts\DriverInterface
     */
    public function getDriver()
    {
        return $this->driver;
    }

    /**
     * @param \Vinelab\UrlShortener\Contracts\DriverInterface $driver
     */
    public function setDriver($driver)
    {
        $this->driver = $driver;
    }

}
