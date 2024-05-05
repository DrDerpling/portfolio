<?php

declare(strict_types=1);

namespace App\Modules\Frontend\View\Components;

use App\Modules\Frontend\DataObjects\NavigationLink;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class ParentItem extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct(public NavigationLink $link, public bool $hidden = false)
    {
    }


    public function render(): View
    {
        return view('components.navigation.parent-item');
    }
}
