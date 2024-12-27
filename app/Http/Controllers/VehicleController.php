<?php

namespace App\Http\Controllers;

use App\Models\Vehicle;
use Illuminate\Http\Request;

class VehicleController extends Controller
{
    // Tampilkan daftar kendaraan
    public function index(Request $request)
    {
        $search = $request->input('search');

        $vehicles = Vehicle::when($search, function ($query, $search) {
            $query->where('name', 'like', "%{$search}%")
                ->orWhere('license_plate', 'like', "%{$search}%");
        })->paginate(5);

        return view('admin.vehicles.index', compact('vehicles'));
    }

    // Tampilkan form tambah kendaraan
    public function create()
    {
        return view('vehicles.create');
    }

    // Simpan kendaraan baru
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'license_plate' => 'required|string|max:20|unique:vehicles',
            'capacity' => 'required|numeric',
            'status' => 'required|in:available,maintenance',
        ]);

        Vehicle::create($request->all());
        return redirect()->route('vehicles.index')->with('success', 'Vehicle added successfully!');
    }

    // Tampilkan detail kendaraan
    public function show(Vehicle $vehicle)
    {
        return view('admin.vehicles.show', compact('vehicle'));
    }

    // Tampilkan form edit kendaraan
    public function edit(Vehicle $vehicle)
    {
        return view('vehicles.edit', compact('vehicle'));
    }

    // Update data kendaraan
    public function update(Request $request, Vehicle $vehicle)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'license_plate' => 'required|string|max:20|unique:vehicles,license_plate,' . $vehicle->id,
            'capacity' => 'required|numeric',
            'status' => 'required|in:available,maintenance',
        ]);

        $vehicle->update($request->all());
        return redirect()->route('vehicles.index')->with('success', 'Vehicle updated successfully!');
    }

    // Hapus kendaraan
    public function destroy(Vehicle $vehicle)
    {
        $vehicle->delete();
        return redirect()->route('vehicles.index')->with('success', 'Vehicle deleted successfully!');
    }
}
