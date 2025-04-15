<?php

use App\Livewire\UserPage\AboutPage;
use App\Livewire\UserPage\LandingPage;
use App\Livewire\UserPage\ProductsPage;
use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     return view('welcome');
// });

Route::middleware(['guest'])->group(function(){
    Route::get('/',LandingPage::class);
    Route::get('/about',AboutPage::class);
});

Route::middleware(['auth'])->group(function(){
Route::get('/products', ProductsPage::class);
});