<?php

declare(strict_types=1);

namespace App\Modules\Framework\Tests\Feature;

use App\Modules\Framework\Tests\TestCase;

class ExampleTest extends TestCase
{
    /**
     * A basic test example.
     */
    public function testTheApplicationReturnsASuccessfulResponse(): void
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }
}
