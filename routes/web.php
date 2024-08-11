<?php
use App\Http\Controllers\AdminDashboardCarController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\App;
use App\Http\Controllers\RatingController;
use App\Http\Controllers\AdminDashboardController;

use App\Http\Controllers\CarController;
use App\Http\Controllers\CarReservationController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\FleetController;
use App\Http\Controllers\GarageController;
use App\Http\Controllers\MaintenanceController;


use App\Http\Controllers\FacebookPageController;
use App\Http\Controllers\InstagramAccountController;
use App\Http\Controllers\YouTubeChannelController;
use App\Http\Controllers\RecommendationController;


use App\Http\Controllers\Backend\ProductController;
use App\Http\Controllers\Backend\FacebookPageController;




Route::get('/', function () {
    return view('frontend.index');
});



Route::get('ratings', [RatingController::class, 'index'])->name('ratings.index');
Route::post('/ratings', [RatingController::class, 'store'])->name('ratings.store');





Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('dashboard');
});
Route::middleware('auth')->group(function () {
    Route::get('/dashboardcar', [AdminDashboardController::class, 'index'])->name('dashboardcar');
});
Route::middleware('auth')->group(function () {
    Route::resource('/adminpanel/customers', CustomerController::class);
    Route::post('/adminpanel/customers2', [CustomerController::class, 'input'])->name('customers2.input');
    Route::get('/adminpanel/customers2', [CustomerController::class, 'input'])->name('customers2.input');
    Route::post('/adminpanel/customers2', [CustomerController::class, 'input2'])->name('customers2.input2');
    Route::get('/customers/user/{userId}', [CustomerController::class, 'showCustomerByUserId'])->name('customers.showByUserId');

});
Route::get('/n', function () {
    return view('welcome');
});

Route::get('/admin/dashboard', [AdminDashboardController::class, 'index'])->name('admin.dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('dashboard');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';




Route::prefix('backend')->group(function() {
    Route::resource('products', ProductController::class);
    Route::resource('facebook_pages', FacebookPageController::class);
    Route::get('facebook_pages/filter', [FacebookPageController::class, 'filter'])->name('facebook_pages.filter');

});


