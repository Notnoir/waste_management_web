<?php

namespace App\Http\Controllers\Pengelola;

use App\Models\Vehicle;
use App\Models\Feedback;
use App\Models\Schedule;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DashboardController extends Controller
{
    /**
     * Tampilkan halaman dashboard pengelola.
     */
    public function index()
    {
        // Data statistik untuk dashboard
        $jadwalHariIni = Schedule::whereDate('pickup_date', now()->toDateString())->count();
        $kendaraanTersedia = Vehicle::where('status', 'available')->count();
        $ratingRataRata = Feedback::avg('rating');

        // Data jadwal pickup hari ini
        $jadwal = Schedule::with('waste', 'user')
            ->whereDate('pickup_date', now()->toDateString())
            ->get();

        // Data kendaraan
        $kendaraan = Vehicle::all();

        return view('pengelola.dashboard', [
            'jadwalHariIni' => $jadwalHariIni,
            'kendaraanTersedia' => $kendaraanTersedia,
            'ratingRataRata' => $ratingRataRata,
            'jadwal' => $jadwal,
            'kendaraan' => $kendaraan,
        ]);
    }

    /**
     * Ubah status jadwal pengambilan.
     */
    public function updateScheduleStatus(Request $request, $id)
    {
        $schedule = Schedule::findOrFail($id);

        // Validasi data
        $request->validate([
            'status' => 'required|in:pending,in_progress',
        ]);

        $schedule->status = $request->status;
        $schedule->save();

        return redirect()->back()->with('success', 'Status jadwal berhasil diperbarui.');
    }
}
