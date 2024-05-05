<?php

declare(strict_types=1);

namespace App\Modules\Skill\Providers;

use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;

class SkillProvider extends ServiceProvider
{
    public function boot(): void
    {
        Blade::componentNamespace('App\\Modules\\Skill\\View\\Components', 'skill');
    }
}
