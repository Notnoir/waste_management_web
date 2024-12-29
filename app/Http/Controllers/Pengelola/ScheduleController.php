<?php

namespace App\Http\Controllers\Pengelola;

use App\Models\User;
use App\Models\Waste;
use App\Models\Schedule;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ScheduleController extends Controller
{
    public function index()
    {
        // Ambil semua data users (warga)
        $users = User::where('role', 'warga')->get();

        // Ambil semua jenis sampah
        $wastes = Waste::all();

        $schedules = Schedule::with(['user', 'waste'])->orderBy('pickup_date')->get();

        return view('pengelola.schedules.index', compact('users', 'wastes', 'schedules'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'waste_id' => 'required|exists:wastes,id',
            'pickup_date' => 'required|date|after:today',
            'quantity' => 'required|numeric|min:1',
        ]);

        Schedule::create($request->all());

        return redirect()->route('schedules.index')->with('success', 'Jadwal berhasil dibuat.');
    }

    public function updateStatus(Request $request, Schedule $schedule)
    {
        $request->validate([
            'status' => 'required|in:pending,in_progress,completed,cancelled',
        ]);

        $schedule->update(['status' => $request->status]);

        return redirect()->back()->with('success', 'Status jadwal diperbarui.');
    }
}
