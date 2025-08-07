{{-- resources/views/customer/order_detail.blade.php --}}
@extends('layout.app')

@section('title', 'Detail Pesanan #' . $order->id)
@section('nav', 'Panel Pelanggan')

@section('main')
    <main class="flex-1 overflow-x-hidden overflow-y-auto bg-gray-50 p-6">
        <div class="max-w-4xl mx-auto">
            <div class="bg-white p-8 rounded-2xl shadow-xl border border-gray-200">

                {{-- Header with Order ID and Status --}}
                <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between mb-8 pb-4 border-b border-gray-200">
                    <div class="flex-1 mb-4 sm:mb-0">
                        <h2 class="text-3xl font-bold text-gray-800">Detail Pesanan</h2>
                        <span class="text-lg text-gray-600">ID Pesanan: #{{ str_pad($order->id, 5, '0', STR_PAD_LEFT) }}</span>
                    </div>
                    @php
                        $statusClass = match ($order->status) {
                            'menunggu_konfirmasi' => 'bg-yellow-100 text-yellow-800',
                            'diproses' => 'bg-blue-100 text-blue-800',
                            'selesai' => 'bg-green-100 text-green-800',
                            'dibatalkan' => 'bg-red-100 text-red-800',
                            'menunggu_pembayaran' => 'bg-orange-100 text-orange-800',
                            default => 'bg-gray-100 text-gray-800',
                        };
                    @endphp
                    <span class="px-4 py-2 inline-flex text-sm font-semibold rounded-full {{ $statusClass }}">
                        {{ ucfirst(str_replace('_', ' ', $order->status)) }}
                    </span>
                </div>

                {{-- Main Order Details --}}
                <div class="grid grid-cols-1 md:grid-cols-2 gap-y-8 gap-x-10 text-gray-700">
                    <div>
                        <div class="space-y-6">
                            <div class="p-4 bg-gray-50 rounded-xl">
                                <h4 class="text-sm font-medium text-gray-500 uppercase mb-1">Informasi Jasa</h4>
                                <p class="text-xl font-bold text-gray-800">{{ $order->manageService->name ?? 'N/A' }}</p>
                                <p class="text-sm text-gray-500">Kategori: {{ $order->manageService->category ?? 'N/A' }}</p>
                            </div>
                            <div class="p-4 bg-gray-50 rounded-xl">
                                <h4 class="text-sm font-medium text-gray-500 uppercase mb-1">Alamat Service</h4>
                                <p class="text-base">{{ $order->address }}</p>
                            </div>
                            <div class="p-4 bg-gray-50 rounded-xl">
                                <h4 class="text-sm font-medium text-gray-500 uppercase mb-1">Deskripsi Masalah</h4>
                                <p class="text-base">{{ $order->device_problem }}</p>
                            </div>
                        </div>
                    </div>

                    <div>
                        <div class="space-y-6">
                            <div class="p-4 bg-gray-50 rounded-xl">
                                <h4 class="text-sm font-medium text-gray-500 uppercase mb-1">Status Teknisi</h4>
                                @if ($order->technician)
                                    <p class="text-xl font-bold text-gray-800">{{ $order->technician->name }}</p>
                                    <p class="text-sm text-gray-500">Ditugaskan pada {{ $order->assigned_at->format('d M Y') }}</p>
                                @else
                                    <p class="text-lg text-gray-500">Belum ada teknisi</p>
                                @endif
                            </div>
                            <div class="p-4 bg-gray-50 rounded-xl">
                                <h4 class="text-sm font-medium text-gray-500 uppercase mb-1">Waktu Pesanan</h4>
                                <p class="text-base">{{ $order->created_at->format('d M Y') }}</p>
                                <p class="text-sm text-gray-500">Pukul: {{ $order->created_at->format('H:i') }} WIB</p>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Payment Section (Conditional) --}}
                @if ($order->status === 'menunggu_pembayaran')
                    <div class="mt-8 pt-6 border-t border-gray-200">
                        <h3 class="text-xl font-bold text-gray-800 mb-4">Pembayaran</h3>
                        <div class="bg-blue-50 p-6 rounded-lg border-2 border-blue-200">
                            <p class="text-xl font-medium text-blue-800 mb-6">
                                Total Biaya: <span class="font-extrabold">Rp. {{ number_format($order->total_price, 0, ',', '.') }}</span>
                            </p>
                            <form action="{{ route('costumer.paypay', $order->id) }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="mb-6">
                                    <label for="payment_method" class="block text-sm font-medium text-gray-700 mb-1">Pilih Metode Pembayaran</label>
                                    <select name="payment_method" id="payment_method" required
                                        class="block w-full px-4 py-2 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition duration-200">
                                        <option value="">-- Pilih Metode --</option>
                                        <option value="cash">Tunai (Bayar Langsung ke Teknisi)</option>
                                        <option value="transfer">Transfer Bank</option>
                                        <option value="ewallet">E-Wallet (Dana/Ovo/Gopay)</option>
                                    </select>
                                </div>

                                {{-- Dynamic Payment Info --}}
                                <div id="payment-info-container" class="space-y-4 mb-6">
                                    <div id="payment-info-transfer" class="hidden bg-white p-4 rounded-lg border border-gray-200 shadow-sm">
                                        <p class="font-semibold text-gray-700">Silakan transfer ke:</p>
                                        <ul class="mt-2 text-sm text-gray-600 space-y-1">
                                            <li><strong>Bank:</strong> BCA</li>
                                            <li><strong>No. Rekening:</strong> 1234567890</li>
                                            <li><strong>Atas Nama:</strong> PT Skillance Digital Indonesia</li>
                                        </ul>
                                    </div>
                                    <div id="payment-info-ewallet" class="hidden bg-white p-4 rounded-lg border border-gray-200 shadow-sm">
                                        <p class="font-semibold text-gray-700">Silakan kirim ke:</p>
                                        <ul class="mt-2 text-sm text-gray-600 space-y-1">
                                            <li><strong>E-Wallet:</strong> Dana</li>
                                            <li><strong>No. Dana:</strong> 082291700778</li>
                                            <li><strong>Atas Nama:</strong> PT Skillance Digital Indonesia</li>
                                        </ul>
                                    </div>
                                </div>

                                {{-- Proof Upload Section --}}
                                <div id="proof-upload" class="hidden mb-6">
                                    <label for="payment_proof" class="block text-sm font-medium text-gray-700 mb-1">Upload Bukti Pembayaran</label>
                                    <input type="file" name="payment_proof" id="payment_proof" accept="image/*"
                                        class="block w-full text-sm text-gray-700 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100 cursor-pointer border border-gray-300 rounded-lg shadow-sm" />
                                </div>

                                <button type="submit"
                                    class="w-full inline-flex justify-center items-center px-6 py-3 border border-transparent rounded-lg shadow-sm text-base font-medium text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-colors duration-200">
                                    <i class="fas fa-paper-plane mr-2"></i> Kirim Bukti Pembayaran
                                </button>
                            </form>
                        </div>
                    </div>
                @endif

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
        document.addEventListener('DOMContentLoaded', function() {
            const paymentMethodSelect = document.getElementById('payment_method');
            const transferInfo = document.getElementById('payment-info-transfer');
            const ewalletInfo = document.getElementById('payment-info-ewallet');
            const proofUpload = document.getElementById('proof-upload');
            const submitButton = document.querySelector('#proof-upload').closest('form').querySelector('button[type="submit"]');

            paymentMethodSelect.addEventListener('change', function() {
                const selectedMethod = this.value;
                
                // Hide all dynamic sections first
                transferInfo.classList.add('hidden');
                ewalletInfo.classList.add('hidden');
                proofUpload.classList.add('hidden');
                submitButton.textContent = 'Konfirmasi Pembayaran';
                submitButton.querySelector('i').className = 'fas fa-money-bill-wave mr-2';

                if (selectedMethod === 'transfer') {
                    transferInfo.classList.remove('hidden');
                    proofUpload.classList.remove('hidden');
                    submitButton.textContent = 'Kirim Bukti Pembayaran';
                    submitButton.querySelector('i').className = 'fas fa-paper-plane mr-2';
                } else if (selectedMethod === 'ewallet') {
                    ewalletInfo.classList.remove('hidden');
                    proofUpload.classList.remove('hidden');
                    submitButton.textContent = 'Kirim Bukti Pembayaran';
                    submitButton.querySelector('i').className = 'fas fa-paper-plane mr-2';
                } else if (selectedMethod === 'cash') {
                    // For cash payments, we don't need payment info or proof upload
                }
            });
        });
    </script>
@endsection
