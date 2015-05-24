<?php
namespace Vinelab\UrlShortener\Base;

/**
 * Class PackageManager is the heart of the package,
 * It' main job is to initialize the config file.
 *
 * @category Manager
 * @package  Vinelab\UrlShortener\Base
 * @author   Mahmoud Zalt <mahmoud@vinelab.com>
 */
class PackageManager
{

    /**
     * default driver name
     *
     * @var string
     */
    protected $driverName;

    /**
     * configurations of the default driver
     *
     * @var array
     */
    protected $driverParameters;

    /**
     * Http client
     *
     * @var object
     */
    private $httpClient;

    /**
     * @param \Vinelab\UrlShortener\Base\ConfigManager $config
     * @param null                                     $httpClient The http Client 'will be injected here (mocked) for testing'
     */
    public function __construct(ConfigManager $config, $httpClient = null)
    {
        $this->setDriverName($config->driverName());
        $this->setDriverParameters($config->driverParameters($this->getDriverName()));
        $this->setHttpClient($httpClient);
    }

    /**
     * @return string
     */
    public function getDriverName()
    {
        return $this->driverName;
    }

    /**
     * @return array
     */
    public function getDriverParameters()
    {
        return $this->driverParameters;
    }

    /**
     * @return object
     */
    public function getHttpClient()
    {
        return $this->httpClient;
    }

    /**
     * @param string $driverName
     */
    private function setDriverName($driverName)
    {
        $this->driverName = $driverName;
    }

    /**
     * @param array $driverParameters
     */
    private function setDriverParameters($driverParameters)
    {
        $this->driverParameters = $driverParameters;
    }

    /**
     * @param object $httpClient
     */
    private function setHttpClient($httpClient)
    {
        $this->httpClient = $httpClient;
    }

}
