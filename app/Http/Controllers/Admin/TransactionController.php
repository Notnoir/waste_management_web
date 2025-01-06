<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use App\Models\Schedule;
use App\Models\Transaction;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class TransactionController extends Controller
{
    // Menampilkan daftar transaksi
    public function index(Request $request)
    {
        $search = $request->input('search'); // Ambil input pencarian

        // Query data transaksi dengan relasi
        $transactions = Transaction::with(['user', 'schedule'])
            ->when($search, function ($query, $search) {
                $query->whereHas('user', function ($q) use ($search) {
                    $q->where('name', 'like', '%' . $search . '%'); // Pencarian berdasarkan nama pengguna
                })
                    ->orWhereHas('schedule', function ($q) use ($search) {
                        $q->where('pickup_date', 'like', '%' . $search . '%'); // Pencarian berdasarkan tanggal jadwal
                    })
                    ->orWhere('amount', 'like', '%' . $search . '%') // Pencarian berdasarkan jumlah transaksi
                    ->orWhere('status', 'like', '%' . $search . '%') // Pencarian berdasarkan status
                    ->orWhere('payment_method', 'like', '%' . $search . '%'); // Pencarian berdasarkan metode pembayaran
            })
            ->latest()
            ->paginate(5);

        $users = User::all();
        $schedules = Schedule::all();

        return view('admin.transactions.index', compact('transactions', 'users', 'schedules', 'search'));
    }


    // Menampilkan form tambah transaksi
    public function create()
    {
        $users = User::all();
        $schedules = Schedule::all();
        return view('admin.transactions.create', compact('users', 'schedules'));
    }

    // Menyimpan transaksi baru
    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id|uuid',
            'schedule_id' => 'nullable|exists:schedules,id|uuid',
            'type' => 'required|in:top_up,pickup_payment',
            'amount' => 'required|numeric|min:0',
            'status' => 'required|in:pending,success,failed',
            'payment_method' => 'required|string|max:50',
        ]);

        // Cek apakah jadwal yang dipilih cocok dengan user
        // $schedule = Schedule::find($request->schedule_id);
        // if ($schedule->user_id != $request->user_id) {
        //     return redirect()->back()->withErrors(['schedule_id' => 'The selected schedule does not belong to this user.']);
        // }

        Transaction::create([
            'id' => Str::uuid(),
            'user_id' => $request->user_id,
            'schedule_id' => $request->schedule_id,
            'type' => $request->type,
            'amount' => $request->amount,
            'status' => $request->status,
            'payment_method' => $request->payment_method,
        ]);

        return redirect()->route('transactions.index')->with('success', 'Transaction created successfully.');
    }

    // Menampilkan detail transaksi
    public function show($id)
    {
        $transaction = Transaction::with(['user', 'schedule'])->findOrFail($id);
        return view('admin.transactions.show', compact('transaction'));
    }

    // Menampilkan form edit transaksi
    public function edit($id)
    {
        $transaction = Transaction::findOrFail($id);
        $users = User::all();
        $schedules = Schedule::all();
        return view('admin.transactions.edit', compact('transaction', 'users', 'schedules'));
    }

    // Update transaksi
    public function update(Request $request, $id)
    {
        $transaction = Transaction::findOrFail($id);

        $request->validate([
            'user_id' => 'nullable|exists:users,id',
            'schedule_id' => 'nullable|exists:schedules,id',
            'amount' => 'required|numeric|min:0',
            'status' => 'required|in:pending,success,failed',
            'payment_method' => 'required|string|max:50',
        ]);

        $transaction->update($request->all());

        return redirect()->route('transactions.index')->with('success', 'Transaction updated successfully.');
    }

    // Hapus transaksi
    public function destroy($id)
    {
        $transaction = Transaction::findOrFail($id);
        $transaction->delete();

        return redirect()->route('transactions.index')->with('success', 'Transaction deleted successfully.');
    }
}
