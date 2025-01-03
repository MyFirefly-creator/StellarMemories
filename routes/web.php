<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\Auth\SocialiteController;
use App\Http\Controllers\DashboardController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\GaleriController;
use App\Http\Controllers\FotoController;
use App\Http\Controllers\KomentarController;
use App\Http\Controllers\LikeFotoController;
use App\Http\Controllers\ProfilController;
use App\Http\Controllers\WarningController;

Route::get('/', function () {
    return view('welcome');
});

Route::prefix('sesi')->name('sesi.')->group(function () {
    Route::get('/', [UserController::class, 'index'])->name('index');
    Route::get('/register', [UserController::class, 'showRegisterForm'])->name('register');
    Route::post('/register', [UserController::class, 'register'])->name('register.store');
    Route::get('/login', [UserController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [UserController::class, 'login'])->name('login.store');
    Route::get('/logout', [UserController::class, 'logout'])->name('logout');
    Route::get('/edit', [UserController::class, 'showEditForm'])->name('edit');
    Route::put('/edit', [UserController::class, 'update'])->name('update');
    Route::get('/profil', [UserController::class, 'profil'])->name('profil.index');
    Route::get('/user/{id}/edit', [UserController::class, 'edit'])->name('user.edit');
    Route::put('/user/{id}', [UserController::class, 'update'])->name('user.update');
});

Route::get('/dashboard', [DashboardController::class, 'index'])->name('index');

Route::prefix('album')->middleware('auth')->group(function () {
    Route::get('/', [GaleriController::class, 'index'])->name('album.index');
    Route::get('/create', [GaleriController::class, 'create'])->name('album.create');
    Route::post('/', [GaleriController::class, 'store'])->name('album.store');
    Route::get('/{id}/edit', [GaleriController::class, 'edit'])->name('album.edit');
    Route::put('/{id}', [GaleriController::class, 'update'])->name('album.update');
    Route::delete('/{id}', [GaleriController::class, 'destroy'])->name('album.destroy');
});

Route::resource('foto', FotoController::class);

Route::get('/foto/{id}', [KomentarController::class, 'index'])->name('foto.show');
Route::post('/komentar', [KomentarController::class, 'store'])->name('komentar.store');

Route::post('/like/{fotoId}', [LikeFotoController::class, 'toggleLike'])->name('foto.like');

Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('/', [AdminController::class, 'index'])->name('index');
    Route::get('user/edit/{id}', [AdminController::class, 'editUser'])->name('user.edit');
    Route::put('user/update/{id}', [AdminController::class, 'updateUser'])->name('user.update');
    Route::delete('user/delete/{id}', [AdminController::class, 'destroyUser'])->name('user.destroy');
    Route::delete('foto/delete/{id}', [AdminController::class, 'destroyFoto'])->name('foto.destroy');
});

Route::post('/warning', [WarningController::class, 'store'])->name('warning.store');

Route::get('/foto/download/{id}', [FotoController::class, 'download'])->name('foto.download');


Route::get('sesi/auth/redirect', [SocialiteController::class, 'redirect']);

Route::get('/auth/google/callback', [SocialiteController::class, 'callback']);
