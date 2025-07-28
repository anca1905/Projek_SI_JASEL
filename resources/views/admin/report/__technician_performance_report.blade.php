{{-- resources/views/admin/laporan_performa_teknisi.blade.php --}}
@extends('layout.app')

@section('title', 'Laporan Performa Teknisi')

@section('main')
    <main class="flex-1 overflow-x-hidden overflow-y-auto bg-gray-100 p-6">
        <div class="bg-white p-6 rounded-lg shadow-md">
            <h2 class="text-2xl font-bold mb-4 text-gray-800">Laporan Performa Teknisi</h2>

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
                <div>
                    <label for="technician" class="block text-sm font-medium text-gray-700">Teknisi</label>
                    <select name="technician" id="technician" class="mt-1 p-2 border border-gray-300 rounded focus:outline-none focus:ring focus:border-blue-300">
                        <option value="">Semua Teknisi</option>
                        {{-- Anda akan mengisi opsi teknisi ini dari database --}}
                        {{-- @foreach($technicians as $tech)
                            <option value="{{ $tech->id }}" {{ request('technician') == $tech->id ? 'selected' : '' }}>{{ $tech->name }}</option>
                        @endforeach --}}
                        <option value="1">Teknisi A</option> {{-- Dummy --}}
                        <option value="2">Teknisi B</option> {{-- Dummy --}}
                        <option value="3">Teknisi C</option> {{-- Dummy --}}
                    </select>
                </div>
                <div class="flex items-end gap-2">
                    <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold px-4 py-2 rounded">
                        Filter
                    </button>
                    @if (request()->hasAny(['start_date', 'end_date', 'technician']))
                        <a href="{{ route('adminreport.technicians') }}" class="text-sm text-blue-500 hover:underline">Reset</a>
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
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nama Teknisi</th>
                            <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">Pesanan Ditugaskan</th>
                            <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">Pesanan Selesai</th>
                            <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">Tingkat Penyelesaian (%)</th>
                            <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">Rata-rata Waktu Selesai (Hari)</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        {{-- Contoh data statis. Ganti dengan @foreach loop dari controller --}}
                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap">Teknisi A</td>
                            <td class="px-6 py-4 whitespace-nowrap text-right">15</td>
                            <td class="px-6 py-4 whitespace-nowrap text-right">12</td>
                            <td class="px-6 py-4 whitespace-nowrap text-right">80.00%</td>
                            <td class="px-6 py-4 whitespace-nowrap text-right">2.5</td>
                        </tr>
                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap">Teknisi B</td>
                            <td class="px-6 py-4 whitespace-nowrap text-right">10</td>
                            <td class="px-6 py-4 whitespace-nowrap text-right">9</td>
                            <td class="px-6 py-4 whitespace-nowrap text-right">90.00%</td>
                            <td class="px-6 py-4 whitespace-nowrap text-right">1.8</td>
                        </tr>
                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap">Teknisi C</td>
                            <td class="px-6 py-4 whitespace-nowrap text-right">8</td>
                            <td class="px-6 py-4 whitespace-nowrap text-right">6</td>
                            <td class="px-6 py-4 whitespace-nowrap text-right">75.00%</td>
                            <td class="px-6 py-4 whitespace-nowrap text-right">3.1</td>
                        </tr>
                        {{-- @empty
                            <tr>
                                <td colspan="5" class="px-6 py-4 text-center text-gray-500">Tidak ada data performa teknisi yang ditemukan.</td>
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