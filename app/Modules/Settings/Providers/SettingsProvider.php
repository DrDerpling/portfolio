<?php

declare(strict_types=1);

namespace App\Modules\Settings\Providers;

use App\Modules\Settings\View\SettingButton;
use App\Modules\Settings\View\SettingModal;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;

class SettingsProvider extends ServiceProvider
{
    public function boot(): void
    {
        Blade::component(SettingModal::class, 'modal', 'settings');
        Blade::component(SettingButton::class, 'button', 'settings');
    }
}
