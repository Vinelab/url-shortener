<?php
namespace Vinelab\UrlShortener;

use Illuminate\Config\Repository;
use Symfony\Component\Finder\Finder;

/**
 * Extends the Laravel `Illuminate\Config\Repository` thus it can be used as in Laravel.
 * it also contains some helper functions to facilitate reading the configuration from this package.
 * Once an object of this class is initialized it will automatically read the package config file.
 *
 * Yes this class is doing multiple things it could be easily splited into multiple classes, however
 * I preferred to keep it as portable as possible.
 *
 * @category Manager Class (of the configuration)
 * @package  Vinelab\UrlShortener\Config
 * @author   Mahmoud Zalt <mahmoud@vinelab.com>
 */
class ConfigManager extends Repository
{

    /**
     * the config file name of this package
     */
    const CONFIG_FILE_NAME = 'url-shortener';

    /**
     * load the configuration files
     */
    public function __construct()
    {
        $this->loadConfigurationFiles($this->configurationPath());
    }

    /**
     * extend the functionality of the default get() of the Repository
     * but always prepend the keys with the config file name
     *
     * @param $key
     *
     * @return mixed
     */
    public function read($key)
    {
        return $this->get(SELF::CONFIG_FILE_NAME . '.' . $key);
    }

    /**
     * helper function to return the driver default name
     *
     * @return mixed
     */
    public function driverName()
    {
        return $this->read('default');
    }

    /**
     * helper function to return the parameters of the driver $name
     *
     * @param $name
     *
     * @return mixed
     */
    public function driverParameters($name)
    {
        return $this->read('drivers' . '.' . $name);
    }

    /**
     * Initialize the paths.
     */
    private function configurationPath()
    {
        return __DIR__ . '/config'; // the config file is on this directory
    }

    /**
     * Load the configuration items from all of the files.
     *
     * @param $path
     */
    private function loadConfigurationFiles($path)
    {
        $this->configPath = $path;

        foreach ($this->getConfigurationFiles() as $fileKey => $path) {
            $this->set($fileKey, require $path);
        }

        foreach ($this->getConfigurationFiles() as $fileKey => $path) {
            $envConfig = require $path;

            foreach ($envConfig as $envKey => $value) {
                $this->set($fileKey . '.' . $envKey, $value);
            }
        }
    }

    /**
     * Get the configuration files for the selected environment
     *
     * @return array
     */
    private function getConfigurationFiles()
    {
        $path = $this->configPath;

        if (!is_dir($path)) {
            return [];
        }

        $files = [];
        $phpFiles = Finder::create()->files()->name('*.php')->in($path)->depth(0);

        foreach ($phpFiles as $file) {
            $files[basename($file->getRealPath(), '.php')] = $file->getRealPath();
        }

        return $files;
    }

}
