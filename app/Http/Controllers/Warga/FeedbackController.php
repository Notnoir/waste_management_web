<?php

namespace App\Http\Controllers\Warga;

use App\Models\Feedback;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class FeedbackController extends Controller
{
    // Menampilkan form feedback
    public function create()
    {
        return view('warga.feedback.create');
    }

    // Menyimpan feedback ke database
    public function store(Request $request)
    {
        $request->validate([
            'rating' => 'required|integer|min:1|max:5',
            'comments' => 'nullable|string|max:1000',
        ]);

        Feedback::create([
            'user_id' => Auth::user()->id, // ID pengguna yang sedang login
            'schedule_id' => $request->input('schedule_id'), // Opsional
            'rating' => $request->input('rating'),
            'comments' => $request->input('comments'),
        ]);

        return redirect()->back()->with('success', 'Feedback berhasil dikirim!');
    }

    // Menampilkan daftar feedback
    public function index()
    {
        $feedbacks = Feedback::with('user')->latest()->paginate(6);
        return view('warga.feedback.index', compact('feedbacks'));
    }
}
