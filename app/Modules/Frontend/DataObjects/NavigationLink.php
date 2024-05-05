<?php

declare(strict_types=1);

namespace App\Modules\Frontend\DataObjects;

use App\Modules\Framework\AbstractDataObject;

class NavigationLink extends AbstractDataObject
{
    public function getUrl(): string
    {
        return (string)$this->get('url');
    }

    public function getLabel(): string
    {
        return (string)$this->get('label');
    }

    public function getIconName(): string
    {
        return (string)$this->get('icon_name');
    }

    public function isActive(): bool
    {
        return (bool)$this->get('active');
    }

    public function getChildren(): array
    {
        return (array)$this->get('children');
    }

    public function hasChildren(): bool
    {
        return count($this->getChildren()) > 0;
    }

    public function hasActiveChildren(): bool
    {
        foreach ($this->getChildren() as $child) {
            if ($child->isActive()) {
                return true;
            }
        }

        return false;
    }
}
