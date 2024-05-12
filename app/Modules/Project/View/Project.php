<?php

declare(strict_types=1);

namespace App\Modules\Project\View;

use Illuminate\View\Component;
use Illuminate\View\View;

class Project extends Component
{
    public function render(): View
    {
        return view('project.components.overview');
    }
}
