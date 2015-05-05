<?php
namespace Vinelab\UrlShortener\Contracts;

/**
 * Interface CdnInterface
 * @package Vinelab\UrlShortener\Contracts
 */
interface UrlInterface
{

    public function shorten($url);

}
