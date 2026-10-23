<?php

use App\Http\Controllers\CommunityController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\LogoutController;
use App\Http\Controllers\QuoteController;
use App\Http\Controllers\SignupController;
use App\Http\Controllers\SourceController;
use Illuminate\Support\Facades\Route;

Route::get('/', [QuoteController::class, 'index'])->name('home');
Route::get('/categories', [QuoteController::class, 'categories'])->name('categories.index');
Route::get('/quotes', [QuoteController::class, 'all'])->name('quotes.index');
Route::get('/sources', [SourceController::class, 'index'])->name('sources');
Route::get('/signup', fn () => view('Authentication.SignUp', ['page' => 'Sign Up']))->middleware('guest')->name('signup');
Route::post('/signup', [SignupController::class, 'signup'])->middleware('guest')->name('signup.store');
Route::get('/login', fn () => view('Authentication.LogIn', ['page' => 'Log In']))->middleware('guest')->name('login');
Route::post('/login', [LoginController::class, 'login'])->middleware('guest')->name('login.store');
Route::post('/logout', [LogoutController::class, 'logout'])->middleware('auth')->name('logout');
Route::get('/u/{user}', [CommunityController::class, 'profile'])->name('profile');

Route::middleware('auth')->group(function () {
    Route::post('/quotes', [QuoteController::class, 'store'])->name('quotes.store');
    Route::put('/quote/{quote}', [QuoteController::class, 'update'])->name('edit_quote');
    Route::delete('/quote/{quote}', [QuoteController::class, 'destroy'])->name('delete_quote');
    Route::post('/quote/{quote}/like', [CommunityController::class, 'like'])->name('quotes.like');
    Route::post('/quote/{quote}/favorite', [CommunityController::class, 'favorite'])->name('quotes.favorite');
    Route::post('/quote/{quote}/comments', [CommunityController::class, 'comment'])->name('quotes.comment');
    Route::post('/quote/{quote}/report', [CommunityController::class, 'report'])->name('quotes.report');
    Route::post('/quote/{quote}/collections', [CommunityController::class, 'addToCollection'])->name('quotes.collections');
    Route::post('/u/{user}/follow', [CommunityController::class, 'follow'])->name('profile.follow');
    Route::get('/favorites', [CommunityController::class, 'favorites'])->name('favorites');
    Route::put('/profile', [CommunityController::class, 'updateProfile'])->name('profile.update');
    Route::post('/collections', [CommunityController::class, 'createCollection'])->name('collections.store');
    Route::get('/collections', [CommunityController::class, 'collections'])->name('collections.index');
    Route::get('/collections/{collection}', [CommunityController::class, 'collection'])->name('collections.show');
    Route::get('/admin/reports', [CommunityController::class, 'admin'])->name('admin.reports');
    Route::patch('/admin/reports/{report}', [CommunityController::class, 'resolveReport'])->name('admin.reports.resolve');
    Route::delete('/admin/reports/{report}', [CommunityController::class, 'removeReportedQuote'])->name('admin.reports.delete');
});
