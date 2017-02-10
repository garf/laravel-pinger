# Laravel Weblogs Pinger

[![Software License](https://img.shields.io/badge/license-MIT-brightgreen.svg?style=flat-square)](LICENSE.md)
[![Laravel Version](https://img.shields.io/badge/laravel-5-orange.svg?style=flat-square)](http://laravel.com)

Weblog system blogs pinger for Laravel 5.

Easy way to notify search engines about your new or updated posts in blog.

## Install

Add

``` JSON
"garf/laravel-pinger": "2.*"
```

to your `composer.json` file into `require` section.

Then type in console

``` BASH
$ composer update
```

When update completed, add to your `config/app.conf` file to `providers` section

``` PHP
'providers' => [
    // ...
    Garf\LaravelPinger\LaravelPingerServiceProvider::class,
]
```

If you want to use `Pinger` facade, add to same file at the `aliases` section

``` PHP
'aliases' => [
    // ...
  'Pinger' => Garf\LaravelPinger\PingerFacade::class,
]
`
### Publish with artsian

``` PHP
php artisan vendor:publish
```
Publishes a pinger.php file to config directory. Add and remove all your ping sites in this file. 
Be sure to review the ping responses from the ping sites you add because there are many ping sites 
and do not all provide a uniform response. Some may require additional parameters. Some may stop working.

``

## Usage

### Send ping to services

#### Sending to all services at once

``` php
Pinger::pingAll('Title of post', 'http://url.of/your-post', 'http://url.of/your-rss(optional)');
```

#### Send pings to separate services

**Google**

``` php
Pinger::pingGoogle('Title of post', 'http://url.of/your-post', 'http://url.of/your-rss(optional)');
```

**Yandex**

``` php
Pinger::pingYandex('Title of post', 'http://url.of/your-post', 'http://url.of/your-rss(optional)');
```

**Yahoo**

``` php
Pinger::pingYahoo('Title of post', 'http://url.of/your-post', 'http://url.of/your-rss(optional)');
```

**Feedburner**

``` php
Pinger::pingFeedburner('Title of post', 'http://url.of/your-post', 'http://url.of/your-rss(optional)');
```

**Weblogs**

``` php
Pinger::pingWeblogs('Title of post', 'http://url.of/your-post', 'http://url.of/your-rss(optional)');
```

**PingOMatic**

``` php
    Pinger::pingPingOMatic(
        'Title of post', 
        'http://url.of/your-post', 
        'http://url.of/your-rss(optional)', 
        [
            'additional' => 'params',
            'to' => 'send',
        ]);
```

#### Ping any other service

``` php
Pinger::ping('http://url.of/service', 'Title of post', 'http://url.of/your-post', 'http://url.of/your-rss(optional)');
```

## Further plans

- clean the code 
- create driver system for different services

## Contributions

Contributions are highly appreciated.

Send your pull requests to `master` branch.


## License

The MIT License (MIT). Please see [License File](https://github.com/garf/laravel-pinger/blob/master/LICENSE) for more information.

