<?php

use App\Livewire\UserPage\LandingPage;
use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/',LandingPage::class);