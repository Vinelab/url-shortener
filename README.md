# URL Shortener PHP Package

[![Latest Stable Version](https://poser.pugx.org/vinelab/url-shortener/v/stable)](https://packagist.org/packages/vinelab/url-shortener)
[![Latest Unstable Version](https://poser.pugx.org/vinelab/url-shortener/v/unstable)](https://packagist.org/packages/vinelab/url-shortener)
[![Total Downloads](https://poser.pugx.org/vinelab/url-shortener/downloads)](https://packagist.org/packages/vinelab/url-shortener)
[![Build Status](https://travis-ci.org/Vinelab/url-shortener.svg)](https://travis-ci.org/Vinelab/url-shortener)
[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/Vinelab/url-shortener/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/Vinelab/url-shortener/?branch=master)
[![License](https://poser.pugx.org/vinelab/url-shortener/license)](https://packagist.org/packages/vinelab/url-shortener)

**`vinelab/url-shortener`** is a PHP framework agnostic Package that makes it easy to shorten your URL's, with your favourite URL Shortening provider such as (Bit.ly, Ow.ly).

*The URL Shortening Providers are online services that takes long URLs and squeezes them into fewer characters to make the link easier to share, tweet, or send by email.*

The package requires PHP 5.4+ and comes bundled with a Laravel 5 Facade and a Service Provider to simplify the optional framework integration and follows the FIG standard PSR-4 to ensure a high level of interoperability between shared PHP code and is fully unit-tested.

## Highlights


* Supportes [Bit.ly](https://bitly.com/)


## Installation

The recommended way to install this package is via `Composer`.

#### Via Composer

A. Run this composer command:

```bash
	composer require vinelab/url-shortener:*
```

B. **Or** manually add the package to your `composer.json` and run `composer update`.

```json
    {
        "require": {
            "vinelab/url-shortener": "*"
        }
    }
```

## Integrations

`url-shortener` is framework agnostic and as such can be integrated easily natively or with your favorite framework.

### Laravel:

The `url-shortener` package has optional support for Laravel 5 and it comes bundled with a Service Provider for easier integration.

After you have installed the package correctly, just follow the instructions.


.1. Register the service provider in your `config/app.php`:

```php
    'providers' => array(
        ...
		'Vinelab\UrlShortener\UrlShortenerServiceProvider'
    ),
```
The service provider will automatically alias the `Vinelab\UrlShortener\Shorten` class, so you can easily use the `Shorten` facade anywhere in your app.

.2. Publish the configuration file:

```bash
php artisan vendor:publish --provider ='Vinelab\UrlShortener\UrlShortenerServiceProvider'
```

## Configuration

.1. Open `url-shortener.php` and select your default provider:

```php
	'default' => 'bitly',
```
.2. Then add your provider token:

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

##### With Laravel:

The easiest way is to use it is by the `Shorten` facade.

```php
$long_url = 'http://testing.tst/something/12345/something-else/54321';

$short_url = Shorten\Shorten::url($long_url); // returns the short version of the long_url as a string
```





## Test

To run the tests, run the following command from the project folder.

```bash
$ ./vendor/bin/phpunit
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


## Support

[On Github](https://github.com/Vinelab/url-shortener/issues)


## Security

If you discover any security related issues, please email abed.halawi@vinelab.com instead of using the issue tracker.

## Credits

- [Abed Halawi](https://github.com/Mulkave)
- [Mahmoud Zalt](https://github.com/Mahmoudz)
- [All Contributors](../../contributors)


## License

The MIT License (MIT). Please see [License File](https://github.com/Vinelab/url-shortener/blob/master/LICENSE) for more information.
