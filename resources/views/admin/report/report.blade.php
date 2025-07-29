{{-- resources/views/admin/laporan.blade.php --}}
@extends('layout.app')

@section('title', 'Laporan')

@section('main')
    <main class="flex-1 overflow-x-hidden overflow-y-auto bg-gray-100 p-6">
        <h2 class="text-2xl font-bold mb-6 text-gray-800">Ringkasan Laporan</h2>

        {{-- Summary Cards --}}
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
            <div class="bg-white p-6 rounded-lg shadow-md">
                <h3 class="text-xl font-semibold mb-2 text-gray-700">Total Pesanan Selesai</h3>
                <p class="text-4xl font-bold text-green-600">589</p>
                <p class="text-sm text-gray-500">Periode Tahun Ini</p>
            </div>
            <div class="bg-white p-6 rounded-lg shadow-md">
                <h3 class="text-xl font-semibold mb-2 text-gray-700">Total Pendapatan</h3>
                <p class="text-4xl font-bold text-blue-600">Rp 125.000.000</p>
                <p class="text-sm text-gray-500">Periode Tahun Ini</p>
            </div>
            <div class="bg-white p-6 rounded-lg shadow-md">
                <h3 class="text-xl font-semibold mb-2 text-gray-700">Teknisi Aktif</h3>
                <p class="text-4xl font-bold text-purple-600">12</p>
                <p class="text-sm text-gray-500">Saat Ini</p>
            </div>
        </div>

        {{-- Detailed Reports Section (Links) --}}
        <div class="bg-white p-6 rounded-lg shadow-md mb-8">
            <h3 class="text-xl font-semibold mb-4 text-gray-800">Laporan Detail</h3>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                {{-- Placeholder links for detailed reports --}}
                <a href="{{ route('admin.report.orders') }}" class="block p-4 bg-gray-50 hover:bg-gray-100 rounded-lg shadow-sm transition duration-200">
                    <h4 class="font-semibold text-lg text-gray-700">Laporan Pesanan</h4>
                    <p class="text-sm text-gray-500">Lihat detail pesanan berdasarkan status dan periode.</p>
                </a>
                <a href="{{ route('admin.report.revenue') }}" class="block p-4 bg-gray-50 hover:bg-gray-100 rounded-lg shadow-sm transition duration-200">
                    <h4 class="font-semibold text-lg text-gray-700">Laporan Pendapatan</h4>
                    <p class="text-sm text-gray-500">Analisis pendapatan berdasarkan waktu dan jenis jasa.</p>
                </a>
                <a href="{{ route('admin.report.technicians') }}" class="block p-4 bg-gray-50 hover:bg-gray-100 rounded-lg shadow-sm transition duration-200">
                    <h4 class="font-semibold text-lg text-gray-700">Laporan Performa Teknisi</h4>
                    <p class="text-sm text-gray-500">Pantau kinerja masing-masing teknisi.</p>
                </a>
                <a href="{{ route('admin.report.popular_services') }}" class="block p-4 bg-gray-50 hover:bg-gray-100 rounded-lg shadow-sm transition duration-200">
                    <h4 class="font-semibold text-lg text-gray-700">Laporan Jasa Terpopuler</h4>
                    <p class="text-sm text-gray-500">Identifikasi jasa yang paling banyak diminati.</p>
                </a>
            </div>
        </div>

        {{-- Example: Latest Orders Table --}}
        <div class="bg-white p-6 rounded-lg shadow-md">
            <h3 class="text-xl font-semibold mb-4 text-gray-800">10 Pesanan Terakhir</h3>
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">ID Pesanan</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Pelanggan</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Jenis Jasa</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tanggal</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        {{-- Example static data (replace with @foreach loop from controller) --}}
                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap">#005</td>
                            <td class="px-6 py-4 whitespace-nowrap">Budi Santoso</td>
                            <td class="px-6 py-4 whitespace-nowrap">Service Laptop</td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-yellow-100 text-yellow-800">Menunggu</span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">2025-07-28</td>
                        </tr>
                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap">#004</td>
                            <td class="px-6 py-4 whitespace-nowrap">Dewi Lestari</td>
                            <td class="px-6 py-4 whitespace-nowrap">Perbaikan AC</td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">Selesai</span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">2025-07-27</td>
                        </tr>
                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap">#003</td>
                            <td class="px-6 py-4 whitespace-nowrap">Fajar Putra</td>
                            <td class="px-6 py-4 whitespace-nowrap">Instalasi Jaringan</td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-blue-100 text-blue-800">Dalam Proses</span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">2025-07-26</td>
                        </tr>
                        {{-- @endforeach --}}
                    </tbody>
                </table>
            </div>
        </div>
    </main>
@endsection