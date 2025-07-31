{{-- resources/views/teknisi/pesanan_saya.blade.php --}}
@extends('layout.app')

@section('title', 'Pesanan Saya')
@section('nav', 'Teknisi Panel')

@section('main')
    <main class="flex-1 overflow-x-hidden overflow-y-auto bg-gray-100 p-6">
        <div class="bg-white p-6 rounded-lg shadow-md">
            <h2 class="text-2xl font-bold mb-4 text-gray-800">Daftar Pesanan Saya</h2>

            {{-- Filter/Search Form --}}
            <form action="{{ route('teknisi.my_orders') }}" method="GET"
                class="mb-6 bg-gray-50 p-4 rounded-lg shadow-sm flex flex-wrap gap-4 items-end">
                <div>
                    <label for="status" class="block text-sm font-medium text-gray-700">Filter Status</label>
                    <select name="status" id="status"
                        class="mt-1 p-2 border border-gray-300 rounded focus:outline-none focus:ring focus:border-blue-300">
                        <option value="">Semua Status</option>
                        <option value="diproses" {{ request('status') == 'diproses' ? 'selected' : '' }}>Dalam
                            Proses</option>
                        <option value="selesai" {{ request('status') == 'selesai' ? 'selected' : '' }}>Selesai</option>
                    </select>
                </div>
                <div>
                    <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold px-4 py-2 rounded">
                        Filter
                    </button>
                    @if (request('status'))
                        <a href="{{ route('teknisi.my_orders') }}"
                            class="text-sm text-blue-500 hover:underline ml-2">Reset</a>
                    @endif
                </div>
            </form>

            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th scope="col"
                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">ID
                                Pesanan
                            </th>
                            <th scope="col"
                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Pelanggan
                            </th>
                            <th scope="col"
                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Jasa
                            </th>
                            <th scope="col"
                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Status
                            </th>
                            <th scope="col"
                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Tanggal Ditugaskan
                            </th>
                            <th scope="col"
                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi
                            </th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        {{-- Contoh data statis. Ganti dengan @foreach loop dari controller --}}
                        {{-- @forelse($myOrders as $order) --}}
                        @foreach ($orders as $order)
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap">{{ $order->id }}</td>
                                <td class="px-6 py-4 whitespace-nowrap">{{ $order->user->name }}</td>
                                <td class="px-6 py-4 whitespace-nowrap">{{ $order->manageService->name }}</td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span
                                        class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full {{ $order->status == 'selesai' ? 'bg-green-100 text-green-800' : ( $order->status == 'diproses' ? 'bg-blue-100 text-blue-800' : 'bg-red-100 text-red-800' ) }}">
                                        {{ ucfirst($order->status) }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">{{ $order->created_at->format('Y-m-d') }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                    @if ($order->status == 'diproses')
                                        <a href="{{ route('teknisi.complete', $order->id) }}"
                                            class="text-green-600 hover:text-green-900 mr-2">Selesai</a>
                                        <a href="{{ route('teknisi.cancel', $order->id) }}"
                                            class="text-red-600 hover:text-red-900 mr-2">Batalkan</a>
                                    @endif
                                    <a href="{{ route('teknisi.show', $order->id) }}"
                                        class="text-gray-600 hover:text-gray-900">Detail</a>
                                </td>
                            </tr>
                        @endforeach
                        {{-- @empty
                            <tr>
                                <td colspan="6" class="px-6 py-4 text-center text-gray-500">Belum ada pesanan yang ditugaskan kepada Anda.</td>
                            </tr>
                        @endforelse --}}
                    </tbody>
                </table>
            </div>
            {{-- Paginasi (jika menggunakan) --}}
            {{-- <div class="mt-4">
                {{ $myOrders->links() }}
            </div> --}}
        </div>
    </main>
@endsection
