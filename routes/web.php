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
        Route::get('create/{id}', '\App\Http\Controllers\ObjectController@create')
            ->name('create')
            ->where('id', '1|2|3')
            ->middleware(['permission:objects.crud']);
        Route::post('store', '\App\Http\Controllers\ObjectController@store')
            ->name('store')
            ->middleware(['permission:objects.crud']);
    });

    Route::name('vehicles.')->prefix('vehicles')->group(function(){
        Route::get('', '\App\Http\Controllers\VehicleController@index')
            ->name('index')
            ->middleware(['permission:objects.show']);
        Route::delete('{id}', '\App\Http\Controllers\VehicleController@destroy')
            ->name('destroy')
            ->where('id', '[0-9]+')
            ->middleware(['permission:objects.crud']);
    });

    Route::name('trailers.')->prefix('trailers')->group(function(){
        Route::get('', '\App\Http\Controllers\TrailerController@index')
            ->name('index')
            ->middleware(['permission:objects.show']);
        Route::delete('{id}', '\App\Http\Controllers\TrailerController@destroy')
            ->name('destroy')
            ->where('id', '[0-9]+')
            ->middleware(['permission:objects.crud']);
    });

    Route::name('machines.')->prefix('machines')->group(function(){
        Route::get('', '\App\Http\Controllers\MachineController@index')
            ->name('index')
            ->middleware(['permission:objects.show']);
        Route::delete('{id}', '\App\Http\Controllers\MachineController@destroy')
            ->name('destroy')
            ->where('id', '[0-9]+')
            ->middleware(['permission:objects.crud']);
    });

    /*
Route::middleware(['auth'])->group(function() {
    Route::name('gatunki.')->prefix('gatunki')->group(function(){
        Route::get('', '\App\Http\Controllers\GatunekController@index')
            ->name('index')
            ->middleware(['permission:gatunki.index']);
        Route::get('create', '\App\Http\Controllers\GatunekController@create')
            ->name('create')
            ->middleware(['permission:gatunki.store']);
        Route::post('', '\App\Http\Controllers\GatunekController@store')
            ->name('store')
            ->middleware(['permission:gatunki.store']);
        Route::get('{id}', '\App\Http\Controllers\GatunekController@show')
            ->name('show')
            ->where('id', '[0-9]+')
            ->middleware(['permission:gatunki.show']);
        Route::get('{id}/edit', '\App\Http\Controllers\GatunekController@edit')
            ->name('edit')
            ->where('id', '[0-9]+')
            ->middleware(['permission:gatunki.store']);
        Route::patch('{id}', '\App\Http\Controllers\GatunekController@update')
            ->name('update')
            ->where('id', '[0-9]+')
            ->middleware(['permission:gatunki.store']);
        Route::delete('{id}', '\App\Http\Controllers\GatunekController@destroy')
            ->name('destroy')
            ->where('id', '[0-9]+')
            ->middleware(['permission:gatunki.store']);
    });
});
    */
});


Route::fallback(function () {
    return view('404');
    //return redirect('');
});