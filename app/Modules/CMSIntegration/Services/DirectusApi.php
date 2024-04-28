<?php

declare(strict_types=1);

namespace App\Domains\CMSIntegration\Services;

use GuzzleHttp\Client;

class DirectusApi
{
    public function __construct(private Client $authenticatedClient)
    {
    }

    public function getItems(string $collection, array $query = []): array
    {
        $response = $this->authenticatedClient->get("items/$collection", [
            'query' => $query,
        ]);

        return json_decode($response->getBody()->getContents(), true);
    }
}
