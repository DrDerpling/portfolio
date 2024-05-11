<?php

declare(strict_types=1);

use App\Modules\CMSIntegration\Services\DirectusCollection;

if (!function_exists('directusCollection')) {


    /**
     * Initialize or retrieve a Directus collection.
     *
     * @param  string $collectionName The name of the Directus collection.
     * @return DirectusCollection
     */
    function directusCollection(string $collectionName): DirectusCollection
    {
        return app(DirectusCollection::class, ['collectionName' => $collectionName]);
    }
}
