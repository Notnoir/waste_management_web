<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="icon" type="image/x-icon" href="/img/logo2-putih.png">
    @vite(['resources/css/app.css','resources/js/app.js'])
</head>

<body>
    <header>
        {{-- sidebar --}}
        <button data-drawer-target="cta-button-sidebar" data-drawer-toggle="cta-button-sidebar"
            aria-controls="cta-button-sidebar" type="button"
            class="inline-flex items-center p-2 mt-2 ms-3 text-sm text-gray-500 rounded-lg sm:hidden hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200 dark:text-gray-400 dark:hover:bg-gray-700 dark:focus:ring-gray-600">
            <span class="sr-only">Open sidebar</span>
            <svg class="w-6 h-6" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20"
                xmlns="http://www.w3.org/2000/svg">
                <path clip-rule="evenodd" fill-rule="evenodd"
                    d="M2 4.75A.75.75 0 012.75 4h14.5a.75.75 0 010 1.5H2.75A.75.75 0 012 4.75zm0 10.5a.75.75 0 01.75-.75h7.5a.75.75 0 010 1.5h-7.5a.75.75 0 01-.75-.75zM2 10a.75.75 0 01.75-.75h14.5a.75.75 0 010 1.5H2.75A.75.75 0 012 10z">
                </path>
            </svg>
        </button>

        <aside id="cta-button-sidebar"
            class="fixed top-0 left-0 z-40 w-64 h-screen transition-transform -translate-x-full sm:translate-x-0"
            aria-label="Sidebar">
            <div class="h-full px-3 py-4 overflow-y-auto bg-[#21c434] dark:bg-gray-800">
                <a href="https://flowbite.com/" class="flex items-center ps-2.5 mb-10 border-b border-b-white pb-5">
                    <img src="/img/logo2-putih.png" class="h-9 me-3 sm:h-10" alt="Flowbite Logo" />
                    <span
                        class="self-center text-white text-2xl font-semibold whitespace-nowrap dark:text-white">EcoConnect</span>
                </a>
                <ul class="space-y-2 font-medium`x">
                    <li>
                        <a href="{{ route('dashboard.warga') }}"
                            class="flex items-center p-2 rounded-lg {{ request()->routeIs('dashboard.warga') ? 'bg-white text-gray-900' : 'text-white dark:text-white hover:bg-white hover:text-gray-900 dark:hover:bg-gray-700' }}">
                            <svg class="w-5 h-5 transition duration-75 {{ request()->routeIs('dashboard.warga') ? 'text-[#21c434]' : 'text-white dark:text-gray-400' }} group-hover:text-[#21c434]"
                                aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                                viewBox="0 0 22 21">
                                <path
                                    d="M16.975 11H10V4.025a1 1 0 0 0-1.066-.998 8.5 8.5 0 1 0 9.039 9.039.999.999 0 0 0-1-1.066h.002Z" />
                                <path
                                    d="M12.5 0c-.157 0-.311.01-.565.027A1 1 0 0 0 11 1.02V10h8.975a1 1 0 0 0 1-.935c.013-.188.028-.374.028-.565A8.51 8.51 0 0 0 12.5 0Z" />
                            </svg>
                            <span class="ms-3">Dashboard</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('warga.pickups.index') }}"
                            class="flex items-center p-2 rounded-lg {{ request()->routeIs('warga.pickups.index') ? 'bg-white text-gray-900' : 'text-white dark:text-white hover:bg-gray-200 dark:hover:bg-gray-700' }}">
                            <svg class="w-5 h-5 transition duration-75 {{ request()->routeIs('warga.pickups.index') ? 'text-[#21c434]' : 'text-white dark:text-gray-400' }} group-hover:text-[#21c434]"
                                aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none"
                                viewBox="0 0 24 24">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                    stroke-width="2"
                                    d="M13 7h6l2 4m-8-4v8m0-8V6a1 1 0 0 0-1-1H4a1 1 0 0 0-1 1v9h2m8 0H9m4 0h2m4 0h2v-4m0 0h-5m3.5 5.5a2.5 2.5 0 1 1-5 0 2.5 2.5 0 0 1 5 0Zm-10 0a2.5 2.5 0 1 1-5 0 2.5 2.5 0 0 1 5 0Z" />
                            </svg>
                            <span class="ms-3">Penjemputan</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('warga.transactions.index') }}"
                            class="flex items-center p-2 rounded-lg {{ request()->routeIs('warga.transactions.index') ? 'bg-white text-gray-900' : 'text-white dark:text-white hover:bg-white hover:text-gray-900 dark:hover:bg-gray-700' }}">
                            <svg class="w-5 h-5 transition duration-75 {{ request()->routeIs('warga.transactions.index') ? 'text-[#21c434]' : 'text-white dark:text-gray-400' }} group-hover:text-[#21c434]"
                                aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                fill="currentColor" viewBox="0 0 24 24">
                                <path fill-rule="evenodd"
                                    d="M5.617 2.076a1 1 0 0 1 1.09.217L8 3.586l1.293-1.293a1 1 0 0 1 1.414 0L12 3.586l1.293-1.293a1 1 0 0 1 1.414 0L16 3.586l1.293-1.293A1 1 0 0 1 19 3v18a1 1 0 0 1-1.707.707L16 20.414l-1.293 1.293a1 1 0 0 1-1.414 0L12 20.414l-1.293 1.293a1 1 0 0 1-1.414 0L8 20.414l-1.293 1.293A1 1 0 0 1 5 21V3a1 1 0 0 1 .617-.924ZM9 7a1 1 0 0 0 0 2h6a1 1 0 1 0 0-2H9Zm0 4a1 1 0 1 0 0 2h6a1 1 0 1 0 0-2H9Zm0 4a1 1 0 1 0 0 2h6a1 1 0 1 0 0-2H9Z"
                                    clip-rule="evenodd" />
                            </svg>

                            <span class="ms-3">Transaksi</span>
                        </a>
                    </li>
                    <li>
                        <a href="#"
                            class="flex items-center p-2 text-white hover:text-gray-900 rounded-lg dark:text-white hover:bg-gray-200 dark:hover:bg-gray-700 group">
                            <svg class="w-5 h-5 text-white transition group-hover:text-[#21c434] duration-75 dark:text-gray-400 dark:group-hover:text-white"
                                aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                fill="currentColor" viewBox="0 0 24 24">
                                <path
                                    d="M17.133 12.632v-1.8a5.407 5.407 0 0 0-4.154-5.262.955.955 0 0 0 .021-.106V3.1a1 1 0 0 0-2 0v2.364a.933.933 0 0 0 .021.106 5.406 5.406 0 0 0-4.154 5.262v1.8C6.867 15.018 5 15.614 5 16.807 5 17.4 5 18 5.538 18h12.924C19 18 19 17.4 19 16.807c0-1.193-1.867-1.789-1.867-4.175Zm-13.267-.8a1 1 0 0 1-1-1 9.424 9.424 0 0 1 2.517-6.391A1.001 1.001 0 1 1 6.854 5.8a7.43 7.43 0 0 0-1.988 5.037 1 1 0 0 1-1 .995Zm16.268 0a1 1 0 0 1-1-1A7.431 7.431 0 0 0 17.146 5.8a1 1 0 0 1 1.471-1.354 9.424 9.424 0 0 1 2.517 6.391 1 1 0 0 1-1 .995ZM8.823 19a3.453 3.453 0 0 0 6.354 0H8.823Z" />
                            </svg>

                            <span class="flex-1 ms-3 whitespace-nowrap">Notifikasi</span>
                            <span
                                class="inline-flex items-center justify-center w-3 h-3 p-3 ms-3 text-sm font-medium text-white bg-green-600 rounded-full dark:bg-blue-900 dark:text-blue-300">3</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('warga.feedback.index') }}"
                            class="flex items-center p-2 rounded-lg {{ request()->routeIs('warga.feedback.index') ? 'bg-white text-gray-900' : 'text-white dark:text-white hover:bg-white hover:text-gray-900 dark:hover:bg-gray-700' }}">
                            <svg class="w-5 h-5 transition duration-75 {{ request()->routeIs('warga.feedback.index') ? 'text-[#21c434]' : 'text-white dark:text-gray-400' }} group-hover:text-[#21c434]"
                                aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                fill="currentColor" viewBox="0 0 24 24">
                                <path
                                    d="M13.849 4.22c-.684-1.626-3.014-1.626-3.698 0L8.397 8.387l-4.552.361c-1.775.14-2.495 2.331-1.142 3.477l3.468 2.937-1.06 4.392c-.413 1.713 1.472 3.067 2.992 2.149L12 19.35l3.897 2.354c1.52.918 3.405-.436 2.992-2.15l-1.06-4.39 3.468-2.938c1.353-1.146.633-3.336-1.142-3.477l-4.552-.36-1.754-4.17Z" />
                            </svg>

                            <span class="flex-1 ms-3 whitespace-nowrap">Ulasan</span>
                        </a>
                    </li>
                    <li class="border-t py-3 mt-3">
                        <form action="{{ route('logout') }}" method="POST">
                            @csrf
                            <button
                                class="flex items-center w-full p-2 text-white hover:text-red-600 rounded-lg dark:text-white hover:bg-gray-200 dark:hover:bg-gray-700 group">

                                <svg class="w-5 h-5 text-white transition group-hover:text-red-600 duration-75 dark:text-gray-400 dark:group-hover:text-white"
                                    aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                    fill="none" viewBox="0 0 24 24">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                        stroke-width="2"
                                        d="M16 12H4m12 0-4 4m4-4-4-4m3-4h2a3 3 0 0 1 3 3v10a3 3 0 0 1-3 3h-2" />
                                </svg>

                                <span class="ms-3 whitespace-nowrap">Logout</span>
                            </button>
                        </form>

                    </li>
                </ul>
            </div>
        </aside>
    </header>
    <main>
        <div class="p-4 sm:ml-64">
            <div class="p-4 rounded-lg dark:border-gray-700  ">
                @yield('content')
            </div>
        </div>
    </main>

</body>

</html>