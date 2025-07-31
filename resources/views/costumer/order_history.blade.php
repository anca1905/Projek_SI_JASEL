{{-- resources/views/pelanggan/riwayat_pesanan/index.blade.php --}}
@extends('layout.app')

@section('title', 'Riwayat Pesanan Anda')
@section('nav', 'Costumer Panel')

@section('main')
    <main class="flex-1 overflow-x-hidden overflow-y-auto bg-gray-100 p-6">
        @if (session('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
                <strong class="font-bold">Sukses!</strong>
                <span class="block sm:inline">{{ session('success') }}</span>
            </div>
        @endif

        @if (session('error'))
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4" role="alert">
                <strong class="font-bold">Error!</strong>
                <span class="block sm:inline">{{ session('error') }}</span>
            </div>
        @endif

        <div class="bg-white p-6 rounded-lg shadow-md">
            <h3 class="text-xl font-semibold mb-4">Daftar Riwayat Pesanan</h3>

            {{-- Filter and Search (Optional, if you want to add this functionality) --}}
            <div class="mb-4 flex flex-wrap gap-4 items-end">
                <form action="{{ route('costumer.order_history') }}" method="GET" class="flex items-center space-x-2">
                    <input type="text" name="search" value="{{ request('search') }}"
                        placeholder="Cari ID atau Jasa..."
                        class="border rounded px-3 py-2 focus:outline-none focus:ring focus:border-blue-300">

                    <select name="status"
                        class="border rounded px-3 py-2 focus:outline-none focus:ring focus:border-blue-300">
                        <option value="">Semua Status</option>
                        <option value="menunggu_konfirmasi" {{ request('status') == 'menunggu_konfirmasi' ? 'selected' : '' }}>Menunggu Konfirmasi</option>
                        <option value="diproses" {{ request('status') == 'diproses' ? 'selected' : '' }}>Diproses</option>
                        <option value="selesai" {{ request('status') == 'selesai' ? 'selected' : '' }}>Selesai</option>
                        {{-- <option value="dibatalkan" {{ request('status') == 'dibatalkan' ? 'selected' : '' }}>Dibatalkan</option> --}}
                    </select>

                    <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold px-4 py-2 rounded">
                        Cari
                    </button>

                    @if (request('search') || request('status'))
                        <a href="{{ route('costumer.order_history') }}" class="text-sm text-blue-500 hover:underline ml-2">
                            Reset
                        </a>
                    @endif
                </form>
            </div>

            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">ID Pesanan</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Jenis Jasa</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Deskripsi Masalah</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tanggal Pesanan</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        {{-- Contoh data pesanan. Anda akan mengganti ini dengan loop data dari controller --}}
                        @forelse ($orders as $order)
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap">#{{ str_pad($order->id, 5, '0', STR_PAD_LEFT) }}</td>
                                <td class="px-6 py-4 whitespace-nowrap">{{ $order->manageService->name }}</td>
                                <td class="px-6 py-4 whitespace-nowrap">{{ Str::limit($order->device_problem, 50) }}</td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    @php
                                        $statusClass = match ($order->status) {
                                            'menunggu_konfirmasi' => 'bg-yellow-100 text-yellow-800',
                                            'diproses' => 'bg-blue-100 text-blue-800',
                                            'selesai' => 'bg-green-100 text-green-800',
                                            'dibatalkan' => 'bg-red-100 text-red-800',
                                            default => 'bg-gray-100 text-gray-800',
                                        };
                                    @endphp
                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full {{ $statusClass }}">
                                        {{ ucfirst(str_replace('_', ' ', $order->status)) }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">{{ $order->created_at->format('Y-m-d') }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                    <a href="{{ route('costumer.order_detail', $order->id) }}" class="text-blue-600 hover:text-blue-900 mr-2">Detail</a>
                                    @if ($order->status == 'menunggu_konfirmasi')
                                        <form action="" method="POST" class="inline-block" onsubmit="return confirm('Apakah Anda yakin ingin membatalkan pesanan ini?');">
                                            @csrf
                                            @method('PUT') {{-- Atau DELETE, tergantung implementasi backend Anda --}}
                                            <button type="submit" class="text-red-600 hover:text-red-900">Batal</button>
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
                <br>
                {{-- Pagination Links --}}
                <div class="mt-4 flex justify-between items-center">
                    @if ($orders->total() > 0)
                        <span class="text-sm text-gray-700">Menampilkan {{ $orders->firstItem() ?? 0 }} sampai
                            {{ $orders->lastItem() ?? 0 }} dari {{ $orders->total() }} entri</span>
                        {{ $orders->links() }}
                    @endif
                </div>
            </div>
        </div>
    </main>
@endsection