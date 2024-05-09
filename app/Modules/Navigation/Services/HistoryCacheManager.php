<?php

declare(strict_types=1);

namespace App\Modules\Navigation\Services;

use App\Modules\Navigation\Models\LinkItem;
use Illuminate\Support\Facades\Cache;

class HistoryCacheManager
{
    private function getSessionKey(): string
    {
        return  'navigation_history_' . session()->getId();
    }

    /**
     * @return LinkItem[]
     */
    public function getList(): array
    {
        return Cache::get($this->getSessionKey(), []);
    }

    public function add(LinkItem $linkItem): void
    {
        $history = $this->getList();

        foreach ($history as $item) {
            if ($item->id === $linkItem->id) {
                return;
            }
        }

        $history[]  = $linkItem;

        Cache::put($this->getSessionKey(), $history, 3600); // Store for 1 hour
    }

    public function clear(): void
    {
        Cache::forget($this->getSessionKey());
    }

    public function remove(int $index): void
    {
        $history = $this->getList();

        if (!isset($history[$index])) {
            return;
        }

        unset($history[$index]);

        Cache::put($this->getSessionKey(), $history, 3600);
    }
}
