<?php

namespace App\Http\Controllers\Warga;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Schedule;
use App\Models\Waste;
use Illuminate\Support\Facades\Auth;

class PickupController extends Controller
{
    // Menampilkan halaman untuk membuat jadwal penjemputan
    public function create()
    {
        $wastes = Waste::all(); // Mendapatkan daftar kategori limbah
        return view('warga.pickups.create', compact('wastes'));
    }

    // Menyimpan jadwal penjemputan
    public function store(Request $request)
    {
        $request->validate([
            'waste_id' => 'required|exists:wastes,id',
            'pickup_date' => 'required|date|after:today',
            'quantity' => 'required|numeric|min:1',
        ]);

        Schedule::create([
            'user_id' => Auth::id(),
            'waste_id' => $request->waste_id,
            'pickup_date' => $request->pickup_date,
            'quantity' => $request->quantity,
            'status' => 'pending',
        ]);

        return redirect()->route('warga.pickups.index')->with('success', 'Jadwal penjemputan berhasil dibuat.');
    }

    // Menampilkan riwayat jadwal penjemputan
    public function index()
    {
        $schedules = Schedule::where('user_id', Auth::id())->orderBy('pickup_date', 'desc')->paginate(5);
        $wastes = Waste::all();
        return view('warga.pickups.index', compact('schedules', 'wastes'));
    }

    // Membatalkan jadwal penjemputan
    public function cancel($id)
    {
        $schedule = Schedule::where('id', $id)->where('user_id', Auth::id())->firstOrFail();

        if ($schedule->status === 'pending') {
            $schedule->update(['status' => 'cancelled']);
            return redirect()->route('warga.pickups.index')->with('success', 'Jadwal penjemputan berhasil dibatalkan.');
        }

        return redirect()->route('warga.pickups.index')->with('error', 'Jadwal ini tidak dapat dibatalkan.');
    }
}
