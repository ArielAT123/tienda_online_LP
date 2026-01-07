<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\VendorController;

/*
|--------------------------------------------------------------------------
| Web Routes - Tienda Frontend (consumes Django API)
|--------------------------------------------------------------------------
*/

// Home
Route::get('/', [HomeController::class, 'index'])->name('home');

// Auth - Login
Route::get('/login', [AuthController::class, 'showLogin'])->name('auth.login.show');
Route::post('/login', [AuthController::class, 'login'])->name('auth.login');
Route::post('/logout', [AuthController::class, 'logout'])->name('auth.logout');

// Auth - Client Registration
Route::get('/registro/cliente', [AuthController::class, 'showRegisterClient'])->name('auth.register-client');
Route::post('/registro/cliente', [AuthController::class, 'registerClient'])->name('auth.register-client.store');

// Auth - Vendor Registration
Route::get('/registro/vendedor', [AuthController::class, 'showRegisterVendor'])->name('auth.register-vendor');
Route::post('/registro/vendedor', [AuthController::class, 'registerVendor'])->name('auth.register-vendor.store');

// Products - Tags
Route::get('/etiquetas', [ProductController::class, 'tags'])->name('products.tags');

// Products - By Tag
Route::get('/productos/{tag}', [ProductController::class, 'byTag'])->name('products.by-tag');

// Products - Add (form must be before {tag} to avoid conflict)
Route::get('/productos-agregar', [ProductController::class, 'showAddForm'])->name('products.add');
Route::post('/productos-agregar', [ProductController::class, 'addProduct'])->name('products.add.store');

// Cart
Route::get('/carrito', [CartController::class, 'index'])->name('cart.index');
Route::post('/carrito/agregar', [CartController::class, 'addItem'])->name('cart.add');
Route::get('/carrito/total', [CartController::class, 'getTotal'])->name('cart.total');

// Vendors
Route::get('/vendedor/{id}', [VendorController::class, 'show'])->name('vendors.show');
