<?php

declare(strict_types=1);

namespace App\Modules\CMSIntegration\Factories;

use App\Modules\CMSIntegration\Repositories\Context;

class ContextFactory
{
    public static function create(
        string $modelClass,
        array $fields = [],
        string $collectionName = '',
        ?string $orderBy = 'sort'
    ): Context {
        $request = request();
        $forceRefresh = (bool)$request->input('force_new', false);

        return new Context($modelClass, $fields, $forceRefresh, $collectionName, $orderBy);
    }
}
