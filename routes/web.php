<?php

use App\Models\Customer;
use App\Models\Course;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PurchaseController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\PlantController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Public Routes
|--------------------------------------------------------------------------
*/

// Home page route
Route::get('/', function () {
    return view('welcome');
});

/*
|--------------------------------------------------------------------------
| Dashboard Route (Requires Authentication & Email Verification)
|--------------------------------------------------------------------------
*/
Route::get('/dashboard', function () {
    // Fetch latest 5 customers (optional, example usage)
    $customers = Customer::latest()->take(5)->get();
    return view('dashboard');  // You may want to pass $customers to view if used
})->middleware(['auth', 'verified'])->name('dashboard');

/*
|--------------------------------------------------------------------------
| Profile Routes (Protected by Auth Middleware)
|--------------------------------------------------------------------------
*/
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::get('/users', [UserController::class, 'index'])->name('users.index');
});

/*
|--------------------------------------------------------------------------
| Resource Routes & Additional Routes for Customers
|--------------------------------------------------------------------------
*/
Route::resource('customers', CustomerController::class);
Route::get('customers-export', [CustomerController::class, 'exportPdf'])->name('customers.exportPdf');

/*
|--------------------------------------------------------------------------
| Resource Routes & Additional Routes for Plants
|--------------------------------------------------------------------------
*/
Route::resource('plants', PlantController::class);
// Custom delete confirmation route (if needed)
Route::get('/plants/{plant}/delete', [PlantController::class, 'delete'])->name('plants.delete');
// Explicit destroy route (optional if resource route covers it)
Route::delete('/plants/{plant}', [PlantController::class, 'destroy'])->name('plants.destroy');
// Export PDF for plants
Route::get('plants-export', [PlantController::class, 'exportPdf'])->name('plants.exportPdf');

/*
|--------------------------------------------------------------------------
| Resource Routes for Courses
|--------------------------------------------------------------------------
*/
Route::resource('courses', CourseController::class);

/*
|--------------------------------------------------------------------------
| Resource Routes & Additional Routes for Purchases
|--------------------------------------------------------------------------
*/
Route::resource('purchases', PurchaseController::class);
// Export PDF for purchases
Route::get('purchases/export/pdf', [PurchaseController::class, 'exportPdf'])->name('purchases.exportPdf');

/*
|--------------------------------------------------------------------------
| Authentication Routes (Login, Register, etc.)
|--------------------------------------------------------------------------
*/
require __DIR__.'/auth.php';
