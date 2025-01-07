<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use App\Models\Waste;
use App\Models\Schedule;
use App\Models\Transaction;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class AdminDashboardController extends Controller
{
    /**
     * Tampilkan halaman utama Dashboard Admin.
     */
    public function index()
    {
        $currentMonth = now()->month; // Bulan saat ini
        $currentYear = now()->year;  // Tahun saat ini

        // Ambil total transaksi (uang) per bulan
        $transactions = Transaction::select(
            DB::raw('MONTHNAME(created_at) as month'), // Nama bulan
            DB::raw('SUM(amount) as total'),          // Total uang
            DB::raw('MONTH(created_at) as month_number') // Nomor bulan (1 = Januari, 2 = Februari, dst.)
        )
            ->groupBy('month', 'month_number') // Group by nama bulan dan nomor bulan
            ->orderBy('month_number')          // Urutkan berdasarkan nomor bulan
            ->get();

        // Siapkan data untuk chart
        $months = $transactions->pluck('month'); // Nama bulan
        $totals = $transactions->pluck('total'); // Total uang

        // Data jadwal berdasarkan status
        $schedules = Schedule::select(
            DB::raw('status'),
            DB::raw('COUNT(*) as count')
        )
            ->groupBy('status')
            ->get()
            ->pluck('count', 'status'); // Bentuk data menjadi array dengan key = status

        // Pastikan status yang tidak ada diberi nilai default 0
        $statusData = [
            'pending' => $schedules->get('pending', 0),
            'completed' => $schedules->get('completed', 0),
            'cancelled' => $schedules->get('cancelled', 0),
        ];

        // Statistik Utama
        $totalUsers = User::count(); // Total pengguna
        // $totalTransactions = Transaction::where('status', 'success')->sum('amount'); // Total transaksi sukses
        $totalTransactions = Transaction::where('status', 'success')
            ->whereMonth('created_at', $currentMonth)
            ->whereYear('created_at', $currentYear)
            ->sum('amount');
        $completedPickups = Schedule::where('status', 'completed')->count(); // Total jadwal selesai

        // Ambil transaksi terbaru (limit 5)
        $recentTransactions = Transaction::with('user')
            ->orderBy('created_at', 'desc')
            ->take(5)
            ->get();

        // Ambil jadwa pending (limit 5)
        $pendingSchedule = Schedule::with('user')
            ->where('status', 'pending')
            ->take(5)
            ->paginate(5);

        return view('admin.dashboard', [
            'totalUsers' => $totalUsers,
            'totalTransactions' => $totalTransactions,
            'completedPickups' => $completedPickups,
            'recentTransactions' => $recentTransactions,
            'months' => $months,
            'totals' => $totals,
            'statusData' => $statusData,
            'pendingSchedule' => $pendingSchedule,
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
