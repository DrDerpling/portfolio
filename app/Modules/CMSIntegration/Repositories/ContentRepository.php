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
     * The model class to use for the repository.
     *
     * @var class-string<Model>
     */
    protected string $modelClass;

    public function get(int $id): Model
    {
        $this->validateModelClass($this->modelClass);

        return $this->modelClass::findOrFail($id);
    }

    public function getByCmsId(int $cmsId): Model
    {
        $this->validateModelClass($this->modelClass);

        return $this->modelClass::where('cms_id', $cmsId)->firstOrFail();
    }

    /**
     * Abstract method to update an existing entity or create a new one based on provided data.
     * This method needs to be implemented in subclass repositories to handle model-specific details.
     *
     * @param array $data The data to update or create the entity with.
     * @return Model The updated or newly created model instance.
     * @throws InvalidArgumentException If the model class is invalid.
     */
    abstract public function updateOrCreate(array $data): Model;

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
     * @return Collection<Model>
     */
    public function getList(): Collection
    {
        return $this->modelClass::orderBy('sort')->get();
    }
}
