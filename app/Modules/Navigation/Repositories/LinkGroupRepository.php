<?php

declare(strict_types=1);

namespace App\Modules\Navigation\Repositories;

use App\Modules\CMSIntegration\Api\Directus;
use App\Modules\CMSIntegration\Enums\StatusEnum;
use App\Modules\CMSIntegration\Factories\ContextFactory;
use App\Modules\CMSIntegration\Repositories\Context;
use App\Modules\CMSIntegration\Repositories\DirectusRepository;
use App\Modules\Framework\DataObject;
use App\Modules\Navigation\Models\LinkGroup as LinkGroupModel;
use App\Modules\Navigation\Models\LinkItem as LinkItemModel;
use Illuminate\Database\Eloquent\Model;

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
     * @param DataObject $item
     * @return Model
     */
    public function updateOrCreate(DataObject $item): Model
    {
        $cmsId = $item->get('cms_id');

        /** @var LinkGroupModel $linkGroup */
        $linkGroup = $this->getModelQuery()->updateOrCreate(['cms_id' => $cmsId], $item->getData());

        if ($item->has('children')) {
            foreach ($item->get('children') as $child) {
                $child->set('parent_id', $linkGroup->id);
                $child->set('cms_id', $child->get('id'));

                $this->linkItemRepository->updateOrCreate($child);
            }
        }

        return $linkGroup;
    }

    protected function prepareData(array $data): DataObject
    {
        $object = new DataObject($data);
        $object->set('cms_id', $data['id']);

        $linkItemIds = array_values($object->get('link_items'));

        $items = Directus::collection('link_items')
            ->where('id', '_in', implode(',', $linkItemIds))
            ->fields('id', 'name', 'page.slug', 'page.id', 'icon.key', 'sort', 'status', 'link_group')
            ->get();

        $object->set('children', array_map(static function (array $item) {
            return LinkItemRepository::buildLinkItemData($item);
        }, $items));

        return $object;
    }

    public function getContext(): Context
    {
        return ContextFactory::create(LinkGroupModel::class, collectionName: 'link_group');
    }
}
