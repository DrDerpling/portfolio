<?php

declare(strict_types=1);

namespace App\Modules\Project\Providers;

use App\Modules\Project\View\ProjectCard;
use App\Modules\Project\View\ProjectOverview;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;

class ProjectProvider extends ServiceProvider
{
    public function boot(): void
    {
        Blade::component('overview', ProjectOverview::class, 'project');
        Blade::component('card', ProjectCard::class, 'project');
    }
}
