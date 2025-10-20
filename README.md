# Doniyor Bitrix24 Laravel Package

Laravel wrapper around the Bitrix24 REST API with a focus on CRM entities.

## Installation

```bash
composer require doniyor/bitrix24-laravel
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
use Doniyor\Bitrix24\Bitrix24Manager;
use Doniyor\Bitrix24\DTO\CRM\LeadFieldsDto;

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
use Doniyor\Bitrix24\Facades\Bitrix24;
use Doniyor\Bitrix24\DTO\CRM\LeadFieldsDto;

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

- All `add` and `update` operations expect an implementation of `Doniyor\Bitrix24\DTO\FieldsDtoInterface`.
- Use any of the ready-made CRM DTOs for type-safe payloads:
  - `Doniyor\Bitrix24\DTO\CRM\LeadFieldsDto`
  - `Doniyor\Bitrix24\DTO\CRM\DealFieldsDto`
  - `Doniyor\Bitrix24\DTO\CRM\ContactFieldsDto`
  - `Doniyor\Bitrix24\DTO\CRM\CompanyFieldsDto`
  - `Doniyor\Bitrix24\DTO\CRM\ProductFieldsDto`
  - `Doniyor\Bitrix24\DTO\CRM\ProductSectionFieldsDto`
  - `Doniyor\Bitrix24\DTO\CRM\QuoteFieldsDto`
  - `Doniyor\Bitrix24\DTO\CRM\InvoiceFieldsDto`
  - `Doniyor\Bitrix24\DTO\CRM\ActivityFieldsDto`
  - `Doniyor\Bitrix24\DTO\CRM\RequisiteFieldsDto`
  - `Doniyor\Bitrix24\DTO\CRM\DealCategoryFieldsDto`
  - `Doniyor\Bitrix24\DTO\CRM\StatusFieldsDto`
  - `Doniyor\Bitrix24\DTO\CRM\StageFieldsDto`
  - `Doniyor\Bitrix24\DTO\CRM\CurrencyFieldsDto`
- Use `Doniyor\Bitrix24\DTO\GenericFieldsDto` for quick array-backed payloads.
- Create your own DTO classes to add validation, defaults, or IDE type safety before making requests.

## Response DTOs & Mappers

- Services still return the raw Bitrix24 payload arrays so you can keep existing behaviour.
- When you want typed objects, use the dedicated mappers:
  - `Doniyor\Bitrix24\CRM\Mappers\LeadResponseMapper` → `Doniyor\Bitrix24\DTO\CRM\Response\LeadData`
  - `Doniyor\Bitrix24\CRM\Mappers\DealResponseMapper` → `Doniyor\Bitrix24\DTO\CRM\Response\DealData`
  - `Doniyor\Bitrix24\CRM\Mappers\ContactResponseMapper` → `Doniyor\Bitrix24\DTO\CRM\Response\ContactData`
  - `Doniyor\Bitrix24\CRM\Mappers\CompanyResponseMapper` → `Doniyor\Bitrix24\DTO\CRM\Response\CompanyData`
  - `Doniyor\Bitrix24\CRM\Mappers\ProductResponseMapper` → `Doniyor\Bitrix24\DTO\CRM\Response\ProductData`
  - `Doniyor\Bitrix24\CRM\Mappers\ProductSectionResponseMapper` → `Doniyor\Bitrix24\DTO\CRM\Response\ProductSectionData`
  - `Doniyor\Bitrix24\CRM\Mappers\QuoteResponseMapper` → `Doniyor\Bitrix24\DTO\CRM\Response\QuoteData`
  - `Doniyor\Bitrix24\CRM\Mappers\InvoiceResponseMapper` → `Doniyor\Bitrix24\DTO\CRM\Response\InvoiceData`
  - `Doniyor\Bitrix24\CRM\Mappers\ActivityResponseMapper` → `Doniyor\Bitrix24\DTO\CRM\Response\ActivityData`
  - `Doniyor\Bitrix24\CRM\Mappers\RequisiteResponseMapper` → `Doniyor\Bitrix24\DTO\CRM\Response\RequisiteData`
  - `Doniyor\Bitrix24\CRM\Mappers\DealCategoryResponseMapper` → `Doniyor\Bitrix24\DTO\CRM\Response\DealCategoryData`
  - `Doniyor\Bitrix24\CRM\Mappers\StatusResponseMapper` → `Doniyor\Bitrix24\DTO\CRM\Response\StatusData`
  - `Doniyor\Bitrix24\CRM\Mappers\StageResponseMapper` → `Doniyor\Bitrix24\DTO\CRM\Response\StageData`
  - `Doniyor\Bitrix24\CRM\Mappers\CurrencyResponseMapper` → `Doniyor\Bitrix24\DTO\CRM\Response\CurrencyData`
- Example usage:

```php
use Doniyor\Bitrix24\Facades\Bitrix24;
use Doniyor\Bitrix24\CRM\Mappers\LeadResponseMapper;

$payload = Bitrix24::crm()->leads()->get(42);
$lead = app(LeadResponseMapper::class)->map($payload);

echo $lead->title;
```
# Bitrix24RestApi
