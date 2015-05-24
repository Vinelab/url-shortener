<?php
namespace Vinelab\UrlShortener\Base;

/**
 * Class DriversAbstract
 * Every Driver must extend from the DriversAbstract which holds
 * the common functionality between all the drivers.
 *
 * @category Drivers Abstract
 * @package Vinelab\UrlShortener\Base
 * @author  Mahmoud Zalt <mahmoud@vinelab.com>
 */
abstract class DriversAbstract
{

    /**
     * @var Client Adapter
     */
    protected $clientAdapter;

    /**
     * @var HTTP Client instance
     */
    protected $client;


    public function __construct()
    {
        $this->clientAdapter = new ClientAdapter();
    }

    /**
     * @param $httpClient
     */
    public function setClient($httpClient)
    {
        $this->clientAdapter->setClient($httpClient);
    }

    /**
     * @return mixed
     */
    public function getClient()
    {
        return $this->clientAdapter->getClient();
    }

    /**
     * @param $url
     * @param $parameters
     *
     * @return mixed
     */
    public function fetchUrl($url, $parameters)
    {
        return $this->clientAdapter->fetchUrl($url, $parameters);
    }

}
