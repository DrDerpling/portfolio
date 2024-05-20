<?php

declare(strict_types=1);

namespace App\Frontend\View\Components;

use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class LineNumbers extends Component
{
    public function __construct(
        public int $lineHeight,
        public int $height
    ) {
    }

    public function render(): View
    {
        return view('components.line-numbers');
    }
}
