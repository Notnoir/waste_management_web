<?php

use App\Models\Schedule;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Middleware\RoleMiddleware;
use App\Http\Controllers\AuthController;

// admin controllers
use App\Http\Controllers\ChatController;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\admin\AdminUserController;
use App\Http\Controllers\admin\AdminDashboardController;
use App\Http\Controllers\Warga\WargaDashboardController;
use App\Http\Controllers\admin\WasteController as AdminWasteController;
use App\Http\Controllers\Admin\ProfileController as AdminProfileController;

// pengelola controllers
use App\Http\Controllers\admin\RegionController as AdminRegionController;
use App\Http\Controllers\Warga\PickupController as WargaPickupController;
use App\Http\Controllers\admin\VehicleController as AdminVehicleController;
use App\Http\Controllers\Warga\ProfileController as WargaProfileController;
use App\Http\Controllers\admin\FeedbackController as AdminFeedbackController;
use App\Http\Controllers\admin\ScheduleController as AdminScheduleController;
use App\Http\Controllers\Warga\FeedbackController as WargaFeedbackController;
use App\Http\Controllers\Pengelola\WasteController as PengelolaWasteController;
use App\Http\Controllers\Pengelola\RegionController as PengelolaRegionController;

// warga controllers
use App\Http\Controllers\admin\TransactionController as AdminTransactionController;
use App\Http\Controllers\Pengelola\VehicleController as PengelolaVehicleController;
use App\Http\Controllers\Warga\TransactionController as WargaTransactionController;
use App\Http\Controllers\Pengelola\FeedbackController as PengelolaFeedbackController;
use App\Http\Controllers\Pengelola\ScheduleController as PengelolaScheduleController;
use App\Http\Controllers\Pengelola\DashboardController as PengelolaDashboardController;
use App\Http\Controllers\Pengelola\DailyReportController as PengelolaDailyReportController;
use App\Http\Controllers\Pengelola\PickupAssignmentController as PengelolaPickupAssignmentController;


Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login_view');
Route::post('/login', [AuthController::class, 'login'])->name('login');
Route::get('/register', [AuthController::class, 'showRegistrationForm'])->name('register_view');
Route::post('/register', [AuthController::class, 'register'])->name('register');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

//akses admin
Route::middleware([RoleMiddleware::class . ':admin'])->group(function () {
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

    //route profile
    Route::get('admin/profile/show', [AdminProfileController::class, 'show'])->name('admin.profile.show');
    Route::get('admin/profile/show/edit', [AdminProfileController::class, 'edit'])->name('admin.profile.edit');
    Route::post('admin/profile//update', [AdminProfileController::class, 'update'])->name('admin.profile.update');
});

//akses pengelola
Route::middleware([RoleMiddleware::class . ':pengelola'])->group(function () {
    // route pengelola untuk dashboard
    Route::resource('pengelola', PengelolaDashboardController::class)->except(['show']);
    Route::put('/update-status/{id}', [PengelolaDashboardController::class, 'updateScheduleStatus'])->name('pengelola.updateStatus');

    // route pengelola untuk jadwal
    Route::resource('pengelola/schedules', PengelolaScheduleController::class, ['as' => 'pengelola']);
    Route::post('pengelola/schedules/{schedule}/status', [PengelolaScheduleController::class, 'updateStatus'])->name('schedules.updateStatus');

    // route pengelola untuk kendaraan
    Route::resource('pengelola/vehicles', PengelolaVehicleController::class, ['as' => 'pengelola']);

    // route pengelola untuk penugasan
    Route::resource('pengelola/assignments', PengelolaPickupAssignmentController::class, ['as' => 'pengelola']);
    Route::patch('pengelola/assignments/{assignment}/status', [PengelolaPickupAssignmentController::class, 'updateStatus'])->name('assignments.updateStatus');

    // route Pengelola untuk feedback
    Route::resource('Pengelola/feedback', PengelolaFeedbackController::class, ['as' => 'pengelola']);

    // route pengelola untuk daily report
    Route::get('/pengelola/daily-report', [PengelolaDailyReportController::class, 'dailyReport'])->name('pengelola.dailyReport');

    // route pengelola untuk limbah
    Route::resource('pengelola/wastes', PengelolaWasteController::class, ['as' => 'pengelola']);

    // route pengelola untuk region
    Route::resource('pengelola/regions', PengelolaRegionController::class, ['as' => 'pengelola']);
});

//akses warga
Route::middleware([RoleMiddleware::class . ':warga'])->group(function () {
    Route::get('/dashboard', [WargaDashboardController::class, 'index'])->name('dashboard.warga');

    // jadwal penjemputan
    Route::resource('warga/pickups', WargaPickupController::class, ['as' => 'warga']);
    Route::post('/pickups/{id}/cancel', [WargaPickupController::class, 'cancel'])->name('pickups.cancel');

    // route untuk profile

    // route untuk transaksi
    Route::resource('warga/transactions', WargaTransactionController::class, ['as' => 'warga']);
    Route::post('/warga/transactions/{transaction}/simulate', [WargaTransactionController::class, 'simulatePayment'])->name('warga.transactions.simulate');

    // route untuk feedback
    Route::resource('warga/feedback', WargaFeedbackController::class, ['as' => 'warga']);

    // route untuk profile
    Route::get('warga/profile/show', [WargaProfileController::class, 'show'])->name('warga.profile.show');
    Route::get('warga/profile/show/edit', [WargaProfileController::class, 'edit'])->name('warga.profile.edit');
    Route::post('warga/profile//update', [WargaProfileController::class, 'update'])->name('warga.profile.update');
});

Route::middleware('auth')->group(function () {
    Route::get('/chats', [ChatController::class, 'index'])->name('chats.index');

    // Membuat chat baru
    Route::get('/chats/create', [ChatController::class, 'create'])->name('chats.create');
    Route::post('/chats', [ChatController::class, 'store'])->name('chats.store');

    // Melihat detail chat tertentu dan mengirim pesan
    Route::get('/chats/{chatId}', [ChatController::class, 'show'])->name('chats.show');

    // Mengirim pesan ke dalam chat tertentu
    Route::post('/chats/{chatId}/messages', [MessageController::class, 'send'])->name('messages.send');

    // Menandai pesan sebagai sudah dibaca
    Route::post('/messages/{messageId}/mark-as-read', [MessageController::class, 'markAsRead'])->name('messages.markAsRead');

    Route::post('/chats/{chat}/add-member', [ChatController::class, 'addMember'])->name('chats.addMember');

    // Route::post('/chats/{chat}/send-message', [ChatController::class, 'sendMessage'])->name('chats.sendMessage');
    Route::post('/chats/{chat}/send-message', [ChatController::class, 'sendMessage'])->name('chats.sendMessage');
});

// tidak memiliki akses
Route::get('/unauthorized', function () {
    return view('unauthorized');
})->name('unauthorized');




Route::get('/', function () {
    return view('welcome');
});

// Route::get('/dashboard-pengelola', function () {
//     return view('pengelola.dashboard');
// });
// Route::get('/dashboard-admin', function () {
//     return view('admin.dashboard');
// });

Route::get('/profile', function () {
    return view('warga.profile');
});
Route::get('/jenis-wastes', function () {
    return view('admin.jenis_sampah.index');
});

Route::get('/error-404', function () {
    return view('err-page-404');
})->name('error-404');

Route::get('/dashboard-guest', function () {
    return view('guest.dashboard');
});
