<?php

declare(strict_types=1);

namespace App\Modules\Project\DataObjects;

use App\Modules\Framework\AbstractDataObject;

class Project extends AbstractDataObject
{
    public function getName(): string
    {
        return (string)$this->get('name');
    }

    public function getHero(): string
    {
        return (string)$this->get('hero');
    }
}
