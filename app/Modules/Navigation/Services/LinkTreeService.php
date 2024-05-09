<?php

declare(strict_types=1);

namespace App\Modules\Navigation\Services;

use App\Modules\CMSIntegration\Services\DirectusApi;
use App\Modules\Navigation\DataObjects\LinkGroup as LinkGroupDataObject;
use App\Modules\Navigation\DataObjects\LinkItem as LinkItemDataObject;
use App\Modules\Navigation\Models\LinkGroup;
use App\Modules\Navigation\Models\LinkItem;
use App\Modules\Navigation\Repositories\NavigationRepository;
use GuzzleHttp\Exception\GuzzleException;

class LinkTreeService
{
    public function __construct(
        private NavigationRepository $navigationRepository,
        private DirectusApi $directusApi
    ) {
    }

    /**
     * @param bool $forceRefresh
     * @param bool $devMode
     * @return array<LinkGroup|LinkItem>
     * @throws GuzzleException
     * @throws \JsonException
     */
    public function getTree(bool $forceRefresh, bool $devMode = false): array
    {
        if ($forceRefresh) {
            return $this->getFromDirectus();
        }

        $links = $this->navigationRepository->getTree($devMode);

        if (empty($links)) {
            return $this->getFromDirectus();
        }

        return $links;
    }


    /**
     * @param LinkGroupDataObject[] $items
     * @return LinkGroup[]
     */
    private function saveItems(array $items): array
    {
        $result = [];

        foreach ($items as $item) {
            $result[] = $this->saveItem($item);
        }

        return $result;
    }

    /**
     * @param LinkGroupDataObject $item
     * @return LinkGroup
     */
    private function saveItem(LinkGroupDataObject $item): LinkGroup
    {
        $item->set('cms_id', $item->get('id'));

        return $this->navigationRepository->saveLinkGroup($item->toArray());
    }

    /**
     * @return array
     * @throws GuzzleException
     * @throws \JsonException
     */
    private function getFromDirectus(): array
    {
        $directusItems = $this->directusApi->getItems('link_group');

        $directusItems = array_map(function (array $item) {
            $linkItemIds = array_values($item['link_items']);

            // ?filter[id][_in]=1&fields=id,page.slug,icon.key,sort,status,link_group
            $items = $this->directusApi->getItems('link_items', [
                'filter[id][_in]' => implode(',', $linkItemIds),
                'fields' => 'id,name,page.slug,icon.key,sort,status,link_group']);

            $item['children'] = array_map(function (array $item) {
                $item['slug'] = $item['page']['slug'];
                unset($item['page']);
                $item['icon'] = $item['icon']['key'];
                $item['parent_id'] = $item['link_group'];

                return new LinkItemDataObject($item);
            }, $items);

            return new LinkGroupDataObject($item);
        }, $directusItems);

        return $this->saveItems($directusItems);
    }
}
