<?php

use Inertia\Inertia;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\ConsignedProductController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', function () {
        return Inertia::render('Dashboard');
    })->name('dashboard');

    Route::get('/suppliers', [SupplierController::class, 'index'])->name('suppliers');
    Route::post('/suppliers', [SupplierController::class, 'store'])->name('suppliers.store');
    Route::patch('/suppliers/{supp_id}', [SupplierController::class, 'update'])->name('suppliers.update');
    Route::delete('/suppliers/{supp_id}', [SupplierController::class, 'destroy'])->name('suppliers.destroy');

    Route::get('/products', [ProductController::class, 'index'])->name('products');
    Route::post('/products', [ProductController::class, 'store'])->name('products.store');
    Route::patch('/products/{prod_id}', [ProductController::class, 'update'])->name('products.update');
    Route::delete('/products/{prod_id}', [ProductController::class, 'destroy'])->name('products.destroy');

    Route::get('/orders', [OrderController::class, 'index'])->name('orders');
    Route::post('/orders', [OrderController::class, 'store'])->name('orders.store');
    Route::patch('/orders/{order_id}', [OrderController::class, 'update'])->name('orders.update');
    Route::delete('/orders/{order_id}', [OrderController::class, 'destroy'])->name('orders.destroy');

    Route::get('/consigned-inventory', [ConsignedProductController::class, 'index'])->name('consigned-inventory');
    Route::post('/consigned-inventory', [ConsignedProductController::class, 'store'])->name('consigned-inventory.store');
    Route::patch('/consigned-inventory/{item_id}', [ConsignedProductController::class, 'update'])->name('consigned-inventory.update');
    Route::delete('/consigned-inventory/{item_id}', [ConsignedProductController::class, 'destroy'])->name('consigned-inventory.destroy');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
