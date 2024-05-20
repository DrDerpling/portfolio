<?php

declare(strict_types=1);

namespace App\Modules\Package\View;

use Illuminate\View\Component;
use Illuminate\View\View;

class Overview extends Component
{
    public function __construct(public array $packages)
    {
    }

    public function render(): View
    {
        return view('package.components.overview', [
            'packages' => $this->packages,
        ]);
    }
}
