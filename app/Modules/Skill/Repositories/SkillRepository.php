<?php

declare(strict_types=1);

namespace App\Modules\Skill\Repositories;

use App\Modules\Skill\Models\Skill;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Arr;
use InvalidArgumentException;

class SkillRepository
{
    /**
     * Returns
     *
     * @return Collection<Skill>
     */
    public function getList(): Collection
    {
        return Skill::all();
    }

    public function updateOrCreate(array $data): Skill
    {
        $cmsId = Arr::get($data, 'cms_id');
        $hydratedData = Arr::only($data, ['name', 'logo', 'proficiency', 'cms_id']);

        if (!$cmsId) {
            throw new InvalidArgumentException('cms_id is required');
        }

            /** @var Skill|null $skill */
        $skill = Skill::query()->updateOrCreate(
            ['cms_id' => $cmsId],
            $hydratedData
        );

        return $skill;
    }
}
