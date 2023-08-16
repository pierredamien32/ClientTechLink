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
    Route::get('/utilisateurs', [UserController::class, 'index'])->name('user.index');
    Route::post('/utilisateurs', [UserController::class, 'store'])->name('user.store');
    Route::post('/utilisateurs/update/{id}', [UserController::class, 'update'])->name('user.update');
    Route::delete('/utilisateurs/delete/{id}', [UserController::class, 'destroy'])->name('user.delete');
    Route::post('/logout', [Usercontroller::class, 'logout'])->name('logout');
    Route::get('/dashboard', [ClientController::class, 'create'])->name('client.create');
});