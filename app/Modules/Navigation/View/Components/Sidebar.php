<?php

declare(strict_types=1);

namespace App\Modules\Navigation\View\Components;

use App\Modules\Navigation\Models\LinkGroup;
use App\Modules\Navigation\Models\LinkItem;
use App\Modules\Navigation\Repositories\LinkGroupRepository;
use Closure;
use GuzzleHttp\Exception\GuzzleException;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;
use JsonException;

class Sidebar extends Component
{
    public bool $forceRefresh = false;

    /**
     * Create a new component instance.
     */
    public function __construct(public bool $forceVisible = false)
    {
        $this->forceRefresh = (bool)request()->query('force_new');
    }


    /**
     * @throws GuzzleException
     * @throws JsonException
     */
    public function render(): View|Closure|string
    {
        return view('navigation.components.sidebar', [
            'links' => $this->getNavLinks(),
            'forceVisible' => $this->forceVisible,
        ]);
    }

    /**
     * @return array<LinkGroup|LinkItem>
     * @throws GuzzleException
     * @throws JsonException
     */
    private function getNavLinks(): array
    {
        return app(LinkGroupRepository::class)->getTree($this->forceRefresh);
    }
}
