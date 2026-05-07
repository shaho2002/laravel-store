<?php

use App\Http\Controllers\ProfileController;
use App\Livewire\Frontend\Article;
use App\Livewire\Frontend\ArticlesList;
use App\Livewire\Frontend\Cart;
use App\Livewire\Frontend\FavoriteList;
use App\Livewire\Frontend\Homepage;
use App\Livewire\Frontend\Orders;
use App\Livewire\Frontend\Payment;
use App\Livewire\Frontend\ProductDetails;
use App\Livewire\Frontend\Shop;
use App\Livewire\Frontend\UserAddress;
use App\Livewire\Frontend\UserProfile;
use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     return view('welcome');
// })->name('mainPage');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';


Route::get('/', Homepage::class)->name('mainPage');

Route::get('/product-details/{slug}', ProductDetails::class)->name('product.details');

Route::middleware('auth')->group(function () {

    Route::get('/cart', Cart::class)->name('cart');
    Route::get('/address', UserAddress::class)->name('address');
    Route::get('/user-profile', UserProfile::class)->name('user.profile');
    Route::get('/payment', Payment::class)->name('payment');
    Route::get('/orders', Orders::class)->name('orders');
    Route::get('/favorites', FavoriteList::class)->name('favorite.list');

});
//shop
Route::get('/shop', Shop::class)->name('shop');

//articles
Route::get('/articlesList', ArticlesList::class)->name('articles.list');
Route::get('/article/{article_slug}', Article::class)->name('article');


