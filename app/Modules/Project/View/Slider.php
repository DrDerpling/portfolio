<?php

declare(strict_types=1);

namespace App\Modules\Project\View;

use App\Modules\Project\Models\Project;
use Illuminate\View\Component;
use Illuminate\View\View;

class Slider extends Component
{
    /**
     * @var Project[]
     */
    public array $projects;

    public function __construct(array $projects)
    {
        $this->projects = $projects;
    }

    public function render(): View
    {
        return view('project.components.slider');
    }
}
