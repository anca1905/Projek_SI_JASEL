{{-- resources/views/admin/laporan_performa_teknisi.blade.php --}}
@extends('layout.app')

@section('title', 'Laporan Performa Teknisi')
@section('nav', 'Admin Panel')

@section('main')
    <div class="space-y-6">
        <div class="bg-white p-8 rounded-xl shadow-lg border border-gray-200">
            <h2 class="text-3xl font-bold mb-6 text-gray-800">Laporan Performa Teknisi</h2>

            {{-- Filter Form --}}
            <form action="{{ route('admin.report.technicians') }}" method="GET"
                class="mb-8 p-6 rounded-lg border border-gray-200 bg-gray-50 flex flex-col md:flex-row gap-4 items-end">
                <div class="w-full md:w-1/3">
                    <label for="start_date" class="block text-sm font-medium text-gray-700 mb-1">Dari Tanggal</label>
                    <input type="date" name="start_date" id="start_date" value="{{ request('start_date') }}"
                        class="w-full block rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 transition duration-150 ease-in-out sm:text-sm">
                </div>
                <div class="w-full md:w-1/3">
                    <label for="end_date" class="block text-sm font-medium text-gray-700 mb-1">Sampai Tanggal</label>
                    <input type="date" name="end_date" id="end_date" value="{{ request('end_date') }}"
                        class="w-full block rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 transition duration-150 ease-in-out sm:text-sm">
                </div>
                <div class="w-full md:w-1/3">
                    <label for="technician" class="block text-sm font-medium text-gray-700 mb-1">Teknisi</label>
                    <select name="technician" id="technician"
                        class="w-full p-2 block rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 transition duration-150 ease-in-out sm:text-sm">
                        <option value="">Semua Teknisi</option>
                        {{-- @foreach($technicians as $tech) --}}
                        <option value="1" {{ request('technician') == '1' ? 'selected' : '' }}>Teknisi A</option>
                        <option value="2" {{ request('technician') == '2' ? 'selected' : '' }}>Teknisi B</option>
                        <option value="3" {{ request('technician') == '3' ? 'selected' : '' }}>Teknisi C</option>
                        {{-- @endforeach --}}
                    </select>
                </div>
                <div class="flex-shrink-0 flex items-center space-x-2 w-full md:w-auto">
                    <button type="submit"
                        class="w-full md:w-auto inline-flex justify-center items-center px-4 py-2 border border-transparent rounded-lg shadow-sm text-sm font-medium text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-colors duration-200">
                        <i class="fas fa-filter mr-2"></i> Filter
                    </button>
                    @if (request()->hasAny(['start_date', 'end_date', 'technician']))
                        <a href="{{ route('admin.report.technicians') }}"
                            class="w-full md:w-auto inline-flex justify-center items-center px-4 py-2 border border-gray-300 rounded-lg shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-100 transition-colors duration-200">
                            Reset
                        </a>
                    @endif
                </div>
            </form>

            <div class="mb-6 flex justify-end items-center space-x-4">
                <a href=""
                    class="inline-flex items-center px-4 py-2 border border-transparent rounded-lg shadow-sm text-sm font-medium text-white bg-green-600 hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500 transition-colors duration-200">
                    <i class="fas fa-file-excel mr-2"></i> Export ke Excel
                </a>
            </div>

            <div class="table-container">
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-6 py-4 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Nama Teknisi</th>
                                <th class="px-6 py-4 text-right text-xs font-semibold text-gray-500 uppercase tracking-wider">Pesanan Ditugaskan</th>
                                <th class="px-6 py-4 text-right text-xs font-semibold text-gray-500 uppercase tracking-wider">Pesanan Selesai</th>
                                <th class="px-6 py-4 text-right text-xs font-semibold text-gray-500 uppercase tracking-wider">Tingkat Penyelesaian (%)</th>
                                <th class="px-6 py-4 text-right text-xs font-semibold text-gray-500 uppercase tracking-wider">Rata-rata Waktu Selesai (Hari)</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            {{-- Contoh data statis. Ganti dengan @foreach loop dari controller --}}
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">Teknisi A</td>
                                <td class="px-6 py-4 whitespace-nowrap text-right text-sm text-gray-500">15</td>
                                <td class="px-6 py-4 whitespace-nowrap text-right text-sm text-gray-500">12</td>
                                <td class="px-6 py-4 whitespace-nowrap text-right text-sm text-gray-500">80.00%</td>
                                <td class="px-6 py-4 whitespace-nowrap text-right text-sm text-gray-500">2.5</td>
                            </tr>
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">Teknisi B</td>
                                <td class="px-6 py-4 whitespace-nowrap text-right text-sm text-gray-500">10</td>
                                <td class="px-6 py-4 whitespace-nowrap text-right text-sm text-gray-500">9</td>
                                <td class="px-6 py-4 whitespace-nowrap text-right text-sm text-gray-500">90.00%</td>
                                <td class="px-6 py-4 whitespace-nowrap text-right text-sm text-gray-500">1.8</td>
                            </tr>
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">Teknisi C</td>
                                <td class="px-6 py-4 whitespace-nowrap text-right text-sm text-gray-500">8</td>
                                <td class="px-6 py-4 whitespace-nowrap text-right text-sm text-gray-500">6</td>
                                <td class="px-6 py-4 whitespace-nowrap text-right text-sm text-gray-500">75.00%</td>
                                <td class="px-6 py-4 whitespace-nowrap text-right text-sm text-gray-500">3.1</td>
                            </tr>
                            {{-- @empty
                                <tr>
                                    <td colspan="5" class="px-6 py-4 text-center text-gray-500">Tidak ada data performa teknisi yang ditemukan.</td>
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