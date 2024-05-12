<?php

declare(strict_types=1);

namespace App\Modules\Project\Providers;

use App\Modules\Project\View\Project;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;

class ProjectProvider extends ServiceProvider
{
    public function boot(): void
    {
        Blade::component('overview', Project::class, 'project');
    }
}
