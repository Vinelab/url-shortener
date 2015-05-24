<?php
namespace Vinelab\UrlShortener\Tests;

use Mockery as M;
use PHPUnit_Framework_TestCase as PHPUnit;

/**
 * Class TestCase is the Parent test class that every test class must extend from
 *
 * @category Parent TestCase
 * @package Vinelab\UrlShortener\Tests
 * @author  Mahmoud Zalt <mahmoud@vinelab.com>
 */
class TestCase extends PHPUnit
{

    public function __construct()
    {
        parent::__construct();
    }

    public function setUp()
    {
        parent::setUp();
    }

    public function tearDown()
    {
        parent::tearDown();
    }

}
