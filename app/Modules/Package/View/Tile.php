<?php

declare(strict_types=1);

namespace App\Modules\Package\View;

use App\Modules\Package\Models\Package;
use Illuminate\View\Component;
use Illuminate\View\View;

class Tile extends Component
{
    public function __construct(public Package $package)
    {
    }

    public function render(): View
    {
        return view('package.components.tile', [
            'package' => $this->package,
        ]);
    }

    public function formatProjectStats(): string
    {
        $commitMessage = $this->package->commits > 0 ? "{$this->package->commits} commits" : "No commits";
        $releaseMessage = $this->package->releases > 0 ? "{$this->package->releases} releases" : "Not released";

        return "{$commitMessage} · {$releaseMessage}";
    }

    public function lastUpdatedFormatted(): string
    {
        return $this->package->last_commit ? $this->package->last_commit->diffForHumans() : 'Not updated yet';
    }

    public function starsFormatted(): string
    {
        return $this->package->stars > 0 ? "{$this->package->stars} stars" : 'No stars :(';
    }

    public function downloadsFormatted(): string
    {
        return $this->package->downloads > 0 ? "{$this->package->downloads} downloads " : 'No downloads';
    }
}
