<?php

declare(strict_types=1);

namespace App\Modules\Navigation\Livewire\Navigation;

use App\Modules\Navigation\Models\LinkItem;
use App\Modules\Navigation\Services\HistoryCacheManager;
use Illuminate\View\View;
use Livewire\Component;

class History extends Component
{
    /**
     * @var LinkItem[]
     */
    public array $history = [];

    private ?HistoryCacheManager $navigationHistoryRepository = null;

    public function render(): View
    {
        return view('navigation.livewire.history');
    }

    public function boot(array $history = []): void
    {
        if (!empty($history)) {
            $this->history = $history;
            return;
        }

        $this->history = $this->getHistory();
    }

    /**
     * @return LinkItem[]
     */
    private function getHistory(): array
    {
        return $this->getHistoryRepository()->getList();
    }

    /**
     * Lazy load the repository
     *
     * @return HistoryCacheManager
     */
    private function getHistoryRepository(): HistoryCacheManager
    {
        if ($this->navigationHistoryRepository === null) {
            $this->navigationHistoryRepository = new HistoryCacheManager();
        }

        return $this->navigationHistoryRepository;
    }

    public function removeItem(int $index): void
    {
        $this->getHistoryRepository()->remove($index);

        $this->history = $this->getHistory();
    }
}
