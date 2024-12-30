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

        // Wilayah Pengelola
        $managerRegion = Auth::user()->region_id;;

        // Data Laporan
        $totalSchedules = Schedule::whereHas('user', function ($query) use ($managerRegion) {
            $query->where('region_id', $managerRegion);
        })->whereDate('pickup_date', $today)->count();

        $completedSchedules = Schedule::whereHas('user', function ($query) use ($managerRegion) {
            $query->where('region_id', $managerRegion);
        })->whereDate('pickup_date', $today)->where('status', 'completed')->count();

        $pendingSchedules = Schedule::whereHas('user', function ($query) use ($managerRegion) {
            $query->where('region_id', $managerRegion);
        })->whereDate('pickup_date', $today)->where('status', 'pending')->count();

        $totalWasteVolume = Schedule::whereHas('user', function ($query) use ($managerRegion) {
            $query->where('region_id', $managerRegion);
        })->whereDate('pickup_date', $today)->sum('quantity');

        $wasteByType = Waste::join('schedules', 'wastes.id', '=', 'schedules.waste_id')
            ->whereHas('schedules.user', function ($query) use ($managerRegion) {
                $query->where('region_id', $managerRegion);
            })
            ->whereDate('schedules.pickup_date', $today)
            ->select('wastes.type', DB::raw('SUM(schedules.quantity) as total'))
            ->groupBy('wastes.type')
            ->get();

        $averageRating = Feedback::whereHas('schedule', function ($query) use ($managerRegion) {
            $query->whereHas('user', function ($subQuery) use ($managerRegion) {
                $subQuery->where('region_id', $managerRegion);
            });
        })->whereDate('created_at', $today)->avg('rating');

        $totalTransactions = Transaction::whereHas('schedule', function ($query) use ($managerRegion) {
            $query->whereHas('user', function ($subQuery) use ($managerRegion) {
                $subQuery->where('region_id', $managerRegion);
            });
        })->whereDate('created_at', $today)->sum('amount');

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
