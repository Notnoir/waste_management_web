<?php

namespace App\Http\Controllers\Pengelola;

use App\Models\Vehicle;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

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

        return view('pengelola.vehicles.index', compact('vehicles'));
    }

    // Tampilkan detail kendaraan
    public function show(Vehicle $vehicle)
    {
        return view('pengelola.vehicles.show', compact('vehicle'));
    }

    public function create()
    {
        return view('vehicles.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:100',
            'license_plate' => 'required|string|max:20|unique:vehicles',
            'capacity' => 'required|numeric|min:0',
            'status' => 'required|in:available,maintenance',
        ]);

        Vehicle::create($request->all());
        return redirect()->route('pengelola.vehicles.index')->with('success', 'Vehicle added successfully.');
    }

    public function edit(Vehicle $vehicle)
    {
        return view('vehicles.edit', compact('vehicle'));
    }

    public function update(Request $request, Vehicle $vehicle)
    {
        $request->validate([
            'name' => 'required|string|max:100',
            'license_plate' => 'required|string|max:20|unique:vehicles,license_plate,' . $vehicle->id,
            'capacity' => 'required|numeric|min:0',
            'status' => 'required|in:available,maintenance',
        ]);

        $vehicle->update($request->all());
        return redirect()->route('pengelola.vehicles.index')->with('success', 'Vehicle updated successfully.');
    }

    public function destroy(Vehicle $vehicle)
    {
        $vehicle->delete();
        return redirect()->route('pengelola.vehicles.index')->with('success', 'Vehicle deleted successfully.');
    }
}
