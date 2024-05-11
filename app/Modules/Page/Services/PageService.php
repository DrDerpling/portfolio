<?php

declare(strict_types=1);

namespace App\Modules\Page\Services;

use App\Modules\CMSIntegration\Services\CMSDataService;
use App\Modules\Framework\AbstractDataObject;
use App\Modules\Page\DataObjects\Page as PageData;
use App\Modules\Page\Models\Page;
use App\Modules\Page\Repositories\PageRepository;

class PageService extends CMSDataService
{
    public function __construct(
        protected PageRepository $pageRepository,
    ) {
        parent::__construct($pageRepository);
    }

    public function getByCmnsId(int $id, bool $forceNew = false): Page
    {
        if ($forceNew) {
            return $this->getFromDirectus($id);
        }

        try {
            return $this->pageRepository->getByCmsId($id, Page::class);
        } catch (\Exception $e) {
            return $this->getFromDirectus($id);
        }
    }

    protected function getFromDirectus(int $id = null): Page
    {
        $page = directusCollection('pages')->find($id);
        $page['cms_id'] = $page['id'];

        return $this->saveItem(new PageData($page));
    }

    protected function saveItem(AbstractDataObject $item): Page
    {
        return $this->pageRepository->updateOrCreate($item->toArray(), Page::class);
    }
}
