<?php

declare(strict_types=1);

namespace App\Modules\CMSIntegration\Repositories;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Arr;
use InvalidArgumentException;

abstract class ContentRepository
{
    /**
     * Retrieve an entity by its primary ID using the specified model class.
     *
     * @param int $id The primary key ID of the entity.
     * @param class-string<Model> $modelClass The model class to use for the query.
     * @return Model The model instance retrieved.
     * @throws InvalidArgumentException If the model class is invalid.
     */
    public function get(int $id, string $modelClass): Model
    {
        $this->validateModelClass($modelClass);

        return $modelClass::findOrFail($id);
    }

    /**
     * @template T of Model
     * @param int $cmsId
     * @param class-string<T> $modelClass
     * @return T
     * @throws InvalidArgumentException If the model class is invalid.
     */
    public function getByCmsId(int $cmsId, string $modelClass): Model
    {
        $this->validateModelClass($modelClass);

        return $modelClass::where('cms_id', $cmsId)->firstOrFail();
    }

    /**
     * Abstract method to update an existing entity or create a new one based on provided data.
     * This method needs to be implemented in subclass repositories to handle model-specific details.
     *
     * @template T of Model
     * @param array $data The data to update or create the entity with.
     * @param class-string<T> $modelClass The model class to use for the operation.
     * @return T The updated or newly created model instance.
     * @throws InvalidArgumentException If the model class is invalid.
     */
    abstract public function updateOrCreate(array $data, string $modelClass);

    /**
     * Utility method to filter and prepare data for persistence.
     * This method can be used within `updateOrCreate` or other methods requiring data manipulation.
     *
     * @param array $data The original data array.
     * @param array $allowedFields The list of fields that are allowed to be persisted.
     * @return array The filtered data array.
     */
    protected function prepareData(array $data, array $allowedFields): array
    {
        return Arr::only($data, $allowedFields);
    }

    /**
     * Validates that the provided class name is a valid Eloquent model class.
     *
     * @param class-string<Model> $modelClass The model class name to validate.
     * @throws InvalidArgumentException If the model class is invalid.
     */
    protected function validateModelClass(string $modelClass): void
    {
        if (!is_subclass_of($modelClass, Model::class)) {
            throw new InvalidArgumentException("The class {$modelClass} must be a subclass of " . Model::class);
        }
    }

    /**
     * Returns
     *
     * @template T of Model
     * @param class-string<T> $modelClass
     * @return Collection<T>
     */
    public function getList(string $modelClass): Collection
    {
        return $modelClass::orderBy('sort')->get();
    }
}
