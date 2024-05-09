<?php

declare(strict_types=1);

namespace App\Modules\Page\Repositories;

use App\Modules\Page\Models\Page;
use Illuminate\Support\Arr;

class PageRepository
{
    public function get(int $id): Page
    {
        return Page::query()->findOrFail($id);
    }

    public function updateOrCreate(array $data): Page
    {
        $cmsId = Arr::get($data, 'cms_id');
        $hydratedData = Arr::only($data, ['name', 'type', 'slug', 'content', 'status','cms_id']);

        $page = Page::whereCmsId($cmsId)->firstOrNew();
        $page->fill($hydratedData);
        $page->save();

        return $page;
    }
}
