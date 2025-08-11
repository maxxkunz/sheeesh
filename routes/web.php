<?php

use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', function () {
    return Inertia::render('Welcome');
})->name('home');

Route::get('dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::get('dashboard2', function () {
    return Inertia::render('Dashboard2');
})->middleware(['auth', 'verified'])->name('dashboard2');

Route::get('dashboard3', function () {
    return Inertia::render('Dashboard3');
})->middleware(['auth', 'verified'])->name('dashboard3');

Route::get('beispielseite1', function () {
    return Inertia::render('Beispielseite1');
})->middleware(['auth', 'verified'])->name('beispielseite1');

Route::get('beispielseite2', function () {
    return Inertia::render('Beispielseite2');
})->middleware(['auth', 'verified'])->name('beispielseite2');

Route::get('beispielseite3', function () {
    return Inertia::render('Beispielseite3');
})->middleware(['auth', 'verified'])->name('beispielseite3');

// Projects (Platzhalter-Seiten)
    Route::get('/projects/project1', function () {
        return Inertia::render('projects/Project1');
    })->name('project1');

    Route::get('/projects/project2', function () {
        return Inertia::render('projects/Project2');
    })->name('project2');

    Route::get('/projects/project3', function () {
        return Inertia::render('projects/Project3');
    })->name('project3');


require __DIR__.'/settings.php';
require __DIR__.'/auth.php';
