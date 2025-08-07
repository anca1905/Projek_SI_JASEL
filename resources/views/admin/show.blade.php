@extends('layout.app')

@section('title', 'Detail Pesanan #' . $order->id)
@section('nav', 'Admin Panel')

@section('main')
<div class="space-y-6">
    <div class="bg-white p-8 rounded-xl shadow-lg border border-gray-200">
        <h2 class="text-3xl font-bold text-gray-800 mb-6">Detail Pesanan <span class="text-blue-600">#{{ $order->id }}</span></h2>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-x-12 gap-y-6">
            <div class="space-y-4">
                <h3 class="text-xl font-semibold text-gray-700 border-b border-gray-200 pb-2">Informasi Pelanggan</h3>
                <div class="flex items-center space-x-3">
                    <svg class="w-6 h-6 text-gray-500" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd"></path>
                    </svg>
                    <p class="text-gray-800"><strong class="font-medium">Pelanggan:</strong> {{ $order->user->name ?? 'N/A' }}</p>
                </div>
                <div class="flex items-center space-x-3">
                    <svg class="w-6 h-6 text-gray-500" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                        <path d="M2.003 5.884L10 9.882l7.997-3.998A2 2 0 0016 4H4a2 2 0 00-1.997 1.884z"></path>
                        <path d="M18 8.118l-8 4-8-4V14a2 2 0 002 2h12a2 2 0 002-2V8.118z"></path>
                    </svg>
                    <p class="text-gray-800"><strong class="font-medium">Email:</strong> {{ $order->user->email ?? 'N/A' }}</p>
                </div>
                <div class="flex items-start space-x-3">
                    <svg class="w-6 h-6 text-gray-500 mt-1" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd" d="M5.057 4.057a1 1 0 00-1.066 1.057l.63 7.559A2 2 0 005.636 15h8.728a2 2 0 001.993-1.827l.63-7.559a1 1 0 00-1.066-1.057C14.156 4.148 12.182 4 10 4s-4.156.148-4.943.057zM5 16h10v2H5v-2z" clip-rule="evenodd"></path>
                    </svg>
                    <p class="text-gray-800"><strong class="font-medium">Alamat Service:</strong> {{ $order->address }}</p>
                </div>
                <div class="flex items-start space-x-3">
                    <svg class="w-6 h-6 text-gray-500 mt-1" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd" d="M4 4a2 2 0 012-2h8a2 2 0 012 2v12a2 2 0 01-2 2H6a2 2 0 01-2-2V4zM6 6v8a2 2 0 002 2h4a2 2 0 002-2V6H6z" clip-rule="evenodd"></path>
                        <path fill-rule="evenodd" d="M10 11a1 1 0 100-2 1 1 0 000 2z" clip-rule="evenodd"></path>
                    </svg>
                    <p class="text-gray-800"><strong class="font-medium">Deskripsi Masalah:</strong> {{ $order->device_problem }}</p>
                </div>
            </div>

            <div class="space-y-4">
                <h3 class="text-xl font-semibold text-gray-700 border-b border-gray-200 pb-2">Detail Pesanan</h3>
                <div class="flex items-center space-x-3">
                    <svg class="w-6 h-6 text-gray-500" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd" d="M10 2a1 1 0 011 1v1a1 1 0 11-2 0V3a1 1 0 011-1zM4.343 4.343a1 1 0 011.414 0l.707.707a1 1 0 01-1.414 1.414l-.707-.707a1 1 0 010-1.414zM16 10a1 1 0 11-2 0 1 1 0 012 0zm-3.536 6.464a1 1 0 010-1.414l.707-.707a1 1 0 011.414 1.414l-.707.707a1 1 0 01-1.414 0zM10 18a1 1 0 11-2 0 1 1 0 012 0zM3.536 15.536a1 1 0 011.414 0l.707.707a1 1 0 01-1.414 1.414l-.707-.707a1 1 0 010-1.414zM18 10a1 1 0 11-2 0 1 1 0 012 0zM12.464 4.464a1 1 0 011.414 0l.707.707a1 1 0 01-1.414 1.414l-.707-.707a1 1 0 010-1.414z"></path>
                    </svg>
                    <p class="text-gray-800"><strong class="font-medium">Jasa Diminta:</strong> {{ $order->manageService->name }}</p>
                </div>
                <div class="flex items-center space-x-3">
                    <svg class="w-6 h-6 text-gray-500" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00.293.707l2.828 2.829a1 1 0 101.415-1.415L11 9.586V6z" clip-rule="evenodd"></path>
                    </svg>
                    <p class="text-gray-800"><strong class="font-medium">Tanggal Pesanan:</strong> {{ $order->created_at->format('d M Y H:i') }}</p>
                </div>
                <div class="flex items-center space-x-3">
                    <svg class="w-6 h-6 text-gray-500" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd" d="M10 2a1 1 0 011 1v1a1 1 0 11-2 0V3a1 1 0 011-1zM4.343 4.343a1 1 0 011.414 0l.707.707a1 1 0 01-1.414 1.414l-.707-.707a1 1 0 010-1.414zM16 10a1 1 0 11-2 0 1 1 0 012 0zm-3.536 6.464a1 1 0 010-1.414l.707-.707a1 1 0 011.414 1.414l-.707.707a1 1 0 01-1.414 0zM10 18a1 1 0 11-2 0 1 1 0 012 0zM3.536 15.536a1 1 0 011.414 0l.707.707a1 1 0 01-1.414 1.414l-.707-.707a1 1 0 010-1.414zM18 10a1 1 0 11-2 0 1 1 0 012 0zM12.464 4.464a1 1 0 011.414 0l.707.707a1 1 0 01-1.414 1.414l-.707-.707a1 1 0 010-1.414z"></path>
                    </svg>
                    <p class="text-gray-800"><strong class="font-medium">Teknisi Ditugaskan:</strong> {{ $order->teknisi->name ?? 'Belum Ditugaskan' }}</p>
                </div>
                <div class="flex items-center space-x-3">
                    <svg class="w-6 h-6 text-gray-500" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                        <path d="M10 18a8 8 0 100-16 8 8 0 000 16zm-1-9a1 1 0 112 0 1 1 0 01-2 0zm-2 5a2 2 0 114 0h-4z"></path>
                    </svg>
                    <p class="text-gray-800"><strong class="font-medium">Status:</strong>
                        <span class="px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-full capitalize
                            @if($order->status == 'dibatalkan') bg-red-100 text-red-800
                            @elseif($order->status == 'selesai') bg-green-100 text-green-800
                            @elseif($order->status == 'menunggu_konfirmasi') bg-yellow-100 text-yellow-800
                            @else bg-blue-100 text-blue-800
                            @endif">
                            {{ $order->status }}
                        </span>
                    </p>
                </div>
            </div>
        </div>

        <div class="mt-8 pt-6 border-t border-gray-200 flex justify-start">
            <a href="{{ route('admin.admin.index') }}"
                class="inline-flex items-center px-6 py-3 border border-transparent text-sm font-medium rounded-lg shadow-sm text-white bg-gray-600 hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500 transition-colors duration-200">
                <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd" d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                </svg>
                Kembali
            </a>
        </div>
    </div>
</div>
@endsection