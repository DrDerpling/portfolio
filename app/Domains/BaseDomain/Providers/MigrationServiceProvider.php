<?php

declare(strict_types=1);

namespace App\Domains\BaseDomain\Providers;

use App\Domains\BaseDomain\Services\DomainDirectoryService;
use Illuminate\Support\ServiceProvider;

class MigrationServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        if (app()->runningInConsole()) {
            $this->registerMigrations();
        }
    }

    /**
     * Register Sanctum's migration files.
     *
     * @return void
     */
    protected function registerMigrations(): void
    {
        $domainDirectoryService = app(DomainDirectoryService::class);
        $domains = $domainDirectoryService->listDomainPaths();

        foreach ($domains as $domainPath) {
            $migrationsPath = $domainPath . '/Database/Migrations/';

            // check if migrations directory exists
            if (!is_dir($migrationsPath)) {
                continue;
            }

            $this->loadMigrationsFrom($migrationsPath);
        }
    }
}
