<?php
namespace Vinelab\UrlShortener\Tests;

use Mockery as M;
use Vinelab\Http\Response;
use Vinelab\UrlShortener\Drivers\Bitly;

/**
 * Class BitlyTest
 *
 * @category Test Class
 * @package Vinelab\UrlShortener\Tests
 * @author  Mahmoud Zalt <mahmoud@vinelab.com>
 */
class BitlyTest extends TestCase {

    public function setUp()
    {
        parent::setUp();
    }

    public function tearDown()
    {
        M::close();
        parent::tearDown();
    }

    private function driverParameters()
    {
        return [
            'domain' => 'https://api-ssl.bitly.com',
            'endpoint' => '/v3/shorten',
            "token" => "1234567890qwertyuiopasdfghjklzxcvbnm",
        ];
    }

    /**
     * test initializing an object of Bitly
     */
    public function testInitializingBitlyInstance()
    {

        $parameters = $this->driverParameters();

        $bitly = New Bitly($parameters);

        $this->assertInstanceOf('Vinelab\UrlShortener\Drivers\Bitly', $bitly);
    }


    /**
     * TODO: continue the tests
     */
//    public function testCallingShortenFunction()
//    {
//        $parameters = [
//            "token" => "5b049304ecb6d7be952caa8655f212d75c8cad92"
//        ];
//
////         mocked api response
//        $api_response = new Response([]);
////         mocked http client
//        $m_client = M::mock('Vinelab\Http\Client');
//        $m_client->shouldReceive('get')->once()->andReturn($api_response);
//
//        $bitly = new Bitly($parameters, $m_client);
//
//        $url = 'http://testing.com/v4/content/something/12345/something-else/54321?featured=1&published=1';
//
//        $shorted_url = $bitly->shorten($url);
//
//        $this->assertEquals($shorted_url, 'http://bit.ly/1zIv6l7');
//    }



    public function testMissingToken(){}

}
