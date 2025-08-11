<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - Sistem Service Elektronik</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/flowbite/1.6.5/flowbite.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <style>
        body {
            font-family: 'Inter', sans-serif;
        }
    </style>
    @yield('css')
</head>

<body class="bg-gray-50 text-gray-800">
    <div class="flex h-screen overflow-hidden antialiased">
        <aside
            class="w-64 bg-white text-gray-800 border-r border-gray-200 shadow-lg flex flex-col p-4 transition-all duration-300 ease-in-out">
            <div class="text-center py-6 mb-8 border-b border-gray-200">
                <h1 class="text-3xl font-extrabold text-blue-700 tracking-tight">@yield('nav')</h1>
            </div>
            <nav class="flex-1 overflow-y-auto">
                <ul class="space-y-1">
                    @auth
                        @if (Auth::user()->role == 'admin')
                            <li>
                                <a href="{{ route('admin.admin.index') }}"
                                    class="flex items-center px-4 py-3 rounded-lg transition-colors duration-200 {{ request()->is('admin/dashboard') ? 'bg-blue-50 text-blue-700 font-semibold shadow-sm' : 'hover:bg-gray-100 text-gray-700' }}">
                                    <svg class="w-5 h-5 mr-3" fill="currentColor" viewBox="0 0 20 20"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path
                                            d="M10.707 2.293a1 1 0 00-1.414 0l-7 7a1 1 0 001.414 1.414L4 10.414V17a1 1 0 001 1h2a1 1 0 001-1v-2a1 1 0 011-1h2a1 1 0 011 1v2a1 1 0 001 1h2a1 1 0 001-1v-6.586l.293.293a1 1 0 001.414-1.414l-7-7z">
                                        </path>
                                    </svg>
                                    Dashboard
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('admin.adminuser.index') }}"
                                    class="flex items-center px-4 py-3 rounded-lg transition-colors duration-200 {{ request()->is('admin/user*') ? 'bg-blue-50 text-blue-700 font-semibold shadow-sm' : 'hover:bg-gray-100 text-gray-700' }}">
                                    <svg class="w-5 h-5 mr-3" fill="currentColor" viewBox="0 0 20 20"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path
                                            d="M13 6a3 3 0 11-6 0 3 3 0 016 0zM18 8a2 2 0 11-4 0 2 2 0 014 0zM14 15a4 4 0 00-8 0v3h8v-3zM6 8a2 2 0 11-4 0 2 2 0 014 0zM16 18v-3a5.972 5.972 0 00-.75-2.906A3.499 3.499 0 0117 10c0-1.542-1.025-2.85-2.434-3.262a.991.991 0 00-.007-.008l-.002-.001A3.498 3.498 0 0115 5a3.5 3.5 0 10-7 0 3.498 3.498 0 01-.555 1.737c-.012.016-.022.029-.033.044A.984.984 0 005.82 8.718L5.795 8.74c.061-.005.123-.01.185-.015a3.49 3.49 0 01.378-.04c.002-.001.003-.001.005-.002A3.504 3.504 0 0110.5 4.5a3.5 3.5 0 100 7c.451 0 .885-.09 1.285-.245l.138.138A5.972 5.972 0 0016 15v3z">
                                        </path>
                                    </svg>
                                    Kelola User
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('admin.adminkelola_jasa.index') }}"
                                    class="flex items-center px-4 py-3 rounded-lg transition-colors duration-200 {{ request()->is('admin/kelola_jasa') ? 'bg-blue-50 text-blue-700 font-semibold shadow-sm' : 'hover:bg-gray-100 text-gray-700' }}">
                                    <svg class="w-5 h-5 mr-3" fill="currentColor" viewBox="0 0 20 20"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path
                                            d="M10 2a1 1 0 011 1v1a1 1 0 11-2 0V3a1 1 0 011-1zM4 5a1 1 0 10-2 0v1h2V5zM2 9v2h2V9H2zM4 13a1 1 0 10-2 0v1h2v-1zM2 17v2h2v-2H2zM8 17a1 1 0 10-2 0v1h2v-1zM6 13a1 1 0 10-2 0v2h2v-2zM6 9a1 1 0 10-2 0v2h2V9zM8 5a1 1 0 10-2 0v2h2V5zM12 5a1 1 0 10-2 0v2h2V5zM10 9a1 1 0 10-2 0v2h2V9zM12 13a1 1 0 10-2 0v2h2v-2zM10 17a1 1 0 10-2 0v1h2v-1zM14 17a1 1 0 10-2 0v1h2v-1zM14 13a1 1 0 10-2 0v2h2v-2zM14 9a1 1 0 10-2 0v2h2V9zM16 5a1 1 0 10-2 0v2h2V5zM18 5a1 1 0 10-2 0v1h2V5zM16 9v2h2V9h-2zM18 13a1 1 0 10-2 0v1h2v-1zM16 17a1 1 0 10-2 0v1h2v-1z">
                                        </path>
                                    </svg>
                                    Kelola Jasa
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('admin.report.index') }}"
                                    class="flex items-center px-4 py-3 rounded-lg transition-colors duration-200 {{ request()->is('admin/report*') ? 'bg-blue-50 text-blue-700 font-semibold shadow-sm' : 'hover:bg-gray-100 text-gray-700' }}">
                                    <svg class="w-5 h-5 mr-3" fill="currentColor" viewBox="0 0 20 20"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path fill-rule="evenodd"
                                            d="M2 5a2 2 0 012-2h12a2 2 0 012 2v10a2 2 0 01-2 2H4a2 2 0 01-2-2V5zm15 2h-4a1 1 0 00-1 1v2a1 1 0 001 1h4a1 1 0 001-1V8a1 1 0 00-1-1z"
                                            clip-rule="evenodd"></path>
                                        <path fill-rule="evenodd"
                                            d="M12 11H8a1 1 0 00-1 1v4a1 1 0 001 1h4a1 1 0 001-1v-4a1 1 0 00-1-1z"
                                            clip-rule="evenodd"></path>
                                    </svg>
                                    Laporan
                                </a>
                            </li>
                        @endif

                        @if (Auth::user()->role == 'teknisi')
                            <li>
                                <a href="{{ route('teknisi.incoming_orders') }}"
                                    class="flex items-center px-4 py-3 rounded-lg transition-colors duration-200 {{ request()->is('teknisi/incoming_orders') ? 'bg-blue-50 text-blue-700 font-semibold shadow-sm' : 'hover:bg-gray-100 text-gray-700' }}">
                                    <svg class="w-5 h-5 mr-3" fill="currentColor" viewBox="0 0 20 20"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path
                                            d="M10 2a1 1 0 011 1v1a1 1 0 11-2 0V3a1 1 0 011-1zM4.343 4.343a1 1 0 011.414 0l.707.707a1 1 0 01-1.414 1.414l-.707-.707a1 1 0 010-1.414zM16 10a1 1 0 11-2 0 1 1 0 012 0zm-3.536 6.464a1 1 0 010-1.414l.707-.707a1 1 0 011.414 1.414l-.707.707a1 1 0 01-1.414 0zM10 18a1 1 0 11-2 0 1 1 0 012 0zM3.536 15.536a1 1 0 011.414 0l.707.707a1 1 0 01-1.414 1.414l-.707-.707a1 1 0 010-1.414zM18 10a1 1 0 11-2 0 1 1 0 012 0zM12.464 4.464a1 1 0 011.414 0l.707.707a1 1 0 01-1.414 1.414l-.707-.707a1 1 0 010-1.414z">
                                        </path>
                                    </svg>
                                    Pesanan Masuk
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('teknisi.my_orders') }}"
                                    class="flex items-center px-4 py-3 rounded-lg transition-colors duration-200 {{ request()->is('teknisi/my_orders') ? 'bg-blue-50 text-blue-700 font-semibold shadow-sm' : 'hover:bg-gray-100 text-gray-700' }}">
                                    <svg class="w-5 h-5 mr-3" fill="currentColor" viewBox="0 0 20 20"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path
                                            d="M2 4a1 1 0 011-1h2a1 1 0 011 1v12a1 1 0 01-1 1H3a1 1 0 01-1-1V4zM8 4a1 1 0 011-1h2a1 1 0 011 1v12a1 1 0 01-1 1H9a1 1 0 01-1-1V4zM14 4a1 1 0 011-1h2a1 1 0 011 1v12a1 1 0 01-1 1h-2a1 1 0 01-1-1V4z">
                                        </path>
                                    </svg>
                                    Pesanan Saya
                                </a>
                            </li>
                        @endif

                        @can('costumer')
                            <li>
                                <a href="{{ route('costumer.make_an_order') }}"
                                    class="flex items-center px-4 py-3 rounded-lg transition-colors duration-200 {{ request()->is('costumer/make_an_order') ? 'bg-blue-50 text-blue-700 font-semibold shadow-sm' : 'hover:bg-gray-100 text-gray-700' }}">
                                    <svg class="w-5 h-5 mr-3" fill="currentColor" viewBox="0 0 20 20"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path
                                            d="M5 3a2 2 0 00-2 2v2a2 2 0 002 2h2a2 2 0 002-2V5a2 2 0 00-2-2H5zM5 11a2 2 0 00-2 2v2a2 2 0 002 2h2a2 2 0 002-2v-2a2 2 0 00-2-2H5zM13 3a2 2 0 00-2 2v2a2 2 0 002 2h2a2 2 0 002-2V5a2 2 0 00-2-2h-2zM13 11a2 2 0 00-2 2v2a2 2 0 002 2h2a2 2 0 002-2v-2a2 2 0 00-2-2h-2z">
                                        </path>
                                    </svg>
                                    Buat Pesanan
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('costumer.order_history') }}"
                                    class="flex items-center px-4 py-3 rounded-lg transition-colors duration-200 {{ request()->is('costumer/order_history') ? 'bg-blue-50 text-blue-700 font-semibold shadow-sm' : 'hover:bg-gray-100 text-gray-700' }}">
                                    <svg class="w-5 h-5 mr-3" fill="currentColor" viewBox="0 0 20 20"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path
                                            d="M2 4a1 1 0 011-1h2.586a1 1 0 01.707.293L10 6.586V15a2 2 0 01-2 2H4a2 2 0 01-2-2V4zM11 11h3a1 1 0 011 1v3a1 1 0 01-1 1h-3a1 1 0 01-1-1v-3a1 1 0 011-1z">
                                        </path>
                                        <path d="M12 4a1 1 0 011-1h2a1 1 0 011 1v1a1 1 0 01-1 1h-2a1 1 0 01-1-1V4z"></path>
                                    </svg>
                                    Riwayat Pesanan
                                </a>
                            </li>
                            @can('apply')
                                <li>
                                    <a href="{{ route('costumer.apply_as_teknisi') }}"
                                        class="flex items-center px-4 py-3 rounded-lg transition-colors duration-200 {{ request()->is('costumer/apply_as_teknisi') ? 'bg-blue-50 text-blue-700 font-semibold shadow-sm' : 'hover:bg-gray-100 text-gray-700' }}">
                                        <svg class="w-5 h-5 mr-3" fill="currentColor" viewBox="0 0 20 20"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <path
                                                d="M13 6a3 3 0 11-6 0 3 3 0 016 0zM18 8a2 2 0 11-4 0 2 2 0 014 0zM14 15a4 4 0 00-8 0v3h8v-3zM6 8a2 2 0 11-4 0 2 2 0 014 0zM16 18v-3a5.972 5.972 0 00-.75-2.906A3.499 3.499 0 0117 10c0-1.542-1.025-2.85-2.434-3.262a.991.991 0 00-.007-.008l-.002-.001A3.498 3.498 0 0115 5a3.5 3.5 0 10-7 0 3.498 3.498 0 01-.555 1.737c-.012.016-.022.029-.033.044A.984.984 0 005.82 8.718L5.795 8.74c.061-.005.123-.01.185-.015a3.49 3.49 0 01.378-.04c.002-.001.003-.001.005-.002A3.504 3.504 0 0110.5 4.5a3.5 3.5 0 100 7c.451 0 .885-.09 1.285-.245l.138.138A5.972 5.972 0 0016 15v3z">
                                            </path>
                                        </svg>
                                        Ajukan Jadi Teknisi
                                    </a>
                                </li>
                            @endcan
                        @endcan
                    @endauth
                </ul>
            </nav>
            <div class="mt-8 pt-4 border-t border-gray-200">
                <form action="{{ route('auth.logout') }}" method="POST">
                    @csrf
                    <button type="submit"
                        class="w-full text-left flex items-center px-4 py-3 rounded-lg hover:bg-red-50 text-red-600 transition-colors duration-200">
                        <svg class="w-5 h-5 mr-3" fill="currentColor" viewBox="0 0 20 20"
                            xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd"
                                d="M3 3a1 1 0 00-1 1v12a1 1 0 102 0V4a1 1 0 00-1-1zm10.707 3.293a1 1 0 00-1.414 1.414L14.586 10l-2.293 2.293a1 1 0 101.414 1.414L17.414 10l-3.707-3.707zM17 10a1 1 0 00-1 1v2a1 1 0 102 0v-2a1 1 0 00-1-1z"
                                clip-rule="evenodd"></path>
                        </svg>
                        Logout
                    </button>
                </form>
            </div>
        </aside>

        <main class="flex-1 flex flex-col overflow-hidden">
            <header
                class="bg-white text-gray-800 flex justify-between items-center px-6 py-4 shadow-lg border-b border-gray-200">
                <h2 class="text-2xl font-bold text-gray-900">@yield('title')</h2>
                <div class="flex items-center space-x-4">
                    <span class="text-gray-600 font-medium truncate max-w-[150px]">
                        {{ Auth::user()->name ?? 'Admin Account' }}
                    </span>
                    <img src="https://ui-avatars.com/api/?name={{ urlencode(Auth::user()->name ?? 'Admin') }}&background=E0E7FF&color=4338CA"
                        alt="User Avatar"
                        class="rounded-full w-10 h-10 object-cover border-2 border-blue-500 shadow-sm">
                </div>
            </header>

            <section class="p-8 overflow-auto flex-1 bg-gray-50">
                @yield('main')
            </section>
        </main>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/1.6.5/flowbite.min.js"></script>
    <script src="{{ asset('js/jquery-3.7.1.min.js') }}"></script>
    @yield('js')
</body>

</html>
