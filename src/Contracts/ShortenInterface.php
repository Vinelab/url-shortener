<?php
namespace Vinelab\UrlShortener\Contracts;

/**
 * Interface ShortenInterface
 * @package Vinelab\UrlShortener\Contracts
 */
interface ShortenInterface
{
    /**
     * Responsible of shortening the URL and returning the short version.
     *
     * @param $url
     */
    public function url($url);

}
