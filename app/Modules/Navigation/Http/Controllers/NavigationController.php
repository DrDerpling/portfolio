<?php

declare(strict_types=1);

namespace App\Modules\Navigation\Http\Controllers;

use App\Modules\Framework\Http\Controllers\Controller;
use App\Modules\Navigation\Models\LinkItem;
use App\Modules\Navigation\Repositories\LinkItemRepository;
use App\Modules\Package\Repositories\PackageRepository;
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
        private ProjectRepository $projectRepository,
        private PackageRepository $packageRepository,
    ) {
    }

    public function handle(Request $request): View
    {
        $path = $request->path();

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
        $page = $this->pageRepository->getByCmsId($linkItem->page_id);

        switch ($page->type) {
            case PageTypes::CONTENT:
                return view('pages.content', ['page' => $page]);
            case PageTypes::HOME:
                return $this->resolveHomePage($page);
            case PageTypes::COMPONENTS:
                return $this->resolveComponentsPage($page);
            default:
                abort(404);
        }
    }

    private function resolveHomePage(Page $page): View
    {
        /**
         * @var LinkItem[] $history
         */
        $history = $this->itemRepository->getList()->take(2)->all();

        if (count($history) > 0) {
            $history[0]->is_active = true;
        }

        return view(
            'pages.home',
            [
                'page' => $page,
                'skills' => $this->skillRepository->getList()->all(),
                'history' => $history,
                'projects' => $this->projectRepository->getList()->all(),
                'packages' => $this->packageRepository->getList()->all(),
            ]
        );
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
                'packages' => $this->packageRepository->getList()->all(),
            ]
        );
    }
}
