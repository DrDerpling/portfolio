<?php

declare(strict_types=1);

namespace App\Modules\Navigation\Http\Controllers;

use App\Modules\Framework\Http\Controllers\Controller;
use App\Modules\Navigation\Repositories\NavigationRepository;
use App\Modules\Page\Services\PageService;
use App\Modules\Page\Types\PageTypes;
use App\Modules\Skill\Services\SkillService;
use Illuminate\Http\Request;
use Illuminate\View\View;

class NavigationController extends Controller
{
    public function __construct(
        private NavigationRepository $navigationRepository,
        private PageService $pageService,
        private SkillService $skillService
    ) {
    }

    public function handle(Request $request): View
    {
        $path = $request->path();
        $forceNew = (bool)$request->query('force_new');

        if ($path === '/') {
            $path = PageTypes::HOME;
        }

        $linkItem = $this->navigationRepository->getByUrl($path);

        if ($linkItem === null && $path !== PageTypes::HOME) {
            abort(404);
        }

        if (!$linkItem) {
            return view('pages.initialize');
        }

        // Lazy load the page from the database or CMS
        $page = $this->pageService->get($linkItem->page_id, $forceNew);

        switch ($page->type) {
            case PageTypes::CONTENT:
                return view('pages.content', ['page' => $page]);
            case PageTypes::HOME:
                return view('pages.home', ['page' => $page]);
            case PageTypes::COMPONENTS:
                return view(
                    'pages.components',
                    ['page' => $page,  'skills' => $this->skillService->getSkills($forceNew)]
                );
            default:
                abort(404);
        }
    }
}
