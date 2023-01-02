# An Opentelemetry implementation for Laravel Horizon and queues

[![Latest Version on Packagist](https://img.shields.io/packagist/v/worksome/horizon-telemetry.svg?style=flat-square)](https://packagist.org/packages/worksome/horizon-telemetry)
[![GitHub Tests Action Status](https://img.shields.io/github/actions/workflow/status/worksome/horizon-telemetry/tests.yml?branch=main&style=flat-square&label=Tests)](https://github.com/worksome/horizon-telemetry/actions?query=workflow%3ATests+branch%3Amain)
[![GitHub Static Analysis Action Status](https://img.shields.io/github/actions/workflow/status/worksome/horizon-telemetry/static.yml?branch=main&style=flat-square&label=Static%20Analysis)](https://github.com/worksome/horizon-telemetry/actions?query=workflow%3A"Static%20Analysis"+branch%3Amain)
[![Total Downloads](https://img.shields.io/packagist/dt/worksome/horizon-telemetry.svg?style=flat-square)](https://packagist.org/packages/worksome/horizon-telemetry)

This is where your description should go. Limit it to a paragraph or two. Consider adding a small example.

## Installation

You can install the package via composer:

```bash
composer require worksome/horizon-telemetry
```

You can publish and run the migrations with:

```bash
php artisan vendor:publish --tag="horizon-telemetry-migrations"
php artisan migrate
```

You can publish the config file with:

```bash
php artisan vendor:publish --tag="horizon-telemetry-config"
```

This is the contents of the published config file:

```php
return [
];
```

Optionally, you can publish the views using

```bash
php artisan vendor:publish --tag="horizon-telemetry-views"
```

## Usage

```php
$horizonTelemetry = new Worksome\HorizonTelemetry();
echo $horizonTelemetry->echoPhrase('Hello, Worksome!');
```

## Testing

```bash
composer test
```

## Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information on what has changed recently.

## Contributing

Please see [CONTRIBUTING](.github/CONTRIBUTING.md) for details.

## Security Vulnerabilities

Please review [our security policy](../../security/policy) on how to report security vulnerabilities.

## Credits

- [Oliver Nybroe](https://github.com/worksome)
- [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
