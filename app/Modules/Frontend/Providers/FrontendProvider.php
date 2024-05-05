<?php

declare(strict_types=1);

namespace App\Modules\Frontend\Providers;

use App\Modules\Frontend\View\Components\Item;
use App\Modules\Frontend\View\Components\Navbar;
use App\Modules\Frontend\View\Components\ParentItem;
use App\Modules\Frontend\View\Components\Skill;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;

class FrontendProvider extends ServiceProvider
{
    public function boot(): void
    {
        Blade::component(Navbar::class, 'navbar');
        Blade::component(Skill::class, 'skill');
        Blade::component(Item::class, 'item');
        Blade::component(ParentItem::class, 'parent-item');
    }
}
