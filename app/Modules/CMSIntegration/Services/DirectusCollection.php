<?php

declare(strict_types=1);

namespace App\Modules\CMSIntegration\Services;

use Illuminate\Filesystem\FilesystemAdapter;
use Illuminate\Support\Facades\Storage;

class DirectusCollection
{
    protected array $filters = [];
    protected array $fields = [];
    protected array $queryParameters = [];

    final public function __construct(protected string $collectionName, protected DirectusApi $httpClient)
    {
    }

    public static function collection(string $collectionName): self
    {
        return new static($collectionName, resolve(DirectusApi::class));
    }

    public function where(string $field, string $operator, mixed $value): self
    {
        $this->filters[] = [
            'field' => $field,
            'operator' => $operator,
            'value' => $value
        ];
        return $this;
    }

    public function addQueryParameter(string $key, mixed $value): self
    {
        $this->queryParameters[$key] = $value;
        return $this;
    }

    public function fields(string ...$fields): self
    {
        $this->fields = $fields;

        return $this;
    }

    public function get(): array
    {
        $queryParameters = $this->buildQueryParameters();

        return $this->httpClient->getItems($this->collectionName, $queryParameters);
    }

    public function find(int|string $id): array
    {
        if ($this->collectionName === 'assets') {
            return $this->httpClient->findAssets($id, $this->buildQueryParameters());
        }

        return $this->httpClient->getItem($this->collectionName, $id);
    }

    public function download(
        string $id,
        ?FilesystemAdapter $disk = null,
        ?string $filePath = null
    ): string {
        if ($this->collectionName !== 'assets') {
            throw new \Exception('Download method is only available for assets collection');
        }

        if (is_null($disk)) {
            $disk = Storage::disk('local');
        }

        return $this->httpClient->downloadAssets($id, $this->buildQueryParameters(), $disk, $filePath);
    }

    protected function buildQueryParameters(): array
    {
        $parameters = [];

        if (!empty($this->filters)) {
            foreach ($this->filters as $filter) {
                $parameters['filter'][$filter['field']][$filter['operator']] = $filter['value'];
            }
        }

        if (!empty($this->fields)) {
            $parameters['fields'] = implode(',', $this->fields);
        }

        if (!empty($this->queryParameters)) {
            $parameters = array_merge($parameters, $this->queryParameters);
        }

        return $parameters;
    }
}
