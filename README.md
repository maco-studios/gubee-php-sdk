<img src=".github/assets/logo.png" width="100px" />

[![CI](https://img.shields.io/github/actions/workflow/status/maco-studios/gubee-php-sdk/ci.yml?branch=main&label=ci&color=6F2DBD)](https://github.com/maco-studios/gubee-php-sdk/actions/workflows/ci.yml)
[![Security](https://img.shields.io/github/actions/workflow/status/maco-studios/gubee-php-sdk/security.yml?branch=main&label=security&color=6F2DBD)](https://github.com/maco-studios/gubee-php-sdk/actions/workflows/security.yml)
[![OpenSSF Scorecard](https://img.shields.io/ossf-scorecard/github.com/maco-studios/gubee-php-sdk?label=scorecard&color=6F2DBD)](https://scorecard.dev/viewer/?uri=github.com/maco-studios/gubee-php-sdk)
[![Contributors](https://img.shields.io/github/contributors/maco-studios/gubee-php-sdk?color=6F2DBD)](https://github.com/maco-studios/gubee-php-sdk/graphs/contributors)
[![Issues](https://img.shields.io/github/issues/maco-studios/gubee-php-sdk?color=6F2DBD)](https://github.com/maco-studios/gubee-php-sdk/issues)
[![Coverage](./.github/assets/coverage.svg)](#running-tests)
[![Changelog](https://img.shields.io/badge/changelog-gitmoji-6F2DBD)](./CHANGELOG.md)

# Gubee PHP SDK

English | [Português (Brasil)](./README.pt-BR.md)

PHP SDK for integrating with the Gubee API, aimed at teams that need to consume catalog, orders, promotions, media, platform, and related Gubee resources from PHP applications.

## Summary

- [Installation](#installation)
- [Documentation And Help](#documentation-and-help)
- [What This Repository Covers](#what-this-repository-covers)
- [Usage/Examples](#usageexamples)
- [Running Tests](#running-tests)
- [Development](#development)
- [Repository Maintenance](#repository-maintenance)
- [Contributing](#contributing)
- [Contributors](#contributors)
- [Official Links](#official-links)
- [FAQ](#faq)
- [License](#license)

## Installation

Install `gubee-marketplace/php-sdk` with Composer.

```bash
composer require gubee-marketplace/php-sdk
```

## Documentation And Help

- API and integration docs: [developers.gubee.com.br](https://developers.gubee.com.br/)
- Official Gubee website: [gubee.com.br](https://gubee.com.br/)
- Repository contribution flow: [CONTRIBUTING.md](./CONTRIBUTING.md)
- Security reports: [SECURITY.md](./SECURITY.md)
- Bug reports and feature requests: [GitHub Issues](https://github.com/maco-studios/gubee-php-sdk/issues)

## What This Repository Covers

- HTTP client with Bearer authentication, retries, and response history
- models and enums for API payloads
- resources for catalog, orders, ads, invoice, notifications, promotions, tags, media, shipping, and platform APIs
- unit tests and integration contract tests against the OpenAPI specification

## Usage/Examples

```php
<?php

use Gubee\SDK\Client;

$client = (new Client())
    ->authenticate('your-token');
```

### Revalidate a token

```php
<?php

use Gubee\SDK\Client;

$client = (new Client())
    ->authenticate('your-token');

$token = $client->token()->revalidate('your-token');

echo $token->getSellerId();
```

### Query platform configuration

```php
<?php

use Gubee\SDK\Client;
use Gubee\SDK\Resource\PlatformResource;

$client = (new Client())
    ->authenticate('your-token');

$platforms = (new PlatformResource($client))->configuration();
```

### Load a product by id

```php
<?php

use Gubee\SDK\Client;
use Gubee\SDK\Resource\Catalog\ProductResource;

$client = (new Client())
    ->authenticate('your-token');

$product = (new ProductResource($client))->loadById('product-id');

echo $product->getId();
```

### Read the last response

```php
<?php

use Gubee\SDK\Client;

$client = (new Client())
    ->authenticate('your-token');

$client->token()->revalidate('your-token');

$response = $client->getLastResponse();
```

## Running Tests

To run tests, run the following command:

```bash
composer test
```

## Development

```bash
composer cs
composer cs:fix
composer rector:dry-run
composer test
```

## Repository Maintenance

- CI: [`.github/workflows/ci.yml`](./.github/workflows/ci.yml)
- security checks: [`.github/workflows/security.yml`](./.github/workflows/security.yml)
- stale triage: [`.github/workflows/stale.yml`](./.github/workflows/stale.yml)
- changelog automation: [`.github/workflows/changelog.yml`](./.github/workflows/changelog.yml)
- contributors banner: [`.github/workflows/contributors.yml`](./.github/workflows/contributors.yml)

## Contributing

Read [CONTRIBUTING.md](./CONTRIBUTING.md) before opening issues or pull requests.

## Contributors

<p>
  <a href="https://github.com/maco-studios/gubee-php-sdk/graphs/contributors">
    <img src="./.github/assets/contributors.svg" alt="Contributors" />
  </a>
</p>

## Official Links

- Developer portal: [developers.gubee.com.br](https://developers.gubee.com.br/)
- Official website: [gubee.com.br](https://gubee.com.br/)

## FAQ

<details>
  <summary>Which PHP version is supported?</summary>

This SDK targets PHP `^8.0`, matching the requirement declared in `composer.json`.
</details>

<details>
  <summary>Does the SDK include a built-in DI container?</summary>

No dedicated application container is required for normal use. The SDK bootstraps its internal service provider, and the common entrypoint is instantiating `Gubee\SDK\Client` directly.
</details>

<details>
  <summary>How do I authenticate requests?</summary>

Instantiate `Client` and call `authenticate('your-token')` before using a resource.
</details>

<details>
  <summary>How do I access resources not exposed as shortcut methods on `Client`?</summary>

Instantiate the resource directly with the client instance, for example `new ProductResource($client)` or `new PlatformResource($client)`.
</details>

<details>
  <summary>Are there tests for the SDK contracts?</summary>

Yes. The repository includes unit tests and integration contract tests validated against the OpenAPI fixture in `test/Integration/Contract/openapi-integration.json`.
</details>

## License

This project is currently distributed as proprietary software unless the maintainers publish a different license later.
