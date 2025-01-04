<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use App\Models\Waste;
use App\Models\Schedule;
use App\Models\Transaction;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AdminDashboardController extends Controller
{
    /**
     * Tampilkan halaman utama Dashboard Admin.
     */
    public function index()
    {
        // Statistik Utama
        $totalUsers = User::count(); // Total pengguna
        $totalTransactions = Transaction::where('status', 'success')->sum('amount'); // Total transaksi sukses
        $completedPickups = Schedule::where('status', 'completed')->count(); // Total jadwal selesai

        // Ambil transaksi terbaru (limit 5)
        $recentTransactions = Transaction::with('user')
            ->orderBy('created_at', 'desc')
            ->take(5)
            ->get();

        return view('admin.dashboard', [
            'totalUsers' => $totalUsers,
            'totalTransactions' => $totalTransactions,
            'completedPickups' => $completedPickups,
            'recentTransactions' => $recentTransactions,
        ]);
    }

    /**
     * Tampilkan semua transaksi.
     */
    public function transactions()
    {
        $transactions = Transaction::with('user', 'schedule')
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        return view('admin.transactions.index', compact('transactions'));
    }

    /**
     * Tampilkan semua pengguna.
     */
    public function users()
    {
        $users = User::orderBy('created_at', 'desc')->paginate(10);

        return view('admin.users.index', compact('users'));
    }

    /**
     * Tampilkan semua jadwal pengambilan.
     */
    public function schedules()
    {
        $schedules = Schedule::with('user', 'waste')
            ->orderBy('pickup_date', 'desc')
            ->paginate(10);

        return view('admin.schedules.index', compact('schedules'));
    }

    /**
     * Tampilkan semua jenis sampah.
     */
    public function wastes()
    {
        $wastes = Waste::with('category')->paginate(10);

        return view('admin.wastes.index', compact('wastes'));
    }
}
