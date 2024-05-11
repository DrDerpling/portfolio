<?php

declare(strict_types=1);

namespace App\Modules\Skill\Repositories;

use App\Modules\CMSIntegration\Repositories\ContentRepository;
use App\Modules\Skill\Models\Skill;
use Illuminate\Support\Arr;
use InvalidArgumentException;

class SkillRepository extends ContentRepository
{
    /**
     * @param array $data
     * @param class-string<Skill> $modelClass
     * @return Skill
     */
    public function updateOrCreate(array $data, string $modelClass): Skill
    {
        $hydratedData = $this->prepareData($data, ['name', 'logo', 'proficiency', 'cms_id', 'sort']);

        $cmsId = Arr::get($data, 'cms_id');

        if (!$cmsId) {
            throw new InvalidArgumentException('cms_id is required');
        }

        return $modelClass::updateOrCreate(['cms_id' => $cmsId], $hydratedData);
    }
}
