<?php

declare(strict_types=1);

namespace App\Modules\Project\View;

use Illuminate\View\Component;
use Illuminate\View\View;

class ProjectCard extends Component
{
    public array $project;

    public function __construct(array $project)
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
