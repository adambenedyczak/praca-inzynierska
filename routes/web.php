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


Auth::routes();

Route::view('/test', 'test');


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


    Route::name('objects.')->prefix('objects')->group(function(){
        Route::get('create', '\App\Http\Livewire\AddNewObject')
            ->name('create')
            ->middleware(['permission:objects.crud']);
    });

    Route::name('parts.')->prefix('parts')->group(function(){
        Route::get('create/{owner}', '\App\Http\Controllers\PartController@create')
            ->name('create')
            ->where('owner', '[0-9]+')
            ->middleware(['permission:objects.crud']);
        Route::post('store/{id}/{owner}', '\App\Http\Controllers\PartController@store')
            ->name('store')
            ->where('id', '1|2|3')
            ->where('owner', '[0-9]+')
            ->middleware(['permission:objects.crud']);
    });

    Route::name('vehicles.')->prefix('vehicles')->group(function(){
        Route::get('', '\App\Http\Controllers\VehicleController@index')
            ->name('index')
            ->middleware(['permission:objects.show']);
        Route::get('{id}', '\App\Http\Controllers\VehicleController@show')
            ->name('show')
            ->where('id', '[0-9]+')
            ->middleware(['permission:objects.show']);
    });

    Route::name('trailers.')->prefix('trailers')->group(function(){
        Route::get('', '\App\Http\Controllers\TrailerController@index')
            ->name('index')
            ->middleware(['permission:objects.show']);
    });

    Route::name('machines.')->prefix('machines')->group(function(){
        Route::get('', '\App\Http\Controllers\MachineController@index')
            ->name('index')
            ->middleware(['permission:objects.show']);
    });




});


Route::fallback(function () {
    return view('404');
    //return redirect('');
});