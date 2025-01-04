@extends('layouts.main_pengelola')

@section('content')
<!-- Content -->
<div class="p-6 space-y-6">
    <h1 class="text-3xl font-bold text-gray-800 mb-6">Detail Kendaraan</h1>

    <!-- Informasi Vehicle -->
    <div class="bg-white shadow rounded p-6">
        <h3 class="text-lg font-semibold text-gray-700 mb-4">Informasi</h3>
        <div class="space-y-4">
            <p><strong>Nama Kendaraan:</strong> <span class="text-gray-800">{{ $vehicle->name }}</span></p>
            <p><strong>Plat Nomor:</strong> <span class="text-gray-800">{{ $vehicle->license_plate }}</span></p>
            <p><strong>Kapasitas:</strong> <span class="text-gray-800">{{ $vehicle->capacity }} Kg</span></p>
            <p><strong>Status:</strong>
                <span class="text-gray-800">
                    @if($vehicle->status == 'available') Tersedia
                    @elseif($vehicle->status == 'maintenance') Dalam Perawatan
                    @endif
                </span>
            </p>
            <p><strong>Dibuat Pada:</strong> <span class="text-gray-800">{{ $vehicle->created_at->format('Y-m-d H:i')
                    }}</span></p>
            <p><strong>Terakhir Diperbarui:</strong> <span class="text-gray-800">{{ $vehicle->updated_at ?
                    $vehicle->updated_at->format('Y-m-d H:i') : 'Belum Diperbarui' }}</span></p>
        </div>
    </div>

    <!-- Tombol Aksi -->
    <div class="mt-6">
        <a href="{{ route('pengelola.vehicles.index') }}"
            class="text-white bg-gray-800 hover:bg-gray-900 focus:outline-none focus:ring-4 focus:ring-gray-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-gray-800 dark:hover:bg-gray-700 dark:focus:ring-gray-700 dark:border-gray-700">
            Kembali
        </a>
        <button type="submit" data-modal-target="popup-modal" data-modal-toggle="popup-modal"
            data-id="{{ $vehicle->id }}" data-name="{{ $vehicle->name }}"
            class="focus:outline-none text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-900">
            Hapus
        </button>
    </div>
</div>

<!-- Modal Hapus -->
<div id="popup-modal" tabindex="-1"
    class="hidden fixed inset-0 flex items-center justify-center bg-gray-900 bg-opacity-50 z-50">
    <div class="bg-white p-6 rounded-lg w-full max-w-md shadow-lg">
        <h3 class="text-xl font-semibold text-gray-800 border-b-2 py-3">Hapus Kendaraan</h3>
        <p class="text-gray-500 my-6">Apakah Anda yakin ingin menghapus kendaraan <span id="deleteVehicleName"></span>?
        </p>
        <form id="deleteForm" action="" method="POST">
            @csrf
            @method('DELETE')
            <div class="flex justify-end space-x-2">
                <button type="button" data-modal-hide="popup-modal"
                    class="text-white bg-gray-800 hover:bg-gray-900 focus:outline-none focus:ring-4 focus:ring-gray-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-gray-800 dark:hover:bg-gray-700 dark:focus:ring-gray-700 dark:border-gray-700">
                    Batal
                </button>
                <button type="submit"
                    class="focus:outline-none text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-900">
                    Hapus
                </button>
            </div>
        </form>
    </div>
</div>

<script>
    // Script untuk modal hapus
    const deleteButtons = document.querySelectorAll('[data-modal-toggle="popup-modal"]');
    const deleteModal = document.getElementById('popup-modal');
    const deleteForm = document.getElementById('deleteForm');
    const deleteVehicleName = document.getElementById('deleteVehicleName');

    deleteButtons.forEach(button => {
        button.addEventListener('click', (event) => {
            const vehicleId = event.target.getAttribute('data-id');
            const vehicleName = event.target.getAttribute('data-name');
            deleteVehicleName.textContent = vehicleName;
            deleteForm.action = `/pengelola/vehicles/${vehicleId}`;
            deleteModal.classList.remove('hidden');
        });
    });

    document.querySelector('[data-modal-hide="popup-modal"]').addEventListener('click', () => {
        deleteModal.classList.add('hidden');
    });
</script>
@endsection