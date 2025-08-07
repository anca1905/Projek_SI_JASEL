@extends('layout.app')

@section('title', 'Detail Pesanan #' . $order->id)
@section('nav', 'Costumer Panel')

@section('main')
    <main class="flex-1 overflow-x-hidden overflow-y-auto bg-gray-50 p-6">
        <div class="max-w-4xl mx-auto">
            <div class="bg-white p-8 rounded-2xl shadow-xl border border-gray-200">

                <div class="flex items-center justify-between mb-6">
                    <h2 class="text-3xl font-bold text-gray-800">Detail Pesanan</h2>
                    <span class="text-xl font-semibold text-gray-600">#{{ str_pad($order->id, 5, '0', STR_PAD_LEFT) }}</span>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-y-6 gap-x-8 text-gray-700">
                    {{-- Left Column --}}
                    <div>
                        <div class="mb-4">
                            <h4 class="text-sm font-medium text-gray-500 uppercase">Informasi Pelanggan</h4>
                            <p class="mt-1 text-lg font-semibold">{{ $order->user->name ?? 'N/A' }}</p>
                            <p class="text-sm text-gray-500">{{ $order->user->email ?? 'N/A' }}</p>
                        </div>
                        <div class="mb-4">
                            <h4 class="text-sm font-medium text-gray-500 uppercase">Alamat Service</h4>
                            <p class="mt-1 text-base">{{ $order->address }}</p>
                        </div>
                        <div class="mb-4">
                            <h4 class="text-sm font-medium text-gray-500 uppercase">Deskripsi Masalah</h4>
                            <p class="mt-1 text-base">{{ $order->device_problem }}</p>
                        </div>
                    </div>

                    {{-- Right Column --}}
                    <div>
                        <div class="mb-4">
                            <h4 class="text-sm font-medium text-gray-500 uppercase">Detail Pesanan</h4>
                            <p class="mt-1 text-lg font-semibold">{{ $order->manageService->name ?? 'N/A' }}</p>
                            <p class="text-sm text-gray-500">Jasa yang diminta</p>
                        </div>
                        <div class="mb-4">
                            <h4 class="text-sm font-medium text-gray-500 uppercase">Status</h4>
                            @php
                                $statusClass = match ($order->status) {
                                    'menunggu_konfirmasi' => 'bg-yellow-100 text-yellow-800',
                                    'diproses' => 'bg-blue-100 text-blue-800',
                                    'selesai' => 'bg-green-100 text-green-800',
                                    'dibatalkan' => 'bg-red-100 text-red-800',
                                    default => 'bg-gray-100 text-gray-800',
                                };
                            @endphp
                            <span class="mt-1 px-3 py-1 inline-flex text-xs font-semibold rounded-full {{ $statusClass }}">
                                {{ ucfirst(str_replace('_', ' ', $order->status)) }}
                            </span>
                        </div>
                        <div class="mb-4">
                            <h4 class="text-sm font-medium text-gray-500 uppercase">Teknisi Ditugaskan</h4>
                            <p class="mt-1 text-base">{{ $teknisi->name ?? 'Belum Ditugaskan' }}</p>
                        </div>
                        <div class="mb-4">
                            <h4 class="text-sm font-medium text-gray-500 uppercase">Tanggal Pesanan</h4>
                            <p class="mt-1 text-base">{{ $order->created_at->format('d M Y') }}</p>
                            <p class="text-sm text-gray-500">Pukul: {{ $order->created_at->format('H:i') }} WIB</p>
                        </div>
                    </div>
                </div>

                <div class="mt-8 pt-6 border-t border-gray-200 flex justify-between items-center">
                    <a href="{{ route('costumer.order_history') }}"
                        class="inline-flex items-center justify-center px-4 py-2 border border-gray-300 rounded-lg shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-colors duration-200">
                        <i class="fas fa-arrow-left mr-2"></i> Kembali
                    </a>
                </div>
            </div>
        </div>
    </main>
@endsection

@section('js')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap');
        body {
            font-family: 'Poppins', sans-serif;
        }
    </style>
@endsection