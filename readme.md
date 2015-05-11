# URL Shortener PHP Package

Shorten your URL the easy way, with your favourite provider (Bit.ly, Goo.gl, Ow.ly).

*The URL Shorteneing Providers are online services that takes long URLs and squeezes them into fewer characters to make the link easier to share, tweet, or send by email.*

`vinelab/url-shortener` is a PHP Package that consumes `URL Shorteneing Prioviders` API's.

The supported providers of this release:
* Bit.ly
* ...


## Installation

The recommended way to install this package is via `Composer`.

#### Via Composer

A. Run this composer command:
```dos 
	composer require vinelab/url-shortener:*
```

B. Or manually add the package to your `composer.json` and run `composer update`.
```json
    {
        "require": {
            "vinelab/url-shortener": "*"
        }
    }
```

##### Inside Laravel project:

If you are using this package inside a Laravel project then you need to:

1. Register the service provider in your `config/app.php`:
```php
    'providers' => array(
        ...
		'Vinelab\UrlShortener\UrlShortenerServiceProvider'
    ),
```
The service provider will automatically alias the `Vinelab\UrlShortener\Shorten` class, so you can easely use the `Shorten` facade anywhere in your app.

2. Publish the configuration file:
```dos 
	php artisan vendor:publish vinelab/url-shortener
```

Go to the generated config file `url-shortener.php` and select your default provider:
```php
	'default' => 'bitly',
```

Then add your provider token:
```php
        'bitly' => [

            'token' => 'YOUR-TOKEN-HERE',

        ],
```

 
## Usage

##### Inside Laravel project:

The easiest way is to use it is by the `Shorten` facade.
```php
$long_url = 'http://testing.tst/something/12345/something-else/54321';
$short_url = Shorten::url($long_url);
```
Note: if you have a custom namespace in your client class make sure you are using the `Shorten` class on the top of your class.
```php 
	use Shorten; 
```





## Contribution

### Support new provider

Supporting a new URL shortening provider is very easy.

1. all you have to is to write a driver for your URL Shoretener service.
check the `Bitly` driver `Vinelab\UrlShortener\Drivers\Bitly` implementation to get an overview.
2. add you driver configuration to the config file.
3. write tests for your drvier.
4. check out the  [Contribuition Guide](https://github.com/Vinelab/url-shortener/blob/master/CONTRIBUTING.md) for general details.


## License

The MIT License (MIT). Please see [License File](https://github.com/Vinelab/url-shortener/blob/master/LICENSE) for more information.

