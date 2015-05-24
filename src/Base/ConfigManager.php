<?php
namespace Vinelab\UrlShortener\Base;

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
        $path = $this->configurationPath();

        $this->loadConfigurationFiles($path);
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
        return $this->get(self::CONFIG_FILE_NAME . '.' . $key);
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
     * check if this package is used inside of laravel project,
     * if it is laravel project then try to load the config file
     * from the laravel config directory.
     * if the file was not found (not published) ten load the config
     * file form the package directory.
     *
     * @return string
     */
    private function configurationPath()
    {
        // the config file of the package directory
        $config_path = str_replace("/Base", "/Config", __DIR__);

        // check if this laravel specific function `config_path()` exist (means this package is used inside
        // a laravel framework). If so then load then try to load the laravel config file if it exist.
        if (function_exists('config_path')) {
            $config_file = config_path() . '/' . self::CONFIG_FILE_NAME . '.php';

            if (file_exists($config_file)) {
                // override the path by the laravel specific config directory 
                $config_path = config_path();
            }
        }

        return $config_path;
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
