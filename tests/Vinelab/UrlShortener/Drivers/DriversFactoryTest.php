<?php
namespace Vinelab\UrlShortener\Tests;

use Mockery as M;
use Vinelab\UrlShortener\Drivers\DriversFactory;

/**
 * Class DriversFactoryTest
 *
 * @category Test Class
 * @package Vinelab\UrlShortener\Tests
 * @author  Mahmoud Zalt <mahmoud@vinelab.com>
 */
class DriversFactoryTest extends TestCase {

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
     * the initializing a bitly driver using the factory
     */
    public function testInitializingBitlyDriver()
    {
        $driverName = 'bitly';
        $driverParameters = [
            "token" => "1234567890qwertyuiopasdfghjklzxcvbnm"
        ];

        $driver = DriversFactory::make($driverName, $driverParameters);

        $this->assertInstanceOf('Vinelab\UrlShortener\Drivers\Bitly', $driver);
    }

    /**
     * the initializing a NULL driver
     *
     * @expectedException Vinelab\UrlShortener\Exceptions\MissingConfigurationException
     */
    public function testMissingDriverName()
    {
        $driverName = '';
        $driverParameters = [
            "token" => "1234567890qwertyuiopasdfghjklzxcvbnm"
        ];

        DriversFactory::make($driverName, $driverParameters);
    }

    /**
     * the initializing a non supported driver
     *
     * @expectedException Vinelab\UrlShortener\Exceptions\UnsupportedDriverException
     */
    public function testNonSupportedDriver()
    {
        $driverName = 'NonSupported';
        $driverParameters = [
            "token" => "1234567890qwertyuiopasdfghjklzxcvbnm"
        ];

        DriversFactory::make($driverName, $driverParameters);
    }

    /**
     * test initializing an object of the factory normally
     */
    public function testInitializingFactoryNormally()
    {
        $driverName = 'bitly';
        $driverParameters = [
            "token" => "1234567890qwertyuiopasdfghjklzxcvbnm"
        ];

        $driver = (new DriversFactory())->make($driverName, $driverParameters);

        $this->assertInstanceOf('Vinelab\UrlShortener\Drivers\Bitly', $driver);
    }

}
