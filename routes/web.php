<?php

use App\Http\Controllers\Auth\UserController;
use App\Http\Controllers\ClientController;
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
        
        Route::get('/client', [ClientController::class, 'create'])->name('client.create');
    });


    Route::post('/logout', [Usercontroller::class, 'logout'])->name('logout');
});