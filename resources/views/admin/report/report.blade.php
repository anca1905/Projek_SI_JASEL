{{-- resources/views/admin/laporan.blade.php --}}
@extends('layout.app')

@section('title', 'Laporan')
@section('nav', 'Admin Panel')

@section('main')
    <main class="flex-1 overflow-x-hidden overflow-y-auto bg-gray-50 p-6">
        <div class="space-y-8">
            <h2 class="text-2xl sm:text-3xl font-bold text-gray-800">Ringkasan Laporan</h2>

            {{-- Summary Cards with Icons and Enhanced Styling --}}
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4 lg:gap-6">
                <div class="bg-white p-6 rounded-xl shadow-lg border border-gray-200 flex items-center space-x-4">
                    <div class="p-3 bg-green-100 rounded-full text-green-600">
                        <i class="fas fa-clipboard-check fa-lg"></i>
                    </div>
                    <div>
                        <h3 class="text-md sm:text-lg font-semibold text-gray-700">Total Pesanan Selesai</h3>
                        <p class="text-3xl sm:text-4xl font-bold text-green-600">{{ $orderCount }}</p>
                        <p class="text-sm text-gray-500">Periode Tahun Ini</p>
                    </div>
                </div>

                <div class="bg-white p-6 rounded-xl shadow-lg border border-gray-200 flex items-center space-x-4">
                    <div class="p-3 bg-blue-100 rounded-full text-blue-600">
                        <i class="fas fa-wallet fa-lg"></i>
                    </div>
                    <div>
                        <h3 class="text-md sm:text-lg font-semibold text-gray-700">Total Pendapatan</h3>
                        <p class="text-3xl sm:text-4xl font-bold text-blue-600">
                            Rp{{ number_format(125000000, 0, ',', '.') }}</p>
                        <p class="text-sm text-gray-500">Periode Tahun Ini</p>
                    </div>
                </div>

                <div class="bg-white p-6 rounded-xl shadow-lg border border-gray-200 flex items-center space-x-4">
                    <div class="p-3 bg-purple-100 rounded-full text-purple-600">
                        <i class="fas fa-tools fa-lg"></i>
                    </div>
                    <div>
                        <h3 class="text-md sm:text-lg font-semibold text-gray-700">Teknisi Aktif</h3>
                        <p class="text-3xl sm:text-4xl font-bold text-purple-600">{{ $services }}</p>
                        <p class="text-sm text-gray-500">Saat Ini</p>
                    </div>
                </div>
            </div>

            <hr class="my-8">

            {{-- Detailed Reports Section (Links with Icons) --}}
            <div class="bg-white p-6 sm:p-8 rounded-xl shadow-lg border border-gray-200">
                <h3 class="text-xl sm:text-2xl font-bold text-gray-800 mb-6">Laporan Detail</h3>
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">
                    <a href="{{ route('admin.report.orders') }}"
                        class="p-4 sm:p-6 bg-gray-50 hover:bg-gray-100 rounded-lg shadow-sm transition-colors duration-200 flex flex-col md:flex-row items-center md:items-start text-center md:text-left space-y-4 md:space-y-0 md:space-x-4 group">
                        <div class="text-blue-500 group-hover:text-blue-700 transition-colors duration-200">
                            <i class="fas fa-file-invoice fa-2x"></i>
                        </div>
                        <div class="flex-1">
                            <h4 class="font-semibold text-md sm:text-lg text-gray-800">Laporan Pesanan</h4>
                            <p class="text-sm text-gray-500">Lihat detail pesanan berdasarkan status dan periode.</p>
                        </div>
                    </a>

                    <a href="{{ route('admin.report.revenue') }}"
                        class="p-4 sm:p-6 bg-gray-50 hover:bg-gray-100 rounded-lg shadow-sm transition-colors duration-200 flex flex-col md:flex-row items-center md:items-start text-center md:text-left space-y-4 md:space-y-0 md:space-x-4 group">
                        <div class="text-green-500 group-hover:text-green-700 transition-colors duration-200">
                            <i class="fas fa-chart-line fa-2x"></i>
                        </div>
                        <div class="flex-1">
                            <h4 class="font-semibold text-md sm:text-lg text-gray-800">Laporan Pendapatan</h4>
                            <p class="text-sm text-gray-500">Analisis pendapatan berdasarkan waktu dan jenis jasa.</p>
                        </div>
                    </a>

                    <a href="{{ route('admin.report.technicians') }}"
                        class="p-4 sm:p-6 bg-gray-50 hover:bg-gray-100 rounded-lg shadow-sm transition-colors duration-200 flex flex-col md:flex-row items-center md:items-start text-center md:text-left space-y-4 md:space-y-0 md:space-x-4 group">
                        <div class="text-purple-500 group-hover:text-purple-700 transition-colors duration-200">
                            <i class="fas fa-users-cog fa-2x"></i>
                        </div>
                        <div class="flex-1">
                            <h4 class="font-semibold text-md sm:text-lg text-gray-800">Laporan Performa Teknisi</h4>
                            <p class="text-sm text-gray-500">Pantau kinerja masing-masing teknisi.</p>
                        </div>
                    </a>

                    <a href="{{ route('admin.report.popular_services') }}"
                        class="p-4 sm:p-6 bg-gray-50 hover:bg-gray-100 rounded-lg shadow-sm transition-colors duration-200 flex flex-col md:flex-row items-center md:items-start text-center md:text-left space-y-4 md:space-y-0 md:space-x-4 group">
                        <div class="text-orange-500 group-hover:text-orange-700 transition-colors duration-200">
                            <i class="fas fa-fire fa-2x"></i>
                        </div>
                        <div class="flex-1">
                            <h4 class="font-semibold text-md sm:text-lg text-gray-800">Laporan Jasa Terpopuler</h4>
                            <p class="text-sm text-gray-500">Identifikasi jasa yang paling banyak diminati.</p>
                        </div>
                    </a>
                </div>
            </div>

            <hr class="my-8">

            {{-- Latest Orders Table --}}
            <div class="bg-white p-6 sm:p-8 rounded-xl shadow-lg border border-gray-200">
                <h3 class="text-xl sm:text-2xl font-bold text-gray-800 mb-6">10 Pesanan Terakhir</h3>
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th
                                    class="px-3 sm:px-6 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">
                                    ID Pesanan</th>
                                <th
                                    class="px-3 sm:px-6 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">
                                    Pelanggan</th>
                                <th
                                    class="px-3 sm:px-6 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">
                                    Jenis Jasa</th>
                                <th
                                    class="px-3 sm:px-6 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">
                                    Status</th>
                                <th
                                    class="px-3 sm:px-6 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">
                                    Tanggal</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            {{-- Example static data (replace with dynamic data from controller) --}}
                            <tr>
                                <td class="px-3 sm:px-6 py-4 whitespace-nowrap">#005</td>
                                <td class="px-3 sm:px-6 py-4 whitespace-nowrap font-medium text-gray-900">Budi Santoso</td>
                                <td class="px-3 sm:px-6 py-4 whitespace-nowrap text-sm text-gray-500">Service Laptop</td>
                                <td class="px-3 sm:px-6 py-4 whitespace-nowrap">
                                    <span
                                        class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-yellow-100 text-yellow-800">Menunggu</span>
                                </td>
                                <td class="px-3 sm:px-6 py-4 whitespace-nowrap text-sm text-gray-500">2025-07-28</td>
                            </tr>
                            <tr>
                                <td class="px-3 sm:px-6 py-4 whitespace-nowrap">#004</td>
                                <td class="px-3 sm:px-6 py-4 whitespace-nowrap font-medium text-gray-900">Dewi Lestari</td>
                                <td class="px-3 sm:px-6 py-4 whitespace-nowrap text-sm text-gray-500">Perbaikan AC</td>
                                <td class="px-3 sm:px-6 py-4 whitespace-nowrap">
                                    <span
                                        class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">Selesai</span>
                                </td>
                                <td class="px-3 sm:px-6 py-4 whitespace-nowrap text-sm text-gray-500">2025-07-27</td>
                            </tr>
                            <tr>
                                <td class="px-3 sm:px-6 py-4 whitespace-nowrap">#003</td>
                                <td class="px-3 sm:px-6 py-4 whitespace-nowrap font-medium text-gray-900">Fajar Putra</td>
                                <td class="px-3 sm:px-6 py-4 whitespace-nowrap text-sm text-gray-500">Instalasi Jaringan
                                </td>
                                <td class="px-3 sm:px-6 py-4 whitespace-nowrap">
                                    <span
                                        class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-blue-100 text-blue-800">Dalam
                                        Proses</span>
                                </td>
                                <td class="px-3 sm:px-6 py-4 whitespace-nowrap text-sm text-gray-500">2025-07-26</td>
                            </tr>
                            {{-- @endforeach --}}
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </main>
@endsection

@section('js')
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
@endsection
