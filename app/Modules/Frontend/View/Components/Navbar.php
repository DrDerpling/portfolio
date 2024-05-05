<?php

declare(strict_types=1);

namespace App\Modules\Frontend\View\Components;

use App\Modules\Frontend\DataObjects\NavigationLink;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\Routing\Route;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Request;
use Illuminate\View\Component;

class Navbar extends Component
{
    public bool $devMode = false;

    /**
     * Create a new component instance.
     */
    public function __construct()
    {
        $this->devMode = App::environment('local');
    }


    public function render(): View|Closure|string
    {
        return view('components.navigation.navbar', [
            'devMode' => $this->devMode,
            'links' => $this->getNavLinks(),
        ]);
    }

    /**
     * @return NavigationLink[]
     */
    private function getNavLinks(): array
    {
        $route = Request::route();

        // Check if route is an instance of Illuminate\Routing\Route to prevent errors
        if (!$route instanceof Route) {
            return [];
        }

        $currentRoute = $route->getName();

        $links = [
            [
                'label' => 'Dennis portfolio',
                'children' => [
                    [
                        'url' => route('home'),
                        'label' => 'Home',
                        'icon_name' => 'file-text',
                        'active' => $currentRoute === 'home' ,
                    ],
                    [
                        'url' => route('skills'),
                        'label' => 'Skills',
                        'icon_name' => 'file-text',
                        'active' => $currentRoute === 'skills',
                    ],
                    [
                        'url' => route('about-me'),
                        'label' => 'About me',
                        'icon_name' => 'file-text',
                        'active' => $currentRoute === 'about-me',
                    ],
                    [
                        'url' => route('skills'),
                        'label' => 'Contact',
                        'icon_name' => 'file-text',
                        'active' => $currentRoute === 'contact',
                    ],
                    [
                        'url' => route('skills'),
                        'label' => 'Projects',
                        'icon_name' => 'file-text',
                        'active' => $currentRoute  === 'projects',
                    ],
                ],
            ],
        ];

        if ($this->devMode) {
            $links[] =             [
                'label' => 'Dev pages',
                'children' => [
                    [
                        'url' => route('components'),
                        'label' => 'Components',
                        'icon_name' => 'file-text',
                        'active' => $currentRoute === 'components',
                    ],
                    [
                        'url' => route('components'),
                        'label' => 'Icons',
                        'icon_name' => 'file-text',
                        'active' => $currentRoute === 'icons',
                    ],
                ],
            ];
        }

        return array_map(function (array $link) {
            if (isset($link['children'])) {
                $link['children'] = array_map(function (array $child) {
                    return new NavigationLink($child);
                }, $link['children']);
            }

            return new NavigationLink($link);
        }, $links);
    }
}
