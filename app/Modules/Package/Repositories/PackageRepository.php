<?php

declare(strict_types=1);

namespace App\Modules\Package\Repositories;

use App\Modules\Project\Models\Project;
use Drderpling\DirectusRepository\Factories\ContextFactory;
use Drderpling\DirectusRepository\Repositories\Context;
use Drderpling\DirectusRepository\Repositories\DirectusRepository;

class PackageRepository extends DirectusRepository
{
    public function getContext(): Context
    {
        return ContextFactory::create(Project::class);
    }
}
