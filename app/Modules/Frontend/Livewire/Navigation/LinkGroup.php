<?php

declare(strict_types=1);

namespace App\Modules\Frontend\Livewire\Navigation;

use App\Modules\Frontend\DataObjects\NavigationLink;
use Illuminate\View\View;
use Livewire\Component;

class LinkGroup extends Component
{
    public NavigationLink $link;
    public bool $open = false;

    public function render(): View
    {
        return view('components.navigation.link-group');
    }

    public function mount(NavigationLink $link, bool $open = true): void
    {
        $this->link = $link;
        $this->open = $open;
    }

    public function toggle(): void
    {
        $this->open = !$this->open;
    }
}
