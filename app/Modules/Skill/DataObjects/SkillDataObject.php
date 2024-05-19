<?php

declare(strict_types=1);

namespace App\Modules\Skill\DataObjects;

use App\Modules\Framework\DataObject;

class SkillDataObject extends DataObject
{
    public function getLogo(): string
    {
        return $this->get('logo');
    }

    public function getName(): string
    {
        return $this->get('name');
    }
}
