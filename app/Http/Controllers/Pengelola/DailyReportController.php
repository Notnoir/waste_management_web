<?php

namespace App\Http\Controllers\Pengelola;

use Carbon\Carbon;
use App\Models\Waste;
use App\Models\Feedback;
use App\Models\Schedule;
use App\Models\Transaction;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class DailyReportController extends Controller
{
    public function dailyReport()
    {
        $today = Carbon::today();

        // Data Laporan
        $totalSchedules = Schedule::whereDate('pickup_date', $today)->count();
        $completedSchedules = Schedule::whereDate('pickup_date', $today)
            ->where('status', 'completed')
            ->count();
        $pendingSchedules = Schedule::whereDate('pickup_date', $today)
            ->where('status', 'pending')
            ->count();
        $totalWasteVolume = Schedule::whereDate('pickup_date', $today)->sum('quantity');
        $wasteByType = Waste::join('schedules', 'wastes.id', '=', 'schedules.waste_id')
            ->whereDate('schedules.pickup_date', $today)
            ->select('wastes.type', DB::raw('SUM(schedules.quantity) as total'))
            ->groupBy('wastes.type')
            ->get();
        $averageRating = Feedback::whereDate('created_at', $today)->avg('rating');
        $totalTransactions = Transaction::whereDate('created_at', $today)->sum('amount');

        // Kirim Data ke View
        return view('pengelola.daily_report', compact(
            'totalSchedules',
            'completedSchedules',
            'pendingSchedules',
            'totalWasteVolume',
            'wasteByType',
            'averageRating',
            'totalTransactions'
        ));
    }
}
