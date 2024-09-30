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
Route::get('/cart', 'CartController@index')->name('cart');
Route::delete('cart/destroy', 'CartController@massDestroy')->name('cart.massDestroy');
Route::get('/wishlist', 'WishListController@index')->name('wishlist');
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
