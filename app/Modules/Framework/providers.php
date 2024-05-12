<?php

declare(strict_types=1);

return [
    \App\Modules\Framework\Providers\AppServiceProvider::class,
    \App\Modules\Framework\Providers\ViewServiceProvider::class,
    \App\Modules\Framework\Providers\MigrationServiceProvider::class,
    \App\Modules\Frontend\Providers\FrontendProvider::class,
    \App\Modules\Skill\Providers\SkillProvider::class,
    \App\Modules\Navigation\Providers\NavigationProvider::class,
    \App\Modules\FeatherIcons\Providers\FeatherIconProvider::class,
    \App\Modules\Settings\Providers\SettingsProvider::class,
    \App\Modules\Project\Providers\ProjectProvider::class,
];
