<?php

declare(strict_types=1);

namespace App\Modules\Package\Repositories;

use App\Modules\CMSIntegration\Factories\ContextFactory;
use App\Modules\CMSIntegration\Repositories\Context;
use App\Modules\CMSIntegration\Repositories\DirectusRepository;
use App\Modules\Project\Models\Project;

class PackageRepository extends DirectusRepository
{
    public function getContext(): Context
    {
        return ContextFactory::create(Project::class);
    }
}
