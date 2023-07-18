<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\ClientController as Ck;
use App\Http\Controllers\AccountController as Ac;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});


Route::prefix('clients')->name('clients-')->group(function () {

    Route::get('/', [Ck::class, 'index'])->name('index');
    Route::get('/create', [Ck::class, 'create'])->name('create');
    Route::post('/', [Ck::class, 'store'])->name('store');
    Route::get('/delete/{client}', [Ck::class, 'delete'])->name('delete');
    Route::delete('/{client}', [Ck::class, 'destroy'])->name('destroy');
    Route::get('/edit/{client}', [Ck::class, 'edit'])->name('edit');
    Route::put('/{client}', [Ck::class, 'update'])->name('update');

});

Route::prefix('accounts')->name('accounts-')->group(function () {

    Route::get('/', [Ac::class, 'index'])->name('index');
    Route::get('/create', [Ac::class, 'create'])->name('create');
    Route::post('/', [Ac::class, 'store'])->name('store');
    Route::get('/delete/{account}', [Ac::class, 'delete'])->name('delete');
    Route::delete('/{account}', [Ac::class, 'destroy'])->name('destroy');
    Route::get('/edit/{account}', [Ac::class, 'edit'])->name('edit');
    Route::put('/{account}', [Ac::class, 'update'])->name('update');


    Route::get('/transfare', [Ac::class, 'transfare'])->name('transfare');
    // Route::get('/transfare/{account}/{account2}', [Ac::class, 'transfare'])->name('transfare');
    // Route::post('/transfare/{account}/{account2}', [Ac::class, 'execute'])->name('execute');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
