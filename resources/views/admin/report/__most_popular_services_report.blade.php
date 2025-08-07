{{-- resources/views/admin/laporan_jasa_terpopuler.blade.php --}}
@extends('layout.app')

@section('title', 'Laporan Jasa Terpopuler')
@section('nav', 'Admin Panel')

@section('main')
    <div class="space-y-6">
        <div class="bg-white p-8 rounded-xl shadow-lg border border-gray-200">
            <h2 class="text-3xl font-bold mb-6 text-gray-800">Laporan Jasa Terpopuler</h2>

            {{-- Filter Form --}}
            <form action="{{ route('admin.report.popular_services') }}" method="GET"
                class="mb-8 p-6 rounded-lg border border-gray-200 bg-gray-50 flex flex-col md:flex-row gap-4 items-end">
                <div class="w-full md:w-1/2">
                    <label for="start_date" class="block text-sm font-medium text-gray-700 mb-1">Dari Tanggal</label>
                    <input type="date" name="start_date" id="start_date" value="{{ request('start_date') }}"
                        class="w-full block rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 transition duration-150 ease-in-out sm:text-sm">
                </div>
                <div class="w-full md:w-1/2">
                    <label for="end_date" class="block text-sm font-medium text-gray-700 mb-1">Sampai Tanggal</label>
                    <input type="date" name="end_date" id="end_date" value="{{ request('end_date') }}"
                        class="w-full block rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 transition duration-150 ease-in-out sm:text-sm">
                </div>
                <div class="flex-shrink-0 flex items-center space-x-2 w-full md:w-auto">
                    <button type="submit"
                        class="w-full md:w-auto inline-flex justify-center items-center px-4 py-2 border border-transparent rounded-lg shadow-sm text-sm font-medium text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-colors duration-200">
                        <i class="fas fa-filter mr-2"></i> Filter
                    </button>
                    @if (request()->hasAny(['start_date', 'end_date']))
                        <a href="{{ route('admin.report.popular_services') }}"
                            class="w-full md:w-auto inline-flex justify-center items-center px-4 py-2 border border-gray-300 rounded-lg shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-100 transition-colors duration-200">
                            Reset
                        </a>
                    @endif
                </div>
            </form>

            {{-- Export Button --}}
            <div class="mb-6 flex justify-end items-center space-x-4">
                <a href="{{ route('admin.report.popular_services', array_merge(request()->query(), ['export' => 'excel'])) }}"
                    class="inline-flex items-center px-4 py-2 border border-transparent rounded-lg shadow-sm text-sm font-medium text-white bg-green-600 hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500 transition-colors duration-200">
                    <i class="fas fa-file-excel mr-2"></i> Export ke Excel
                </a>
            </div>

            <div class="table-container">
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-6 py-4 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">No.</th>
                                <th class="px-6 py-4 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Nama Jasa</th>
                                <th class="px-6 py-4 text-right text-xs font-semibold text-gray-500 uppercase tracking-wider">Jumlah Pesanan</th>
                                <th class="px-6 py-4 text-right text-xs font-semibold text-gray-500 uppercase tracking-wider">Total Pendapatan dari Jasa</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            {{-- Contoh data statis. Ganti dengan @foreach loop dari controller --}}
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">1</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">Service Laptop</td>
                                <td class="px-6 py-4 whitespace-nowrap text-right text-sm text-gray-500">50</td>
                                <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium text-gray-900">Rp 7.500.000</td>
                            </tr>
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">2</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">Perbaikan AC</td>
                                <td class="px-6 py-4 whitespace-nowrap text-right text-sm text-gray-500">30</td>
                                <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium text-gray-900">Rp 6.000.000</td>
                            </tr>
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">3</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">Instalasi Jaringan</td>
                                <td class="px-6 py-4 whitespace-nowrap text-right text-sm text-gray-500">25</td>
                                <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium text-gray-900">Rp 8.750.000</td>
                            </tr>
                            {{-- @empty
                                <tr>
                                    <td colspan="4" class="px-6 py-4 text-center text-gray-500">Tidak ada data jasa terpopuler yang ditemukan.</td>
                                </tr>
                            @endforelse --}}
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="mt-8 text-right">
                <a href="{{ route('admin.report.index') }}"
                    class="inline-flex items-center text-gray-600 hover:text-gray-900 font-medium transition-colors duration-200">
                    <i class="fas fa-arrow-left mr-2"></i> Kembali ke Laporan Utama
                </a>
            </div>
        </div>
    </div>
@endsection

@section('js')
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
@endsection