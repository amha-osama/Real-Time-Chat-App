<?php

use App\Livewire\Friends;
use App\Events\NewMessage;
use Illuminate\Support\Facades\Route;


Route::view('/', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::view('profile', 'profile')
    ->middleware(['auth'])
    ->name('profile');

Route::view('/friend', 'users')
    ->middleware(['auth', 'verified'])
    ->name('users');



require __DIR__.'/auth.php';
