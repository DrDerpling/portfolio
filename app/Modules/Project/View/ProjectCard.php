<?php

declare(strict_types=1);

namespace App\Modules\Project\View;

use App\Modules\Project\Models\Project;
use Illuminate\View\Component;
use Illuminate\View\View;

class ProjectCard extends Component
{
    public Project $project;

    public function __construct(Project $project)
    {
        $this->project = $project;
    }

    public function render(): View
    {
        return view('project.components.card', [
            'project' => $this->project,
        ]);
    }
}
