<?php

declare(strict_types=1);

use App\Modules\Skill\Services\SkillService;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::get('/components', function () {
    /** @var SkillService $skillService */
    $skillService = app()->make(SkillService::class);
    $skills = $skillService->getSkills();

    return view('components', compact('skills'));
})->name('components');
