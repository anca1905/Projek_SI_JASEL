<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - Sistem Service Elektronik</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdn.jsdelivr.net/npm/flowbite@3.1.2/dist/flowbite.min.css" rel="stylesheet" />
    @yield('css')
</head>

<body class="bg-gray-100 font-sans">
    <div class="flex h-screen overflow-hidden">
        <!-- Sidebar -->
        <aside class="w-64 bg-white text-gray-800 border-r flex flex-col p-4">
            <div class="text-center mb-8">
                <h1 class="text-2xl font-bold text-green-600">@yield('nav')</h1>
            </div>
            <nav class="flex-1">
                <ul class="space-y-2">
                    @auth
                        @if (Auth::user()->role == 'admin')
                            <li>
                                <a href="{{ route('admin.admin.index') }}"
                                    class="block px-4 py-2 rounded hover:bg-gray-200 {{ request()->is('admin/dashboard') ? 'bg-gray-200 font-semibold text-green-700' : '' }}">
                                    Dashboard
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('admin.adminuser.index') }}"
                                    class="block px-4 py-2 rounded hover:bg-gray-200 {{ request()->is('admin/user*') ? 'bg-gray-200 font-semibold text-green-700' : '' }}">
                                    Kelola User
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('admin.adminkelola_jasa.index') }}"
                                    class="block px-4 py-2 rounded hover:bg-gray-200 {{ request()->is('admin/kelola_jasa') ? 'bg-gray-200 font-semibold text-green-700' : '' }}">
                                    Kelola Jasa
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('admin.report.index') }}"
                                    class="block px-4 py-2 rounded hover:bg-gray-200 {{ request()->is('admin/report*') ? 'bg-gray-200 font-semibold text-green-700' : '' }}">
                                    Laporan
                                </a>
                            </li>
                        @endif

                        @if (Auth::user()->role == 'teknisi')
                            <li>
                                <a href="{{ route('teknisi.incoming_orders') }}"
                                    class="block px-4 py-2 rounded hover:bg-gray-200 {{ request()->is('teknisi/incoming_orders') ? 'bg-gray-200 font-semibold text-green-700' : '' }}">
                                    Pesanan Masuk
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('teknisi.my_orders') }}"
                                    class="block px-4 py-2 rounded hover:bg-gray-200 {{ request()->is('teknisi/my_orders') ? 'bg-gray-200 font-semibold text-green-700' : '' }}">
                                    Pesanan Saya
                                </a>
                            </li>
                        @endif

                        @can('costumer')
                            <li>
                                <a href="{{ route('costumer.make_an_order') }}"
                                    class="block px-4 py-2 rounded hover:bg-gray-200 {{ request()->is('costumer/make_an_order') ? 'bg-gray-200 font-semibold text-green-700' : '' }}">
                                    Buat Pesanan
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('costumer.order_history') }}"
                                    class="block px-4 py-2 rounded hover:bg-gray-200 {{ request()->is('costumer/order_history') ? 'bg-gray-200 font-semibold text-green-700' : '' }}">
                                    Riwayat Pesanan
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('costumer.apply_as_teknisi') }}"
                                    class="block px-4 py-2 rounded hover:bg-gray-200 {{ request()->is('costumer/apply_as_teknisi') ? 'bg-gray-200 font-semibold text-green-700' : '' }}">
                                    Ajukan Jadi Teknisi
                                </a>
                            </li>
                        @endcan

                        <li>
                            <form action="{{ route('auth.logout') }}" method="POST">
                                @csrf
                                <button type="submit"
                                    class="w-full text-left px-4 py-2 rounded hover:bg-red-100 text-red-600">
                                    Logout
                                </button>
                            </form>
                        </li>
                    @endauth
                </ul>
            </nav>
        </aside>

        <!-- Main content -->
        <main class="flex-1 flex flex-col overflow-hidden">
            <!-- Header/Navbar -->
            <header class="bg-green-600 text-white flex justify-between items-center px-6 py-4 shadow">
                <h2 class="text-xl font-semibold">@yield('title')</h2>
                <div class="flex items-center space-x-4">
                    <span class="text-white font-medium truncate max-w-[150px]">
                        {{ Auth::user()->name ?? 'Admin Account' }}
                    </span>
                    <img src="https://ui-avatars.com/api/?name={{ urlencode(Auth::user()->name ?? 'Admin') }}&background=ffffff&color=0D8ABC"
                        alt="User Avatar" class="rounded-full w-10 h-10 object-cover border border-white">
                </div>
            </header>

            <!-- Main Content -->
            <section class="p-6 overflow-auto flex-1 bg-gray-50">
                @yield('main')
            </section>
        </main>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/flowbite@3.1.2/dist/flowbite.min.js"></script>
    <script src="{{ asset('js/jquery-3.7.1.min.js') }}"></script>
    @yield('js')
</body>

</html>
