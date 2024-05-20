<?php

declare(strict_types=1);

namespace App\Modules\Package\Providers;

use App\Modules\Package\View\Overview;
use App\Modules\Package\View\Tile;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;

class PackageProvider extends ServiceProvider
{
    public function boot(): void
    {
        Blade::component('overview', Overview::class, 'package');
        Blade::component('tile', Tile::class, 'package');
    }
}
