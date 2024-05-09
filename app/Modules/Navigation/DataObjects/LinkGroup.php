<?php

declare(strict_types=1);

namespace App\Modules\Navigation\DataObjects;

use App\Modules\Framework\AbstractDataObject;

class LinkGroup extends AbstractDataObject
{
    public function getUrl(): string
    {
        return (string)$this->get('url');
    }

    public function getLabel(): string
    {
        return (string)$this->get('label');
    }

    public function isActive(): bool
    {
        return (bool)$this->get('active');
    }

    /**
     * @return LinkItem[]
     */
    public function getChildren(): array
    {
        return $this->get('children');
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
