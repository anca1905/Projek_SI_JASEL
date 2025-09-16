{{-- resources/views/admin/laporan_pesanan.blade.php --}}
@extends('layout.app')

@section('title', 'Laporan Detail Pesanan')
@section('nav', 'Admin Panel')

@section('main')
    <div class="space-y-6">
        <div class="bg-white p-8 rounded-xl shadow-lg border border-gray-200">
            <h2 class="text-3xl font-bold mb-6 text-gray-800">Laporan Detail Pesanan</h2>

            {{-- Filter Form --}}
            <form action="{{ route('admin.report.orders') }}" method="GET"
                class="mb-8 p-6 rounded-lg border border-gray-200 bg-gray-50 flex flex-col md:flex-row gap-4 items-end">
                <div class="w-full md:w-1/4">
                    <label for="start_date" class="block text-sm font-medium text-gray-700 mb-1">Dari Tanggal</label>
                    <input type="date" name="start_date" id="start_date" value="{{ request('start_date') }} "
                        max="{{ request('end_date') }}"
                        class="w-full block rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 transition duration-150 ease-in-out sm:text-sm">
                </div>
                <div class="w-full md:w-1/4">
                    <label for="end_date" class="block text-sm font-medium text-gray-700 mb-1">Sampai Tanggal</label>
                    <input type="date" name="end_date" id="end_date" value="{{ request('end_date') }}"
                        min="{{ request('start_date') }}"
                        class="w-full block rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 transition duration-150 ease-in-out sm:text-sm">
                </div>
                <div class="w-full md:w-1/4">
                    <label for="status" class="block text-sm font-medium text-gray-700 mb-1">Status</label>
                    <select name="status" id="status"
                        class="w-full p-2 block rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 transition duration-150 ease-in-out sm:text-sm">
                        <option value="">Semua Status</option>
                        <option value="menunggu_konfirmasi"
                            {{ request('status') == 'menunggu_konfirmasi' ? 'selected' : '' }}>Menunggu Konfirmasi</option>
                        <option value="diproses" {{ request('status') == 'diproses' ? 'selected' : '' }}>Dalam
                            Proses</option>
                        <option value="selesai" {{ request('status') == 'selesai' ? 'selected' : '' }}>Selesai</option>
                    </select>
                </div>
                <div class="w-full md:w-1/4">
                    <label for="technician" class="block text-sm font-medium text-gray-700 mb-1">Teknisi</label>
                    <select name="technician" id="technician"
                        class="w-full p-2 block rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 transition duration-150 ease-in-out sm:text-sm">
                        <option value="">Semua Teknisi</option>
                        @foreach ($technicians as $tech)
                            <option value="{{ $tech->id }}" {{ request('technician') == $tech->id ? 'selected' : '' }}>
                                {{ $tech->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="flex-shrink-0 flex items-center space-x-2 w-full md:w-auto">
                    <button type="submit"
                        class="w-full md:w-auto inline-flex justify-center items-center px-4 py-2 border border-transparent rounded-lg shadow-sm text-sm font-medium text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-colors duration-200">
                        <i class="fas fa-filter mr-2"></i> Filter
                    </button>
                    @if (request()->hasAny(['start_date', 'end_date', 'status', 'technician']))
                        <a href="{{ route('admin.report.orders') }}"
                            class="w-full md:w-auto inline-flex justify-center items-center px-4 py-2 border border-gray-300 rounded-lg shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-100 transition-colors duration-200">
                            Reset
                        </a>
                    @endif
                </div>
            </form>

            <div class="mb-6 flex justify-end items-center space-x-4">
                <a href="{{ route('admin.admin.report.orders.export', array_merge(request()->query(), ['type' => 'pdf'])) }}"
                    class="inline-flex items-center px-4 py-2 border border-transparent rounded-lg shadow-sm text-sm font-medium text-white bg-red-600 hover:bg-red-700">
                    <i class="fas fa-file-pdf mr-2"></i> Export ke PDF
                </a>
                <a href="{{ route('admin.admin.report.orders.export', array_merge(request()->query(), ['type' => 'excel'])) }}"
                    class="inline-flex items-center px-4 py-2 border border-transparent rounded-lg shadow-sm text-sm font-medium text-white bg-green-600 hover:bg-green-700">
                    <i class="fas fa-file-excel mr-2"></i> Export ke Excel
                </a>
            </div>


            <div class="table-container">
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th
                                    class="px-6 py-4 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">
                                    ID Pesanan</th>
                                <th
                                    class="px-6 py-4 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">
                                    Pelanggan</th>
                                <th
                                    class="px-6 py-4 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">
                                    Jasa</th>
                                <th
                                    class="px-6 py-4 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">
                                    Status</th>
                                <th
                                    class="px-6 py-4 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">
                                    Teknisi</th>
                                <th
                                    class="px-6 py-4 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">
                                    Tgl Pesan</th>
                                <th
                                    class="px-6 py-4 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">
                                    Tgl Selesai</th>
                                <th
                                    class="px-6 py-4 text-right text-xs font-semibold text-gray-500 uppercase tracking-wider">
                                    Total Harga</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @foreach ($orders as $order)
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                        #{{ str_pad($order->id, 5, '0', STR_PAD_LEFT) }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                        {{ $order->user->name }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                        {{ $order->manageService->name }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        @php
                                            $statusClass = match ($order->status) {
                                                'menunggu_konfirmasi' => 'bg-yellow-100 text-yellow-800',
                                                'diproses' => 'bg-blue-100 text-blue-800',
                                                'selesai' => 'bg-green-100 text-green-800',
                                                'menunggu_pembayaran' => 'bg-orange-100 text-orange-800',
                                                default => 'bg-gray-100 text-gray-800',
                                            };
                                        @endphp
                                        <span
                                            class="px-3 py-1 inline-flex text-xs font-semibold rounded-full {{ $statusClass }}">
                                            {{ ucfirst(str_replace('_', ' ', $order->status)) }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                        {{ $order->teknisi ? $order->teknisi->name : 'Belum di Tugaskan' }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                        {{ $order->created_at->format('Y-m-d') }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                        {{ $order->status == 'menunggu_konfirmasi' ? 'Belum di Konfirmasi' : ($order->status == 'diproses' ? 'on progress' : $order->finish_time) }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium text-gray-900">Rp
                                        150.000</td>
                                </tr>
                                {{-- @empty
                                    <tr>
                                        <td colspan="8" class="px-6 py-4 text-center text-gray-500">Tidak ada pesanan yang
                                            ditemukan.</td>
                                    </tr>
                                @endforelse --}}
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

            {{-- Pagination and Navigation --}}
            <div class="mt-6 flex justify-between items-center">
                {{-- Pagination links --}}
                <span class="text-sm text-gray-700">Menampilkan 1 sampai 3 dari 3 entri</span>
                {{-- {{ $orders->links() }} --}}
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
    <script>
        const start = document.getElementById('start_date');
        const end = document.getElementById('end_date');

        start.addEventListener('change', function() {
            end.min = this.value;
        });

        end.addEventListener('change', function() {
            start.max = this.value;
        });
    </script>

@endsection
