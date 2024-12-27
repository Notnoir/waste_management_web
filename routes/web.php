<?php

use App\Models\Schedule;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\WasteController;
use App\Http\Controllers\RegionController;
use App\Http\Controllers\VehicleController;
use App\Http\Controllers\FeedbackController;
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

// halaman admin untuk limbah
Route::resource('admin/wastes', WasteController::class);

// halaman admin untuk jadwal
Route::resource('admin/schedules', ScheduleController::class);

// halaman admin untuk kendaraan
Route::resource('admin/vehicles', VehicleController::class);

// halaman admin untuk transaksi
Route::resource('admin/transactions', TransactionController::class);

// Route untuk mendapatkan schedules berdasarkan user_id
Route::get('/schedules-transactions', function (Request $request) {
    $user_id = $request->query('user_id');

    $schedules = Schedule::where('user_id', $user_id)->get();

    return response()->json([
        'schedules' => $schedules
    ]);
});

// route admin untuk feedback
Route::resource('admin/feedback', FeedbackController::class);

// route admin untuk region
Route::resource('admin/regions', RegionController::class);
