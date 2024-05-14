<?php

declare(strict_types=1);

namespace App\Modules\Project\View;

use Illuminate\View\Component;
use Illuminate\View\View;

class ProjectOverview extends Component
{
    public array $projectsChunks;

    public function render(): View
    {
        $slides = [];
        $count = 1;

        // Yeah i know, this is a bit hacky, but it works, i promise :)
        // TODO: Refactor this
        foreach ($this->projectsChunks as $ignored) {
            $slides[] = $count++;
        }

        return view('project.components.overview', [
            'projectsChunks' => $this->projectsChunks,
            'slides' => $slides,
        ]);
    }

    public function __construct(array $projects)
    {
        $this->projectsChunks = array_chunk($projects, 3);
    }
}
