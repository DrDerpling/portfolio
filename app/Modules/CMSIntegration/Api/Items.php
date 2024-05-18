<?php

declare(strict_types=1);

namespace App\Modules\CMSIntegration\Api;

use App\Modules\CMSIntegration\Services\DirectusApi;

class Items extends Builder
{
    protected string $collectionName;

    public function __construct(DirectusApi $httpClient, string $collectionName)
    {
        parent::__construct($httpClient);
        $this->collectionName = $collectionName;
    }

    public function find(int|string $id): array
    {
        return $this->httpClient->getItem($this->collectionName, $id);
    }

    public function get(): array
    {
        $queryParameters = $this->buildQueryParameters();

        return $this->httpClient->getItems($this->collectionName, $queryParameters);
    }
}
