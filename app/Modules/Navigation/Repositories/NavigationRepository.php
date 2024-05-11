<?php

declare(strict_types=1);

namespace App\Modules\Navigation\Repositories;

use App\Modules\CMSIntegration\Enums\StatusEnum;
use App\Modules\CMSIntegration\Repositories\ContentRepository;
use App\Modules\Navigation\DataObjects\LinkItem;
use App\Modules\Navigation\Models\LinkGroup as LinkGroupModel;
use App\Modules\Navigation\Models\LinkItem as LinkItemModel;
use InvalidArgumentException;

class NavigationRepository extends ContentRepository
{
    /**
     * @param bool $devMode
     * @return array<LinkGroupModel|LinkItemModel>
     */
    public function getTree(bool $devMode): array
    {
        $statuses = [StatusEnum::PUBLISHED->value];

        if ($devMode) {
            $statuses[] = StatusEnum::DRAFT->value;
        }

        $linkGroups = LinkGroupModel::query()->with(
            'children',
            fn($query) => $query->whereIn('status', $statuses)->orderBy('sort')
        )->whereIn('status', $statuses)->orderBy('sort')->get();

        $linkItems = LinkItemModel::query()
            ->whereIn('status', $statuses)
            ->orderBy('sort')
            ->where('parent_id', null)
            ->get();

        // @phpstan-ignore-next-line
        return $linkGroups->merge($linkItems)->sortBy('sort')->values()->all();
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

    public function saveLinkGroup(array $data): LinkGroupModel
    {
        $linkGroup = LinkGroupModel::firstOrNew(['cms_id' => $data['cms_id']]);
        $linkGroup->fill($data);
        $linkGroup->save();

        if (isset($data['children'])) {
            /** @var LinkItem $child */
            foreach ($data['children'] as $child) {
                $child->set('parent_id', $linkGroup->id);
                $child->set('cms_id', $child->get('id'));

                $this->saveLinkItem($child->toArray());
            }
        }

        return $linkGroup;
    }

    public function saveLinkItem(array $data): LinkItemModel
    {
        $linkItem = LinkItemModel::firstOrNew(['cms_id' => $data['cms_id']]);

        $linkItem->fill($data);
        $linkItem->save();

        return $linkItem;
    }

    /**
     * @param array $data
     * @param class-string<LinkGroupModel>|class-string<LinkItemModel> $modelClass
     * @return LinkGroupModel|LinkItemModel
     */
    public function updateOrCreate(array $data, string $modelClass): LinkGroupModel|LinkItemModel
    {
        $cmsId = $data['cms_id'];

        if ($modelClass === LinkGroupModel::class) {
            /** @var class-string<LinkGroupModel> $modelClass */
            $hydratedData = $this->prepareData($data, ['name', 'children', 'status', 'sort', 'cms_id']);
            $linkGroup = $modelClass::updateOrCreate(['cms_id' => $cmsId], $hydratedData);

            if (isset($data['children'])) {
                /** @var LinkItem $child */
                foreach ($data['children'] as $child) {
                    $child->set('parent_id', $linkGroup->id);
                    $child->set('cms_id', $child->get('id'));

                    $this->saveLinkItem($child->toArray());
                }
            }

            return $linkGroup;
        }

        if ($modelClass === LinkItemModel::class) {
            /** @var class-string<LinkItemModel> $modelClass */
            $hydratedData = $this->prepareData(
                $data,
                ['name', 'slug', 'page_id', 'icon', 'parent_id', 'status', 'sort', 'cms_id']
            );

            return $modelClass::updateOrCreate(['cms_id' => $cmsId], $hydratedData);
        }

        throw new InvalidArgumentException('Invalid model class provided');
    }
}
