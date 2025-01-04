<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EcoConnect - Halaman Guest</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="font-sans bg-gray-100">

    <!-- Header -->
    <header class="bg-green-600 text-white p-6">
        <div class="container mx-auto flex justify-between items-center">
            <div class="text-2xl font-bold">EcoConnect</div>
            <nav class="space-x-6">
                <a href="#about" class="hover:text-green-300">Tentang Kami</a>
                <a href="#features" class="hover:text-green-300">Fitur</a>
                <a href="#signup" class="hover:text-green-300">Daftar</a>
                <a href="#contact" class="hover:text-green-300">Kontak</a>
            </nav>
        </div>
    </header>

    <!-- Section 1: Tentang EcoConnect -->
    <section id="about" class="bg-white py-16">
        <div class="container mx-auto text-center">
            <h2 class="text-3xl font-semibold text-gray-800 mb-4">Tentang EcoConnect</h2>
            <p class="text-lg text-gray-600 max-w-2xl mx-auto">
                EcoConnect adalah aplikasi yang menghubungkan masyarakat dengan penyedia jasa pengelolaan sampah seperti
                daur ulang, komposting, dan layanan pengelolaan sampah lainnya. Tujuan kami adalah untuk menciptakan
                lingkungan yang lebih bersih dan berkelanjutan dengan menyediakan solusi pengelolaan sampah yang mudah
                diakses.
            </p>
        </div>
    </section>

    <!-- Section 2: Fitur Utama -->
    <section id="features" class="bg-gray-50 py-16">
        <div class="container mx-auto text-center">
            <h2 class="text-3xl font-semibold text-gray-800 mb-8">Fitur Utama</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-12">
                <div class="bg-white p-6 rounded-lg shadow-lg">
                    <h3 class="text-xl font-semibold text-green-600 mb-4">Pengelolaan Sampah yang Mudah</h3>
                    <p class="text-gray-600">
                        Pengguna dapat mengatur jadwal pengambilan sampah dan memilih layanan pengelolaan yang sesuai
                        dengan kebutuhan.
                    </p>
                </div>
                <div class="bg-white p-6 rounded-lg shadow-lg">
                    <h3 class="text-xl font-semibold text-green-600 mb-4">Penyedia Layanan Terpercaya</h3>
                    <p class="text-gray-600">
                        Kami menghubungkan pengguna dengan penyedia jasa pengelolaan sampah yang terverifikasi dan dapat
                        diandalkan.
                    </p>
                </div>
                <div class="bg-white p-6 rounded-lg shadow-lg">
                    <h3 class="text-xl font-semibold text-green-600 mb-4">Sistem Feedback</h3>
                    <p class="text-gray-600">
                        Pengguna dapat memberikan ulasan dan feedback terhadap layanan yang diterima untuk meningkatkan
                        kualitas layanan.
                    </p>
                </div>
                <div class="bg-white p-6 rounded-lg shadow-lg">
                    <h3 class="text-xl font-semibold text-green-600 mb-4">Laporan dan Statistik</h3>
                    <p class="text-gray-600">
                        Menyediakan laporan tentang volume sampah yang telah dikelola dan statistik pengelolaan sampah
                        yang ramah lingkungan.
                    </p>
                </div>
                <div class="bg-white p-6 rounded-lg shadow-lg">
                    <h3 class="text-xl font-semibold text-green-600 mb-4">Notifikasi Pengingat</h3>
                    <p class="text-gray-600">
                        Pemberitahuan otomatis untuk jadwal pengambilan sampah atau pengingat penting lainnya.
                    </p>
                </div>
            </div>
        </div>
    </section>

    <!-- Section 3: Cara Bergabung -->
    <section id="signup" class="bg-white py-16">
        <div class="container mx-auto text-center">
            <h2 class="text-3xl font-semibold text-gray-800 mb-4">Cara Bergabung</h2>
            <p class="text-lg text-gray-600 max-w-2xl mx-auto mb-8">
                Daftar sekarang untuk mulai mengelola sampah Anda dengan cara yang lebih mudah dan ramah lingkungan.
                Cukup buat akun untuk mendapatkan akses ke semua fitur yang kami tawarkan.
            </p>
            <a href="#register"
                class="inline-block bg-green-600 text-white py-2 px-6 rounded-full hover:bg-green-700">Daftar
                Sekarang</a>
        </div>
    </section>

    <!-- Section 4: Testimoni Pengguna -->
    <section id="testimonials" class="bg-gray-50 py-16">
        <div class="container mx-auto text-center">
            <h2 class="text-3xl font-semibold text-gray-800 mb-8">Testimoni Pengguna</h2>
            <div class="flex justify-center space-x-6">
                <div class="bg-white p-6 rounded-lg shadow-lg w-80">
                    <p class="text-lg text-gray-600 mb-4">"Aplikasi ini sangat memudahkan saya dalam mengatur jadwal
                        pengambilan sampah. Sekarang saya tidak perlu khawatir lagi tentang sampah yang menumpuk."</p>
                    <p class="font-semibold text-green-600">Rika, Pengguna</p>
                </div>
                <div class="bg-white p-6 rounded-lg shadow-lg w-80">
                    <p class="text-lg text-gray-600 mb-4">"Layanan pengelolaan sampah yang tersedia sangat terpercaya.
                        Saya senang bisa membantu lingkungan melalui aplikasi ini!"</p>
                    <p class="font-semibold text-green-600">Andi, Pengguna</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-green-600 text-white py-6">
        <div class="container mx-auto text-center">
            <p>&copy; 2024 EcoConnect. Semua hak dilindungi.</p>
            <div class="space-x-6 mt-4">
                <a href="#privacy" class="hover:text-green-300">Kebijakan Privasi</a>
                <a href="#terms" class="hover:text-green-300">Syarat dan Ketentuan</a>
                <a href="#contact" class="hover:text-green-300">Kontak</a>
            </div>
        </div>
    </footer>

</body>

</html>