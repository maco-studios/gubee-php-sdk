<img src=".github/assets/logo.png" width="100px" />

[![CI](https://img.shields.io/github/actions/workflow/status/maco-studios/gubee-php-sdk/ci.yml?branch=main&label=ci&color=6F2DBD)](https://github.com/maco-studios/gubee-php-sdk/actions/workflows/ci.yml)
[![Security](https://img.shields.io/github/actions/workflow/status/maco-studios/gubee-php-sdk/security.yml?branch=main&label=security&color=6F2DBD)](https://github.com/maco-studios/gubee-php-sdk/actions/workflows/security.yml)
[![OpenSSF Scorecard](https://img.shields.io/ossf-scorecard/github.com/maco-studios/gubee-php-sdk?label=scorecard&color=6F2DBD)](https://scorecard.dev/viewer/?uri=github.com/maco-studios/gubee-php-sdk)
[![Contributors](https://img.shields.io/github/contributors/maco-studios/gubee-php-sdk?color=6F2DBD)](https://github.com/maco-studios/gubee-php-sdk/graphs/contributors)
[![Issues](https://img.shields.io/github/issues/maco-studios/gubee-php-sdk?color=6F2DBD)](https://github.com/maco-studios/gubee-php-sdk/issues)
[![Coverage](./.github/assets/coverage.svg)](#executando-os-testes)
[![Changelog](https://img.shields.io/badge/changelog-gitmoji-6F2DBD)](./CHANGELOG.md)

[English](./README.md) | Português (Brasil)

# Gubee PHP SDK

SDK PHP para integração com a API da Gubee, voltado para times que precisam consumir recursos de catálogo, pedidos, promoções, mídia, plataformas e outras superfícies da plataforma em aplicações PHP.

## Sumário

- [Instalação](#instalação)
- [Documentação e Ajuda](#documentação-e-ajuda)
- [O Que Este Repositório Cobre](#o-que-este-repositório-cobre)
- [Uso/Exemplos](#usoexemplos)
- [Executando os Testes](#executando-os-testes)
- [Desenvolvimento](#desenvolvimento)
- [Manutenção do Repositório](#manutenção-do-repositório)
- [Contribuição](#contribuição)
- [Contribuidores](#contribuidores)
- [Links Oficiais](#links-oficiais)
- [FAQ](#faq)
- [Licença](#licença)

## Instalação

Instale `gubee-marketplace/php-sdk` com Composer.

```bash
composer require gubee-marketplace/php-sdk
```

## Documentação e Ajuda

- Documentação de API e integrações: [developers.gubee.com.br](https://developers.gubee.com.br/)
- Site oficial da Gubee: [gubee.com.br](https://gubee.com.br/)
- Fluxo de contribuição do repositório: [CONTRIBUTING.md](./CONTRIBUTING.md)
- Reporte de vulnerabilidades: [SECURITY.md](./SECURITY.md)
- Bugs e solicitações de funcionalidade: [GitHub Issues](https://github.com/maco-studios/gubee-php-sdk/issues)

## O Que Este Repositório Cobre

- cliente HTTP com autenticação Bearer, retry e histórico de respostas
- models e enums para payloads da API
- resources para catálogo, pedidos, anúncios, invoice, notificações, promoções, tags, mídia, frete e plataforma
- testes unitários e contratos de integração contra a especificação OpenAPI

## Uso/Exemplos

```php
<?php

use Gubee\SDK\Client;

$client = (new Client())
    ->authenticate('your-token');
```

### Revalidar um token

```php
<?php

use Gubee\SDK\Client;

$client = (new Client())
    ->authenticate('your-token');

$token = $client->token()->revalidate('your-token');

echo $token->getSellerId();
```

### Consultar configurações de plataforma

```php
<?php

use Gubee\SDK\Client;
use Gubee\SDK\Resource\PlatformResource;

$client = (new Client())
    ->authenticate('your-token');

$platforms = (new PlatformResource($client))->configuration();
```

### Carregar um produto por id

```php
<?php

use Gubee\SDK\Client;
use Gubee\SDK\Resource\Catalog\ProductResource;

$client = (new Client())
    ->authenticate('your-token');

$product = (new ProductResource($client))->loadById('product-id');

echo $product->getId();
```

### Ler a última resposta

```php
<?php

use Gubee\SDK\Client;

$client = (new Client())
    ->authenticate('your-token');

$client->token()->revalidate('your-token');

$response = $client->getLastResponse();
```

## Executando os Testes

Para rodar os testes, execute:

```bash
composer test
```

## Desenvolvimento

```bash
composer cs
composer cs:fix
composer rector:dry-run
composer test
```

## Manutenção do Repositório

- CI: [`.github/workflows/ci.yml`](./.github/workflows/ci.yml)
- verificações de segurança: [`.github/workflows/security.yml`](./.github/workflows/security.yml)
- triagem de stale: [`.github/workflows/stale.yml`](./.github/workflows/stale.yml)
- automação de changelog: [`.github/workflows/changelog.yml`](./.github/workflows/changelog.yml)
- banner de contributors: [`.github/workflows/contributors.yml`](./.github/workflows/contributors.yml)

## Contribuição

Leia [CONTRIBUTING.md](./CONTRIBUTING.md) antes de abrir issue ou pull request.

## Contribuidores

<p>
  <a href="https://github.com/maco-studios/gubee-php-sdk/graphs/contributors">
    <img src="./.github/assets/contributors.svg" alt="Contributors" />
  </a>
</p>

## Links Oficiais

- Portal para desenvolvedores: [developers.gubee.com.br](https://developers.gubee.com.br/)
- Site oficial: [gubee.com.br](https://gubee.com.br/)

## FAQ

<details>
  <summary>Qual versão do PHP é suportada?</summary>

Este SDK suporta PHP `^8.0`, seguindo o requisito declarado no `composer.json`.
</details>

<details>
  <summary>O SDK inclui um container de DI para uso da aplicação?</summary>

Não é necessário um container dedicado da aplicação para uso normal. O SDK inicializa internamente seu service provider, e o ponto de entrada comum é instanciar `Gubee\SDK\Client` diretamente.
</details>

<details>
  <summary>Como autentico as requisições?</summary>

Instancie `Client` e chame `authenticate('your-token')` antes de usar um resource.
</details>

<details>
  <summary>Como acesso resources que não têm método de atalho em `Client`?</summary>

Instancie o resource diretamente com a instância de `Client`, por exemplo `new ProductResource($client)` ou `new PlatformResource($client)`.
</details>

<details>
  <summary>Existem testes para os contratos do SDK?</summary>

Sim. O repositório inclui testes unitários e testes de contrato de integração validados contra o fixture OpenAPI em `test/Integration/Contract/openapi-integration.json`.
</details>

## Licença

Este projeto é distribuído atualmente como software proprietário, salvo definição diferente futura pelos mantenedores.
