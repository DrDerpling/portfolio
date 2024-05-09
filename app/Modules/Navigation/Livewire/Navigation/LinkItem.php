<?php

declare(strict_types=1);

namespace App\Modules\Navigation\Livewire\Navigation;

use App\Modules\Navigation\Models\LinkItem as LinkItemModel;
use Illuminate\View\View;
use Livewire\Attributes\Reactive;
use Livewire\Component;

class LinkItem extends Component
{
    public LinkItemModel $link;
    #[Reactive]
    public bool $hidden = false;

    public function render(): View
    {
        return view('navigation.livewire.link-item');
    }

    public function mount(LinkItemModel $link, bool $hidden = true): void
    {
        $this->link = $link;
        $this->hidden = $hidden;
    }
}
