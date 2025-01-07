@extends('layouts.main_guest')

@section('content')
<!-- Hero Section -->
<div id="carouselExample" class="relative w-full" data-carousel="slide">
    <!-- Carousel Wrapper -->
    <div class="relative h-56 overflow-hidden md:h-96">
        <!-- Slide 1 -->
        <div class="hidden duration-700 ease-in-out" data-carousel-item>
            <img src="/img/carousel1.jpg" class="absolute block w-full filter brightness-50" alt="Slide 1">
            <div class="absolute inset-0 flex flex-col justify-center items-center bg-black/50 text-white">
                <h2 class="text-2xl md:text-4xl font-bold">Selamat Datang di EcoConnect</h2>
                <p class="text-sm md:text-lg mt-2 max-w-md text-center">
                    Bersama kita wujudkan lingkungan yang lebih hijau dan bersih untuk generasi mendatang.
                </p>
            </div>
        </div>
        <!-- Slide 2 -->
        <div class="hidden duration-700 ease-in-out" data-carousel-item>
            <img src="https://mdbcdn.b-cdn.net/img/new/slides/041.webp"
                class="absolute block w-full filter brightness-50" alt="Slide 2">
            <div class="absolute inset-0 flex flex-col justify-center items-center bg-black/50 text-white">
                <h2 class="text-2xl md:text-4xl font-bold">Daur Ulang Mudah</h2>
                <p class="text-sm md:text-lg mt-2 max-w-md text-center">
                    Atur jadwal penjemputan sampah Anda hanya dalam beberapa klik melalui aplikasi kami.
                </p>
            </div>
        </div>
        <!-- Slide 3 -->
        <div class="hidden duration-700 ease-in-out" data-carousel-item>
            <img src="https://tecdn.b-cdn.net/img/Photos/Slides/img%20(22).jpg"
                class="absolute block w-full filter brightness-75" alt="Slide 3">
            <div class="absolute inset-0 flex flex-col justify-center items-center bg-black/50 text-white">
                <h2 class="text-2xl md:text-4xl font-bold">Dapatkan Reward</h2>
                <p class="text-sm md:text-lg mt-2 max-w-md text-center">
                    Kontribusi Anda akan mendapatkan poin reward yang bisa ditukarkan dengan berbagai hadiah menarik.
                </p>
            </div>
        </div>
    </div>

    <!-- Controls -->
    <button type="button"
        class="absolute top-0 left-0 z-30 flex items-center justify-center h-full px-4 cursor-pointer group focus:outline-none"
        data-carousel-prev>
        <span
            class="inline-flex items-center justify-center w-10 h-10 rounded-full bg-white/30 group-hover:bg-white/50">
            <svg aria-hidden="true" class="w-6 h-6 text-white group-hover:text-gray-800" fill="none"
                stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
            </svg>
            <span class="sr-only">Previous</span>
        </span>
    </button>
    <button type="button"
        class="absolute top-0 right-0 z-30 flex items-center justify-center h-full px-4 cursor-pointer group focus:outline-none"
        data-carousel-next>
        <span
            class="inline-flex items-center justify-center w-10 h-10 rounded-full bg-white/30 group-hover:bg-white/50">
            <svg aria-hidden="true" class="w-6 h-6 text-white group-hover:text-gray-800" fill="none"
                stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
            </svg>
            <span class="sr-only">Next</span>
        </span>
    </button>
</div>

<div class="container mx-auto py-4">
    <!-- Fitur Section -->
    <section id="fitur" class="py-16 bg-gray-100">
        <div class="container mx-auto text-center">
            <h2 class="text-3xl font-bold mb-10">Fitur Kami</h2>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-12">
                <div class="p-8 bg-white rounded-lg shadow-md">
                    <img src="/img/card1.png" alt="Jadwal Penjemputan" class="w-16 mx-auto mb-4">
                    <h3 class="text-xl font-bold text-green-600">Penjadwalan Penjemputan Sampah</h3>
                    <p class="mt-4 text-gray-600">Jadwalkan penjemputan sampah dengan mudah melalui platform kami.</p>
                </div>
                <div class="p-8 bg-white rounded-lg shadow-md">
                    <img src="/img/card2.png" alt="Daur Ulang" class="w-16 mx-auto mb-4">
                    <h3 class="text-xl font-bold text-green-600">Daur Ulang dan Kompos</h3>
                    <p class="mt-4 text-gray-600">Akses layanan daur ulang dan kompos yang terpercaya di daerah Anda.
                    </p>
                </div>
                <div class="p-8 bg-white rounded-lg shadow-md">
                    <img src="/img/card3.png" alt="Komunitas" class="w-16 mx-auto mb-4">
                    <h3 class="text-xl font-bold text-green-600">Keterlibatan Komunitas</h3>
                    <p class="mt-4 text-gray-600">Terhubung dengan komunitas Anda untuk berbagi tips hidup
                        berkelanjutan.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Testimoni Section -->
    <section id="testimoni" class="py-16">
        <div class="container mx-auto text-center">
            <h2 class="text-3xl font-bold mb-10">Apa Kata Pengguna Kami</h2>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-12">
                <div class="bg-white p-8 rounded-lg shadow-md">
                    <p class="italic text-gray-600">"EcoConnect telah sepenuhnya mengubah cara saya mengelola sampah di
                        rumah. Sangat direkomendasikan!"</p>
                    <h4 class="mt-4 font-bold text-green-600">- Sarah K.</h4>
                </div>
                <div class="bg-white p-8 rounded-lg shadow-md">
                    <p class="italic text-gray-600">"Saya suka fitur komunitas dan layanan daur ulang. Sangat praktis!"
                    </p>
                    <h4 class="mt-4 font-bold text-green-600">- James L.</h4>
                </div>
                <div class="bg-white p-8 rounded-lg shadow-md">
                    <p class="italic text-gray-600">"Platform luar biasa yang membuat hidup berkelanjutan menjadi lebih
                        mudah."</p>
                    <h4 class="mt-4 font-bold text-green-600">- Maria P.</h4>
                </div>
            </div>
        </div>
    </section>

    <!-- Top Stats -->
    <section class="py-8">
        <h2 class="text-3xl text-center font-bold mb-10">Statistik Kami</h2>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-4">
            <div class="bg-white shadow rounded p-4 text-center">
                <div class="flex justify-center items-center mb-4 text-green-500">
                    <svg class="w-8 h-8" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                    </svg>
                </div>
                <h3 class="text-gray-600 text-sm">Pengguna Aktif</h3>
                <p class="text-2xl font-bold">1,200+</p>
            </div>
            <div class="bg-white shadow rounded p-4 text-center">
                <div class="flex justify-center items-center mb-4 text-blue-500">
                    <svg class="w-8 h-8" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                    </svg>
                </div>
                <h3 class="text-gray-600 text-sm">Total Pickup</h3>
                <p class="text-2xl font-bold">10,000+</p>
            </div>
            <div class="bg-white shadow rounded p-4 text-center">
                <div class="flex justify-center items-center mb-4 text-yellow-500">
                    <svg class="w-8 h-8" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                    </svg>
                </div>
                <h3 class="text-gray-600 text-sm">Kepuasan Pelanggan</h3>
                <p class="text-2xl font-bold">98%</p>
            </div>
        </div>
    </section>


    <!-- Main Feature -->
    <div class="bg-white shadow p-6 rounded text-center mb-4">
        <h1 class="text-green-600 text-3xl font-bold mb-3">EcoConnect</h1>
        <h2 class="text-gray-800 text-2xl font-bold mb-3">Mulai Perjalanan Hijau Anda</h2>
        <p class="text-gray-700 mb-4 mx-auto max-w-xl">
            Bergabunglah dengan komunitas peduli lingkungan dan mulai kontribusi untuk bumi yang lebih bersih
        </p>
        <a href="/register" class="bg-green-500 text-white px-6 py-3 rounded-lg hover:bg-green-600">
            Daftar Sekarang
        </a>
    </div>

    <!-- Features Grid -->
    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
        <div class="bg-white shadow rounded p-4 flex items-center">
            <div class="bg-blue-100 p-3 rounded-full text-blue-500 mr-4">
                <svg class="w-6 h-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
            </div>
            <div>
                <h3 class="text-gray-800 font-semibold">Penjadwalan Mudah</h3>
                <p class="text-gray-600 text-sm">Atur jadwal pickup sampah sesuai kebutuhan Anda</p>
            </div>
        </div>
        <div class="bg-white shadow rounded p-4 flex items-center">
            <div class="bg-green-100 p-3 rounded-full text-green-500 mr-4">
                <svg class="w-6 h-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
            </div>
            <div>
                <h3 class="text-gray-800 font-semibold">Sistem Poin Rewards</h3>
                <p class="text-gray-600 text-sm">Dapatkan rewards dari setiap kontribusi Anda</p>
            </div>
        </div>
    </div>

    <!-- Bottom Stats -->
    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 my-16">
        <div class="bg-white shadow rounded p-4">
            <h3 class="text-gray-800 font-semibold mb-4">Jenis Sampah Yang Kami Kelola</h3>
            <div>
                <div class="flex justify-between items-center mb-3">
                    <span class="text-gray-600">Organik</span>
                    <span class="text-green-500 font-medium">40%</span>
                </div>
                <div class="flex justify-between items-center mb-3">
                    <span class="text-gray-600">Plastik</span>
                    <span class="text-green-500 font-medium">35%</span>
                </div>
                <div class="flex justify-between items-center">
                    <span class="text-gray-600">Kertas</span>
                    <span class="text-green-500 font-medium">25%</span>
                </div>
            </div>
        </div>
        <div class="bg-white shadow rounded p-4">
            <h3 class="text-gray-800 font-semibold mb-4">Statistik Platform</h3>
            <div>
                <div class="flex justify-between items-center mb-3">
                    <span class="text-gray-600">Total Penggunaan</span>
                    <span class="text-blue-500 font-medium">15,000+ Jam</span>
                </div>
                <div class="flex justify-between items-center mb-3">
                    <span class="text-gray-600">Pengguna Aktif Harian</span>
                    <span class="text-blue-500 font-medium">1,200+</span>
                </div>
                <div class="flex justify-between items-center">
                    <span class="text-gray-600">Rating Aplikasi</span>
                    <span class="text-blue-500 font-medium">4.8/5.0</span>
                </div>
            </div>
        </div>
    </div>

    <!-- FAQ Section -->
    <section id="faq" class="py-16 bg-gray-100">
        <div class="container mx-auto">
            <h2 class="text-3xl font-bold text-center mb-10">Pertanyaan yang Sering Diajukan</h2>
            <div class="space-y-8">
                <div class="bg-white p-6 rounded-lg shadow-md">
                    <h3 class="text-lg font-bold text-green-600">Bagaimana cara menjadwalkan penjemputan sampah?</h3>
                    <p class="mt-2 text-gray-600">Cukup daftar akun, masuk, dan gunakan fitur penjadwalan untuk memilih
                        tanggal dan waktu penjemputan.</p>
                </div>
                <div class="bg-white p-6 rounded-lg shadow-md">
                    <h3 class="text-lg font-bold text-green-600">Apakah EcoConnect tersedia di daerah saya?</h3>
                    <p class="mt-2 text-gray-600">Kami terus memperluas jangkauan. Periksa daerah Anda dengan memasukkan
                        lokasi saat mendaftar.</p>
                </div>
                <div class="bg-white p-6 rounded-lg shadow-md">
                    <h3 class="text-lg font-bold text-green-600">Bisakah saya bergabung sebagai penyedia layanan
                        pengelolaan sampah?</h3>
                    <p class="mt-2 text-gray-600">Ya, penyedia layanan dapat mendaftar dan bermitra dengan kami untuk
                        menawarkan layanan mereka melalui EcoConnect.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Kontak Section -->
    <section id="kontak" class="py-16">
        <div class="container mx-auto text-center">
            <h2 class="text-3xl font-bold mb-6">Hubungi Kami</h2>
            <p class="mb-8 text-gray-600">Punya pertanyaan? Hubungi kami, dan kami akan segera menghubungi Anda.</p>
            <a href="mailto:support@ecoconnect.com" class="text-blue-500 underline">support@ecoconnect.com</a>
        </div>
    </section>
</div>
@endsection