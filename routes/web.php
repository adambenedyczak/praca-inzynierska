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
*/

Route::get('/', function () {
    return view('home');
});

Auth::routes();

Route::middleware(['auth'])->group(function() {
    Route::get('logout', '\App\Http\Controllers\Auth\LoginController@logout');

    Route::name('profile.')->prefix('profile')->group(function(){
        Route::get('', '\App\Http\Controllers\UserController@show')
            ->name('show');
        Route::patch('update', '\App\Http\Controllers\UserController@update')
            ->name('update');
    });

    Route::get('/home', [App\Http\Controllers\DashboardController::class, 'index'])
        ->name('home');

    Route::get('/', [App\Http\Controllers\DashboardController::class, 'index'])
    ->name('');
});
