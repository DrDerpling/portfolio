<?php

declare(strict_types=1);

namespace App\Modules\Package\Repositories;

use App\Modules\Project\Models\Project;
use DrDerpling\DirectusRepository\Factories\ContextFactory;
use DrDerpling\DirectusRepository\Repositories\Context;
use DrDerpling\DirectusRepository\Repositories\DirectusRepository;

class PackageRepository extends DirectusRepository
{
    public function getContext(): Context
    {
        return ContextFactory::create(Project::class);
    }
}
