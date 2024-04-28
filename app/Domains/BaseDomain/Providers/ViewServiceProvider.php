<?php

declare(strict_types=1);

namespace App\Domains\BaseDomain\Providers;

use App\Domains\BaseDomain\Services\DomainDirectoryService;
use Illuminate\View\FileViewFinder;
use Illuminate\View\ViewServiceProvider as ServiceProvider;

class ViewServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->registerFactory();
        $this->registerViewFinder();
        $this->registerBladeCompiler();
        $this->registerEngineResolver();
    }

    public function registerViewFinder(): void
    {
        $domainDirectoryService = app(DomainDirectoryService::class);
        $domainMakerViews = $this->getDomainViewPaths($domainDirectoryService);

        $this->app->bind('view.finder', function ($app) use ($domainMakerViews) {
            $paths = $app['config']['view.paths'];

            foreach ($domainMakerViews as $path) {
                $paths[] = $path;
            }

            return new FileViewFinder($app['files'], $paths);
        });
    }

    /**
     * @return string[]
     * @throws \Exception
     */
    public function getDomainViewPaths(DomainDirectoryService $domainDirectoryService): array
    {
        $viewPaths = [];
        $listDomainPaths = $domainDirectoryService->listDomainPaths();

        foreach ($listDomainPaths as $domain) {
            $resourcedDir = $domain . '/resources';
            $viewDir = $resourcedDir . '/views';

            // checking if resources and views/resources directories exist
            if (!is_dir($resourcedDir) || !is_dir($viewDir)) {
                continue;
            }

            $viewPaths[] = $viewDir;
        }

        return $viewPaths;
    }
}
