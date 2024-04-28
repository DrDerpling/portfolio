<?php

declare(strict_types=1);

use App\Modules\Framework\Services\DomainDirectoryService;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Support\Facades\Route;

return Application::configure(basePath: dirname(__DIR__, 3))
    ->withRouting(
        using: function (Application $application) {
            $domainDirectoryService = new DomainDirectoryService();
            $domainPaths = $domainDirectoryService->listDomainPaths();

            if (empty($domainPaths)) {
                return;
            }

            foreach ($domainPaths as $domainPath) {
                $routesPath = $domainPath . '/routes/';

                if (!is_dir($routesPath)) {
                    continue;
                }

                $domainRouteFiles = $domainDirectoryService->getFolderContents($routesPath);
                foreach ($domainRouteFiles as $file) {
                    if (!str_ends_with($file, '.php')) {
                        continue;
                    }

                    $namespace = str_replace('.php', '', $file);

                    match ($namespace) {
                        'web' => Route::namespace($namespace)->middleware($namespace)->group($routesPath . $file),
                        'api' => Route::namespace($namespace)->middleware($namespace)->prefix($namespace)->group(
                            $routesPath . $file
                        ),
                        default => Route::namespace('default')->group($routesPath . $file)
                    };
                }
            }
        }
    )
    ->withMiddleware(function (Middleware $middleware) {
        //
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->withProviders(
        require __DIR__ . '/providers.php',
        false // We are loading the bootstrap providers manually
    )->create();
