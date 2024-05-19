<?php

declare(strict_types=1);

use App\Modules\Navigation\Http\Controllers\NavigationController;
use Illuminate\Support\Facades\Route;

Route::get('{any}', [NavigationController::class, 'handle'])
    ->name('navigation.link')->where('any', '.*');
