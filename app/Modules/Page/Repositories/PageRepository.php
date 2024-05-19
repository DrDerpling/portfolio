<?php

declare(strict_types=1);

namespace App\Modules\Page\Repositories;

use App\Modules\CMSIntegration\Factories\ContextFactory;
use App\Modules\CMSIntegration\Repositories\Context;
use App\Modules\CMSIntegration\Repositories\DirectusRepository;
use App\Modules\Page\Models\Page;

class PageRepository extends DirectusRepository
{
    public function getContext(): Context
    {
        return ContextFactory::create(Page::class, orderBy: null);
    }
}
