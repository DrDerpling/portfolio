<?php

declare(strict_types=1);

namespace App\Modules\Navigation\Http\Controllers;

use App\Modules\Framework\Http\Controllers\Controller;
use App\Modules\Navigation\Models\LinkItem;
use App\Modules\Navigation\Repositories\LinkItemRepository;
use App\Modules\Navigation\Services\LinkTreeService;
use App\Modules\Page\Models\Page;
use App\Modules\Page\Services\PageService;
use App\Modules\Page\Types\PageTypes;
use App\Modules\Project\Services\ProjectService;
use App\Modules\Skill\Services\SkillService;
use Illuminate\Http\Request;
use Illuminate\View\View;

class NavigationController extends Controller
{
    public function __construct(
        private LinkItemRepository $itemRepository,
        private PageService $pageService,
        private SkillService $skillService,
        private LinkTreeService $linkTreeService,
        private ProjectService $projectService,
    ) {
    }

    public function handle(Request $request): View
    {
        $path = $request->path();
        $forceNew = (bool)$request->query('force_new');
        $links = $this->linkTreeService->getTree($forceNew);

        if ($path === '/') {
            $path = PageTypes::HOME;
        }

        $linkItem = $this->itemRepository->getByUrl($path);

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
        $page = $this->pageService->find($linkItem->page_id, $forceNew);

        switch ($page->type) {
            case PageTypes::CONTENT:
                return view('pages.content', ['page' => $page]);
            case PageTypes::HOME:
                return view('pages.home', ['page' => $page, 'links' => $links]);
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
        $history = $this->itemRepository->getList()->take(2)->all();

        if (count($history) > 0) {
            $history[0]->is_active = true;
        }

        $projects = $this->projectService->getList($forceNew);

        return view(
            'pages.components',
            [
                'page' => $page,
                'skills' => $this->skillService->getList($forceNew),
                'history' => $history,
                'projects' => $projects,
            ]
        );
    }
}
