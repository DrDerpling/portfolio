<?php

declare(strict_types=1);

namespace App\Modules\Project\Repositories;

use App\Modules\CMSIntegration\Repositories\ContentRepository;
use App\Modules\Project\Models\Project;
use App\Modules\Skill\Repositories\SkillRepository;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

class ProjectRepository extends ContentRepository
{
    public function __construct(private SkillRepository $skillRepository)
    {
    }

    /**
     * The model class to use for the repository.
     *
     * @var class-string<Project>
     */
    protected string $modelClass = Project::class;

    public function updateOrCreate(array $data): Project
    {
        $hydratedData = $this->prepareData($data, [
            'hero_image',
            'name',
            'image',
            'status',
            'description',
            'short_description',
            'content',
            'cms_id',
            'url',
            'skills'
        ]);

        $project = $this->modelClass::updateOrCreate(
            ['cms_id' => $hydratedData['cms_id']],
            $hydratedData
        );

        $skillCmsIds = array_map(fn($skill) => $skill['id'], $hydratedData['skills']);
        $skillsIds = $this->skillRepository->getSkillIds($skillCmsIds);

        $project->skills()->detach();
        foreach ($hydratedData['skills'] as $skill) {
            $project->skills()->attach($skillsIds[$skill['id']], ['sort' => $skill['sort']]);
        }

        return $project;
    }

    /**
     * @return Collection<Model>
     */
    public function getList(): Collection
    {
        return $this->modelClass::orderBy('sort')->with('skills')->get();
    }
}
