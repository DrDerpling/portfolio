<?php

declare(strict_types=1);

namespace App\Modules\CMSIntegration\Services;

use Exception;
use Illuminate\Http\Client\Response;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Http;

class DirectusApi
{
    public function __construct()
    {
    }

    /**
     * @param string $collection
     * @param array $query
     * @return array
     * @throws Exception
     */
    public function getItems(string $collection, array $query = []): array
    {
        $response = $this->get("items/$collection", $query)->json();

        if (isset($response['errors'])) {
            $this->handleError($response);
        }


        return $response['data'];
    }

    public function getItem(string $collection, int $id): array
    {
        $response = $this->get("items/$collection/$id")->json();

        if (isset($response['errors'])) {
            $this->handleError($response);
        }


        return $response['data'];
    }

    /**
     * @param array{errors:array{array-key,array{message:string}}} $response
     * @throws Exception
     */
    private function handleError(array $response): void
    {
        /**
         * @var array{message:string} $firstError
         */
        $firstError = Arr::first($response['errors']);

        throw new Exception($firstError['message']);
    }

    /**
     * @param string $endpoint
     * @param array $query
     * @return Response
     */
    private function get(string $endpoint, array $query = []): Response
    {
        $url = config('integration.directus.base_uri') . '/' . $endpoint;

        return Http::withToken(config('integration.directus.token'))->get($url, $query);
    }
}
