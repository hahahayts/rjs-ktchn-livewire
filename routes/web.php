<?php

use App\Livewire\AdminPage\Dashboard;
use App\Livewire\AdminPage\ManageUsersPage;
use App\Livewire\AdminPage\Order;
use App\Livewire\AdminPage\ProductAdminPage;
use App\Livewire\Auth\LoginPage;
use App\Livewire\Auth\RegisterPage;
use App\Livewire\UserPage\AboutPage;
use App\Livewire\UserPage\LandingPage;
use App\Livewire\UserPage\OrderPageUser;
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
    Route::middleware(['can:user'])->group(function(){
        Route::get('/products',ProductsPage::class);
        Route::get('/order',OrderPageUser::class);
    });




// For Admin
Route::middleware(['can:admin'])->group(function(){
    Route::get('/admin', Dashboard::class);
    Route::get('/admin/dashboard', Dashboard::class);
    Route::get('/admin/orders', Order::class);
    Route::get('/admin/products', ProductAdminPage::class);
    Route::get('/admin/manage-users', ManageUsersPage::class);
});
});