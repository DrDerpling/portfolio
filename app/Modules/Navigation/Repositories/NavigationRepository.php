<?php

declare(strict_types=1);

namespace App\Modules\Navigation\Repositories;

use App\Modules\CMSIntegration\Enums\StatusEnum;
use App\Modules\Navigation\DataObjects\LinkItem;
use App\Modules\Navigation\Models\LinkGroup as LinkGroupModel;
use App\Modules\Navigation\Models\LinkItem as LinkItemModel;

class NavigationRepository
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
        // Get the path from the URL
        $path = parse_url($url, PHP_URL_PATH);

        /** @var LinkItemModel $linkItem */
        $linkItem = LinkItemModel::query()
            ->where('slug', $path)
            ->first();

        return $linkItem;
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
}
