<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="icon" type="image/x-icon" href="/img/logo2-putih.png">
    @vite(['resources/css/app.css','resources/js/app.js'])

    {{-- Chart Apex --}}
    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>

    {{-- animate css --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />
</head>

<body class="bg-gray-100">
    <header>
        {{-- navbar --}}
        <nav class="fixed top-0 z-50 w-full bg-white border-b border-gray-200 dark:bg-gray-800 dark:border-gray-700">
            <div class="px-3 py-3 lg:px-5 lg:pl-3">
                <div class="flex items-center justify-between">
                    <div class="flex items-center justify-start rtl:justify-end">
                        <button data-drawer-target="logo-sidebar" data-drawer-toggle="logo-sidebar"
                            aria-controls="logo-sidebar" type="button"
                            class="inline-flex items-center p-2 text-sm text-gray-500 rounded-lg sm:hidden hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200 dark:text-gray-400 dark:hover:bg-gray-700 dark:focus:ring-gray-600">
                            <span class="sr-only">Open sidebar</span>
                            <svg class="w-6 h-6" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20"
                                xmlns="http://www.w3.org/2000/svg">
                                <path clip-rule="evenodd" fill-rule="evenodd"
                                    d="M2 4.75A.75.75 0 012.75 4h14.5a.75.75 0 010 1.5H2.75A.75.75 0 012 4.75zm0 10.5a.75.75 0 01.75-.75h7.5a.75.75 0 010 1.5h-7.5a.75.75 0 01-.75-.75zM2 10a.75.75 0 01.75-.75h14.5a.75.75 0 010 1.5H2.75A.75.75 0 012 10z">
                                </path>
                            </svg>
                        </button>
                        <a href="https://flowbite.com" class="flex ms-2 md:me-24">
                            <img src="/img/logo2.png" class="h-8 me-3" alt="FlowBite Logo" />
                            <span
                                class="self-center text-[#38FF4F] text-xl font-semibold sm:text-2xl whitespace-nowrap dark:text-white">EcoConnect</span>
                        </a>
                    </div>
                    <div class="flex items-center">
                        <div class="flex items-center ms-3">
                            <div class="flex">
                                <button type="button" class="flex items-center gap-4 text-sm" aria-expanded="false"
                                    data-dropdown-toggle="dropdown-user">
                                    <span class="sr-only">Open user menu</span>
                                    <img class="w-8 h-8 rounded-full"
                                        src="https://flowbite.com/docs/images/people/profile-picture-5.jpg"
                                        alt="user photo">
                                    <span>{{ auth()->user()->name }} | {{ auth()->user()->role }}</span>
                                </button>
                            </div>
                            <div class="z-50 hidden my-4 text-base list-none bg-white divide-y divide-gray-100 rounded shadow dark:bg-gray-700 dark:divide-gray-600"
                                id="dropdown-user">
                                <div class="px-4 py-3" role="none">
                                    <p class="text-sm text-gray-900 dark:text-white" role="none">
                                        {{ auth()->user()->name }}
                                    </p>
                                    <p class="text-sm font-medium text-gray-900 truncate dark:text-gray-300"
                                        role="none">
                                        {{ auth()->user()->email }}
                                    </p>
                                </div>
                                <ul class="py-1" role="none">
                                    <li>
                                        <a href="{{ route('admin.dashboard') }}"
                                            class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:text-gray-300 dark:hover:bg-gray-600 dark:hover:text-white"
                                            role="menuitem">Dashboard</a>
                                    </li>
                                    <li>
                                        <a href="{{ route('admin.profile.show') }}"
                                            class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:text-gray-300 dark:hover:bg-gray-600 dark:hover:text-white"
                                            role="menuitem">Settings</a>
                                    </li>
                                    <li>
                                        <a href="#"
                                            class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:text-gray-300 dark:hover:bg-gray-600 dark:hover:text-white"
                                            role="menuitem">Earnings</a>
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
                </div>
            </div>
        </nav>

        {{-- sidebar --}}
        <aside id="logo-sidebar"
            class="fixed top-0 left-0 z-40 w-64 h-screen pt-20 transition-transform -translate-x-full bg-white border-r border-gray-200 sm:translate-x-0 dark:bg-gray-800 dark:border-gray-700"
            aria-label="Sidebar">
            <div class="h-full px-3 pb-4 overflow-y-auto bg-white dark:bg-gray-800">
                <ul class="space-y-2 font-medium">
                    <li>
                        <a href="{{ route('admin.dashboard') }}"
                            class="flex items-center p-2 rounded-lg hover:bg-[#21c434] hover:text-white dark:hover:bg-gray-700 group {{ request()->routeIs('admin.dashboard') ? 'bg-[#21c434] text-white' : 'text-gray-900 dark:text-white' }}">
                            <svg class="w-5 h-5 transition duration-75 {{ request()->routeIs('admin.dashboard') ? 'text-white' : 'text-gray-500' }} dark:text-gray-400 group-hover:text-white dark:group-hover:text-white"
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
                        <a href="{{ route('users.index') }}"
                            class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-[#21c434] hover:text-white dark:hover:bg-gray-700 group {{ request()->routeIs('users.index') ? 'bg-[#21c434] text-white' : 'text-gray-900 dark:text-white' }}">
                            <svg class="flex-shrink-0 w-5 h-5 text-gray-500 transition duration-75 {{ request()->routeIs('users.index') ? 'text-white' : 'text-gray-500' }} dark:text-gray-400 group-hover:text-white dark:group-hover:text-white"
                                aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                                viewBox="0 0 20 18">
                                <path
                                    d="M14 2a3.963 3.963 0 0 0-1.4.267 6.439 6.439 0 0 1-1.331 6.638A4 4 0 1 0 14 2Zm1 9h-1.264A6.957 6.957 0 0 1 15 15v2a2.97 2.97 0 0 1-.184 1H19a1 1 0 0 0 1-1v-1a5.006 5.006 0 0 0-5-5ZM6.5 9a4.5 4.5 0 1 0 0-9 4.5 4.5 0 0 0 0 9ZM8 10H5a5.006 5.006 0 0 0-5 5v2a1 1 0 0 0 1 1h11a1 1 0 0 0 1-1v-2a5.006 5.006 0 0 0-5-5Z" />
                            </svg>
                            <span class="flex-1 ms-3 whitespace-nowrap">Pengguna</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('wastes.index') }}"
                            class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-[#21c434] hover:text-white dark:hover:bg-gray-700 group {{ request()->routeIs('wastes.index') ? 'bg-[#21c434] text-white' : 'text-gray-900 dark:text-white' }}">
                            <svg class="flex-shrink-0 w-5 h-5 text-gray-500 transition duration-75 {{ request()->routeIs('wastes.index') ? 'text-white' : 'text-gray-500' }} dark:text-gray-400 group-hover:text-white dark:group-hover:text-white"
                                aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                fill="currentColor" viewBox="0 0 24 24">
                                <path fill-rule="evenodd"
                                    d="M9.166 19.986A.915.915 0 0 1 9 20H5a1 1 0 1 1 0-2h4c.057 0 .112.005.166.014a3.001 3.001 0 0 1 5.668 0A.915.915 0 0 1 15 18h4a1 1 0 1 1 0 2h-4c-.056 0-.112-.005-.166-.014a3.001 3.001 0 0 1-5.668 0ZM11 19a1 1 0 1 1 2 0 1 1 0 0 1-2 0Z"
                                    clip-rule="evenodd" />
                                <path
                                    d="M11.5 2.131a1 1 0 0 1 1 0l4.601 2.657c-.06.018-.12.044-.179.075L12.08 7.475 6.946 4.76 11.5 2.131ZM5.967 6.505v5.21a1 1 0 0 0 .5.866l4.57 2.638V9.186l-5.07-2.681Zm7.07 8.671 4.496-2.595a1 1 0 0 0 .5-.866v-5.2a1 1 0 0 1-.161.108l-4.835 2.608v5.945Z" />
                            </svg>

                            <span class="flex-1 ms-3 whitespace-nowrap">Limbah</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('schedules.index') }}"
                            class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-[#21c434] hover:text-white dark:hover:bg-gray-700 group {{ request()->routeIs('schedules.index') ? 'bg-[#21c434] text-white' : 'text-gray-900 dark:text-white' }}">
                            <svg class="flex-shrink-0 w-5 h-5 text-gray-500 transition duration-75 {{ request()->routeIs('schedules.index') ? 'text-white' : 'text-gray-500' }} dark:text-gray-400 group-hover:text-white dark:group-hover:text-white"
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
                        <a href="{{ route('vehicles.index') }}"
                            class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-[#21c434] hover:text-white dark:hover:bg-gray-700 group {{ request()->routeIs('vehicles.index') ? 'bg-[#21c434] text-white' : 'text-gray-900 dark:text-white' }}">
                            <svg class="flex-shrink-0 w-5 h-5 text-gray-500 transition duration-75 {{ request()->routeIs('vehicles.index') ? 'text-white' : 'text-gray-500' }} dark:text-gray-400 group-hover:text-white dark:group-hover:text-white"
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
                        <a href="{{ route('transactions.index') }}"
                            class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-[#21c434] hover:text-white dark:hover:bg-gray-700 group {{ request()->routeIs('transactions.index') ? 'bg-[#21c434] text-white' : 'text-gray-900 dark:text-white' }}">
                            <svg class="flex-shrink-0 w-5 h-5 text-gray-500 transition duration-75 {{ request()->routeIs('transactions.index') ? 'text-white' : 'text-gray-500' }} dark:text-gray-400 group-hover:text-white dark:group-hover:text-white"
                                aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                                viewBox="0 0 20 20">
                                <path d="M5 5V.13a2.96 2.96 0 0 0-1.293.749L.879 3.707A2.96 2.96 0 0 0 .13 5H5Z" />
                                <path
                                    d="M6.737 11.061a2.961 2.961 0 0 1 .81-1.515l6.117-6.116A4.839 4.839 0 0 1 16 2.141V2a1.97 1.97 0 0 0-1.933-2H7v5a2 2 0 0 1-2 2H0v11a1.969 1.969 0 0 0 1.933 2h12.134A1.97 1.97 0 0 0 16 18v-3.093l-1.546 1.546c-.413.413-.94.695-1.513.81l-3.4.679a2.947 2.947 0 0 1-1.85-.227 2.96 2.96 0 0 1-1.635-3.257l.681-3.397Z" />
                                <path
                                    d="M8.961 16a.93.93 0 0 0 .189-.019l3.4-.679a.961.961 0 0 0 .49-.263l6.118-6.117a2.884 2.884 0 0 0-4.079-4.078l-6.117 6.117a.96.96 0 0 0-.263.491l-.679 3.4A.961.961 0 0 0 8.961 16Zm7.477-9.8a.958.958 0 0 1 .68-.281.961.961 0 0 1 .682 1.644l-.315.315-1.36-1.36.313-.318Zm-5.911 5.911 4.236-4.236 1.359 1.359-4.236 4.237-1.7.339.341-1.699Z" />
                            </svg>
                            <span class="flex-1 ms-3 whitespace-nowrap">Transaksi</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('feedback.index') }}"
                            class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-[#21c434] hover:text-white dark:hover:bg-gray-700 group {{ request()->routeIs('feedback.index') ? 'bg-[#21c434] text-white' : 'text-gray-900 dark:text-white' }}">
                            <svg class="flex-shrink-0 w-5 h-5 text-gray-500 transition duration-75 {{ request()->routeIs('feedback.index') ? 'text-white' : 'text-gray-500' }} dark:text-gray-400 group-hover:text-white dark:group-hover:text-white"
                                aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                fill="currentColor" viewBox="0 0 24 24">
                                <path
                                    d="M13.849 4.22c-.684-1.626-3.014-1.626-3.698 0L8.397 8.387l-4.552.361c-1.775.14-2.495 2.331-1.142 3.477l3.468 2.937-1.06 4.392c-.413 1.713 1.472 3.067 2.992 2.149L12 19.35l3.897 2.354c1.52.918 3.405-.436 2.992-2.15l-1.06-4.39 3.468-2.938c1.353-1.146.633-3.336-1.142-3.477l-4.552-.36-1.754-4.17Z" />
                            </svg>
                            <span class="flex-1 ms-3 whitespace-nowrap">Feedback</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('regions.index') }}"
                            class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-[#21c434] hover:text-white dark:hover:bg-gray-700 group {{ request()->routeIs('regions.index') ? 'bg-[#21c434] text-white' : 'text-gray-900 dark:text-white' }}">
                            <svg class="flex-shrink-0 w-5 h-5 text-gray-500 transition duration-75 {{ request()->routeIs('regions.index') ? 'text-white' : 'text-gray-500' }} dark:text-gray-400 group-hover:text-white dark:group-hover:text-white"
                                aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                fill="currentColor" viewBox="0 0 24 24">
                                <path fill-rule="evenodd"
                                    d="M4 4a1 1 0 0 1 1-1h14a1 1 0 1 1 0 2v14a1 1 0 1 1 0 2H5a1 1 0 1 1 0-2V5a1 1 0 0 1-1-1Zm5 2a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1h1a1 1 0 0 0 1-1V7a1 1 0 0 0-1-1H9Zm5 0a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1h1a1 1 0 0 0 1-1V7a1 1 0 0 0-1-1h-1Zm-5 4a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1h1a1 1 0 0 0 1-1v-1a1 1 0 0 0-1-1H9Zm5 0a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1h1a1 1 0 0 0 1-1v-1a1 1 0 0 0-1-1h-1Zm-3 4a2 2 0 0 0-2 2v3h2v-3h2v3h2v-3a2 2 0 0 0-2-2h-2Z"
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
    </header>
    <main>
        <div class="p-4 sm:ml-64">
            <div class="mt-14">
                @yield('content')
            </div>
        </div>
    </main>
    <footer></footer>
</body>

</html>