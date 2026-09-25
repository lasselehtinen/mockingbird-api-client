# This is a cliexternal API

[![Latest Version on Packagist](https://img.shields.io/packagist/v/lasselehtinen/mockingbird-api-client.svg?style=flat-square)](https://packagist.org/packages/lasselehtinen/mockingbird-api-client)
[![GitHub Tests Action Status](https://github.com/spatie/package-mockingbird-api-client-laravel/actions/workflows/run-tests.yml/badge.svg)](https://github.com/lasselehtinen/mockingbird-api-client/actions?query=workflow%3Arun-tests+branch%3Amain)
[![GitHub Code Style Action Status](https://github.com/spatie/package-mockingbird-api-client-laravel/actions/workflows/fix-php-code-style-issues.yml/badge.svg)](https://github.com/lasselehtinen/mockingbird-api-client/actions?query=workflow%3A"Fix+PHP+code+style+issues"+branch%3Amain)
[![Total Downloads](https://img.shields.io/packagist/dt/lasselehtinen/mockingbird-api-client.svg?style=flat-square)](https://packagist.org/packages/lasselehtinen/mockingbird-api-client)

This is where your description should go. Limit it to a paragraph or two. Consider adding a small example.

## Installation

You can install the package via composer:

```bash
composer require lasselehtinen/mockingbird-api-client
```

You can publish the config file with:

```bash
php artisan vendor:publish --tag="mockingbird-api-client-config"
```

This is the contents of the published config file:

```php
return [
    'base_url' => env('MOCKINGBIRD_BASE_URL', 'https://tenantname-external-api-app.azurewebsites.net'),
    'oauth_url' => env('MOCKINGBIRD_OAUTH_URL', 'https://tenantname-identity-app.azurewebsites.net/core/connect/token'),
    'client_id' => env('MOCKINGBIRD_CLIENT_ID', 'client_name_here'),
    'client_secret' => env('MOCKINGBIRD_CLIENT_SECRET', 'client_secret_here'),
    'username' => env('MOCKINGBIRD_USERNAME', 'firstname.lastname@tenant.com'),
    'password' => env('MOCKINGBIRD_PASSWORD', 'mockingbird_user_password_here'),
    'scope' => env('MOCKINGBIRD_SCOPE', 'opus'),
];
```

# Usage

The package exposes dedicated services for each API area.

## Edition

```php
use Lasselehtinen\MockingbirdApiClient\Editions\EditionService;

$edition = app(EditionService::class);
$edition = $edition->get('1ca73850-96c2-4ac3-8b98-44d35c9378d1');
```

Or through dependency injection:

```php
use Lasselehtinen\MockingbirdApiClient\Editions\EditionService;

final class EditionController
{
    public function __construct(
        private readonly EditionService $edition,
    ) {}

    public function show(string $id)
    {
        return $this->edition->get($id);
    }
}
```

The service is registered as a singleton and can be resolved from Laravel's service container.

## Testing

```bash
composer test
```

## Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information on what has changed recently.

## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) for details.

## Security Vulnerabilities

Please review [our security policy](../../security/policy) on how to report security vulnerabilities.

## Credits

- [Lasse Lehtinen](https://github.com/Lasselehtinen)
- [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
