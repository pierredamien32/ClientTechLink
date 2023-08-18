<?php

use App\Http\Controllers\ApController;
use App\Http\Controllers\Auth\UserController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\SiteController;
use Illuminate\Support\Facades\Route;

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
    return view('acceuil');
});


Route::get('/login', [UserController::class, 'createFormLogin'])->name('createFormLogin');
Route::post('/login', [UserController::class, 'loginUsers'])->name('loginUsers');

// Route accessible que si l'utilisateur est connecté
Route::middleware(['auth', 'auth.session'])->group(function () {
    Route::prefix('dashboard')->group(function () {
        Route::prefix('utilisateurs')->group(function () {
            Route::get('/', [UserController::class, 'index'])->name('user.index');
            Route::post('/', [UserController::class, 'store'])->name('user.store');
            Route::post('/update/{id}', [UserController::class, 'update'])->name('user.update');
            Route::delete('/delete/{id}', [UserController::class, 'destroy'])->name('user.delete');
        });

        Route::prefix('sites')->group(function () {
            Route::get('/', [SiteController::class, 'index'])->name('site.index');
            Route::post('/', [SiteController::class, 'store'])->name('site.store');
            Route::post('/update/{id}', [SiteController::class, 'update'])->name('site.update');
            Route::delete('/delete/{id}', [SiteController::class, 'destroy'])->name('site.delete');
        });

        Route::prefix('aps')->group(function () {
            Route::get('/', [ApController::class, 'index'])->name('ap.index');
            Route::post('/', [ApController::class, 'store'])->name('ap.store');
            Route::post('/update/{id}', [ApController::class, 'update'])->name('ap.update');
            Route::delete('/delete/{id}', [ApController::class, 'destroy'])->name('ap.delete');
        });

        Route::prefix('clients')->group(function () {
            Route::get('/', [ClientController::class, 'index'])->name('client.index');
            Route::post('/', [ClientController::class, 'store'])->name('client.store');
            Route::post('/update/{id}', [ClientController::class, 'update'])->name('client.update');
            Route::delete('/delete/{id}', [ClientController::class, 'destroy'])->name('client.delete');
        });
    });


    Route::post('/logout', [Usercontroller::class, 'logout'])->name('logout');
});