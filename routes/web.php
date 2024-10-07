<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
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
Route::middleware(['auth'])->group(function () {
Route::get('/', function () {
    return view('home');
});
Route::get('checkout', function () {
    return view('checkout'); // Create a view named checkout.blade.php
});
Route::post('/payment', [OrderController::class, 'processPayment'])->name('payment.process');
Route::get('/order/confirmation/{orderId}', [OrderController::class, 'confirmation'])->name('order.confirmation');
Route::post('payment/create', [CheckoutController::class, 'createPayment']);
Route::get('payment/status', [CheckoutController::class, 'paymentStatus']);
Route::get('payment/cancel', [CheckoutController::class, 'paymentCancel']);
// Display the cart
Route::get('/cart', [CartController::class, 'index'])->name('cart.index');

// Add a product to the cart
Route::post('/cart/add', [CartController::class, 'add'])->name('cart.add');

// Update a product quantity in the cart
Route::post('/cart/update', [CartController::class, 'update'])->name('cart.update');

// Remove a product from the cart
Route::post('/cart/remove', [CartController::class, 'remove'])->name('cart.remove');

// Clear the cart
Route::get('/cart/clear', [CartController::class, 'clear'])->name('cart.clear');
Route::get('/wishlist', [WishlistController::class, 'index']);
Route::post('/wishlist/add', [WishlistController::class, 'add']);
Route::post('/wishlist/remove', [WishlistController::class, 'remove']);
Route::delete('wishlist/destroy', 'WishListController@massDestroy')->name('wishlist.massDestroy');
})->middleware['auth'];
Route::post('/logout', [UserController::class, 'logout'])->name('logout');
//});
Route::get('/login', function () {
    return view('Login');
})->name('login');
Route::get('/signup', function () {
    return view('Signup');
});
//Auth::routes(['register' => false]);
//Auth::routes(['verify' => true]);
Route::redirect('/home', '/admin');
//Auth::routes();
Route::post('/register', [UserController::class, 'register'])->name('register');
Route::post('/signin', [UserController::class, 'signin'])->name('signin');
Route::group(['prefix' => 'admin', 'as' => 'admin.', 'namespace' => 'Admin', 'middleware' => ['auth']], function () {
    Route::get('/', 'HomeController@index')->name('home');
    Route::delete('categories/destroy', 'CategoryController@massDestroy')->name('categories.massDestroy');
    Route::resource('category', 'CategoryController');
    Route::delete('products/destroy', 'ProductController@massDestroy')->name('products.massDestroy');
    Route::resource('product', 'ProductController');
});
