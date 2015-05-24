<?php
namespace Vinelab\UrlShortener;

use Vinelab\UrlShortener\Base\Handler;
use Vinelab\UrlShortener\Contracts\ShortenInterface;

/**
 * Class Shorten is the API (entry point) to the public functionality of the package.
 *
 * @category API
 * @package  Vinelab\UrlShortener
 * @author   Mahmoud Zalt <mahmoud@vinelab.com>
 */
class Shorten extends Handler implements ShortenInterface
{

    /**
     * {@inheritdoc}
     */
    public function url($url)
    {
        return $this->getDriver()->shorten($url);
    }

}
