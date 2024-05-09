<?php

declare(strict_types=1);

use App\Modules\Skill\Services\SkillService;
use Illuminate\Support\Facades\Route;

Route::get('{any}', [SkillService::class, 'index'])->name('navigation.link')->where('any', '.*');
