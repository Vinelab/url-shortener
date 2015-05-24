<?php
namespace Vinelab\UrlShortener\Tests;

use Mockery as M;
use stdClass;
use Vinelab\UrlShortener\Base\ConfigManager;
use Vinelab\UrlShortener\Base\PackageManager;
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
    protected $m_response;

    protected $m_client;

    public function setUp()
    {
        parent::setUp();

        // created dummy mocked response
        $this->m_response = M::mock(new stdClass());
        $this->m_response->shouldReceive('json')
            ->andReturn($this->apiJsonResponse());

        // mocking the http client (to prevent real API calls)
        $this->m_client = M::mock('Vinelab\Http\Client');
        $this->m_client->shouldReceive('get')
            ->andReturn($this->m_response);

    }

    public function tearDown()
    {
        M::close();
        parent::tearDown();
    }

    /**
     * the response object
     * @return \stdClass
     */
    private function apiJsonResponse()
    {
        $dataObj = new stdClass();
        $dataObj->url = 'http://bit.ly/1zIv6l7';

        $obj = new stdClass();
        $obj->status_code = 200;
        $obj->status_txt = "OK";
        $obj->data = $dataObj;

        return $obj;
    }

    /**
     * Test shortening a valid URL (while mocking the real API call)
     */
    public function testShorteningValidUrl()
    {
        $url = 'http://testing.com/v4/content/something/12345/something-else/54321?featured=1&published=1';

        $config = new ConfigManager();

        $manager = new PackageManager($config, $this->m_client);

        $shortener = new Shorten($manager);

        $shorted_url = $shortener->url($url);

        $this->assertEquals($shorted_url, 'http://bit.ly/1zIv6l7');
    }

}
