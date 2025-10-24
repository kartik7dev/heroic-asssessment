<?php

use Illuminate\Support\Facades\Route;

use App\Livewire\HeroicDashboard;
use App\Livewire\TestDropdown;

Route::get('/', HeroicDashboard::class);

Route::get('/test-dropdown', TestDropdown::class)->name('test.dropdown');

