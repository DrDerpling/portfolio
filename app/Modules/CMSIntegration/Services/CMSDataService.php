<?php

declare(strict_types=1);

namespace App\Modules\CMSIntegration\Services;

use App\Modules\CMSIntegration\Api\Directus;
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

    public function getList(bool $forceNew = false): array
    {
        if ($forceNew) {
            return $this->getFromDirectus();
        }

        $items = $this->repository->getList();

        if ($items->isEmpty()) {
            return $this->getFromDirectus();
        }

        return $items->all();
    }

    /**
     * @template T of Model
     * @param int $id
     * @param class-string<T> $modelClass
     * @param bool $forceNew
     * @return Model
     */
    public function find(int $id, string $modelClass, bool $forceNew = false): Model
    {
        if ($forceNew) {
            return $this->getFromDirectus($id);
        }

        try {
            return $this->repository->getByCmsId($id);
        } catch (\Exception $e) {
            return $this->getFromDirectus($id);
        }
    }

    /**
     * Generic method to fetch data from Directus API, either a single item or multiple items.
     */
    protected function fetchFromDirectus(string $collection, int $id = null): array
    {
        if ($id) {
            return Directus::collection($collection)->find($id);
        }

        return Directus::collection($collection)->get();
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
