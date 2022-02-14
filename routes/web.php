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
Route::post('/product_detail', [App\Http\Controllers\Front\IndexController::class, 'detail'])->name('product.detail');


//Route::post('/quiz', [App\Http\Controllers\Front\IndexController::class, 'quiz'])->name('quiz');
//Route::get('/quiz', [App\Http\Controllers\Front\IndexController::class, 'quiz'])->name('quiz');

Route::post('/start', [App\Http\Controllers\Front\IndexController::class, 'start'])->name('start');
Route::post('/next', [App\Http\Controllers\Front\IndexController::class, 'next'])->name('next');
Route::post('/prev', [App\Http\Controllers\Front\IndexController::class, 'prev'])->name('prev');
Route::post('/result', [App\Http\Controllers\Front\IndexController::class, 'result'])->name('result');


//Route::get('/start', [App\Http\Controllers\Front\IndexController::class, 'start'])->name('start');

Route::get('/get-result', [App\Http\Controllers\Front\IndexController::class, 'getResult']);


Route::get('/cl2', [App\Http\Controllers\Front\IndexController::class, 'clean']);
Route::get('/gets', [App\Http\Controllers\Front\IndexController::class, 'gets']);

Route::group(['namespace'=>'App\Http\Controllers\Admin', 'prefix'=>'admin'], function () {
    Route::get('/', 'MainController@index')->name('admin.index');
    Route::resource('products', ProductController::class);
    Route::post('/products-remove-img','ProductController@remove_img')->name('products.remove.img');
    Route::resource('properties', PropertyController::class);
    Route::resource('steps', StepController::class);
    Route::resource('questions', QuestionController::class);
    Route::resource('benefits', BenefitController::class);
    Route::post('/benefits-remove-img','BenefitController@remove_img')->name('benefits.remove.img');

    Route::post('questions-add','QuestionController@add')->name('questions.add');


});





