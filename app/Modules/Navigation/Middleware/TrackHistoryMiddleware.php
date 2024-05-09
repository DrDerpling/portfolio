<?php

declare(strict_types=1);

namespace App\Modules\Navigation\Middleware;

use App\Modules\Navigation\Repositories\NavigationRepository;
use App\Modules\Navigation\Services\HistoryCacheManager;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class TrackHistoryMiddleware
{
    public function __construct(
        private HistoryCacheManager $historyCacheManager,
        private NavigationRepository $navigationRepository
    ) {
    }

    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $linkItem = $this->navigationRepository->getByUrl($request->url());

        if ($linkItem === null) {
            return $next($request);
        }

        $this->historyCacheManager->add($linkItem);

        return $next($request);
    }
}
