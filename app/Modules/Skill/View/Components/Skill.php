<?php

namespace App\Modules\Skill\View\Components;

use App\Modules\Skill\Models\Skill as SkillModel;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Skill extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct(public SkillModel $skill)
    {
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.skill');
    }
}
