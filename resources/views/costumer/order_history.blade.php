{{-- resources/views/pelanggan/riwayat_pesanan/index.blade.php --}}
@extends('layout.app')

@section('title', 'Riwayat Pesanan Anda')
@section('nav', 'Costumer Panel')

@section('main')
    <main class="flex-1 overflow-x-hidden overflow-y-auto bg-gray-50 p-6">
        <div class="space-y-6">

            {{-- Session alerts using SweetAlert2 --}}
            @section('js')
                <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
                <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
                <style>
                    @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap');
                    body {
                        font-family: 'Poppins', sans-serif;
                    }
                </style>
                @if (session('success'))
                    <script>
                        Swal.fire({
                            icon: 'success',
                            title: 'Berhasil!',
                            text: '{{ session('success') }}',
                            timer: 2500,
                            showConfirmButton: false
                        });
                    </script>
                @endif
                @if (session('error'))
                    <script>
                        Swal.fire({
                            icon: 'error',
                            title: 'Gagal!',
                            text: '{{ session('error') }}',
                            timer: 2500,
                            showConfirmButton: false
                        });
                    </script>
                @endif
            @endsection

            {{-- Main Content Card --}}
            <div class="bg-white p-8 rounded-2xl shadow-xl border border-gray-200">
                <div class="flex justify-between items-center mb-6">
                    <h3 class="text-2xl font-bold text-gray-800">Daftar Riwayat Pesanan</h3>
                    <a href="{{ route('costumer.make_an_order') }}"
                        class="inline-flex items-center px-4 py-2 border border-transparent rounded-lg shadow-sm text-sm font-medium text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-colors duration-200">
                        <i class="fas fa-plus mr-2"></i> Pesan Jasa Baru
                    </a>
                </div>

                {{-- Filter and Search Form --}}
                <div class="mb-6 p-4 rounded-lg border border-gray-200 bg-gray-50">
                    <form action="{{ route('costumer.order_history') }}" method="GET"
                        class="flex flex-col sm:flex-row items-end gap-4">
                        <div class="w-full sm:w-1/2">
                            <label for="search" class="block text-sm font-medium text-gray-700 mb-1">Cari Pesanan</label>
                            <input type="text" name="search" id="search" value="{{ request('search') }}"
                                placeholder="Cari ID atau Jasa..."
                                class="block w-full px-4 py-2 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition duration-200">
                        </div>
                        <div class="w-full sm:w-1/2">
                            <label for="status" class="block text-sm font-medium text-gray-700 mb-1">Filter Status</label>
                            <select name="status" id="status"
                                class="block w-full px-4 py-2 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition duration-200">
                                <option value="">Semua Status</option>
                                <option value="menunggu_konfirmasi" {{ request('status') == 'menunggu_konfirmasi' ? 'selected' : '' }}>Menunggu Konfirmasi</option>
                                <option value="diproses" {{ request('status') == 'diproses' ? 'selected' : '' }}>Diproses</option>
                                <option value="selesai" {{ request('status') == 'selesai' ? 'selected' : '' }}>Selesai</option>
                                <option value="dibatalkan" {{ request('status') == 'dibatalkan' ? 'selected' : '' }}>Dibatalkan</option>
                            </select>
                        </div>
                        <div class="flex-shrink-0 flex items-center space-x-2">
                            <button type="submit"
                                class="w-full sm:w-auto inline-flex justify-center items-center px-4 py-2 border border-transparent rounded-lg shadow-sm text-sm font-medium text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-colors duration-200">
                                <i class="fas fa-search mr-2"></i> Cari
                            </button>
                            @if (request('search') || request('status'))
                                <a href="{{ route('costumer.order_history') }}"
                                    class="w-full sm:w-auto inline-flex justify-center items-center px-4 py-2 border border-gray-300 rounded-lg shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-100 transition-colors duration-200">
                                    Reset
                                </a>
                            @endif
                        </div>
                    </form>
                </div>


                {{-- Order History Table --}}
                <div class="overflow-x-auto rounded-lg shadow-sm border border-gray-200">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">ID Pesanan</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Jenis Jasa</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Deskripsi Masalah</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Status</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Tanggal Pesanan</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @forelse ($orders as $order)
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">#{{ str_pad($order->id, 5, '0', STR_PAD_LEFT) }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $order->manageService->name }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ Str::limit($order->device_problem, 50) }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm">
                                        @php
                                            $statusClass = match ($order->status) {
                                                'menunggu_konfirmasi' => 'bg-yellow-100 text-yellow-800',
                                                'diproses' => 'bg-blue-100 text-blue-800',
                                                'selesai' => 'bg-green-100 text-green-800',
                                                'menunggu_pembayaran' => 'bg-orange-100 text-orange-800',
                                                default => 'bg-gray-100 text-gray-800',
                                            };
                                        @endphp
                                        <span class="px-3 py-1 inline-flex text-xs font-semibold rounded-full {{ $statusClass }}">
                                            {{ ucfirst(str_replace('_', ' ', $order->status)) }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $order->created_at->format('Y-m-d') }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                        <a href="{{ route('costumer.order_detail', $order->id) }}" class="text-blue-600 hover:text-blue-900 mr-4">Detail</a>
                                        @if ($order->status == 'menunggu_konfirmasi')
                                            <form action="" method="POST" class="inline-block" onsubmit="return confirm('Apakah Anda yakin ingin membatalkan pesanan ini?');">
                                                @csrf
                                                @method('PUT') {{-- Or DELETE --}}
                                                <button type="submit" class="text-red-600 hover:text-red-900 focus:outline-none">Batal</button>
                                            </form>
                                        @endif
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="px-6 py-4 text-center text-gray-500">Belum ada riwayat pesanan.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                {{-- Pagination Links --}}
                <div class="mt-6">
                    @if ($orders->total() > 0)
                        <div class="flex flex-col sm:flex-row items-center justify-between">
                            <span class="text-sm text-gray-700 mb-2 sm:mb-0">Menampilkan {{ $orders->firstItem() ?? 0 }} sampai
                                {{ $orders->lastItem() ?? 0 }} dari {{ $orders->total() }} entri</span>
                            {{ $orders->links('pagination::tailwind') }}
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </main>
@endsection