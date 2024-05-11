<?php

declare(strict_types=1);

namespace App\Modules\CMSIntegration\Services;

use App\Modules\CMSIntegration\Repositories\ContentRepository;
use App\Modules\Framework\AbstractDataObject;
use Illuminate\Database\Eloquent\Model;

abstract class CMSDataService
{
    public function __construct(
        protected ContentRepository $repository
    ) {
    }

    /**
     * Abstract method to save a single item.
     * Implement in child classes to handle specific types of data objects.
     * @param AbstractDataObject $item
     * @return Model
     */
    abstract protected function saveItem(AbstractDataObject $item): Model;

    /**
     * Abstract method to fetch data from Directus API.
     * Implement in child classes to handle specific types of data objects.
     * @param int|null $id
     * @return Model[]|Model
     */
    abstract protected function getFromDirectus(int $id = null);

    /**
     * @template T of Model
     * @param class-string<T> $modelClass
     * @param bool $forceNew
     * @return T[]
     */
    public function getList(string $modelClass, bool $forceNew = false): array
    {
        if ($forceNew) {
            return $this->getFromDirectus();
        }

        $items = $this->repository->getList($modelClass);

        if ($items->isEmpty()) {
            return $this->getFromDirectus();
        }

        return $items->all();
    }

    /**
     * Generic method to fetch data from Directus API, either a single item or multiple items.
     */
    protected function fetchFromDirectus(string $collection, int $id = null): array
    {
        if ($id) {
            return directusCollection($collection)->find($id);
        }

        return directusCollection($collection)->get();
    }

    /**
     * Generic method to save multiple items.
     * Convert items to models and persist them using the repository.
     *
     * @return Model[]
     */
    protected function saveItems(array $items): array
    {
        $result = [];
        foreach ($items as $item) {
            $result[] = $this->saveItem($item);
        }

        return $result;
    }
}
