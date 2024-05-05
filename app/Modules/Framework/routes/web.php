<?php

declare(strict_types=1);

use App\Modules\Skill\Services\SkillService;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('pages.welcome');
})->name('home');

Route::get('/components', function () {
    /** @var SkillService $skillService */
    $skillService = app()->make(SkillService::class);
    $skills = $skillService->getSkills();

    return view('pages.components', compact('skills'));
})->name('components');

Route::get('/skills' , function () {
    /** @var SkillService $skillService */
    $skillService = app()->make(SkillService::class);
    $skills = $skillService->getSkills();

    return view('skill.pages.skills', compact('skills'));
})->name('skills');

Route::get('about-me', function () {
    return view('pages.about-me');
})->name('about-me');
