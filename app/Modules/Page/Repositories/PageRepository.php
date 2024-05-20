<?php

declare(strict_types=1);

namespace App\Modules\Page\Repositories;

use App\Modules\Page\Models\Page;
use DrDerpling\DirectusRepository\Factories\ContextFactory;
use DrDerpling\DirectusRepository\Repositories\Context;
use DrDerpling\DirectusRepository\Repositories\DirectusRepository;

class PageRepository extends DirectusRepository
{
    public function getContext(): Context
    {
        return ContextFactory::create(Page::class, orderBy: null);
    }
}
