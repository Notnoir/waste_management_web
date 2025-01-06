<?php

namespace App\Http\Controllers\Warga;

use App\Models\Schedule;
use App\Models\Transaction;
use App\Models\Notification;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class WargaDashboardController extends Controller
{
    /**
     * Display the dashboard for Warga.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        // Ambil user yang sedang login
        $user = Auth::user();

        // Statistik
        $totalTransactions = Transaction::where('user_id', $user->id)->sum('amount');
        $activeSchedules = Schedule::where('user_id', $user->id)
            ->where('status', 'pending')
            ->count();
        $totalBalance = $user->balance ?? 0; // Jika ada sistem poin

        // Jadwal Pickup Aktif
        $schedules = Schedule::where('user_id', $user->id)
            ->orderBy('pickup_date', 'asc')
            ->take(5) // Hanya ambil 5 jadwal terakhir
            ->get();

        // Riwayat Notifikasi
        $notifications = Notification::where('user_id', $user->id)
            ->orderBy('created_at', 'desc')
            ->take(5) // Ambil 5 notifikasi terbaru
            ->get();

        // Kirim data ke view
        return view('warga.dashboard', [
            'user' => $user,
            'totalTransactions' => $totalTransactions,
            'activeSchedules' => $activeSchedules,
            'totalBalance' => $totalBalance,
            'schedules' => $schedules,
            'notifications' => $notifications,
        ]);
    }
}
