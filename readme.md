# Deploy

[![Latest Version on Packagist][ico-version]][link-packagist]
[![Software License][ico-license]](LICENSE.md)
[![Build Status][ico-travis]][link-travis]

A simple Laravel-package to write a deploy file to your storage path. This file can then be used to check when the last deploy occurred. Useful for both debugging purposes and if you need to keep track of builds, updates etc.

## Installation

```bash
$ composer require "olssonm\deploy^1.0"
```

Only tested for Laravel >= 5.5 but should work with any version of Laravel higher than 5.1. This package does require PHP >= 7.0 however.

The package will be auto-discovered in Laravel >= 5.5, else you can add it to your providers array (`config/app.php`):

```php
'providers' => [
    Olssonm\Deploy\ServiceProvider::class
]
```

## Usage

`olssonm\deploy` comes with a set of Artisan-command that you can use straight out of the box:

#### deploy:make

```bash
$ php artisan deploy:make
// Deployed @ 2017-12-02 09:22:11
```

Writes the deployment-file for inspection and timekeeping. Per default the file is located in your `storagepath/app/deploy.txt`.

#### deploy:when

```bash
$ php artisan deploy:when
// Last deploy occurred @ 2017-12-02 09:22:11
```

Displays the time and date of the last deploy.

#### In app

You can also use the `Olssonm\Deploy\Deploy`-class for other more custom functions.

```php
use Olssonm\Deploy\Deploy;

$deploy = new \Olssonm\Deploy\Deploy();
$deploy->make(); // Writes "now" as the deployment time
$deploy->when(); // Retrieves the last deployment time as a Carbon-instance
```

The class is also available for dependency injection:

```php
use Olssonm\Deploy\Deploy;

public function when(Deploy $deploy)
{
    return $deploy->when();
}
```

Pro tip: if you are using a custom deploy routine where you run `composer install` you can add `php artisan deploy:make` to your list of `post-install-cmd`-commands to automatically fire the command:

```json
"scripts": {
    "post-install-cmd": [
        "php artisan deploy:make"
    ]
}
```

## Testing

```bash
$ composer test
```

or

```bash
$ phpunit
```

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.

© 2017 [Marcus Olsson](https://marcusolsson.me).

[ico-version]: https://img.shields.io/packagist/v/olssonm/deploy.svg?style=flat-square
[ico-license]: https://img.shields.io/badge/license-MIT-brightgreen.svg?style=flat-square
[ico-travis]: https://img.shields.io/travis/olssonm/deploy/master.svg?style=flat-square
[link-packagist]: https://packagist.org/packages/olssonm/deploy
[link-travis]: https://travis-ci.org/olssonm/deploy
