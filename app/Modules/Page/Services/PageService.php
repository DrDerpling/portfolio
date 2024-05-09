<?php

declare(strict_types=1);

namespace App\Modules\Page\Services;

use App\Modules\CMSIntegration\Services\DirectusApi;
use App\Modules\Page\Models\Page;
use App\Modules\Page\Repositories\PageRepository;

class PageService
{
    public function __construct(
        private PageRepository $pageRepository,
        private DirectusApi $directusApi
    ) {
    }

    public function getByCmnsId(int $id, bool $forceNew = false): Page
    {
        if ($forceNew) {
            return $this->getFromDirectus($id);
        }

        try {
            return $this->pageRepository->getByCmsId($id);
        } catch (\Exception $e) {
            return $this->getFromDirectus($id);
        }
    }

    private function getFromDirectus(int $id): Page
    {
        $page = $this->directusApi->getItem('pages', $id);
        $page['cms_id'] = $page['id'];

        return $this->pageRepository->updateOrCreate($page);
    }
}
