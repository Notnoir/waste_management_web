<?php

use App\Models\Schedule;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// pengelola controllers
use App\Http\Controllers\Pengelola\DashboardController as PengelolaDashboardController;
use App\Http\Controllers\Pengelola\ScheduleController as PengelolaScheduleController;

// admin controllers
use App\Http\Controllers\admin\AdminUserController;
use App\Http\Controllers\admin\AdminDashboardController;
use App\Http\Controllers\admin\WasteController as AdminWasteController;
use App\Http\Controllers\admin\RegionController as AdminRegionController;
use App\Http\Controllers\admin\VehicleController as AdminVehicleController;
use App\Http\Controllers\admin\FeedbackController as AdminFeedbackController;
use App\Http\Controllers\admin\ScheduleController as AdminScheduleController;
use App\Http\Controllers\admin\TransactionController as AdminTransactionController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('warga.dashboard');
});

// Route::get('/dashboard-pengelola', function () {
//     return view('pengelola.dashboard');
// });
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
Route::get('/admin', [AdminDashboardController::class, 'index'])->name('admin.dashboard');
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
Route::resource('admin/wastes', AdminWasteController::class);

// halaman admin untuk jadwal
Route::resource('admin/schedules', AdminScheduleController::class);

// halaman admin untuk kendaraan
Route::resource('admin/vehicles', AdminVehicleController::class);

// halaman admin untuk transaksi
Route::resource('admin/transactions', AdminTransactionController::class);

// Route untuk mendapatkan schedules berdasarkan user_id
Route::get('/schedules-transactions', function (Request $request) {
    $user_id = $request->query('user_id');

    $schedules = Schedule::where('user_id', $user_id)->get();

    return response()->json([
        'schedules' => $schedules
    ]);
});

// route admin untuk feedback
Route::resource('admin/feedback', AdminFeedbackController::class);

// route admin untuk region
Route::resource('admin/regions', AdminRegionController::class);

// route pengelola untuk dashboard
Route::resource('pengelola', PengelolaDashboardController::class)->except(['show']);
Route::put('/update-status/{id}', [PengelolaDashboardController::class, 'updateScheduleStatus'])->name('pengelola.updateStatus');

// route pengelola untuk jadwal
Route::resource('pengelola/schedules', PengelolaScheduleController::class, ['as' => 'pengelola']);
Route::post('pengelola/schedules/{schedule}/status', [PengelolaScheduleController::class, 'updateStatus'])->name('schedules.updateStatus');
