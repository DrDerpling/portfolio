<?php

declare(strict_types=1);

namespace App\Modules\Page\Repositories;

use App\Modules\CMSIntegration\Repositories\ContentRepository;
use App\Modules\Page\Models\Page;
use Illuminate\Support\Arr;
use InvalidArgumentException;

class PageRepository extends ContentRepository
{
    /**
     * @param array $data
     * @param class-string<Page> $modelClass
     * @return Page
     */
    public function updateOrCreate(array $data, string $modelClass): Page
    {
        $hydratedData = $this->prepareData($data, ['name', 'type', 'slug', 'content', 'status','cms_id']);
        $cmsId = Arr::get($data, 'cms_id');

        if (!$cmsId) {
            throw new InvalidArgumentException('cms_id is required');
        }

        return $modelClass::updateOrCreate(['cms_id' => $cmsId], $hydratedData);
    }
}
