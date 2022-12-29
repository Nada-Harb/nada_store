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

Route::group([
    'prefix' => '/dashboard/categories',
    'as' => 'dashboard.categories',
    'controller' => CategoriesController::class, //laravel 9
], function(){

    Route::get('/',[categoriescontroller::class, 'index'])
        ->name('index');

    Route::get('/create', [categoriescontroller::class, 'create'])
        ->name('create');
    
    Route::post('/', [categoriescontroller::class, 'store'])
        ->name('store');
        Route::get('/{category}/edit', 'edit')->name('edit');
        Route::put('/{category}', 'update')->name('update');
        Route::delete('/{category}', 'destroy')->name('destroy');

});


