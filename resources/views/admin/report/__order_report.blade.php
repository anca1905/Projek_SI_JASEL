{{-- resources/views/admin/laporan_pesanan.blade.php --}}
@extends('layout.app')

@section('title', 'Laporan Detail Pesanan')

@section('main')
    <main class="flex-1 overflow-x-hidden overflow-y-auto bg-gray-100 p-6">
        <div class="bg-white p-6 rounded-lg shadow-md">
            <h2 class="text-2xl font-bold mb-4 text-gray-800">Laporan Detail Pesanan</h2>

            {{-- Filter Form --}}
            <form action="{{ route('adminadmin.laporan_pesanan') }}" method="GET" class="mb-6 bg-gray-50 p-4 rounded-lg shadow-sm flex flex-wrap gap-4 items-end">
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
                    <label for="status" class="block text-sm font-medium text-gray-700">Status</label>
                    <select name="status" id="status" class="mt-1 p-2 border border-gray-300 rounded focus:outline-none focus:ring focus:border-blue-300">
                        <option value="">Semua Status</option>
                        <option value="menunggu" {{ request('status') == 'menunggu' ? 'selected' : '' }}>Menunggu</option>
                        <option value="dalam_proses" {{ request('status') == 'dalam_proses' ? 'selected' : '' }}>Dalam Proses</option>
                        <option value="selesai" {{ request('status') == 'selesai' ? 'selected' : '' }}>Selesai</option>
                        <option value="dibatalkan" {{ request('status') == 'dibatalkan' ? 'selected' : '' }}>Dibatalkan</option>
                    </select>
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
                    </select>
                </div>
                <div class="flex items-end gap-2">
                    <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold px-4 py-2 rounded">
                        Filter
                    </button>
                    @if (request()->hasAny(['start_date', 'end_date', 'status', 'technician']))
                        <a href="{{ route('adminreport.orders') }}" class="text-sm text-blue-500 hover:underline">Reset</a>
                    @endif
                </div>
            </form>

            {{-- Export Button (Placeholder) --}}
            <div class="mb-4 flex justify-end">
                <a href="{{ route('adminadmin.laporan_pesanan', array_merge(request()->query(), ['export' => 'excel'])) }}"
                    class="bg-green-600 hover:bg-green-700 text-white font-bold py-2 px-4 rounded inline-flex items-center">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                    Export ke Excel
                </a>
            </div>

            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">ID Pesanan</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Pelanggan</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Jasa</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Teknisi</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tanggal Pesan</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tanggal Selesai</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Total Harga</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        {{-- Contoh data statis. Ganti dengan @foreach loop dari controller --}}
                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap">#202507001</td>
                            <td class="px-6 py-4 whitespace-nowrap">Andi Susanto</td>
                            <td class="px-6 py-4 whitespace-nowrap">Service Laptop</td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">Selesai</span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">Teknisi A</td>
                            <td class="px-6 py-4 whitespace-nowrap">2025-07-20</td>
                            <td class="px-6 py-4 whitespace-nowrap">2025-07-22</td>
                            <td class="px-6 py-4 whitespace-nowrap">Rp 150.000</td>
                        </tr>
                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap">#202507002</td>
                            <td class="px-6 py-4 whitespace-nowrap">Budi Wijaya</td>
                            <td class="px-6 py-4 whitespace-nowrap">Perbaikan AC</td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-yellow-100 text-yellow-800">Menunggu</span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">Belum Ditugaskan</td>
                            <td class="px-6 py-4 whitespace-nowrap">2025-07-25</td>
                            <td class="px-6 py-4 whitespace-nowrap">-</td>
                            <td class="px-6 py-4 whitespace-nowrap">Rp 200.000</td>
                        </tr>
                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap">#202507003</td>
                            <td class="px-6 py-4 whitespace-nowrap">Citra Dewi</td>
                            <td class="px-6 py-4 whitespace-nowrap">Instalasi Jaringan</td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-blue-100 text-blue-800">Dalam Proses</span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">Teknisi B</td>
                            <td class="px-6 py-4 whitespace-nowrap">2025-07-26</td>
                            <td class="px-6 py-4 whitespace-nowrap">-</td>
                            <td class="px-6 py-4 whitespace-nowrap">Rp 350.000</td>
                        </tr>
                        {{-- @empty
                            <tr>
                                <td colspan="8" class="px-6 py-4 text-center text-gray-500">Tidak ada pesanan yang ditemukan.</td>
                            </tr>
                        @endforelse --}}
                    </tbody>
                </table>
            </div>

            <div class="mt-4 flex justify-between items-center">
                {{-- Placeholder untuk link paginasi --}}
                <span class="text-sm text-gray-700">Menampilkan 1 sampai 3 dari 3 entri</span>
                {{-- {{ $orders->links() }} --}}
            </div>

            <div class="mt-6 text-right">
                <a href="{{ route('adminadmin.report') }}" class="text-gray-600 hover:underline">Kembali ke Laporan Utama</a>
            </div>
        </div>
    </main>
@endsection