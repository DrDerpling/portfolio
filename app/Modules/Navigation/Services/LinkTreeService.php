<?php

declare(strict_types=1);

namespace App\Modules\Navigation\Services;

use App\Modules\CMSIntegration\Api\Directus;
use App\Modules\CMSIntegration\Services\CMSDataService;
use App\Modules\Framework\AbstractDataObject;
use App\Modules\Navigation\DataObjects\LinkGroup as LinkGroupDataObject;
use App\Modules\Navigation\DataObjects\LinkItem as LinkItemDataObject;
use App\Modules\Navigation\Models\LinkGroup;
use App\Modules\Navigation\Models\LinkItem;
use App\Modules\Navigation\Repositories\LinkGroupRepository;
use Illuminate\Database\Eloquent\Model;

class LinkTreeService extends CMSDataService
{
    public function __construct(
        protected LinkGroupRepository $linkGroupRepository,
    ) {
        parent::__construct($linkGroupRepository);
    }

    /**
     * @param bool $forceRefresh
     * @param bool $devMode
     * @return array<LinkGroup|LinkItem>
     * @throws \Exception
     */
    public function getTree(bool $forceRefresh, bool $devMode = false): array
    {
        if ($forceRefresh) {
            return $this->getFromDirectus();
        }

        $links = $this->linkGroupRepository->getTree($devMode);

        if (empty($links)) {
            return $this->getFromDirectus();
        }

        return $links;
    }

    /**
     * @param LinkGroupDataObject $item
     * @return LinkGroup
     */
    protected function saveItem(AbstractDataObject $item): Model
    {
        $item->set('cms_id', $item->get('id'));

        return $this->linkGroupRepository->updateOrCreate($item->toArray());
    }

    /**
     * @param int|null $id
     * @return array
     * @throws \Exception
     */
    protected function getFromDirectus(int $id = null): array
    {
        $directusItems = Directus::collection('link_group')->get();

        $directusItems = array_map(function (array $item) {
            $linkItemIds = array_values($item['link_items']);

            $items = Directus::collection('link_items')
                ->where('id', '_in', implode(',', $linkItemIds))
                ->fields('id', 'name', 'page.slug', 'page.id', 'icon.key', 'sort', 'status', 'link_group')
                ->get();

            $item['children'] = array_map(function (array $item) {
                $item['slug'] = $item['page']['slug'];
                $item['page_id'] = $item['page']['id'];
                unset($item['page']);
                $item['icon'] = $item['icon']['key'];
                $item['parent_id'] = $item['link_group'];
                unset($item['link_group']);

                return new LinkItemDataObject($item);
            }, $items);

            return new LinkGroupDataObject($item);
        }, $directusItems);

        return $this->saveItems($directusItems);
    }
}
