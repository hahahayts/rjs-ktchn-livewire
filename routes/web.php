<?php

use App\Livewire\AdminPage\Dashboard;
use App\Livewire\Auth\LoginPage;
use App\Livewire\Auth\RegisterPage;
use App\Livewire\UserPage\AboutPage;
use App\Livewire\UserPage\LandingPage;
use App\Livewire\UserPage\ProductsPage;
use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     return view('welcome');
// });

Route::middleware(['guest'])->group(function(){
    // Auth
    Route::get('/login',LoginPage::class)->name('login');
    Route::get('/register',RegisterPage::class);


    Route::get('/',LandingPage::class);
    Route::get('/about',AboutPage::class);
});

Route::middleware(['auth'])->group(function(){

    // For Normal User
Route::get('/products', ProductsPage::class);



// For Admin
Route::middleware(['can:admin'])->group(function(){
    Route::get('/admin/dashboard', Dashboard::class);
});
});