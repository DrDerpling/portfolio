<?php

declare(strict_types=1);

namespace App\Modules\Navigation\DataObjects;

use App\Modules\Framework\AbstractDataObject;

class LinkItem extends AbstractDataObject
{
    public function getLabel(): string
    {
        return (string)$this->get('label');
    }

    public function getIconName(): string
    {
        return (string)$this->get('icon_name');
    }

    public function getUrl(): string
    {
        return (string)$this->get('url');
    }

    public function isActive(): bool
    {
        return (bool)$this->get('active');
    }
}
