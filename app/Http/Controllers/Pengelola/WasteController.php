<?php

namespace App\Http\Controllers\Pengelola;

use App\Models\Waste;
use App\Models\WasteCategory;
use App\Http\Controllers\Controller;

class WasteController extends Controller
{
    public function index()
    {
        $wastes = Waste::with('category')->paginate(5); // Ambil data dengan kategori
        $categories = WasteCategory::all(); // Ambil semua kategori
        return view('pengelola.wastes.index', compact('wastes', 'categories'));
    }
}
