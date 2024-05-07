<?php

declare(strict_types=1);

namespace App\Modules\Framework;

use Illuminate\Support\Arr;
use JsonSerializable;
use Livewire\Wireable;

use function json_encode;

/**
 * @phpstan-consistent-constructor
 */
abstract class AbstractDataObject implements JsonSerializable, Wireable
{
    public function __construct(
        private array $data = []
    ) {
    }

    public function getData(): array
    {
        return $this->data;
    }

    public function setData(array $data): AbstractDataObject
    {
        $this->data = $data;
        return $this;
    }

    public function get(string $name): mixed
    {
        return Arr::get($this->data, $name);
    }

    public function set(string $name, mixed $value): AbstractDataObject
    {
        Arr::set($this->data, $name, $value);
        return $this;
    }

    public function toArray(): array
    {
        return $this->data;
    }

    public function toJson(): string
    {
        return json_encode($this->toArray());
    }

    public function __toString(): string
    {
        return $this->toJson();
    }

    public function jsonSerialize(): array
    {
        return $this->toArray();
    }

    /**
     * @return array
     */
    public function toLivewire(): array
    {
        return $this->toArray();
    }

    /**
     * @param array $value
     * @return static
     */
    public static function fromLivewire($value): static
    {
        return new static($value);
    }
}
