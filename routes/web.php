<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\WasteController;
use App\Http\Controllers\VehicleController;
use App\Http\Controllers\ScheduleController;
use App\Http\Controllers\AdminUserController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\AdminDashboardController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('warga.dashboard');
});
Route::get('/dashboard-pengelola', function () {
    return view('pengelola.dashboard');
});
// Route::get('/dashboard-admin', function () {
//     return view('admin.dashboard');
// });
Route::get('/login', function () {
    return view('auth.login');
});
Route::get('/register', function () {
    return view('auth.register');
});
Route::get('/profile', function () {
    return view('warga.profile');
});
Route::get('/jenis-wastes', function () {
    return view('admin.jenis_sampah.index');
});

Route::get('/error-404', function () {
    return view('err-page-404');
})->name('error-404');

// halaman admin
Route::get('/dashboard-admin', [AdminDashboardController::class, 'index'])->name('admin.dashboard');
Route::get('/transactions', [AdminDashboardController::class, 'transactions'])->name('admin.transactions');
Route::get('/users', [AdminDashboardController::class, 'users'])->name('admin.users');
Route::get('/schedules', [AdminDashboardController::class, 'schedules'])->name('admin.schedules');
//Route::get('/wastes', [AdminDashboardController::class, 'wastes'])->name('admin.wastes');

// halaman admin set user
Route::resource('admin/users', AdminUserController::class);
// Route::get('/users', [AdminUserController::class, 'index'])->name('admin.users.index');
// Route::get('/users/{id}', [AdminUserController::class, 'show'])->name('admin.users.show');
// Route::delete('/users/{id}', [AdminUserController::class, 'destroy'])->name('admin.users.destroy');

// halaman admin set sampah
Route::resource('admin/wastes', WasteController::class);

// halaman admin set jadwal
Route::resource('admin/schedules', ScheduleController::class);

// halaman admin set kendaraan
Route::resource('admin/vehicles', VehicleController::class);

// halaman admin set transaksi
Route::resource('transactions', TransactionController::class);
