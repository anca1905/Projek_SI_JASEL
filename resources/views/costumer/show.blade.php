{{-- resources/views/customer/order_detail.blade.php --}}
@extends('layout.app')

@section('title', 'Detail Pesanan #' . $order->id)
@section('nav', 'Panel Pelanggan')

@section('main')
    <main class="flex-1 overflow-x-hidden overflow-y-auto bg-gray-50 p-6">
        <div class="max-w-4xl mx-auto">
            <div class="bg-white p-8 rounded-2xl shadow-xl border border-gray-200">

                {{-- Header with Order ID and Status --}}
                <div class="flex items-center justify-between mb-6">
                    <h2 class="text-3xl font-bold text-gray-800">Detail Pesanan</h2>
                    @php
                        $statusClass = match ($order->status) {
                            'menunggu_konfirmasi' => 'bg-yellow-100 text-yellow-800',
                            'diproses' => 'bg-blue-100 text-blue-800',
                            'selesai' => 'bg-green-100 text-green-800',
                            'menunggu_pembayaran' => 'bg-orange-100 text-orange-800',
                            default => 'bg-gray-100 text-gray-800',
                        };
                    @endphp
                    <span class="px-4 py-2 inline-flex text-sm font-semibold rounded-full {{ $statusClass }}">
                        {{ ucfirst(str_replace('_', ' ', $order->status)) }}
                    </span>
                </div>

                {{-- Main Order Details --}}
                <div class="grid grid-cols-1 md:grid-cols-2 gap-y-6 gap-x-8 text-gray-700">
                    <div>
                        <div class="mb-4">
                            <h4 class="text-sm font-medium text-gray-500 uppercase">Informasi Jasa</h4>
                            <p class="mt-1 text-lg font-semibold">{{ $order->manageService->name ?? 'N/A' }}</p>
                            <p class="text-sm text-gray-500">Kategori: {{ $order->manageService->category ?? 'N/A' }}</p>
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

                    <div>
                        <div class="mb-4">
                            <h4 class="text-sm font-medium text-gray-500 uppercase">Status Teknisi</h4>
                            @if ($order->teknisi)
                                <p class="mt-1 text-lg font-semibold">{{ $order->teknisi->name }}</p>
                                <p class="text-sm text-gray-500">Ditugaskan pada {{ $order->created_at->format('d M Y') }}
                                </p>
                            @else
                                <p class="mt-1 text-lg text-gray-500">Belum ada teknisi</p>
                            @endif
                        </div>
                        <div class="mb-4">
                            <h4 class="text-sm font-medium text-gray-500 uppercase">Tanggal Pesanan</h4>
                            <p class="mt-1 text-base">{{ $order->created_at->format('d M Y') }}</p>
                            <p class="text-sm text-gray-500">Pukul: {{ $order->created_at->format('H:i') }} WIB</p>
                        </div>
                    </div>
                </div>

                {{-- Payment Section (Conditional) --}}
                @if ($order->status === 'menunggu_pembayaran')
                    <div class="mt-8 pt-6 border-t border-gray-200">
                        <h3 class="text-xl font-bold text-gray-800 mb-4">Pembayaran</h3>
                        <div class="bg-blue-50 p-6 rounded-lg border-2 border-blue-200">
                            <p class="text-lg font-medium text-blue-800 mb-4">
                                Total Biaya: <span class="font-bold">{{ $order->manageService->price }}</span>
                            </p>
                            <form action="#" method="POST">
                                @csrf
                                <div class="mb-4">
                                    <label for="payment_method" class="block text-sm font-medium text-gray-700 mb-1">Pilih
                                        Metode Pembayaran</label>
                                    <select name="payment_method" id="payment_method" required
                                        class="block w-full px-4 py-2 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition duration-200">
                                        <option value="">-- Pilih Metode --</option>
                                        <option value="cash">Tunai</option>
                                        <option value="transfer">Transfer Bank</option>
                                        <option value="ewallet">E-Wallet</option>
                                    </select>
                                </div>
                                <button type="submit"
                                    class="w-full inline-flex justify-center items-center px-6 py-3 border border-transparent rounded-lg shadow-sm text-base font-medium text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-colors duration-200">
                                    <i class="fas fa-money-bill-wave mr-2"></i> Konfirmasi Pembayaran
                                </button>
                            </form>
                        </div>
                    </div>
                @endif

                <div id="payment-info-transfer" class="mt-4 hidden">
                    <div class="bg-white p-4 rounded-lg shadow border">
                        <p class="font-semibold text-gray-700">Silakan transfer ke:</p>
                        <ul class="mt-2 text-sm text-gray-600 space-y-1">
                            <li><strong>Bank:</strong> BCA</li>
                            <li><strong>No. Rekening:</strong> 1234567890</li>
                            <li><strong>Atas Nama:</strong> PT Skillance Digital Indonesia</li>
                        </ul>

                        {{-- QR Code --}}
                        <div class="mt-4">
                            <p class="text-sm text-gray-700 mb-2">Atau scan QR code:</p>
                            <img src="{{ asset('images/qrcode_sample.png') }}" alt="QR Code" class="w-32 h-32">
                        </div>
                    </div>
                </div>

                <div id="payment-info-ewallet" class="mt-4 hidden">
                    <div class="bg-white p-4 rounded-lg shadow border">
                        <p class="font-semibold text-gray-700">Silakan kirim ke:</p>
                        <ul class="mt-2 text-sm text-gray-600 space-y-1">
                            <li><strong>e-wallet:</strong> Dana</li>
                            <li><strong>No. Dana:</strong> 082291700778</li>
                            <li><strong>Atas Nama:</strong> PT Skillance Digital Indonesia</li>
                        </ul>

                        {{-- QR Code --}}
                        <div class="mt-4">
                            <p class="text-sm text-gray-700 mb-2">Atau scan QR code:</p>
                            <img src="{{ asset('images/qrcode_sample.png') }}" alt="QR Code" class="w-32 h-32">
                        </div>
                    </div>
                </div>

                <div id="proof-upload" class="mt-4 hidden">
                    <label class="block text-sm font-medium text-gray-700 mb-1">Upload Bukti Pembayaran</label>
                    <input type="file" name="payment_proof" accept="image/*,application/pdf"
                        class="block w-full text-sm text-gray-700 border border-gray-300 rounded-lg shadow-sm focus:ring focus:ring-blue-500" />
                </div>


                {{-- Footer Actions --}}
                <div class="mt-8 pt-6 border-t border-gray-200">
                    <a href="{{ route('costumer.order_history') }}"
                        class="inline-flex items-center justify-center px-4 py-2 border border-gray-300 rounded-lg shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-colors duration-200">
                        <i class="fas fa-arrow-left mr-2"></i> Kembali ke Daftar
                    </a>
                </div>
            </div>
        </div>
    </main>
@endsection

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
                title: 'Pembayaran Berhasil!',
                text: '{{ session('success') }}',
                timer: 2500,
                showConfirmButton: false
            });
        </script>
    @endif

    <script>
        const paymentMethod = document.getElementById('payment_method');
        const paymentInfoTransfer = document.getElementById('payment-info-transfer');
        const paymentInfoEwallet = document.getElementById('payment-info-ewallet');

        paymentMethod.addEventListener('change', function() {
            if (['transfer'].includes(this.value)) {
                paymentInfoEwallet.classList.add('hidden');
                paymentInfoTransfer.classList.remove('hidden');
            } else if (['ewallet'].includes(this.value)) {
                paymentInfoTransfer.classList.add('hidden');
                paymentInfoEwallet.classList.remove('hidden');
            } else {
                paymentInfoTransfer.classList.add('hidden');
                paymentInfoEwallet.classList.add('hidden');
            }
        });

        paymentMethod.addEventListener('change', function() {
            const isTransfer = ['transfer', 'ewallet'].includes(this.value);
            document.getElementById('proof-upload').classList.toggle('hidden', !isTransfer);
        });
    </script>

@endsection
