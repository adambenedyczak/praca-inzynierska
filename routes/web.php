<?php

use App\Mail\NotificationMail;
use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Auth\EmailVerificationRequest;

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

Route::get('/email', function(){
    return new NotificationMail();
});

Auth::routes(['verify' => true]);

Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
    $request->fulfill();

    return redirect('/home');
})->middleware(['auth', 'signed'])->name('verification.verify');


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

    Route::get('/email/verify', function () {
        return view('auth.verify');
    })->middleware('auth')->name('verification.notice');

    Route::name('objects.')->prefix('objects')->middleware('verified')->group(function(){
        Route::get('create', '\App\Http\Livewire\AddNewObject')
            ->name('create')
            ->middleware(['permission:objects.crud']);
        Route::get('{id}', '\App\Http\Livewire\EditObject')
            ->name('edit')
            ->where('id', '[0-9]+')
            ->middleware(['permission:objects.crud']);
    });

    Route::name('vehicles.')->prefix('vehicles')->middleware('verified')->group(function(){
        Route::get('', '\App\Http\Controllers\VehicleController@index')
            ->name('index')
            ->middleware(['permission:objects.show']);
        Route::get('{id}', '\App\Http\Controllers\VehicleController@show')
            ->name('show')
            ->where('id', '[0-9]+')
            ->middleware(['permission:objects.show']);
    });

    Route::name('trailers.')->prefix('trailers')->middleware('verified')->group(function(){
        Route::get('', '\App\Http\Controllers\TrailerController@index')
            ->name('index')
            ->middleware(['permission:objects.show']);
        Route::get('{id}', '\App\Http\Controllers\TrailerController@show')
            ->name('show')
            ->where('id', '[0-9]+')
            ->middleware(['permission:objects.show']);
    });

    Route::name('machines.')->prefix('machines')->middleware('verified')->group(function(){
        Route::get('', '\App\Http\Controllers\MachineController@index')
            ->name('index')
            ->middleware(['permission:objects.show']);
        Route::get('{id}', '\App\Http\Controllers\MachineController@show')
            ->name('show')
            ->where('id', '[0-9]+')
            ->middleware(['permission:objects.show']);
    });

    Route::name('notifications.')->prefix('notifications')->middleware('verified')->group(function(){
        Route::get('settings', 'App\Http\Livewire\NotificationSettings')
            ->name('settings')
            ->middleware(['permission:objects.show']);
        /*Route::get('{id}', '\App\Http\Controllers\MachineController@show')
            ->name('show')
            ->where('id', '[0-9]+')
            ->middleware(['permission:objects.show']);*/
    });




});


Route::fallback(function () {
    return view('404');
    //return redirect('');
});