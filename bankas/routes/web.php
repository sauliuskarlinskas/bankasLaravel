<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ClientController as Ck;

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

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
