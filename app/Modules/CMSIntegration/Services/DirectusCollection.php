<?php

declare(strict_types=1);

namespace App\Modules\CMSIntegration\Services;

class DirectusCollection
{
    protected array $filters = [];
    protected array $fields = [];

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

    public function find(int $id): array
    {
        return $this->httpClient->getItem($this->collectionName, $id);
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

        return $parameters;
    }
}
