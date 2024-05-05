<?php

declare(strict_types=1);

namespace App\Modules\Frontend\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\App;
use Illuminate\View\Component;

class Navbar extends Component
{
    public bool $devMode = false;

    /**
     * Create a new component instance.
     */
    public function __construct()
    {
        $this->devMode = App::environment('local');
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.navigation.navbar', [
            'devMode' => $this->devMode,
        ]);
    }
}
