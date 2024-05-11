<?php

declare(strict_types=1);

namespace App\Modules\Skill\View;

use App\Modules\Skill\Models\Skill as SkillModel;
use Illuminate\View\Component;
use Illuminate\View\View;

class Skill extends Component
{
    /**
     * @param SkillModel[] $skills
     */
    public function __construct(private array $skills)
    {
    }

    public function render(): View
    {
        $ranges = [
            'Advanced' => 8,
            'Intermediate' => 4,
            'Some experience' => 0
        ];

        // Map the skills to the proficiency range
        $skills = collect($this->skills)->map(function (SkillModel $skill) use ($ranges) {
            $proficiency = $skill->proficiency;

            foreach ($ranges as $skillLevel => $value) {
                if ($proficiency >= $value) {
                    $skill->setAttribute('skill_level', $skillLevel);
                    break;
                }
            }

            return $skill;
        })->groupBy('skill_level');

        // Sort the skill levels so that they are displayed in the correct order
        $skills = $skills->sortBy(function ($value, $key) use ($ranges) {
            return array_search($key, array_keys($ranges), true);
        });

        return view('skill.components.overview', ['groupedSkills' => $skills]);
    }
}
