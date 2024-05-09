<?php

declare(strict_types=1);

namespace App\Modules\Navigation\View\Components;

use App\Modules\Navigation\Models\LinkGroup;
use App\Modules\Navigation\Models\LinkItem;
use App\Modules\Navigation\Services\LinkTreeService;
use Closure;
use GuzzleHttp\Exception\GuzzleException;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Navbar extends Component
{
    public bool $forceRefresh = false;

    /**
     * Create a new component instance.
     */
    public function __construct(public bool $forceVisible = false)
    {
        $this->forceRefresh = (bool)request()->query('force_new');
    }


    public function render(): View|Closure|string
    {
        return view('navigation.components.navbar', [
            'links' => $this->getNavLinks(),
            'forceVisible' => $this->forceVisible,
        ]);
    }

    /**
     * @return array<LinkGroup|LinkItem>
     * @throws GuzzleException
     * @throws \JsonException
     */
    private function getNavLinks(): array
    {
        return app(LinkTreeService::class)->getTree($this->forceRefresh);
    }
}
