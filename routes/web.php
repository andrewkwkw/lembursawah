<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::get('/destinations', \App\Livewire\Frontend\DestinationsPage::class)->name('destinations');
Route::get('/destinations/{slug}', \App\Livewire\Frontend\DestinationDetail::class)->name('destination.detail');
Route::get('/packages', \App\Livewire\Frontend\PackagesPage::class)->name('packages');
Route::get('/packages/{slug}', \App\Livewire\Frontend\PackageDetail::class)->name('package.detail');
Route::get('/market', \App\Livewire\Frontend\MarketPage::class)->name('market');
Route::get('/market/{slug}', \App\Livewire\Frontend\ProductDetail::class)->name('product.detail');

Route::get('/map', \App\Livewire\Frontend\MapPage::class)->name('map');
Route::get('/articles', \App\Livewire\Frontend\ArticlesPage::class)->name('articles');
Route::get('/articles/{slug}', \App\Livewire\Frontend\ArticleDetail::class)->name('article.detail');
Route::get('/agendas', \App\Livewire\Frontend\AgendasPage::class)->name('agendas');
Route::get('/gallery', \App\Livewire\Frontend\GalleryPage::class)->name('gallery');
Route::get('/faq', \App\Livewire\Frontend\FaqsPage::class)->name('faq');
