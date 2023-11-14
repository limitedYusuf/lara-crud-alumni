<?php

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
    return view('welcome');
});

// ALUMNI AUTH
Route::group(['prefix' => 'alumni', 'as' => 'alumni.'], function () {
    Route::get('login', [\App\Http\Controllers\AlumniController::class, 'showLoginForm'])->name('login');

    Route::post('login', [\App\Http\Controllers\AlumniController::class, 'login']);

    Route::get('register', [\App\Http\Controllers\AlumniController::class, 'showRegisterForm'])->name('register');

    Route::post('register', [\App\Http\Controllers\AlumniController::class, 'register']);
    
    Route::post('logout', [\App\Http\Controllers\AlumniController::class, 'logout'])->name('logout');
});

// ADMIN AUTH
Route::group(['middleware' => ['guest'], 'prefix' => 'admin'], function () {
    Auth::routes();
});

// ADMIN PAGE
Route::group(['middleware' => ['auth:web'], 'prefix' => 'admin'], function () {
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

    Route::view('about', 'about')->name('about');

    Route::get('users', [\App\Http\Controllers\UserController::class, 'index'])->name('users.index');

    Route::get('profile', [\App\Http\Controllers\ProfileController::class, 'show'])->name('profile.show');
    Route::put('profile', [\App\Http\Controllers\ProfileController::class, 'update'])->name('profile.update');

    Route::resource('angkatan', \App\Http\Controllers\AngkatanController::class);

    Route::resource('kelas', \App\Http\Controllers\KelasController::class);

    Route::post('search', [\App\Http\Controllers\SiswaController::class, 'search'])->name('siswa.search');
    
    Route::resource('siswa', \App\Http\Controllers\SiswaController::class);

    Route::resource('akun', \App\Http\Controllers\AkunController::class);
});
