<?php

declare(strict_types=1);

namespace App\Modules\Navigation\Repositories;

use App\Modules\Navigation\Models\LinkGroup as LinkGroupModel;
use App\Modules\Navigation\Models\LinkItem as LinkItemModel;
use Drderpling\DirectusRepository\Api\Directus;
use Drderpling\DirectusRepository\Enums\StatusEnum;
use Drderpling\DirectusRepository\Factories\ContextFactory;
use Drderpling\DirectusRepository\Repositories\Context;
use Drderpling\DirectusRepository\Repositories\DirectusRepository;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

class LinkGroupRepository extends DirectusRepository
{
    public function __construct(private LinkItemRepository $linkItemRepository)
    {
    }

    /**
     * @param bool $devMode
     * @return array<LinkGroupModel|LinkItemModel>
     */
    public function getTree(bool $devMode): array
    {
        if ($this->getContext()->isForceRefresh()) {
            $this->getFromDirectus(); // I know its inefficient, I'm also lazy and don't care
        }

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

    /**
     * @param Collection $item
     * @return Model
     */
    public function updateOrCreate(Collection $item): Model
    {
        $cmsId = $item->get('cms_id');

        /** @var LinkGroupModel $linkGroup */
        $linkGroup = $this->getModelQuery()->updateOrCreate(['cms_id' => $cmsId], $item->toArray());

        if ($item->has('children')) {
            foreach ($item->get('children') as $child) {
                $child->put('parent_id', $linkGroup->id);
                $child->put('cms_id', $child->get('id'));

                $this->linkItemRepository->updateOrCreate($child);
            }
        }

        return $linkGroup;
    }

    protected function prepareData(array $data): Collection
    {
        $object = collect($data);
        $object->put('cms_id', $data['id']);

        $linkItemIds = array_values($object->get('link_items'));

        $items = Directus::collection('link_items')
            ->where('id', '_in', implode(',', $linkItemIds))
            ->fields('id', 'name', 'page.slug', 'page.id', 'icon.key', 'sort', 'status', 'link_group')
            ->get();

        $object->put('children', array_map(static function (array $item) {
            return LinkItemRepository::buildLinkItemData($item);
        }, $items));

        return $object;
    }

    public function getContext(): Context
    {
        return ContextFactory::create(LinkGroupModel::class, collectionName: 'link_group');
    }
}
