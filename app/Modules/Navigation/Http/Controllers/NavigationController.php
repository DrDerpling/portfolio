<?php

declare(strict_types=1);

namespace App\Modules\Navigation\Http\Controllers;

use App\Modules\Framework\Http\Controllers\Controller;
use App\Modules\Navigation\Models\LinkItem;
use App\Modules\Navigation\Repositories\LinkGroupRepository;
use App\Modules\Navigation\Repositories\LinkItemRepository;
use App\Modules\Page\Models\Page;
use App\Modules\Page\Repositories\PageRepository;
use App\Modules\Page\Types\PageTypes;
use App\Modules\Project\Repositories\ProjectRepository;
use App\Modules\Skill\Repositories\SkillRepository;
use Illuminate\Http\Request;
use Illuminate\View\View;

class NavigationController extends Controller
{
    public function __construct(
        private LinkItemRepository $itemRepository,
        private PageRepository $pageRepository,
        private SkillRepository $skillRepository,
        private LinkGroupRepository $linkGroupRepository,
        private ProjectRepository $projectRepository,
    ) {
    }

    public function handle(Request $request): View
    {
        $path = $request->path();
        $devMode = (bool)$request->query('dev_mode');
        $links = $this->linkGroupRepository->getTree($devMode);

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
        $page = $this->pageRepository->get($linkItem->page_id);

        switch ($page->type) {
            case PageTypes::CONTENT:
                return view('pages.content', ['page' => $page]);
            case PageTypes::HOME:
                return view('pages.home', ['page' => $page, 'links' => $links]);
            case PageTypes::COMPONENTS:
                return $this->resolveComponentsPage($page);
            default:
                abort(404);
        }
    }

    private function resolveComponentsPage(Page $page): View
    {
        /**
         * @var LinkItem[] $history
         */
        $history = $this->itemRepository->getList()->take(2)->all();

        if (count($history) > 0) {
            $history[0]->is_active = true;
        }

        return view(
            'pages.components',
            [
                'page' => $page,
                'skills' => $this->skillRepository->getList()->all(),
                'history' => $history,
                'projects' => $this->projectRepository->getList()->all(),
            ]
        );
    }
}
