{{-- resources/views/teknisi/pesanan_masuk.blade.php --}}
@extends('layout.app')

@section('title', 'Pesanan Masuk')
@section('nav', 'Teknisi Panel')

@section('main')
    <main class="flex-1 overflow-x-hidden overflow-y-auto bg-gray-50 p-6">
        <div class="space-y-6 max-w-7xl mx-auto">

            {{-- Main Content Card --}}
            <div class="bg-white p-8 rounded-2xl shadow-xl border border-gray-200">
                <div class="flex justify-between items-center mb-6">
                    <h2 class="text-2xl font-bold text-gray-800">Daftar Pesanan Masuk</h2>
                </div>

                {{-- Alert Sections (using SweetAlert2 for consistency) --}}
                @section('js')
                    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
                    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
                    <style>
                        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap');
                        body {
                            font-family: 'Poppins', sans-serif;
                        }
                    </style>
                    {{-- Assuming success/error messages are passed via session --}}
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

                <div class="overflow-x-auto rounded-lg shadow-sm border border-gray-200">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th scope="col"
                                    class="px-6 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">ID Pesanan
                                </th>
                                <th scope="col"
                                    class="px-6 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Pelanggan
                                </th>
                                <th scope="col"
                                    class="px-6 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Jasa</th>
                                <th scope="col"
                                    class="px-6 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Alamat</th>
                                <th scope="col"
                                    class="px-6 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Status</th>
                                <th scope="col"
                                    class="px-6 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Tanggal Pesan</th>
                                <th scope="col"
                                    class="px-6 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @forelse ($order as $d)
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">#{{ str_pad($d->id, 5, '0', STR_PAD_LEFT) }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $d->user->name }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $d->manageService->name }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ Str::limit($d->address, 30) }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm">
                                        @php
                                            $statusClass = match ($d->status) {
                                                'menunggu_konfirmasi' => 'bg-yellow-100 text-yellow-800',
                                                'diproses' => 'bg-blue-100 text-blue-800',
                                                'selesai' => 'bg-green-100 text-green-800',
                                                'dibatalkan' => 'bg-red-100 text-red-800',
                                                default => 'bg-gray-100 text-gray-800',
                                            };
                                        @endphp
                                        <span class="px-3 py-1 inline-flex text-xs font-semibold rounded-full {{ $statusClass }}">
                                            {{ ucfirst(str_replace('_', ' ', $d->status)) }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $d->appointment_date }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                        <div class="flex items-center space-x-2">
                                            <a href="{{ route('teknisi.take', $d->id) }}"
                                                class="text-indigo-600 hover:text-indigo-900 font-medium transition-colors duration-200"
                                                onclick="return confirm('Apakah Anda yakin ingin mengambil pesanan ini?');">Ambil</a>
                                            <a href="{{ route('teknisi.show', $d->id) }}"
                                                class="text-gray-600 hover:text-gray-900 font-medium transition-colors duration-200">Detail</a>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="7" class="px-6 py-4 text-center text-gray-500">Tidak ada pesanan masuk yang tersedia.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                {{-- Pagination Links (if using) --}}
                {{-- <div class="mt-6">
                    @if ($order->total() > 0)
                        <div class="flex flex-col sm:flex-row items-center justify-between">
                            <span class="text-sm text-gray-700 mb-2 sm:mb-0">Menampilkan {{ $order->firstItem() ?? 0 }} sampai
                                {{ $order->lastItem() ?? 0 }} dari {{ $order->total() }} entri</span>
                            {{ $order->links('pagination::tailwind') }}
                        </div>
                    @endif
                </div> --}}

            </div>
        </div>
    </main>
@endsection