<?php

use App\Http\Controllers\NewsController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\SitemapController;
use App\Http\Controllers\SparepartController;
use Illuminate\Support\Facades\Route;
use TCG\Voyager\Facades\Voyager;

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
Route::get('/sitemap.xml', [SitemapController::class, 'index'])->name('sitemap');

Route::get('/', [PageController::class, 'index'])->name('home');
Route::get('/about', [PageController::class, 'about'])->name('about');
Route::get('/contact', [PageController::class, 'contact'])->name('contact');
Route::get('/search/{q}', [PageController::class, 'search'])->name('search');
Route::post('/contact', [PageController::class, 'send'])->name('contact.send');
Route::get('/privacy-policy', [PageController::class, 'privacy'])->name('privacy');
Route::get('/terms-of-service', [PageController::class, 'tos'])->name('tos');


Route::get('/news', [NewsController::class, 'index'])->name('news');
Route::get('/news/{slug}', [NewsController::class, 'show'])->name('news.show');
Route::get('/news/category/{slug}', [NewsController::class, 'category'])->name('news.category');

Route::get('/product', [ProductController::class, 'index'])->name('product');
Route::get('/product/{slug}', [ProductController::class, 'show'])->name('product.show');
Route::get('/product/category/{slug}', [ProductController::class, 'category'])->name('product.category');

Route::get('/service', [ServiceController::class, 'index'])->name('service');
Route::get('/service/{slug}', [ServiceController::class, 'show'])->name('service.show');
Route::get('/service/category/{slug}', [ServiceController::class, 'category'])->name('service.category');

Route::get('/sparepart', [SparepartController::class, 'index'])->name('sparepart');
Route::get('/sparepart/{slug}', [SparepartController::class, 'show'])->name('sparepart.show');
Route::get('/sparepart/category/{slug}', [SparepartController::class, 'category'])->name('sparepart.category');

Route::group(['prefix' => 'cockpit'], function () {
    Voyager::routes();
});
