@extends('layouts.main_admin')

@section('content')

<!-- Content -->
<div class="p-3 space-y-6">
    {{-- flowbite toast --}}
    @if (session()->has('success'))
    <div id="toast-success"
        class="animate__animated animate__bounceInRight fixed top-15 right-5 flex items-center w-full max-w-xs p-4 mb-4 text-gray-500 bg-white rounded-lg shadow dark:text-gray-400 dark:bg-gray-800"
        role="alert">
        <div
            class="inline-flex items-center justify-center flex-shrink-0 w-8 h-8 text-green-500 bg-green-100 rounded-lg dark:bg-green-800 dark:text-green-200">
            <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                viewBox="0 0 20 20">
                <path
                    d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5Zm3.707 8.207-4 4a1 1 0 0 1-1.414 0l-2-2a1 1 0 0 1 1.414-1.414L9 10.586l3.293-3.293a1 1 0 0 1 1.414 1.414Z" />
            </svg>
            <span class="sr-only">Check icon</span>
        </div>
        <div class="ms-3 text-sm font-normal">{{session('success')}}</div>
        <button type="button"
            class="ms-auto -mx-1.5 -my-1.5 bg-white text-gray-400 hover:text-gray-900 rounded-lg focus:ring-2 focus:ring-gray-300 p-1.5 hover:bg-gray-100 inline-flex items-center justify-center h-8 w-8 dark:text-gray-500 dark:hover:text-white dark:bg-gray-800 dark:hover:bg-gray-700"
            data-dismiss-target="#toast-success" aria-label="Close">
            <span class="sr-only">Close</span>
            <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
            </svg>
        </button>
    </div>
    @endif

    <!-- Stats -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        <div class="bg-white shadow rounded-xl p-4">
            <h3 class="text-lg font-semibold text-gray-700">Total Pengguna</h3>
            <p class="text-2xl font-bold text-[#21c434]">{{ $totalUsers }}</p>
        </div>
        <div class="bg-white shadow rounded-xl p-4">
            <h3 class="text-lg font-semibold text-gray-700">Total Transaksi</h3>
            <p class="text-2xl font-bold text-[#21c434]">Rp {{ number_format($totalTransactions, 2, ',', '.') }}</p>
        </div>
        <div class="bg-white shadow rounded-xl p-4">
            <h3 class="text-lg font-semibold text-gray-700">Pengambilan Selesai</h3>
            <p class="text-2xl font-bold text-[#21c434]">{{ $completedPickups }}</p>
        </div>
    </div>

    <div class="flex bg-white p-5 rounded-lg">
        <!-- Chart total transaksi -->
        <div id="transactions-chart" class="w-full"></div>

        <!-- Chart Status Jadwal -->
        <div id="schedule-status-chart" class="w-full hidden md:block"></div>

    </div>

    <!-- Table -->
    <div class="bg-white shadow rounded-xl overflow-x-auto">
        <div class="p-4 border-b">
            <h3 class="text-lg font-semibold">Transaksi Terbaru</h3>
        </div>
        <table class="w-full text-left table-auto border-collapse">
            <thead>
                <tr>
                    <th class="px-4 py-2 border-b">#</th>
                    <th class="px-4 py-2 border-b">Pengguna</th>
                    <th class="px-4 py-2 border-b">Jumlah</th>
                    <th class="px-4 py-2 border-b">Status</th>
                    <th class="px-4 py-2 border-b">Tanggal</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($recentTransactions as $index => $transaction)
                <tr class="hover:bg-gray-100">
                    <td class="px-4 py-2 border-b">{{ $index + 1 }}</td>
                    <td class="px-4 py-2 border-b">{{ $transaction->user->name }}</td>
                    <td class="px-4 py-2 border-b">Rp {{ number_format($transaction->amount, 0, ',', '.') }}</td>
                    <td class="px-4 py-2 border-b">
                        <span
                            class="{{ $transaction->status == 'success' ? 'bg-green-100 text-green-600' : ($transaction->status == 'pending' ? 'bg-yellow-100 text-yellow-600' : 'bg-red-100 text-red-600') }} px-2 py-1 text-sm rounded">
                            {{ ucfirst($transaction->status) }}
                        </span>
                    </td>
                    <td class="px-4 py-2 border-b">{{ $transaction->created_at->format('Y-m-d') }}</td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="px-4 py-2 text-center text-gray-500 border-b">Tidak ada transaksi terbaru
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

<script>
    // auto close toast
    setTimeout(function() {
        var toastSuccess = document.getElementById('toast-success');
            toastSuccess.classList.add('animate__animated', 'animate__fadeOut');
            setTimeout(function() {
                toastSuccess.style.display = 'none';
            }, 1000);
        }, 2000);

    document.addEventListener('DOMContentLoaded', function () {
            // Data dari server
            const months = @json($months);
            const totals = @json($totals);
            const scheduleStatus = @json($statusData); // Data status jadwal

            // Chart Total Transaksi
            const transactionOptions = {
                chart: {
                    type: 'area',
                    height: 350
                },
                series: [{
                    name: 'Total Uang Transaksi',
                    data: totals
                }],
                xaxis: {
                    categories: months,
                    title: {
                        text: 'Bulan'
                    }
                },
                yaxis: {
                    title: {
                        text: 'Jumlah Uang (IDR)'
                    }
                },
                title: {
                    text: 'Total Transaksi Per Bulan',
                    align: 'center'
                },
                tooltip: {
                    y: {
                        formatter: function (value) {
                            return 'Rp ' + value.toLocaleString();
                        }
                    }
                }
            };

            const transactionChart = new ApexCharts(document.querySelector("#transactions-chart"), transactionOptions);
            transactionChart.render();

            // Chart Status Jadwal
            const scheduleOptions = {
                chart: {
                    type: 'pie',
                    height: 350
                },
                series: [
                    scheduleStatus.pending,
                    scheduleStatus.completed,
                    scheduleStatus.cancelled
                ],
                labels: ['Pending', 'Completed', 'Cancelled'],
                title: {
                    text: 'Status Jadwal',
                    align: 'center'
                },
                colors: ['#FFF600', '#38FF4F', '#F44336'] // Warna untuk masing-masing status
            };

            const scheduleChart = new ApexCharts(document.querySelector("#schedule-status-chart"), scheduleOptions);
            scheduleChart.render();
        });
</script>
@endsection