<?php

declare(strict_types=1);

namespace App\Modules\Navigation\Repositories;

use App\Modules\CMSIntegration\Repositories\ContentRepository;
use App\Modules\Navigation\Models\LinkItem as LinkItemModel;

class LinkItemRepository extends ContentRepository
{
    /**
     * @var class-string<LinkItemModel>
     */
    protected string $modelClass = LinkItemModel::class;

    /**
     * @param array $data
     * @return LinkItemModel
     */
    public function updateOrCreate(array $data): LinkItemModel
    {
        $cmsId = $data['cms_id'];

        $hydratedData = $this->prepareData(
            $data,
            ['name', 'slug', 'page_id', 'icon', 'parent_id', 'status', 'sort', 'cms_id']
        );

        return $this->modelClass::updateOrCreate(['cms_id' => $cmsId], $hydratedData);
    }

    public function getByUrl(string $url): ?LinkItemModel
    {
        $path = parse_url($url, PHP_URL_PATH);

        if ($path === null) {
            $path = 'home';
        }

        $path = ltrim($path, '/');

        return $this->getBySlug($path);
    }

    public function getBySlug(string $slug): ?LinkItemModel
    {
        return LinkItemModel::query()
            ->where('slug', $slug)
            ->first();
    }
}
