{{-- resources/views/teknisi/pesanan_masuk.blade.php --}}
@extends('layout.app')

@section('title', 'Pesanan Masuk')
@section('nav', 'Teknisi Panel')

@section('main')
    <main class="flex-1 overflow-x-hidden overflow-y-auto bg-gray-100 p-6">
        <div class="bg-white p-6 rounded-lg shadow-md">
            <h2 class="text-2xl font-bold mb-4 text-gray-800">Daftar Pesanan Masuk</h2>

            {{-- Filter/Search Form (Opsional, bisa ditambahkan nanti) --}}
            {{-- <form action="{{ route('teknisi.incoming_orders') }}" method="GET" class="mb-6 bg-gray-50 p-4 rounded-lg shadow-sm flex flex-wrap gap-4 items-end">
                <div>
                    <label for="search" class="block text-sm font-medium text-gray-700">Cari Pesanan</label>
                    <input type="text" name="search" id="search"
                        value="{{ request('search') }}"
                        placeholder="ID Pesanan, Pelanggan..."
                        class="mt-1 p-2 border border-gray-300 rounded focus:outline-none focus:ring focus:border-blue-300">
                </div>
                <div>
                    <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold px-4 py-2 rounded">
                        Cari
                    </button>
                    @if (request('search'))
                        <a href="{{ route('teknisi.incoming_orders') }}" class="text-sm text-blue-500 hover:underline ml-2">Reset</a>
                    @endif
                </div>
            </form> --}}

            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th scope="col"
                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">ID Pesanan
                            </th>
                            <th scope="col"
                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Pelanggan
                            </th>
                            <th scope="col"
                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Jasa</th>
                            <th scope="col"
                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Alamat
                            </th>
                            <th scope="col"
                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status
                            </th>
                            <th scope="col"
                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tanggal Pesan
                            </th>
                            <th scope="col"
                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        {{-- Contoh data statis. Ganti dengan @foreach loop dari controller --}}
                        {{-- @forelse($incomingOrders as $order) --}}
                        @foreach ($order as $d)
                            <tr>
                            <td class="px-6 py-4 whitespace-nowrap">#{{ str_pad($d->id, 3, '0', STR_PAD_LEFT) }}    </td>
                            <td class="px-6 py-4 whitespace-nowrap">{{ $d->user->name }}</td>
                            <td class="px-6 py-4 whitespace-nowrap">{{ $d->manageService->name }}</td>
                            <td class="px-6 py-4 whitespace-nowrap">{{ $d->address }}</td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-yellow-100 text-yellow-800">{{ $d->status }}</span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">{{ $d->appointment_date }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                <a href="{{ route('teknisi.take', $d->id) }}" class="text-indigo-600 hover:text-indigo-900 mr-2">Ambil</a>
                                <a href="{{ route('teknisi.show', $d->id) }}" class="text-gray-600 hover:text-gray-900">Detail</a>
                            </td>
                        </tr>
                        @endforeach
                        {{-- @empty
                            <tr>
                                <td colspan="7" class="px-6 py-4 text-center text-gray-500">Tidak ada pesanan masuk.</td>
                            </tr>
                        @endforelse --}}
                    </tbody>
                </table>
            </div>
            {{-- Paginasi (jika menggunakan) --}}
            {{-- <div class="mt-4">
                {{ $incomingOrders->links() }}
            </div> --}}
        </div>
    </main>
@endsection