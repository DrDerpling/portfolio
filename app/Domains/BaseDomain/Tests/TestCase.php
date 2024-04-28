<?php

declare(strict_types=1);

namespace App\Domains\BaseDomain\Tests;

use Illuminate\Contracts\Console\Kernel;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;

abstract class TestCase extends BaseTestCase
{
    public function createApplication()
    {
        $app = require Application::inferBasePath() . '/app/Domains/BaseDomain/app.php';

        $app->make(Kernel::class)->bootstrap();

        return $app;
    }
}
