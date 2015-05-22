<?php
namespace Vinelab\UrlShortener\Tests;

use Mockery as M;
use Vinelab\UrlShortener\ConfigManager;
use Vinelab\UrlShortener\Shorten;

/**
 * Class ShortenTest
 *
 * @category Test Class
 * @package  Vinelab\UrlShortener\Tests
 * @author   Mahmoud Zalt <mahmoud@vinelab.com>
 */
class ShortenTest extends TestCase
{

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

//{
//            +"status_code": 200
//        +"status_txt": "OK"
//        +"data": {#288
//            +"long_url": "http://testing.com/v4/content/something/12345/something-else/54321?featured=1&published=1"
//            +"url": "http://bit.ly/1zIv6l7"
//            +"hash": "1zIv6l7"
//            +"global_hash": "1zIv6l8"
//            +"new_hash": 0
//  }
//}


        $config = new ConfigManager();
        $shortener = new Shorten($config);

        $url = 'http://testing.com/v4/content/something/12345/something-else/54321?featured=1&published=1';

        $shorted_url = $shortener->url($url);

        $this->assertEquals($shorted_url, 'http://bit.ly/1zIv6l7');
    }

}
