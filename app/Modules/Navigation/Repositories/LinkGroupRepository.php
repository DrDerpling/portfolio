<?php

declare(strict_types=1);

namespace App\Modules\Navigation\Repositories;

use App\Modules\CMSIntegration\Enums\StatusEnum;
use App\Modules\CMSIntegration\Repositories\ContentRepository;
use App\Modules\Navigation\DataObjects\LinkItem;
use App\Modules\Navigation\Models\LinkGroup as LinkGroupModel;
use App\Modules\Navigation\Models\LinkItem as LinkItemModel;

class LinkGroupRepository extends ContentRepository
{
    /**
     * @var class-string<LinkGroupModel>
     */
    protected string $modelClass = LinkGroupModel::class;

    public function __construct(private LinkItemRepository $linkItemRepository)
    {
    }

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

    /**
     * @param array $data
     * @return LinkGroupModel
     */
    public function updateOrCreate(array $data): LinkGroupModel
    {
        $cmsId = $data['cms_id'];

        $hydratedData = $this->prepareData($data, ['name', 'children', 'status', 'sort', 'cms_id']);
        $linkGroup = $this->modelClass::updateOrCreate(['cms_id' => $cmsId], $hydratedData);

        if (isset($data['children'])) {
            /** @var LinkItem $child */
            foreach ($data['children'] as $child) {
                $child->set('parent_id', $linkGroup->id);
                $child->set('cms_id', $child->get('id'));

                $this->linkItemRepository->updateOrCreate($child->toArray());
            }
        }

        return $linkGroup;
    }
}
