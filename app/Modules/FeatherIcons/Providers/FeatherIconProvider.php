<?php

declare(strict_types=1);

namespace App\Modules\FeatherIcons\Providers;

use App\Modules\FeatherIcons\View\Components\FeatherIcon;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;

class FeatherIconProvider extends ServiceProvider
{
    public function boot(): void
    {
        Blade::component(FeatherIcon::class, 'feather-icon');
    }
}
