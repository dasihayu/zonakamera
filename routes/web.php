<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\InvoiceController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PageController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', [PageController::class, 'home'])->name('home');

Route::get('/about', [PageController::class, 'about'])->name('about');

Route::get('/products', [PageController::class, 'product'])->name('products');
Route::get('/products/{id}', [PageController::class, 'showProduct'])->name('products.show');

// Route::get('/info', [PageController::class, 'info'])->name('info' );
// Route::get('/featured', [PageController::class, 'featured'])->name('featured' );

Route::get('register', [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('register', [RegisterController::class, 'register']);

Route::get('login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('login', [LoginController::class, 'login']);
Route::post('logout', [LoginController::class, 'logout'])->name('logout');

Route::middleware(['auth'])->group(function () {
    Route::post('/cart/add', [CartController::class, 'addToCart']);
    Route::get('/cart', [CartController::class, 'viewCart'])->name('cart.index');
    Route::delete('/cart/{id}', [CartController::class, 'deleteCartItem'])->name('cart.delete');
    Route::post('/bookings', [BookingController::class, 'createBooking'])->name('bookings.store');
    Route::get('/bookings/{booking}', [BookingController::class, 'show'])->name('bookings.show');
    Route::get('/bookings', [BookingController::class, 'index'])->name('bookings.index');
    Route::get('/invoice/{booking}', [InvoiceController::class, 'generatePDF'])->name('invoice.download');
});
