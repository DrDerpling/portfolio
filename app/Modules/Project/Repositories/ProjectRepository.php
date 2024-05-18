<?php

declare(strict_types=1);

namespace App\Modules\Project\Repositories;

use App\Modules\CMSIntegration\Repositories\ContentRepository;
use App\Modules\Project\Models\Project;

class ProjectRepository extends ContentRepository
{
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
            'status',
            'description',
            'short_description',
            'content',
        ]);

        return $this->modelClass::updateOrCreate(
            ['cms_id' => $hydratedData['cms_id']],
            $hydratedData
        );
    }
}
