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
     *
     */
    public function boot()
    {
//        switch($this->detectLaravelVersion()){
//            case 4:
//                $this->package('vinelab/url-shortener');
//                break;
//            case 5:
        // When users execute Laravel's vendor:publish command, the config file will be copied to the specified location
        $this->publishes([
            __DIR__ . 'Config/url-shortener.php' => config_path('url-shortener.php'),
        ]);
//                break;
//        }
    }

    /**
     * detect and return the laravel version
     *
     * @return int
     */
    private function detectLaravelVersion()
    {
        $app = $this->app;
        $version = intval($app::VERSION);

        return $version;
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
     * Facades Binding
     */
    private function facadeBindings()
    {
        // Register 'vinelab.url' instance container to our CdnFacade object
        $this->app['vinelab.url'] = $this->app->share(function () {
            return $this->app->make('Vinelab\UrlShortener\Url');
        });

        // Register 'Url' Alias, So users don't have to add the Alias to the 'app/config/app.php'
        $this->app->booting(function () {
            $loader = \Illuminate\Foundation\AliasLoader::getInstance();
            $loader->alias('Url', 'Vinelab\UrlShortener\Facades\UrlFacadeAccessor');
        });
    }

    /**
     * Implementation Bindings
     */
    private function implementationBindings()
    {
        $this->app->bind(
            'Vinelab\UrlShortener\Contracts\UrlInterface',
            'Vinelab\UrlShortener\Url'
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
