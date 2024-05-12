<?php

declare(strict_types=1);

namespace App\Modules\Navigation\Http\Controllers;

use App\Modules\Framework\Http\Controllers\Controller;
use App\Modules\Navigation\Models\LinkItem;
use App\Modules\Navigation\Repositories\NavigationRepository;
use App\Modules\Page\Models\Page;
use App\Modules\Page\Services\PageService;
use App\Modules\Page\Types\PageTypes;
use App\Modules\Skill\Models\Skill;
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

        /**
         * Lazy load page model
         * @var Page $page
         */
        $page = $this->pageService->find($linkItem->page_id, Page::class, $forceNew);

        switch ($page->type) {
            case PageTypes::CONTENT:
                return view('pages.content', ['page' => $page]);
            case PageTypes::HOME:
                return view('pages.home', ['page' => $page]);
            case PageTypes::COMPONENTS:
                return $this->resolveComponentsPage($page, $forceNew);
            default:
                abort(404);
        }
    }

    private function resolveComponentsPage(Page $page, bool $forceNew): View
    {
        /**
         * @var LinkItem[] $history
         */
        $history = $this->navigationRepository->getList(LinkItem::class)->take(2)->all();

        if (count($history) > 0) {
            $history[0]->is_active = true;
        }

        return view(
            'pages.components',
            [
                'page' => $page,
                'skills' => $this->skillService->getList(Skill::class, $forceNew),
                'history' => $history
            ]
        );
    }
}
