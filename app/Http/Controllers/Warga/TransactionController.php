<?php

namespace App\Http\Controllers\Warga;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Transaction;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class TransactionController extends Controller
{
    // Menampilkan riwayat transaksi
    public function index()
    {
        // Mengambil riwayat transaksi pengguna yang sedang login
        $transactions = Transaction::where('user_id', Auth::id())->get();

        // Mengambil saldo pengguna (misal, kita simpan di kolom saldo tabel users)
        $user = Auth::user();
        $balance = $user->balance;

        return view('warga.transactions.index', compact('transactions', 'balance'));
    }

    // Menampilkan halaman formulir transaksi
    public function create()
    {
        return view('warga.transactions.create');
    }

    // Menyimpan transaksi baru
    public function store(Request $request)
    {
        // Validasi data yang diterima
        $request->validate([
            'type' => 'required|in:top_up,pickup_payment',
            'amount' => 'required|numeric|min:0',
            'payment_method' => 'required|string|max:50',
            'schedule_id' => 'nullable|exists:schedules,id',
        ]);

        $transaction = Transaction::create([
            'user_id' => Auth::user()->id,
            'type' => $request->type,
            'amount' => $request->amount,
            'payment_method' => $request->payment_method,
            'schedule_id' => $request->schedule_id,
            'status' => 'pending',
        ]);

        // Simulasi proses pembayaran (misalnya dari API atau proses internal)
        // Di sini kita bisa mengganti status transaksi menjadi 'success' setelah pembayaran berhasil
        // $transaction->status = 'success';
        // $transaction->save();

        // // Menambahkan saldo pengguna jika transaksi berhasil
        // if ($transaction->status === 'success') {
        //     $user = User::find(Auth::user()->id);
        //     $user->balance += $transaction->amount;  // Tambah saldo sesuai jumlah transaksi
        //     $user->save();
        // }

        return redirect()->route('warga.transactions.index')->with('success', 'Transaksi berhasil dan saldo telah diperbarui!');
    }

    public function simulatePayment(Transaction $transaction)
    {
        // Simulasi proses pembayaran (misalnya delay beberapa detik)
        sleep(5); // Simulasi waktu proses pembayaran (opsional)

        // Update status transaksi menjadi success
        $transaction->status = 'success';
        $transaction->save();

        // Tambahkan saldo ke akun pengguna
        $user = $transaction->user;
        $user->balance += $transaction->amount;
        $user->save();

        return redirect()->route('warga.transactions.index')->with('success', 'Pembayaran berhasil diproses!');
    }

    // Menampilkan detail transaksi
    public function show($id)
    {
        // Menampilkan detail transaksi tertentu
        $transaction = Transaction::where('user_id', Auth::id())->findOrFail($id);

        return view('warga.transactions.show', compact('transaction'));
    }
}
