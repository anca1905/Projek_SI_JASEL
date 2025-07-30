@extends('layout.app')
@section('title', 'Buat Pesanan Jasa')
@section('nav', 'Costumer Panel')
@section('main')
    <main class="flex-1 overflow-x-hidden overflow-y-auto bg-gray-100 p-6">
        <div class="bg-white p-8 rounded-lg shadow-md w-full max-w-2xl mx-auto">
            <h3 class="text-xl font-semibold mb-6 text-center">Form Pemesanan Jasa</h3>
            <form action="{{ route('costumer.store_order') }}" method="POST">
                @csrf
                <div class="mb-4">
                    <label for="service_type" class="block text-gray-700 text-sm font-bold mb-2">Jenis Jasa</label>
                    <select id="service_type" name="service_type"
                        class="shadow border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline ">
                        <option value="">Pilih Jenis Jasa</option>
                        @foreach ($data as $service)
                            <option value="{{ $service->id }}" {{ old('service_type') == $service->id ? 'selected' : '' }}>
                                {{ $service->name }}</option>
                        @endforeach
                    </select>
                    <p class="text-red-500 text-xs italic mt-1 hidden">Jenis jasa wajib dipilih.</p>
                </div>

                <div class="mb-4">
                    <label for="device_problem" class="block text-gray-700 text-sm font-bold mb-2">Deskripsi Masalah</label>
                    <textarea id="device_problem" name="device_problem" rows="4"
                        class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline   "
                        placeholder="Jelaskan masalah perangkat Anda secara detail...">{{ old('device_problem') }}</textarea>
                    <p class="text-red-500 text-xs italic mt-1 hidden">Deskripsi masalah minimal 10 karakter.</p>
                </div>

                <div class="mb-4">
                    <label for="address" class="block text-gray-700 text-sm font-bold mb-2">Alamat Lengkap</label>
                    <input type="text" id="address" name="address" value="{{ old('address') }}"
                        class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                        placeholder="Masukkan alamat lengkap Anda">
                    <p class="text-red-500 text-xs italic mt-1 hidden">Alamat lengkap wajib diisi.</p>
                </div>

                <div class="mb-6">
                    <label for="appointment_date" class="block text-gray-700 text-sm font-bold mb-2">Tanggal Janji
                        Temu</label>
                    <input type="date" id="appointment_date" name="appointment_date"
                        value="{{ old('appointment_date') }}"
                        class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                    <p class="text-red-500 text-xs italic mt-1 hidden">Tanggal janji temu tidak boleh di masa lalu.</p>
                </div>

                <div class="flex items-center justify-between">
                    <button type="submit"
                        class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline w-full">
                        Buat Pesanan
                    </button>
                </div>
            </form>
        </div>

        <div class="bg-white p-6 rounded-lg shadow-md mt-6">
            <h3 class="text-xl font-semibold mb-4">Riwayat Pesanan Anda</h3>
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th scope="col"
                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">ID
                            Pesanan</th>
                        <th scope="col"
                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Jasa</th>
                        <th scope="col"
                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status
                        </th>
                        <th scope="col"
                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tanggal
                        </th>
                        <th scope="col"
                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @foreach ($orders as $d)
                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap">#{{ str_pad($d->id, 5, '0', STR_PAD_LEFT) }}</td>
                            <td class="px-6 py-4 whitespace-nowrap">{{ $d->user->name }}</td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                @php
                                    $statusClass = match ($d->status) {
                                        'menunggu_konfirmasi' => 'bg-yellow-100 text-yellow-800',
                                        'diproses' => 'bg-blue-100 text-blue-800',
                                        'selesai' => 'bg-green-100 text-green-800',
                                        'dibatalkan' => 'bg-red-100 text-red-800',
                                        default => 'bg-gray-100 text-gray-800',
                                    };
                                @endphp
                                <span
                                    class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full {{ $statusClass }}">
                                    {{ ucfirst(str_replace('_', ' ', $d->status)) }}
                                </span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">{{ $d->created_at->format('Y-m-d') }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                <a href="{{ route('costumer.order_detail', $d->id) }}" class="text-blue-600 hover:text-blue-900 mr-2">Detail</a>
                                @if ($d->status === 'menunggu_konfirmasi')
                                    <button class="text-red-600 hover:text-red-900">Batal</button>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                    @if ($orders->isEmpty())
                        <tr>
                            <td colspan="5" class="text-center py-4">Tidak ada pesanan yang ditemukan.</td>
                        </tr>
                    @endif
                </tbody>
            </table>
        </div>
    </main>
@endsection
