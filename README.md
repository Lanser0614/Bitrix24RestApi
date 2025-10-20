# Codex Bitrix24 Laravel Package

Laravel wrapper around the Bitrix24 REST API with a focus on CRM entities.

## Installation

```bash
composer require codex/bitrix24-laravel
```

Publish configuration:

```bash
php artisan vendor:publish --tag=bitrix24-config
```

Configure the following environment variables:

```
BITRIX24_BASE_URI="https://your-domain.bitrix24.com/rest/"
BITRIX24_WEBHOOK_USER=1
BITRIX24_WEBHOOK_CODE=abcdefghijklmno
# Optional when using OAuth:
# BITRIX24_AUTH_TOKEN="oauth_access_token"
```

## Authentication

- Incoming webhook: supply `BITRIX24_BASE_URI`, `BITRIX24_WEBHOOK_USER`, and `BITRIX24_WEBHOOK_CODE`. Requests are routed to `{base}/{user}/{code}/{method}.json` automatically. Leave the auth token unset.
- OAuth: omit webhook credentials and provide `BITRIX24_AUTH_TOKEN`. The client sends the token as the `auth` query parameter.

If both webhook credentials and an auth token are present, the webhook path takes precedence.

## Usage

Access the manager with dependency injection:

```php
use Codex\Bitrix24\Bitrix24Manager;
use Codex\Bitrix24\DTO\CRM\LeadFieldsDto;

public function __construct(private Bitrix24Manager $bitrix) {}

public function createLead(): int
{
    return $this->bitrix->crm()->leads()->add(
        new LeadFieldsDto(
            title: 'New lead',
            name: 'Jane',
            lastName: 'Doe',
            phones: [
                ['VALUE' => '+123456789', 'VALUE_TYPE' => 'WORK'],
            ],
            emails: [
                ['VALUE' => 'jane@example.com', 'VALUE_TYPE' => 'WORK'],
            ],
        )
    );
}
```

Or via the facade:

```php
use Codex\Bitrix24\Facades\Bitrix24;
use Codex\Bitrix24\DTO\CRM\LeadFieldsDto;

$lead = Bitrix24::crm()->leads()->get(42);

Bitrix24::crm()->leads()->update(
    42,
    (new LeadFieldsDto(title: 'Existing lead'))
        ->withExtra(['STATUS_ID' => 'CONVERTED'])
);
```

## Supported CRM services

- Leads
- Deals
- Contacts
- Companies
- Products
- Product Sections
- Quotes
- Invoices
- Activities
- Requisites
- Deal Categories
- Statuses
- Stages
- Currencies

For other CRM entities, use `Bitrix24::crm()->service('entityName')`.

## Field DTOs

- All `add` and `update` operations expect an implementation of `Codex\Bitrix24\DTO\FieldsDtoInterface`.
- Use any of the ready-made CRM DTOs for type-safe payloads:
  - `Codex\Bitrix24\DTO\CRM\LeadFieldsDto`
  - `Codex\Bitrix24\DTO\CRM\DealFieldsDto`
  - `Codex\Bitrix24\DTO\CRM\ContactFieldsDto`
  - `Codex\Bitrix24\DTO\CRM\CompanyFieldsDto`
  - `Codex\Bitrix24\DTO\CRM\ProductFieldsDto`
  - `Codex\Bitrix24\DTO\CRM\ProductSectionFieldsDto`
  - `Codex\Bitrix24\DTO\CRM\QuoteFieldsDto`
  - `Codex\Bitrix24\DTO\CRM\InvoiceFieldsDto`
  - `Codex\Bitrix24\DTO\CRM\ActivityFieldsDto`
  - `Codex\Bitrix24\DTO\CRM\RequisiteFieldsDto`
  - `Codex\Bitrix24\DTO\CRM\DealCategoryFieldsDto`
  - `Codex\Bitrix24\DTO\CRM\StatusFieldsDto`
  - `Codex\Bitrix24\DTO\CRM\StageFieldsDto`
  - `Codex\Bitrix24\DTO\CRM\CurrencyFieldsDto`
- Use `Codex\Bitrix24\DTO\GenericFieldsDto` for quick array-backed payloads.
- Create your own DTO classes to add validation, defaults, or IDE type safety before making requests.
# Bitrix24RestApi
