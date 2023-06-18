<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\depanController;
use App\Http\Controllers\SesiContollers;
use App\Http\Controllers\halamanController;
use App\Http\Controllers\pengaturanHalamanController;
use App\Http\Controllers\profilController;
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

// Route::get('/', function () {
//     return view('welcome');
// }
Route::middleware(['guest'])->group(function () {
    Route::get('/', [SesiContollers::class, 'index'])->name('login');
    Route::get('/register', [SesiContollers::class, 'register'])->name('register');
    Route::post('/register', [SesiContollers::class, 'store']);
    Route::post('/', [SesiContollers::class, 'login']);
});
Route::get('/home', function () {
    return redirect('/admin');
});
Route::middleware(['auth'])->group(function () {
    // Route::get('/admin', [AdminController::class, 'user']);
    // Route::get('/admin/user',[depanController::class, 'index'])->middleware('userAkses:user'); 
    Route::get('/form/{id}', [AdminController::class, 'form_booking']);
    Route::post('/booking', [AdminController::class, 'booking']);
    Route::get('/admin/user', [AdminController::class, 'user'])->middleware('userAkses:user');
    Route::get('/logout',[SesiContollers::class, 'logout']);
});

Route::prefix('admin')->middleware('auth')->group(
    function() {
        Route::get('',[halamanController::class, 'index']);
        Route::resource('halaman',halamanController::class);
        Route::get('riwayat', [profilController::class, "riwayat"])->name('riwayat.index');
        Route::get('profil', [profilController::class, "index"])->name('profil.index');
        Route::post('profil', [profilController::class, "update"])->name('profil.update');
        Route::get('pengaturan', [pengaturanHalamanController::class, "index"])->name('pengaturan.index');
        Route::post('pengaturan', [pengaturanHalamanController::class, "update"])->name('pengaturan.update');
    }
);

// Route::get('/admin/user',[depanController::class, 'index']); 
