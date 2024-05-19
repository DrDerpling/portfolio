<?php

declare(strict_types=1);

namespace App\Modules\Navigation\Repositories;

use App\Modules\CMSIntegration\Factories\ContextFactory;
use App\Modules\CMSIntegration\Repositories\Context;
use App\Modules\CMSIntegration\Repositories\DirectusRepository;
use App\Modules\Framework\DataObject;
use App\Modules\Navigation\Models\LinkItem as LinkItemModel;

/**
 * Class LinkItemRepository
 *
 * Warning: This class is heavily coupled with the LinkGroupRepository class.
 * It is advised not to use this class outside the Navigation module.
 */
class LinkItemRepository extends DirectusRepository
{
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
        /** @var LinkItemModel $item */
        $item = $this->getModelQuery()
            ->where('slug', $slug)
            ->first();

        return $item;
    }

    protected function prepareData(array $data): DataObject
    {
        return self::buildLinkItemData($data);
    }

    public static function buildLinkItemData(array $data): DataObject
    {
        $object = new DataObject($data);
        $object->set('cms_id', $object->get('id'));
        $object->set('slug', $object->get('page.slug'));
        $object->set('page_id', $object->get('page.id'));
        $object->set('icon', $object->get('icon.key'));

        $object->unset('page');
        $object->unset('link_group');

        return $object;
    }

    public function getContext(): Context
    {
        return ContextFactory::create(
            LinkItemModel::class,
            [
                'id',
                'name',
                'page.slug',
                'page.id',
                'icon.key',
                'sort',
                'status',
                'link_group'
            ],
            collectionName: 'link_items'
        );
    }
}
