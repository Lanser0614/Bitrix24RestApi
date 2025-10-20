<?php

declare(strict_types=1);

namespace Codex\Bitrix24\CRM;

use Codex\Bitrix24\Bitrix24Client;

class CrmManager
{
    private Bitrix24Client $client;

    /** @var array<string, AbstractCrmService> */
    private array $services = [];

    /**
     * @var array<string, class-string<AbstractCrmService>>
     */
    private const SERVICE_MAP = [
        'lead' => LeadService::class,
        'deal' => DealService::class,
        'contact' => ContactService::class,
        'company' => CompanyService::class,
        'product' => ProductService::class,
        'productsection' => ProductSectionService::class,
        'quote' => QuoteService::class,
        'invoice' => InvoiceService::class,
        'activity' => ActivityService::class,
        'requisite' => RequisiteService::class,
        'dealcategory' => DealCategoryService::class,
        'status' => StatusService::class,
        'stage' => StageService::class,
        'currency' => CurrencyService::class,
    ];

    public function __construct(Bitrix24Client $client)
    {
        $this->client = $client;
    }

    public function leads(): LeadService
    {
        /** @var LeadService */
        return $this->service('lead');
    }

    public function deals(): DealService
    {
        /** @var DealService */
        return $this->service('deal');
    }

    public function contacts(): ContactService
    {
        /** @var ContactService */
        return $this->service('contact');
    }

    public function companies(): CompanyService
    {
        /** @var CompanyService */
        return $this->service('company');
    }

    public function products(): ProductService
    {
        /** @var ProductService */
        return $this->service('product');
    }

    public function productSections(): ProductSectionService
    {
        /** @var ProductSectionService */
        return $this->service('productsection');
    }

    public function quotes(): QuoteService
    {
        /** @var QuoteService */
        return $this->service('quote');
    }

    public function invoices(): InvoiceService
    {
        /** @var InvoiceService */
        return $this->service('invoice');
    }

    public function activities(): ActivityService
    {
        /** @var ActivityService */
        return $this->service('activity');
    }

    public function requisites(): RequisiteService
    {
        /** @var RequisiteService */
        return $this->service('requisite');
    }

    public function dealCategories(): DealCategoryService
    {
        /** @var DealCategoryService */
        return $this->service('dealcategory');
    }

    public function statuses(): StatusService
    {
        /** @var StatusService */
        return $this->service('status');
    }

    public function stages(): StageService
    {
        /** @var StageService */
        return $this->service('stage');
    }

    public function currencies(): CurrencyService
    {
        /** @var CurrencyService */
        return $this->service('currency');
    }

    public function service(string $entity): AbstractCrmService
    {
        $entity = strtolower($entity);

        if (!isset($this->services[$entity])) {
            $this->services[$entity] = $this->makeService($entity);
        }

        return $this->services[$entity];
    }

    private function makeService(string $entity): AbstractCrmService
    {
        if (isset(self::SERVICE_MAP[$entity])) {
            $class = self::SERVICE_MAP[$entity];

            return new $class($this->client);
        }

        return new GenericCrmService($entity, $this->client);
    }
}
