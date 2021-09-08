<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserAuthController;
use App\Http\Controllers\RecetteController;

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
    return view('welcome');
});

Route::get('dashboard', [UserAuthController::class, 'dashboard']);
Route::get('login', [UserAuthController::class, 'index'],
                    [RecetteController::class, 'index'])->name('login');
Route::post('custom-login', [UserAuthController::class, 'customLogin'])->name('login.custom');
Route::get('registration', [UserAuthController::class, 'registration'])->name('register-user');
Route::post('custom-registration', [UserAuthController::class, 'customRegistration'])->name('register.custom');
Route::get('signout', [UserAuthController::class, 'signout'])->name('signout');

Route::get('dashboard/create', [RecetteController::class, 'create'])->name('create');
Route::post('dashboard/store', [RecetteController::class, 'store'])->name('store');
Route::get('dashboard/index', [RecetteController::class, 'index'])->name('index');
