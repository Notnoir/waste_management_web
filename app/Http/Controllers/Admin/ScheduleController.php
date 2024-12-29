<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use App\Models\Waste;
use App\Models\Schedule;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ScheduleController extends Controller
{
    /**
     * Tampilkan daftar jadwal.
     */
    public function index()
    {
        $users = User::where('role', 'warga')->get(); // Hanya pengguna dengan peran warga
        $wastes = Waste::all();
        $schedules = Schedule::with(['user', 'waste'])->latest()->paginate(5);

        return view('admin.schedules.index', compact('schedules', 'users', 'wastes'));
    }

    /**
     * Menampilkan detail jadwal.
     */
    public function show(Schedule $schedule)
    {
        $schedule->load(['user', 'waste']);
        return view('admin.schedules.show', compact('schedule'));
    }

    /**
     * Tampilkan halaman untuk membuat jadwal baru.
     */
    public function create()
    {
        $users = User::where('role', 'warga')->get(); // Hanya pengguna dengan peran warga
        $wastes = Waste::all();

        return view('schedules.create', compact('users', 'wastes'));
    }

    /**
     * Simpan jadwal baru ke database.
     */
    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'waste_id' => 'required|exists:wastes,id',
            'pickup_date' => 'required|date|after_or_equal:today',
            'quantity' => 'required|numeric|min:0.1',
        ]);

        Schedule::create($request->all());

        return redirect()->route('schedules.index')->with('success', 'Jadwal berhasil ditambahkan.');
    }

    /**
     * Tampilkan halaman untuk mengedit jadwal.
     */
    public function edit(Schedule $schedule)
    {
        $users = User::where('role', 'warga')->get();
        $wastes = Waste::all();

        return view('schedules.edit', compact('schedule', 'users', 'wastes'));
    }

    /**
     * Perbarui jadwal di database.
     */
    public function update(Request $request, Schedule $schedule)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'waste_id' => 'required|exists:wastes,id',
            // 'pickup_date' => 'required|date|after_or_equal:today',
            'pickup_date' => 'required|date|date_format:Y-m-d',
            'quantity' => 'required|numeric|min:0.1',
            'status' => 'required|in:in_progress,pending,completed,cancelled',
        ]);

        $schedule->update($request->all());

        return redirect()->route('schedules.index')->with('success', 'Jadwal berhasil diperbarui.');
    }

    /**
     * Hapus jadwal dari database.
     */
    public function destroy(Schedule $schedule)
    {
        $schedule->delete();

        return redirect()->route('schedules.index')->with('success', 'Jadwal berhasil dihapus.');
    }
}
