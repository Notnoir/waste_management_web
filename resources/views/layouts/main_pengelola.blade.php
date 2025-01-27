<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EcoConnect</title>
    <link rel="icon" type="image/x-icon" href="/img/logo2-putih.png">
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    {{-- Chart Apex --}}
    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>

    {{-- animate css --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />
</head>

<body class="bg-gray-100">
    <!-- Navbar -->
    <nav class="fixed top-0 left-0 z-50 w-full bg-white border-b border-gray-200 dark:bg-gray-800 dark:border-gray-700">
        <div class="px-4 py-3 flex items-center justify-between">
            <!-- Mobile menu button -->
            <button data-drawer-target="sidebar" data-drawer-toggle="sidebar" aria-controls="sidebar" type="button"
                class="inline-flex items-center p-2 text-sm text-gray-500 rounded-lg sm:hidden hover:bg-gray-100 focus:ring-2 focus:ring-gray-200 dark:text-gray-400 dark:hover:bg-gray-700 dark:focus:ring-gray-600">
                <svg class="w-6 h-6" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                    viewBox="0 0 20 20">
                    <path fill-rule="evenodd"
                        d="M3 5a1 1 0 0 1 1-1h12a1 1 0 1 1 0 2H4a1 1 0 0 1-1-1Zm0 5a1 1 0 0 1 1-1h12a1 1 0 1 1 0 2H4a1 1 0 0 1-1-1Zm0 5a1 1 0 0 1 1-1h12a1 1 0 1 1 0 2H4a1 1 0 0 1-1-1Z"
                        clip-rule="evenodd" />
                </svg>
            </button>
            <!-- Logo -->
            <div class="flex items-center">
                <img src="/img/logo2.png" alt="Logo" class="h-8 me-3">
                <span class="text-xl font-semibold text-[#38FF4F]">EcoConnect</span>
            </div>
            <!-- User menu -->
            <div class="relative">
                <button type="button" class="flex items-center gap-2 text-sm" id="user-menu-button"
                    aria-expanded="false" data-dropdown-toggle="dropdown">
                    <img class="w-8 h-8 rounded-full"
                        src="{{ auth()->user()->profile_picture ? asset('storage/' . auth()->user()->profile_picture) : 'https://via.placeholder.com/150' }}"
                        alt="User photo">
                    <span class="ms-2">{{ auth()->user()->name }} | {{ auth()->user()->role }}</span>
                </button>
                <!-- Dropdown -->
                <div id="dropdown"
                    class="hidden z-10 bg-white divide-y divide-gray-100 rounded-lg shadow w-44 dark:bg-gray-700 dark:divide-gray-600">
                    <div class="px-4 py-3 text-sm text-gray-900 dark:text-white">
                        <p class="font-medium">{{ auth()->user()->name }}</p>
                        <p class="truncate text-sm text-gray-500 dark:text-gray-400">{{ auth()->user()->email }}</p>
                    </div>
                    <ul class="py-1 text-sm text-gray-700 dark:text-gray-200">
                        <li><a href="{{ route('pengelola.index') }}"
                                class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600">Dashboard</a>
                        </li>
                        <li><a href="{{ route('pengelola.profile.show') }}"
                                class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600">Settings</a>
                        </li>
                        <li>
                            <form action="{{ route('logout') }}" method="POST">
                                @csrf
                                <button
                                    class="block px-4 w-full py-2 text-sm text-red-600 hover:bg-gray-100 dark:text-gray-300 dark:hover:bg-gray-600 dark:hover:text-white"
                                    type="submit"><span class="flex justify-start">Logout</span></button>
                            </form>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </nav>

    <!-- Sidebar -->
    <aside id="sidebar"
        class="fixed top-0 left-0 z-40 w-64 h-screen pt-16 bg-white border-r border-gray-200 dark:bg-gray-800 dark:border-gray-700 transition-transform -translate-x-full sm:translate-x-0">
        <div class="h-full px-3 py-4 overflow-y-auto">
            <ul class="space-y-2">
                <li>
                    <a href="{{ route('pengelola.index') }}"
                        class="flex items-center p-2 rounded-lg hover:bg-[#21c434] hover:text-white dark:hover:bg-gray-700 group {{ request()->routeIs('pengelola.index') ? 'bg-[#21c434] text-white' : 'text-gray-900 dark:text-white' }}">
                        <svg class="w-5 h-5 transition duration-75 {{ request()->routeIs('pengelola.index') ? 'text-white' : 'text-gray-500' }} dark:text-gray-400 group-hover:text-white dark:group-hover:text-white"
                            aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                            viewBox="0 0 22 21">
                            <path
                                d="M16.975 11H10V4.025a1 1 0 0 0-1.066-.998 8.5 8.5 0 1 0 9.039 9.039.999.999 0 0 0-1-1.066h.002Z" />
                            <path
                                d="M12.5 0c-.157 0-.311.01-.565.027A1 1 0 0 0 11 1.02V10h8.975a1 1 0 0 0 1-.935c.013-.188.028-.374.028-.565A8.51 8.51 0 0 0 12.5 0Z" />
                        </svg>
                        <span class="ms-3">Beranda</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('pengelola.schedules.index') }}"
                        class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-[#21c434] hover:text-white dark:hover:bg-gray-700 group {{ request()->routeIs('pengelola.schedules.index') ? 'bg-[#21c434] text-white' : 'text-gray-900 dark:text-white' }}">
                        <svg class="flex-shrink-0 w-5 h-5 text-gray-500 transition duration-75 {{ request()->routeIs('pengelola.schedules.index') ? 'text-white' : 'text-gray-500' }} dark:text-gray-400 group-hover:text-white dark:group-hover:text-white"
                            aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                            fill="currentColor" viewBox="0 0 24 24">
                            <path fill-rule="evenodd"
                                d="M5 5a1 1 0 0 0 1-1 1 1 0 1 1 2 0 1 1 0 0 0 1 1h1a1 1 0 0 0 1-1 1 1 0 1 1 2 0 1 1 0 0 0 1 1h1a1 1 0 0 0 1-1 1 1 0 1 1 2 0 1 1 0 0 0 1 1 2 2 0 0 1 2 2v1a1 1 0 0 1-1 1H4a1 1 0 0 1-1-1V7a2 2 0 0 1 2-2ZM3 19v-7a1 1 0 0 1 1-1h16a1 1 0 0 1 1 1v7a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2Zm6.01-6a1 1 0 1 0-2 0 1 1 0 0 0 2 0Zm2 0a1 1 0 1 1 2 0 1 1 0 0 1-2 0Zm6 0a1 1 0 1 0-2 0 1 1 0 0 0 2 0Zm-10 4a1 1 0 1 1 2 0 1 1 0 0 1-2 0Zm6 0a1 1 0 1 0-2 0 1 1 0 0 0 2 0Zm2 0a1 1 0 1 1 2 0 1 1 0 0 1-2 0Z"
                                clip-rule="evenodd" />
                        </svg>
                        <span class="flex-1 ms-3 whitespace-nowrap">Jadwal</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('pengelola.vehicles.index') }}"
                        class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-[#21c434] hover:text-white dark:hover:bg-gray-700 group {{ request()->routeIs('pengelola.vehicles.index') ? 'bg-[#21c434] text-white' : 'text-gray-900 dark:text-white' }}">
                        <svg class="flex-shrink-0 w-5 h-5 text-gray-500 transition duration-75 {{ request()->routeIs('pengelola.vehicles.index') ? 'text-white' : 'text-gray-500' }} dark:text-gray-400 group-hover:text-white dark:group-hover:text-white"
                            aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                            fill="currentColor" viewBox="0 0 24 24">
                            <path fill-rule="evenodd"
                                d="M4 4a2 2 0 0 0-2 2v9a1 1 0 0 0 1 1h.535a3.5 3.5 0 1 0 6.93 0h3.07a3.5 3.5 0 1 0 6.93 0H21a1 1 0 0 0 1-1v-4a.999.999 0 0 0-.106-.447l-2-4A1 1 0 0 0 19 6h-5a2 2 0 0 0-2-2H4Zm14.192 11.59.016.02a1.5 1.5 0 1 1-.016-.021Zm-10 0 .016.02a1.5 1.5 0 1 1-.016-.021Zm5.806-5.572v-2.02h4.396l1 2.02h-5.396Z"
                                clip-rule="evenodd" />
                        </svg>
                        <span class="flex-1 ms-3 whitespace-nowrap">Kendaraan</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('pengelola.assignments.index') }}"
                        class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-[#21c434] hover:text-white dark:hover:bg-gray-700 group {{ request()->routeIs('pengelola.assignments.index') ? 'bg-[#21c434] text-white' : 'text-gray-900 dark:text-white' }}">
                        <svg class="flex-shrink-0 w-5 h-5 text-gray-500 transition duration-75 {{ request()->routeIs('pengelola.assignments.index') ? 'text-white' : 'text-gray-500' }} dark:text-gray-400 group-hover:text-white dark:group-hover:text-white"
                            aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                            fill="currentColor" viewBox="0 0 24 24">
                            <path fill-rule="evenodd"
                                d="M4 4a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V6a2 2 0 0 0-2-2H4Zm10 5a1 1 0 0 1 1-1h3a1 1 0 1 1 0 2h-3a1 1 0 0 1-1-1Zm0 3a1 1 0 0 1 1-1h3a1 1 0 1 1 0 2h-3a1 1 0 0 1-1-1Zm0 3a1 1 0 0 1 1-1h3a1 1 0 1 1 0 2h-3a1 1 0 0 1-1-1Zm-8-5a3 3 0 1 1 6 0 3 3 0 0 1-6 0Zm1.942 4a3 3 0 0 0-2.847 2.051l-.044.133-.004.012c-.042.126-.055.167-.042.195.006.013.02.023.038.039.032.025.08.064.146.155A1 1 0 0 0 6 17h6a1 1 0 0 0 .811-.415.713.713 0 0 1 .146-.155c.019-.016.031-.026.038-.04.014-.027 0-.068-.042-.194l-.004-.012-.044-.133A3 3 0 0 0 10.059 14H7.942Z"
                                clip-rule="evenodd" />
                        </svg>
                        <span class="flex-1 ms-3 whitespace-nowrap">Penugasan</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('pengelola.feedback.index') }}"
                        class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-[#21c434] hover:text-white dark:hover:bg-gray-700 group {{ request()->routeIs('pengelola.feedback.index') ? 'bg-[#21c434] text-white' : 'text-gray-900 dark:text-white' }}">
                        <svg class="flex-shrink-0 w-5 h-5 text-gray-500 transition duration-75 {{ request()->routeIs('pengelola.feedback.index') ? 'text-white' : 'text-gray-500' }} dark:text-gray-400 group-hover:text-white dark:group-hover:text-white"
                            aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                            fill="currentColor" viewBox="0 0 24 24">
                            <path
                                d="M13.849 4.22c-.684-1.626-3.014-1.626-3.698 0L8.397 8.387l-4.552.361c-1.775.14-2.495 2.331-1.142 3.477l3.468 2.937-1.06 4.392c-.413 1.713 1.472 3.067 2.992 2.149L12 19.35l3.897 2.354c1.52.918 3.405-.436 2.992-2.15l-1.06-4.39 3.468-2.938c1.353-1.146.633-3.336-1.142-3.477l-4.552-.36-1.754-4.17Z" />
                        </svg>
                        <span class="flex-1 ms-3 whitespace-nowrap">Feedback</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('pengelola.dailyReport') }}"
                        class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-[#21c434] hover:text-white dark:hover:bg-gray-700 group {{ request()->routeIs('pengelola.dailyReport') ? 'bg-[#21c434] text-white' : 'text-gray-900 dark:text-white' }}">
                        <svg class="flex-shrink-0 w-5 h-5 text-gray-500 transition duration-75 {{ request()->routeIs('pengelola.dailyReport') ? 'text-white' : 'text-gray-500' }} dark:text-gray-400 group-hover:text-white dark:group-hover:text-white"
                            aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                            fill="currentColor" viewBox="0 0 24 24">
                            <path fill-rule="evenodd"
                                d="M8 3a1 1 0 0 1 1-1h6a1 1 0 0 1 1 1h2a2 2 0 0 1 2 2v15a2 2 0 0 1-2 2H6a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h2Zm6 1h-4v2H9a1 1 0 0 0 0 2h6a1 1 0 1 0 0-2h-1V4Zm-3 8a1 1 0 0 1 1-1h3a1 1 0 1 1 0 2h-3a1 1 0 0 1-1-1Zm-2-1a1 1 0 1 0 0 2h.01a1 1 0 1 0 0-2H9Zm2 5a1 1 0 0 1 1-1h3a1 1 0 1 1 0 2h-3a1 1 0 0 1-1-1Zm-2-1a1 1 0 1 0 0 2h.01a1 1 0 1 0 0-2H9Z"
                                clip-rule="evenodd" />
                        </svg>
                        <span class="flex-1 ms-3 whitespace-nowrap">Laporan Harian</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('pengelola.wastes.index') }}"
                        class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-[#21c434] hover:text-white dark:hover:bg-gray-700 group {{ request()->routeIs('pengelola.wastes.index') ? 'bg-[#21c434] text-white' : 'text-gray-900 dark:text-white' }}">
                        <svg class="flex-shrink-0 w-5 h-5 text-gray-500 transition duration-75 {{ request()->routeIs('pengelola.wastes.index') ? 'text-white' : 'text-gray-500' }} dark:text-gray-400 group-hover:text-white dark:group-hover:text-white"
                            aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                            fill="currentColor" viewBox="0 0 24 24">
                            <path fill-rule="evenodd"
                                d="M8.586 2.586A2 2 0 0 1 10 2h4a2 2 0 0 1 2 2v2h3a1 1 0 1 1 0 2v12a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V8a1 1 0 0 1 0-2h3V4a2 2 0 0 1 .586-1.414ZM10 6h4V4h-4v2Zm1 4a1 1 0 1 0-2 0v8a1 1 0 1 0 2 0v-8Zm4 0a1 1 0 1 0-2 0v8a1 1 0 1 0 2 0v-8Z"
                                clip-rule="evenodd" />
                        </svg>
                        <span class="flex-1 ms-3 whitespace-nowrap">Daftar Limbah</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('pengelola.regions.index') }}"
                        class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-[#21c434] hover:text-white dark:hover:bg-gray-700 group {{ request()->routeIs('pengelola.regions.index') ? 'bg-[#21c434] text-white' : 'text-gray-900 dark:text-white' }}">
                        <svg class="flex-shrink-0 w-5 h-5 text-gray-500 transition duration-75 {{ request()->routeIs('pengelola.regions.index') ? 'text-white' : 'text-gray-500' }} dark:text-gray-400 group-hover:text-white dark:group-hover:text-white"
                            aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                            fill="currentColor" viewBox="0 0 24 24">
                            <path fill-rule="evenodd"
                                d="M11.906 1.994a8.002 8.002 0 0 1 8.09 8.421 7.996 7.996 0 0 1-1.297 3.957.996.996 0 0 1-.133.204l-.108.129c-.178.243-.37.477-.573.699l-5.112 6.224a1 1 0 0 1-1.545 0L5.982 15.26l-.002-.002a18.146 18.146 0 0 1-.309-.38l-.133-.163a.999.999 0 0 1-.13-.202 7.995 7.995 0 0 1 6.498-12.518ZM15 9.997a3 3 0 1 1-5.999 0 3 3 0 0 1 5.999 0Z"
                                clip-rule="evenodd" />
                        </svg>

                        <span class="flex-1 ms-3 whitespace-nowrap">Wilayah</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('chats.index') }}"
                        class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-[#21c434] hover:text-white dark:hover:bg-gray-700 group {{ request()->routeIs('chats.index') ? 'bg-[#21c434] text-white' : 'text-gray-900 dark:text-white' }}">
                        <svg class="flex-shrink-0 w-5 h-5 text-gray-500 transition duration-75 {{ request()->routeIs('chats.index') ? 'text-white' : 'text-gray-500' }} dark:text-gray-400 group-hover:text-white dark:group-hover:text-white"
                            aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                            fill="currentColor" viewBox="0 0 24 24">
                            <path fill-rule="evenodd"
                                d="M4 3a1 1 0 0 0-1 1v8a1 1 0 0 0 1 1h1v2a1 1 0 0 0 1.707.707L9.414 13H15a1 1 0 0 0 1-1V4a1 1 0 0 0-1-1H4Z"
                                clip-rule="evenodd" />
                            <path fill-rule="evenodd"
                                d="M8.023 17.215c.033-.03.066-.062.098-.094L10.243 15H15a3 3 0 0 0 3-3V8h2a1 1 0 0 1 1 1v8a1 1 0 0 1-1 1h-1v2a1 1 0 0 1-1.707.707L14.586 18H9a1 1 0 0 1-.977-.785Z"
                                clip-rule="evenodd" />
                        </svg>

                        <span class="flex-1 ms-3 whitespace-nowrap">Obrolan</span>
                    </a>
                </li>
            </ul>
        </div>
    </aside>

    <!-- Main Content -->
    <div class="p-4 sm:ml-64">
        <div class="mt-14">
            @yield('content')
        </div>
    </div>
    <script>
        // auto close toast
        setTimeout(function() {
            var toastSuccess = document.getElementById('toast-success');
                toastSuccess.classList.add('animate__animated', 'animate__fadeOut');
                setTimeout(function() {
                    toastSuccess.style.display = 'none';
                }, 2000);
            }, 2000);
    </script>
</body>

</html>