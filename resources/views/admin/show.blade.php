@extends('layout.app')

@section('title', 'Detail Pesanan #' . $order->id)

@section('main')
    <main class="flex-1 overflow-x-hidden overflow-y-auto bg-gray-100 p-6">
        <div class="bg-white p-6 rounded-lg shadow-md">
            <h2 class="text-2xl font-bold mb-4">Detail Pesanan #{{ $order->id }}</h2>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <p class="text-gray-700"><strong>Pelanggan:</strong> {{ $order->user->name ?? 'N/A' }}</p>
                    <p class="text-gray-700"><strong>Email Pelanggan:</strong> {{ $order->user->email ?? 'N/A' }}</p>
                    <p class="text-gray-700"><strong>Alamat Service:</strong> {{ $order->address }}</p>
                    <p class="text-gray-700"><strong>Deskripsi Masalah:</strong> {{ $order->device_problem }}</p>
                </div>
                <div>
                    <p class="text-gray-700"><strong>Jasa Diminta:</strong>
                    <span class="block">{{ $order->manageService->name }}</span>
                    </p>
                    <p class="text-gray-700"><strong>Status:</strong> <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full {{ $order->status == 'dibatalkan' ? 'bg-red-100 text-red-800' : ($order->status == 'selesai' ? 'bg-green-100 text-green-800' : ($order->status == 'menunggu_konfirmasi' ? 'bg-yellow-100 text-yellow-800' : 'bg-blue-100 text-blue-800')) }}">{{ $order->status }}</span></p>
                    <p class="text-gray-700"><strong>Teknisi Ditugaskan:</strong> {{ $order->teknisi->name ?? 'Belum Ditugaskan' }}</p>
                    <p class="text-gray-700"><strong>Tanggal Pesanan:</strong> {{ $order->created_at->format('d M Y H:i') }}</p>
                </div>
            </div>

            <div class="mt-6">
                <a href="{{ route('admin.admin.index') }}" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">Kembali</a>
                {{-- Tombol untuk Edit/Tugaskan langsung dari sini jika diperlukan --}}
            </div>
        </div>
    </main>
@endsection