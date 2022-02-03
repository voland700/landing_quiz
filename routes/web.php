<?php

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
    Route::get('/', function () {
        return view('welcome');
    });
*/



Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

require __DIR__.'/auth.php';

Route::get('/clear', function() {
    Artisan::call('cache:clear');
    Artisan::call('config:cache');
    Artisan::call('view:clear');
    Artisan::call('route:clear');
    return "Кэш очищен.";
})->name('clear.cash');

Route::get('/', [App\Http\Controllers\Front\IndexController::class, 'index'])->name('index');


Route::group(['namespace'=>'App\Http\Controllers\Admin', 'prefix'=>'admin'], function () {
    Route::get('/', 'MainController@index')->name('admin.index');
});




