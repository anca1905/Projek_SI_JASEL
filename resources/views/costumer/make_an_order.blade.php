@extends('layout.app')

@section('title', 'Buat Pesanan Jasa')
@section('nav', 'Costumer Panel')

@section('main')
    <main class="flex-1 overflow-x-hidden overflow-y-auto bg-gray-50 p-6">
        <div class="space-y-8 max-w-4xl mx-auto">

            {{-- Form Pemesanan Jasa --}}
            <div class="bg-white p-8 rounded-2xl shadow-xl border border-gray-200">
                <div class="text-center mb-6">
                    <h3 class="text-3xl font-bold text-gray-800 mb-2">Form Pemesanan Jasa</h3>
                    <p class="text-gray-500">Isi formulir di bawah ini untuk membuat pesanan baru.</p>
                </div>
                <form action="{{ route('costumer.store_order') }}" method="POST" class="space-y-6">
                    @csrf
                    <div>
                        <label for="service_type" class="block text-gray-700 text-sm font-medium mb-1">Jenis Jasa</label>
                        <select id="service_type" name="service_type"
                            class="block w-full px-4 py-2 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition duration-200">
                            <option value="">Pilih Jenis Jasa</option>
                            @foreach ($data as $service)
                                <option value="{{ $service->id }}" {{ old('service_type') == $service->id ? 'selected' : '' }}>
                                    {{ $service->name }}</option>
                            @endforeach
                        </select>
                        {{-- @error('service_type') --}}
                            <p class="text-red-500 text-xs italic mt-1 hidden">Jenis jasa wajib dipilih.</p>
                        {{-- @enderror --}}
                    </div>

                    <div>
                        <label for="device_problem" class="block text-gray-700 text-sm font-medium mb-1">Deskripsi Masalah</label>
                        <textarea id="device_problem" name="device_problem" rows="4"
                            class="block w-full px-4 py-2 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition duration-200"
                            placeholder="Jelaskan masalah perangkat Anda secara detail...">{{ old('device_problem') }}</textarea>
                        {{-- @error('device_problem') --}}
                            <p class="text-red-500 text-xs italic mt-1 hidden">Deskripsi masalah minimal 10 karakter.</p>
                        {{-- @enderror --}}
                    </div>

                    <div>
                        <label for="address" class="block text-gray-700 text-sm font-medium mb-1">Alamat Lengkap</label>
                        <input type="text" id="address" name="address" value="{{ old('address') }}"
                            class="block w-full px-4 py-2 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition duration-200"
                            placeholder="Masukkan alamat lengkap Anda">
                        {{-- @error('address') --}}
                            <p class="text-red-500 text-xs italic mt-1 hidden">Alamat lengkap wajib diisi.</p>
                        {{-- @enderror --}}
                    </div>

                    <div>
                        <label for="appointment_date" class="block text-gray-700 text-sm font-medium mb-1">Tanggal Janji Temu</label>
                        <input type="date" id="appointment_date" name="appointment_date" value="{{ old('appointment_date') }}"
                            class="block w-full px-4 py-2 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition duration-200">
                        {{-- @error('appointment_date') --}}
                            <p class="text-red-500 text-xs italic mt-1 hidden">Tanggal janji temu tidak boleh di masa lalu.</p>
                        {{-- @enderror --}}
                    </div>

                    <div>
                        <button type="submit"
                            class="w-full bg-blue-600 hover:bg-blue-700 text-white py-3 rounded-lg font-semibold shadow-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition duration-200">
                            Buat Pesanan
                        </button>
                    </div>
                </form>
            </div>

            {{-- Riwayat Pesanan Anda --}}
            <div class="bg-white p-8 rounded-2xl shadow-xl border border-gray-200">
                <h3 class="text-2xl font-bold text-gray-800 mb-4">Riwayat Pesanan Anda</h3>
                <div class="overflow-x-auto rounded-lg shadow-sm border border-gray-200">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th scope="col"
                                    class="px-6 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">ID Pesanan</th>
                                <th scope="col"
                                    class="px-6 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Jasa</th>
                                <th scope="col"
                                    class="px-6 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Status</th>
                                <th scope="col"
                                    class="px-6 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Tanggal</th>
                                <th scope="col"
                                    class="px-6 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @foreach ($orders as $d)
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">#{{ str_pad($d->id, 5, '0', STR_PAD_LEFT) }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $d->user->name }}</td>
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
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $d->created_at->format('Y-m-d') }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                        <a href="{{ route('costumer.order_detail', $d->id) }}" class="text-blue-600 hover:text-blue-900 mr-4">Detail</a>
                                        @if ($d->status === 'menunggu_konfirmasi')
                                            <button class="text-red-600 hover:text-red-900 focus:outline-none">Batal</button>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                            @if ($orders->isEmpty())
                                <tr>
                                    <td colspan="5" class="text-center py-4 text-gray-500">Tidak ada pesanan yang ditemukan.</td>
                                </tr>
                            @endif
                        </tbody>
                    </table>
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