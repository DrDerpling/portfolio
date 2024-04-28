<?php

declare(strict_types=1);

namespace App\Modules\Framework\Tests;

use Illuminate\Contracts\Console\Kernel;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;

abstract class TestCase extends BaseTestCase
{
    public function createApplication()
    {
        $app = require Application::inferBasePath() . '/app/Modules/Framework/app.php';

        $app->make(Kernel::class)->bootstrap();

        return $app;
    }
}
