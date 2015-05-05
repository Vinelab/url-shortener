<?php
namespace Vinelab\UrlShortener\Contracts;

/**
 * Interface DriverInterface
 * @package Vinelab\UrlShortener\Contracts
 */
interface DriverInterface
{

    public function shorten($url);

}
