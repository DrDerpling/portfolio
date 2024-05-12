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

    public function mount(array $history = []): void
    {
        if (!empty($history)) {
            $this->history = array_slice($history, 0, 3);
            return;
        }

        // Max of 3 items
        $this->history = array_slice($this->getHistory(), 0, 3);
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
