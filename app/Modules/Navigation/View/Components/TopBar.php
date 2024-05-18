<?php

declare(strict_types=1);

namespace App\Modules\Navigation\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class TopBar extends Component
{
    public function render(): View|Closure|string
    {
        return view('navigation.components.topbar');
    }
}
