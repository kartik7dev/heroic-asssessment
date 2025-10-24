<?php

use Illuminate\Support\Facades\Route;

use App\Livewire\HeroicDashboard;
use App\Http\Controllers\Api\BreachEventController;

Route::get('/', HeroicDashboard::class);

Route::get('/api/breach-events/{identityId?}', [BreachEventController::class, 'index']);

