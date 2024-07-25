<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\IndexController;
use App\Http\Controllers\TourController;
use App\Http\Controllers\CategoriesController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\App;

Route::get('/', [IndexController::class, 'index'])->name('home');

Route::get('/tour/{slug}', [TourController::class, 'index'])->name('tour');
Route::get('/chi-tiet-tour/{slug}', [TourController::class, 'detail_tour'])->name('detail_tour');

Auth::routes();

Route::get('/home', [HomeController::class, 'index'])->name('home');

Route::resource('/categories', CategoriesController::class);
