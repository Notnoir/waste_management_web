<?php

namespace App\Http\Controllers\Admin;

use App\Models\Waste;
use Illuminate\Http\Request;
use App\Models\WasteCategory;
use App\Http\Controllers\Controller;

class WasteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $wastes = Waste::with('category')->paginate(5); // Ambil data dengan kategori
        $categories = WasteCategory::all(); // Ambil semua kategori
        return view('admin.wastes.index', compact('wastes', 'categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = WasteCategory::all(); // Ambil semua kategori untuk dropdown
        return view('wastes.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'type' => 'required|string|max:100',
            'cost' => 'required|numeric',
            'category_id' => 'nullable|exists:waste_categories,id',
        ]);

        Waste::create($request->all());

        return redirect()->route('wastes.index')->with('success', 'Data berhasil ditambahkan!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Waste $waste)
    {
        return view('admin.wastes.show', compact('waste'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Waste $waste)
    {
        $categories = WasteCategory::all(); // Ambil semua kategori
        return view('wastes.edit', compact('waste', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Waste $waste)
    {
        $request->validate([
            'type' => 'required|string|max:100',
            'cost' => 'required|numeric',
            'category_id' => 'nullable|exists:waste_categories,id',
        ]);

        $waste->update($request->all());

        return redirect()->route('wastes.index')->with('success', 'Waste updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Waste $waste)
    {
        $waste->delete();

        return redirect()->route('wastes.index')->with('success', 'Data berhasil dihapus!');
    }
}
