<?php
namespace Vinelab\UrlShortener\Contracts;

/**
 * Interface ShortenInterface
 * @package Vinelab\UrlShortener\Contracts
 */
interface ShortenInterface
{
    /**
     * Shortening the URL and returning the short version.
     * Internally the function call the shorten() of the driver.
     * The driver is initialized in the Handler parent class.
     *
     * @param $url
     */
    public function url($url);

}
