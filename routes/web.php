<?php

use App\Http\Controllers\Dashboard\CategoriesController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Route;

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

Route::get('/',[HomeController::class, 'index'])->name('home');

//Route::view('/styles', 'front.pages.styles');

Route::get('/pages/{name}',[HomeController::class, 'show'])->name('pages');

//Route::view('/dashboard','layout.dashboard');
Route::get('/dashboard/categories',[categoriescontroller::class, 'index'])
    ->name('dashboard.categories.index');

Route::get('/dashboard/categories/create', [categoriescontroller::class, 'create'])
    ->name('dashboard.categories.create');
  
Route::post('/dashoard/categories', [categoriescontroller::class, 'store'])
    ->name('dashboard.categories.store');

