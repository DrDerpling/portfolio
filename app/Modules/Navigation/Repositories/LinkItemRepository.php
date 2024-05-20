<?php

declare(strict_types=1);

namespace App\Modules\Navigation\Repositories;

use App\Modules\Navigation\Models\LinkItem as LinkItemModel;
use Arr;
use DrDerpling\DirectusRepository\Factories\ContextFactory;
use DrDerpling\DirectusRepository\Repositories\Context;
use DrDerpling\DirectusRepository\Repositories\DirectusRepository;
use Illuminate\Support\Collection;

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

    protected function prepareData(array $data): Collection
    {
        return self::buildLinkItemData($data);
    }

    public static function buildLinkItemData(array $data): Collection
    {
        $object = collect($data);

        $object->put('cms_id', $object->get('id'));
        $object->put('slug', Arr::get($object, 'page.slug'));
        $object->put('page_id', Arr::get($object, 'page.id'));
        $object->put('icon', Arr::get($object, 'icon.key'));

        $object->forget('page');
        $object->forget('link_group');

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
