<?php

declare(strict_types=1);

namespace App\Modules\Settings\View;

use Illuminate\View\Component;
use Illuminate\View\View;

class SettingButton extends Component
{
    public function render(): View
    {
        return view('settings.button');
    }
}
