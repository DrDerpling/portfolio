<?php

declare(strict_types=1);

namespace App\Modules\Frontend\Providers;

use App\Modules\Frontend\Livewire\Navigation\LinkGroup;
use App\Modules\Frontend\View\Components\LinkItem;
use App\Modules\Frontend\View\Components\Navbar;
use App\Modules\Frontend\View\Components\Skill;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;
use Livewire\Livewire;

class FrontendProvider extends ServiceProvider
{
    public function boot(): void
    {
        Blade::component(Navbar::class, 'navbar');
        Blade::component(Skill::class, 'skill');
        Blade::component(LinkItem::class, 'navigation.link-item');
        Livewire::component('navigation.link-group', LinkGroup::class);
    }
}
