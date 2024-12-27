<?php

namespace App\Http\Controllers;

use App\Models\Feedback;
use Illuminate\Http\Request;

class FeedbackController extends Controller
{
    // Tampilkan semua feedback
    public function index(Request $request)
    {
        // Mengambil input pencarian
        $search = $request->input('search');

        // Query untuk mengambil feedback dengan filter pencarian
        $feedbacks = Feedback::with('user', 'schedule')
            ->when($search, function ($query) use ($search) {
                return $query->whereHas('user', function ($q) use ($search) {
                    $q->where('name', 'like', '%' . $search . '%');
                })
                    ->orWhere('rating', 'like', '%' . $search . '%')
                    ->orWhere('comments', 'like', '%' . $search . '%');
            })
            ->latest()
            ->paginate(5);

        return view('admin.feedback.index', compact('feedbacks', 'search'));
    }

    // Tambahkan feedback (opsional untuk warga)
    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'required|uuid|exists:users,id',
            'schedule_id' => 'nullable|uuid|exists:schedules,id',
            'rating' => 'required|integer|min:1|max:5',
            'comments' => 'nullable|string|max:255',
        ]);

        Feedback::create($request->all());

        return redirect()->back()->with('success', 'Feedback berhasil ditambahkan!');
    }

    // Hapus feedback
    public function destroy(Feedback $feedback)
    {
        $feedback->delete();
        return redirect()->back()->with('success', 'Feedback berhasil dihapus!');
    }
}
