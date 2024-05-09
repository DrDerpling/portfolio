<?php

declare(strict_types=1);

namespace App\Modules\Navigation\Livewire\Navigation;

use App\Modules\Navigation\Models\LinkGroup as LinkGroupModel;
use Illuminate\View\View;
use Livewire\Component;

class LinkGroup extends Component
{
    public LinkGroupModel $linkGroup;
    public bool $open = true;
    public bool $active = false;

    public function render(): View
    {
        return view('navigation.livewire.link-group');
    }

    public function mount(LinkGroupModel $linkGroup, bool $open = true): void
    {
        $this->linkGroup = $linkGroup;
        $this->active = $linkGroup->hasActiveChildren();
        $this->open = $open;
    }
}
