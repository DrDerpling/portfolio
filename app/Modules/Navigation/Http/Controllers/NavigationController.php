<?php

declare(strict_types=1);

namespace App\Modules\Navigation\Http\Controllers;

use App\Modules\Framework\Http\Controllers\Controller;
use App\Modules\Navigation\Repositories\NavigationRepository;
use Illuminate\View\View;

class NavigationController extends Controller
{
    public function __construct(private NavigationRepository $navigationRepository)
    {
    }

    public function handle(string $any): View
    {
        $linkItem = $this->navigationRepository->getByUrl($any);

        if (!$linkItem) {
            abort(404);
        }

        $page = $linkItem->page;

        // Assume the page model knows how to render itself or what to do
        return view('pages.display', ['page' => $page]);
    }
}
