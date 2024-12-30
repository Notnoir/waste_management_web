<?php

namespace App\Http\Controllers\Pengelola;

use App\Http\Controllers\Controller;
use App\Models\PickupAssignment;
use App\Models\Schedule;
use App\Models\Vehicle;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class PickupAssignmentController extends Controller
{
    // Menampilkan daftar penugasan
    public function index(Request $request)
    {
        $search = $request->input('search');
        $schedules = Schedule::where('status', 'pending')->get();
        $vehicles = Vehicle::where('status', 'available')->get();
        $assignments = PickupAssignment::with(['schedule', 'vehicle'])
            ->when($search, function ($query, $search) {
                $query->where('status', 'like', "%{$search}%")
                    ->orWhere('driver_name', 'like', "%{$search}%");
            })
            ->paginate(5);
        return view('pengelola.assignments.index', compact('assignments', 'schedules', 'vehicles'));
    }

    // Menampilkan detail penugasan
    public function show($id)
    {
        $assignment = PickupAssignment::with(['schedule', 'vehicle'])->findOrFail($id);
        return view('pengelola.assignments.show', compact('assignment'));
    }

    // Menampilkan form penugasan baru
    public function create()
    {
        $schedules = Schedule::where('status', 'pending')->get();
        $vehicles = Vehicle::where('status', 'available')->get();
        return view('assignments.create', compact('schedules', 'vehicles'));
    }

    // Menyimpan penugasan baru
    public function store(Request $request)
    {
        $request->validate([
            'schedule_id' => 'required|exists:schedules,id',
            'vehicle_id' => 'required|exists:vehicles,id',
            'driver_name' => 'required|string|max:100',
        ]);

        PickupAssignment::create([
            'id' => Str::uuid(), // Generate UUID
            'schedule_id' => $request->schedule_id,
            'vehicle_id' => $request->vehicle_id,
            'driver_name' => $request->driver_name,
            'status' => 'assigned',
        ]);

        // Update kendaraan jadi "in_progress"
        Vehicle::find($request->vehicle_id)->update(['status' => 'in_progress']);

        return redirect()->route('pengelola.assignments.index')->with('success', 'Penugasan berhasil dibuat.');
    }

    // Mengubah status penugasan
    public function updateStatus(Request $request, PickupAssignment $assignment)
    {
        $request->validate([
            'status' => 'required|in:assigned,in_progress,completed',
        ]);

        $assignment->update(['status' => $request->status]);

        // Jika tugas selesai, kendaraan jadi "available"
        if ($request->status === 'completed') {
            $assignment->vehicle->update(['status' => 'available']);
        }

        return redirect()->back()->with('success', 'Status penugasan diperbarui.');
    }
}
