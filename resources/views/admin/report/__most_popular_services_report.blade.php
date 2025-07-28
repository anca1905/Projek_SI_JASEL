{{-- resources/views/admin/laporan_jasa_terpopuler.blade.php --}}
@extends('layout.app')

@section('title', 'Laporan Jasa Terpopuler')

@section('main')
    <main class="flex-1 overflow-x-hidden overflow-y-auto bg-gray-100 p-6">
        <div class="bg-white p-6 rounded-lg shadow-md">
            <h2 class="text-2xl font-bold mb-4 text-gray-800">Laporan Jasa Terpopuler</h2>

            {{-- Filter Form --}}
            <form action="" method="GET" class="mb-6 bg-gray-50 p-4 rounded-lg shadow-sm flex flex-wrap gap-4 items-end">
                <div>
                    <label for="start_date" class="block text-sm font-medium text-gray-700">Dari Tanggal</label>
                    <input type="date" name="start_date" id="start_date"
                        value="{{ request('start_date') }}"
                        class="mt-1 p-2 border border-gray-300 rounded focus:outline-none focus:ring focus:border-blue-300">
                </div>
                <div>
                    <label for="end_date" class="block text-sm font-medium text-gray-700">Sampai Tanggal</label>
                    <input type="date" name="end_date" id="end_date"
                        value="{{ request('end_date') }}"
                        class="mt-1 p-2 border border-gray-300 rounded focus:outline-none focus:ring focus:border-blue-300">
                </div>
                <div class="flex items-end gap-2">
                    <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold px-4 py-2 rounded">
                        Filter
                    </button>
                    @if (request()->hasAny(['start_date', 'end_date']))
                        <a href="{{ route('adminreport.popular_services') }}" class="text-sm text-blue-500 hover:underline">Reset</a>
                    @endif
                </div>
            </form>

            {{-- Export Button (Placeholder) --}}
            <div class="mb-4 flex justify-end">
                <a href=""
                    class="bg-green-600 hover:bg-green-700 text-white font-bold py-2 px-4 rounded inline-flex items-center">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                    Export ke Excel
                </a>
            </div>

            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">No.</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nama Jasa</th>
                            <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">Jumlah Pesanan</th>
                            <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">Total Pendapatan dari Jasa</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        {{-- Contoh data statis. Ganti dengan @foreach loop dari controller --}}
                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap">1</td>
                            <td class="px-6 py-4 whitespace-nowrap">Service Laptop</td>
                            <td class="px-6 py-4 whitespace-nowrap text-right">50</td>
                            <td class="px-6 py-4 whitespace-nowrap text-right">Rp 7.500.000</td>
                        </tr>
                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap">2</td>
                            <td class="px-6 py-4 whitespace-nowrap">Perbaikan AC</td>
                            <td class="px-6 py-4 whitespace-nowrap text-right">30</td>
                            <td class="px-6 py-4 whitespace-nowrap text-right">Rp 6.000.000</td>
                        </tr>
                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap">3</td>
                            <td class="px-6 py-4 whitespace-nowrap">Instalasi Jaringan</td>
                            <td class="px-6 py-4 whitespace-nowrap text-right">25</td>
                            <td class="px-6 py-4 whitespace-nowrap text-right">Rp 8.750.000</td>
                        </tr>
                        {{-- @empty
                            <tr>
                                <td colspan="4" class="px-6 py-4 text-center text-gray-500">Tidak ada data jasa terpopuler yang ditemukan.</td>
                            </tr>
                        @endforelse --}}
                    </tbody>
                </table>
            </div>

            <div class="mt-6 text-right">
                <a href="{{ route('adminadmin.report') }}" class="text-gray-600 hover:underline">Kembali ke Laporan Utama</a>
            </div>
        </div>
    </main>
@endsection