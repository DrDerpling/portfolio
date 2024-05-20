<?php

declare(strict_types=1);

namespace App\Frontend\Providers;

use App\Modules\Skill\View\Skill;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;

class FrontendProvider extends ServiceProvider
{
    public function boot(): void
    {
        Blade::component(Skill::class, 'skill');
    }
}
