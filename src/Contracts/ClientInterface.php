<?php

namespace Vinelab\UrlShortener\Contracts;

/**
 * Interface ClientInterface.
 */
interface ClientInterface
{
    public function fetchUrl($url, $parameters = [], $json_formatted = true, $verb = 'get');
}
