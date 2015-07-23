<?php

namespace Vinelab\UrlShortener\Contracts;

/**
 * Interface DriverInterface.
 */
interface DriverInterface
{
    public function shorten($url);
}
