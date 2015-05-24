# URL Shortener PHP Package

[![Latest Stable Version](https://poser.pugx.org/vinelab/url-shortener/v/stable)](https://packagist.org/packages/vinelab/url-shortener) 
[![Latest Unstable Version](https://poser.pugx.org/vinelab/url-shortener/v/unstable)](https://packagist.org/packages/vinelab/url-shortener) 
[![Total Downloads](https://poser.pugx.org/vinelab/url-shortener/downloads)](https://packagist.org/packages/vinelab/url-shortener) 
[![Build Status](https://travis-ci.org/Vinelab/url-shortener.svg)](https://travis-ci.org/Vinelab/url-shortener)
[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/Vinelab/url-shortener/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/Vinelab/url-shortener/?branch=master)
[![License](https://poser.pugx.org/vinelab/url-shortener/license)](https://packagist.org/packages/vinelab/url-shortener)

**`vinelab/url-shortener`** is a PHP Package that helps you shorten your URL the easy way, with your favourite URL Shortening provider (Bit.ly, Goo.gl, Ow.ly).

*The URL Shortening Providers are online services that takes long URLs and squeezes them into fewer characters to make the link easier to share, tweet, or send by email.*



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

#### Inside Frameworks

##### Laravel:

To use this package inside a Laravel project, you need to:


1. Register the service provider in your `config/app.php`:
```php
    'providers' => array(
        ...
		'Vinelab\UrlShortener\UrlShortenerServiceProvider'
    ),
```
The service provider will automatically alias the `Vinelab\UrlShortener\Shorten` class, so you can easily use the `Shorten` facade anywhere in your app.

2. Publish the configuration file:
```dos 
php artisan vendor:publish --provider ='Vinelab\UrlShortener\UrlShortenerServiceProvider'
```
3. Go to the generated config file `url-shortener.php` and select your default provider:
```php
	'default' => 'bitly',
```
4. Then add your provider token:

```php
        'bitly' => [
            'domain' => 'https://api-ssl.bitly.com',
            'endpoint' => '/v3/shorten',
            'token' => 'YOUR-TOKEN-HERE',
        ],
```


Note: It's very recommended to not add your token (any sensetive data) to the config file instead reference it to a `.env` variable. 

And to do so:

1. replace the `'token' => 'YOUR-TOKEN-HERE',` with `'token' => env('BITLY_TOKEN'),`
2. open your `.env` file and add the token variable there with the token value: `BITLY_TOKEN=YOUR-TOKEN-HERE`. 
3. add the variable `BITLY_TOKEN=` to the `.env.example` for other developers.


 
## Usage

##### Inside Laravel project:

The easiest way is to use it is by the `Shorten` facade.
```php
$long_url = 'http://testing.tst/something/12345/something-else/54321';

$short_url = Shorten\Shorten::url($long_url); // returns the short version of the long_url as a string 
```










## Contributing

### Support new provider

To add support for a new URL shortening provider:

1. write a driver for your URL Shortener service.
check the `Bitly` driver `Vinelab\UrlShortener\Drivers\Bitly` class.
2. add you driver configuration to the config file.
3. write tests for your drvier.
4. update the `README` file
5. check out the [Contribution Guide](https://github.com/Vinelab/url-shortener/blob/master/CONTRIBUTING.md) for general details.


## Security

If you discover any security related issues, please email mahmoud@vinelab.com instead of using the issue tracker.

## Credits

- [Mahmoud Zalt](https://github.com/Mahmoudz)
- [All Contributors](../../contributors)


## License

The MIT License (MIT). Please see [License File](https://github.com/Vinelab/url-shortener/blob/master/LICENSE) for more information.

