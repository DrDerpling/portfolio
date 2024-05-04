<?php

declare(strict_types=1);

namespace App\Modules\CMSIntegration\Services;

use Exception;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use Illuminate\Http\Client\Response;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Http;
use JsonException;

class DirectusApi
{
    public function __construct(private Client $authenticatedClient)
    {
    }

    /**
     * @throws GuzzleException
     * @throws JsonException
     */
    public function getItems(string $collection, array $query = []): array
    {
        $response = $this->get("items/$collection", $query)->json();

        if (isset($response['errors'])) {
            $firstError = Arr::first($response['errors']);

            throw new Exception($firstError['message']);
        }


        return $response['data'];
    }

    /**
     * @param string $endpoint
     * @param array $query
     * @return Response
     */
    private function get(string $endpoint, array $query = []): Response
    {
        $url = config('integration.directus.base_uri') . '/' . $endpoint;

        return Http::withToken(config('integration.directus.token'))->get($url, [
            'query' => $query,
        ]);
    }
}
