<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use App\Models\User;
use App\Models\Schedule;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class TransactionController extends Controller
{
    // Menampilkan daftar transaksi
    public function index()
    {
        $transactions = Transaction::with(['user', 'schedule'])->latest()->paginate(10);
        return view('admin.transactions.index', compact('transactions'));
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
            'user_id' => 'required|exists:users,id',
            'schedule_id' => 'nullable|exists:schedules,id',
            'amount' => 'required|numeric|min:0',
            'status' => 'required|in:pending,success,failed',
            'payment_method' => 'required|string|max:50',
        ]);

        Transaction::create([
            'id' => Str::uuid(),
            'user_id' => $request->user_id,
            'schedule_id' => $request->schedule_id,
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
            'user_id' => 'required|exists:users,id',
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
