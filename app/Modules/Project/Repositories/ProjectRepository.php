<?php

declare(strict_types=1);

namespace App\Modules\Project\Repositories;

use App\Modules\CMSIntegration\Api\Directus;
use App\Modules\CMSIntegration\Factories\ContextFactory;
use App\Modules\CMSIntegration\Repositories\Context;
use App\Modules\CMSIntegration\Repositories\DirectusRepository;
use App\Modules\Framework\DataObject;
use App\Modules\Project\Models\Project;
use App\Modules\Skill\Repositories\SkillRepository;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ProjectRepository extends DirectusRepository
{
    public function __construct(
        private readonly SkillRepository $skillRepository
    ) {
    }

    public function updateOrCreate(DataObject $item): Model
    {
        /** @var Project $project */
        $project = $this->getContext()->getModelClass()::updateOrCreate(
            ['cms_id' => $item->get('cms_id')],
            $item->getData()
        );

        $skillCmsIds = array_map(static fn($skill) => $skill['id'], $item->get('skills'));
        $skillsIds = $this->skillRepository->getSkillIds($skillCmsIds);

        $project->skills()->detach();
        foreach ($item->get('skills') as $skill) {
            $project->skills()->attach($skillsIds[$skill['id']], ['sort' => $skill['sort']]);
        }

        return $project;
    }

    protected function prepareData(array $data): DataObject
    {
        $item = new DataObject($data);

        $item->set('cms_id', $item->get('id'));
        $disk = Storage::disk('public');
        $fileName = 'projects/' . Str::slug($item->get('name')) . '.webp'; // Don't really care if this overwrites

        Directus::collection('assets')
            ->addQueryParameter('fit', 'cover')
            ->addQueryParameter('width', '500')
            ->addQueryParameter('height', '300')
            ->addQueryParameter('quality', ' 100')
            ->addQueryParameter('format', 'webp')
            ->addQueryParameter('download', '1')
            ->download($item->get('hero'), $disk, $fileName);

        $item->set('image', $fileName);

        $skills = array_map(static function ($skill) {
            return [
                'id' => $skill['skills_id'],
                'sort' => $skill['sort'],
            ];
        }, $item->get('skills'));

        $item->set('skills', $skills);

        return $item;
    }

    /**
     * Get a list of models from the database or from Directus if the database is empty.
     *
     * @return Collection<int, Model>
     */
    public function getList(): Collection
    {
        if ($this->getContext()->isForceRefresh()) {
            return new Collection($this->getFromDirectus());
        }

        $list = $this->getModelQuery()->with('skills')->get();

        if ($list->isEmpty()) {
            return new Collection($this->getFromDirectus());
        }

        return $list;
    }

    public function getContext(): Context
    {
        return ContextFactory::create(Project::class, [
            'id',
            'hero',
            'name',
            'image',
            'status',
            'description',
            'short_description',
            'content',
            'url',
            'skills.*',
        ]);
    }
}
