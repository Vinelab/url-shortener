<?php
namespace Vinelab\UrlShortener\Tests;

use Mockery as M;
use Vinelab\UrlShortener\ConfigManager;
use Vinelab\UrlShortener\Url;
use Vinelab\UrlShortener\Tests\TestCase;

/**
 * Class UrlTest
 *
 * @category Test Class
 * @package Vinelab\UrlShortener\Tests
 * @author  Mahmoud Zalt <mahmoud@vinelab.com>
 */
class UrlTest extends TestCase {

    public function setUp()
    {
        parent::setUp();
    }

    public function tearDown()
    {
        M::close();
        parent::tearDown();
    }

    /**
     *
     */
    public function testShorteningValidUrl()
    {
//        TODO: mock this tests (prevent sending real request to the API)

        $config = new ConfigManager();
        $url_manager = new Url($config);

        $url = 'http://testing.com/v4/content/something/12345/something-else/54321?featured=1&published=1';

        $shorted_url = $url_manager->shorten($url);

        $this->assertEquals($shorted_url, 'http://bit.ly/1zIv6l7');
    }

}
