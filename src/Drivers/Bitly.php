<?php
namespace Vinelab\UrlShortener\Drivers;

use Vinelab\UrlShortener\Base\DriversAbstract;
use Vinelab\UrlShortener\Contracts\DriverInterface;
use Vinelab\UrlShortener\Validators\ValidatorTrait;

/**
 * Class Bitly the driver of the Bitly URL shortener provider
 *
 * @category Bitly Driver
 * @package  Vinelab\UrlShortener
 * @author   Mahmoud Zalt <mahmoud@vinelab.com>
 */
class Bitly extends DriversAbstract implements DriverInterface
{

    use ValidatorTrait;

    /**
     * the response data format
     */
    const RESPONSE_FORMAT = 'json';

    /**
     * the bitly API domain
     */
    protected $domain;

    /**
     * bitly endpoint to shorten URL
     */
    protected $endpoint;

    /**
     * bitly app access token collected from the config file
     *
     * @var string
     */
    private $access_token;

    /**
     * @param array  $parameters
     * @param Object $httpClient
     */
    public function __construct($parameters, $httpClient = null)
    {
        // must call the constructor of the abstracted class (the Client)
        parent::__construct();

        // set the HTTP client
        $this->setClient($httpClient);

        // read the configuration parameters and set them as attributes of this class
        $this->setParameters($parameters);
    }

    /**
     * set the attributes on the class after validating them
     *
     * @param $parameters
     */
    private function setParameters($parameters)
    {
        $this->domain = $this->validateConfiguration($parameters['domain']);
        $this->endpoint = $this->validateConfiguration($parameters['endpoint']);
        $this->access_token = $this->validateConfiguration($parameters['token']);
    }

    /**
     * shorten the input $url and return the shorted version.
     *
     * @param $url
     *
     * @return mixed
     */
    public function shorten($url)
    {
        // make the API call through the extended client
        $response = $this->fetchUrl($this->url(), $this->parameters($url));

        // read the shorted url from the response object
        $shorter_url = $this->parse($response);

        return $shorter_url;
    }

    /**
     * Build the request parameters
     *
     * @param $url
     *
     * @return array
     */
    protected function parameters($url)
    {
        return [
            'access_token' => $this->access_token,
            'format'       => self::RESPONSE_FORMAT,
            'longUrl'      => urlencode($url),
        ];
    }

    /**
     * get the bitly shorten URL
     *
     * @return string
     */
    protected function url()
    {
        return $this->domain . $this->endpoint;
    }

    /**
     * get a response object and return the short URL form the result
     *
     * @param $response_object
     *
     * @return mixed
     * @throws \Vinelab\UrlShortener\Validators\ResponseErrorException
     */
    private function parse($response_object)
    {
        // will throw an exception if not valid
        $this->validateResponseCode($response_object->status_code);

        // return only the short generated url
        return $response_object->data->url;
    }

}
