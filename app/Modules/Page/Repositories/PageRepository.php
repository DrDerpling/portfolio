<?php

declare(strict_types=1);

namespace App\Modules\Page\Repositories;

use App\Modules\Page\Models\Page;
use Drderpling\DirectusRepository\Factories\ContextFactory;
use Drderpling\DirectusRepository\Repositories\Context;
use Drderpling\DirectusRepository\Repositories\DirectusRepository;

class PageRepository extends DirectusRepository
{
    public function getContext(): Context
    {
        return ContextFactory::create(Page::class, orderBy: null);
    }
}
