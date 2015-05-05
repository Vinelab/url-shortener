<?php
namespace Vinelab\UrlShortener;

use Vinelab\Http\Client as HttpClient;
use Vinelab\UrlShortener\Contracts\ClientInterface;

/**
 * Class Client
 *
 * @category
 * @package Vinelab\UrlShortener
 * @author  Mahmoud Zalt <mahmoud@vinelab.com>
 */
class Client implements ClientInterface
{

    /**
     * @var \Vinelab\Http\Client
     */
    private $client;

    /**
     * @param null $client
     */
    public function __construct($client = null)
    {
        $this->client = (!$client) ? new HttpClient() : $client;
    }

    /**
     * build the URI from the provided data
     * do the actual call to the API through the Http Client
     * parse the data to return the shorten URL.
     *
     * @param        $url            the url which needs to be Shortened
     * @param array  $parameters     parameters tp be added to the URL
     * @param bool   $json_formatted the format of the output
     * @param string $verb           the HTTP verb function in the Client
     *
     * @return mixed
     */
    public function call($url, $parameters = [], $json_formatted = true, $verb = 'get')
    {
        $uri = $this->generateUri($url, $parameters);

        $response = $this->client->{$verb}($uri);

        return ($json_formatted) ? $response->json() : $response;
    }

    /**
     * build the final URI to be called by the client
     *
     * @param $url
     * @param $parameters
     *
     * @return string
     */
    private function generateUri($url, $parameters)
    {
        $prams_former = '?';

        foreach ($parameters as $key => $value) {
            $prams_former = $prams_former . $key . '=' . $value . '&';
        }

        return $url . substr($prams_former, 0, -1);
    }

}
