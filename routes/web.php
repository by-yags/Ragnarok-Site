<?php

use Illuminate\Support\Facades\Route;
use Livewire\Volt\Volt;

Route::get('/', function () {
    $updates = [
        ['date' => '2024-08-10', 'title' => 'New Class: Soul Reaper Arrives!'],
        ['date' => '2024-08-08', 'title' => 'Summer Festival Event Begins'],
        ['date' => '2024-08-05', 'title' => 'Server Maintenance and Update'],
    ];

    $events = [
        ['date' => '2024-08-12', 'title' => 'Double EXP and Drop Rate Weekend'],
        ['date' => '2024-08-09', 'title' => 'Poring Capture Contest'],
        ['date' => '2024-08-07', 'title' => 'Guild vs. Guild Tournament'],
    ];

    $patchNotes = [
        ['date' => '2024-08-05', 'title' => 'Patch v1.2.3 - Skill Balancing'],
        ['date' => '2024-08-01', 'title' => 'Emergency Maintenance Notes'],
        ['date' => '2024-07-28', 'title' => 'Patch v1.2.2 - Bug Fixes'],
    ];

    return view('welcome', compact('updates', 'events', 'patchNotes'));
})->name('home');

Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::middleware(['auth'])->group(function () {
    Route::redirect('settings', 'settings/profile');

    Volt::route('settings/profile', 'settings.profile')->name('settings.profile');
    Volt::route('settings/password', 'settings.password')->name('settings.password');
    Volt::route('settings/appearance', 'settings.appearance')->name('settings.appearance');
});

require __DIR__.'/auth.php';
