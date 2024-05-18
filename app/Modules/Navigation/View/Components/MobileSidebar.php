<?php

declare(strict_types=1);

namespace App\Modules\Navigation\View\Components;

use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class MobileSidebar extends Component
{
    /**
     * @return View
     */
    public function render(): View
    {
        return view('navigation.components.mobile-sidebar');
    }
}
