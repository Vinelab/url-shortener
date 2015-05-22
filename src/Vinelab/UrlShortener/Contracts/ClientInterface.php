<?php
namespace Vinelab\UrlShortener\Contracts;

/**
 * Interface ClientInterface
 * @package Vinelab\UrlShortener\Contracts
 */
interface ClientInterface
{
    public function fetchUrl($url, $parameters = [], $json_formatted = true, $verb = 'get');
}
