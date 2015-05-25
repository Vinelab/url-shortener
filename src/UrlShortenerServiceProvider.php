<?php
namespace Vinelab\UrlShortener;

use Illuminate\Support\ServiceProvider;

/**
 * Class UrlShortenerServiceProvider
 *
 * @category The package service provider
 * @package  Vinelab\UrlShortener
 * @author   Mahmoud Zalt <mahmoud@vinelab.com>
 */
class UrlShortenerServiceProvider extends ServiceProvider
{

    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
    protected $defer = false;

    /**
     * Boot the package.
     */
    public function boot()
    {
        /*
        |--------------------------------------------------------------------------
        | Publish the Config file from the Package to the App directory
        |--------------------------------------------------------------------------
        */
        $this->configPublisher();
    }


    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        /*
        |--------------------------------------------------------------------------
        | Implementation Bindings
        |--------------------------------------------------------------------------
        */
        $this->implementationBindings();

        /*
        |--------------------------------------------------------------------------
        | Facade Bindings
        |--------------------------------------------------------------------------
        */
        $this->facadeBindings();

        /*
        |--------------------------------------------------------------------------
        | Registering Service Providers
        |--------------------------------------------------------------------------
        */
        $this->serviceProviders();
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return [];
    }

    /**
     * Publish the Config file from the Package to the App directory
     */
    private function configPublisher()
    {
        // When users execute Laravel's vendor:publish command, the config file will be copied to the specified location
        $this->publishes([
            __DIR__ . '/Config/url-shortener.php' => config_path('url-shortener.php'),
        ]);
    }

    /**
     * Facades Binding
     */
    private function facadeBindings()
    {
        // Register 'vinelab.shorten' instance container
        $this->app['vinelab.shorten'] = $this->app->share(function ($app) {
            return $app->make('Vinelab\UrlShortener\Shorten');
        });

        // Register 'Shorten' Alias, So users don't have to add the Alias to the 'app/config/app.php'
        $this->app->booting(function () {
            $loader = \Illuminate\Foundation\AliasLoader::getInstance();
            $loader->alias('Shorten', 'Vinelab\UrlShortener\Facades\ShortenFacadeAccessor');
        });
    }

    /**
     * Implementation Bindings
     */
    private function implementationBindings()
    {
        $this->app->bind(
            'Vinelab\UrlShortener\Contracts\ShortenInterface',
            'Vinelab\UrlShortener\Shorten'
        );
    }

    /**
     * Registering Other Custom Service Providers
     */
    private function serviceProviders()
    {
//        $this->app->register('Vinelab\...\...');
    }

}
