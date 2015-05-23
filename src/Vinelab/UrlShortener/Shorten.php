<?php
namespace Vinelab\UrlShortener;

use Vinelab\UrlShortener\Contracts\ShortenInterface;
use Vinelab\UrlShortener\Drivers\DriversFactory;

/**
 * The Manager class of the package and the single entry point to
 * all the functionality of the package.
 *
 * @category Manager Class (of the package)
 * @package  Vinelab\UrlShortener
 * @author   Mahmoud Zalt <mahmoud@vinelab.com>
 */
class Shorten implements ShortenInterface
{

    /**
     * Instance of the default driver
     *
     * @var \Vinelab\UrlShortener\Contracts\DriverInterface
     */
    protected $driver;

    /**
     * the default driver name
     *
     * @var string
     */
    protected $driverName;

    /**
     * the configurations of the default driver
     *
     * @var array
     */
    protected $driverParameters;

    /**
     * @var object
     */
    private $httpClient;

    /**
     * @param \Vinelab\UrlShortener\ConfigManager $config
     * @param null $httpClient The http Client 'will be injected here (mocked) for testing'
     */
    public function __construct(ConfigManager $config, $httpClient = null)
    {
        $this->driverName = $config->driverName();
        $this->driverParameters = $config->driverParameters($this->driverName);

        $this->httpClient = $httpClient;

        // initialize driver instance (based on the configuration input)
        $this->driver = DriversFactory::make($this->driverName, $this->driverParameters, $this->httpClient);
    }

    /**
     * the most important function, this is responsible of shortening the URL and
     * returning the short version.
     * Internally the function call the shorten() of the driver.
     *
     * @param $url
     */
    public function url($url)
    {
        return $this->driver->shorten($url);
    }

}
