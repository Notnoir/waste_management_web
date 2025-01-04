<?php

namespace App\Http\Controllers\Pengelola;

use App\Models\Feedback;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class FeedbackController extends Controller
{
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
        return view('pengelola.feedback.index', compact('feedbacks'));
    }
}
