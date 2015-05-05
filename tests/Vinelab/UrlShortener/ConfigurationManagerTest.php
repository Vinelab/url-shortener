<?php
namespace Vinelab\UrlShortener\Tests;

use Mockery as M;
use Vinelab\UrlShortener\ConfigManager;

/**
 * Class ConfigurationManagerTest
 *
 * @category Test Class
 * @package Vinelab\UrlShortener\Tests
 * @author  Mahmoud Zalt <mahmoud@vinelab.com>
 */
class ConfigurationManagerTest extends TestCase {

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
     * the getting driver name
     */
    public function testReadingFromConfigFile()
    {
        $config = New ConfigManager();

        $this->assertEquals($config->read('default'), 'bitly');
    }

    /**
     * the getting driver name
     */
    public function testGettingDriverName()
    {
        $config = New ConfigManager();

        $this->assertEquals($config->driverName(), 'bitly');
    }
    /**
     * the getting driver name
     */
    public function testGettingDriverParameters()
    {
        $config = New ConfigManager();

        $this->assertArrayHasKey('token', $config->driverParameters('bitly'));
    }

}
