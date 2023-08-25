<?php

use App\Http\Controllers\ApController;
use App\Http\Controllers\Auth\UserController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\EmplacementController;
use App\Http\Controllers\RadioController;
use App\Http\Controllers\RouteurController;
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
})->middleware('guest');


Route::get('/login', [UserController::class, 'createFormLogin'])->name('createFormLogin')->middleware('guest');
Route::post('/login', [UserController::class, 'loginUsers'])->name('loginUsers')->middleware('guest');


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
            Route::post('/particuliers', [ClientController::class, 'FormParticulier'])->name('client.FormParticulier');
            Route::post('/entreprises', [ClientController::class, 'FormEntreprise'])->name('client.FormEntreprise');
            Route::post('/update/{id}', [ClientController::class, 'update'])->name('client.update');
            Route::delete('/delete/{id}', [ClientController::class, 'destroy'])->name('client.delete');
        });

        Route::prefix('emplacements')->group(function () {
            Route::get('/', [EmplacementController::class, 'index'])->name('emplacement.index');
            Route::post('/', [EmplacementController::class, 'store'])->name('emplacement.store');
            Route::post('/update/{id}', [EmplacementController::class, 'update'])->name('emplacement.update');
            Route::delete('/delete/{id}', [EmplacementController::class, 'destroy'])->name('emplacement.delete');
        });

        Route::prefix('radios')->group(function () {
            Route::get('/', [RadioController::class, 'index'])->name('radio.index');
            Route::post('/', [RadioController::class, 'store'])->name('radio.store');
            Route::post('/update/{id}', [RadioController::class, 'update'])->name('radio.update');
            Route::delete('/delete/{id}', [RadioController::class, 'destroy'])->name('radio.delete');
        });

        Route::prefix('routeurs')->group(function () {
            Route::get('/', [RouteurController::class, 'index'])->name('routeur.index');
            Route::post('/', [RouteurController::class, 'store'])->name('routeur.store');
            Route::post('/update/{id}', [RouteurController::class, 'update'])->name('routeur.update');
            Route::delete('/delete/{id}', [RouteurController::class, 'destroy'])->name('routeur.delete');
        });
    });

    Route::get('/logout', [Usercontroller::class, 'logout'])->name('logout');
    
});