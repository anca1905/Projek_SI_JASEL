@extends('layout.app')
@section('title', 'Selamat Datang, Admin!')
@section('nav', 'Admin Panel')
@section('main')
    <main class="flex-1 overflow-x-hidden overflow-y-auto bg-gray-100 p-6">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-6">
            <div class="bg-white p-6 rounded-lg shadow-md">
                <h3 class="text-xl font-semibold mb-2">Total Pesanan</h3>
                <p class="text-3xl font-bold text-blue-600">{{ $total }}</p>
            </div>
            <div class="bg-white p-6 rounded-lg shadow-md">
                <h3 class="text-xl font-semibold mb-2">Pesanan Baru</h3>
                <p class="text-3xl font-bold text-green-600">{{ $newOrdersCount }}</p>
            </div>
            <div class="bg-white p-6 rounded-lg shadow-md">
                <h3 class="text-xl font-semibold mb-2">Teknisi Aktif</h3>
                <p class="text-3xl font-bold text-purple-600">{{ $teknisiCount }}</p>
            </div>
        </div>

        <div class="bg-white p-6 rounded-lg shadow-md">
            <h3 class="text-xl font-semibold mb-4">Daftar Pesanan</h3>

            <form action="{{ route('admin.admin.index') }}" method="get">
                <div class="mb-4 flex flex-wrap gap-4 items-end">
                    <div>
                        <label for="filter_status" class="block text-gray-700 text-sm font-bold mb-2">Filter
                            Status:</label>
                        <select id="filter_status" name="filter_status" onchange="applyFilters()"
                            class="shadow border rounded py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                            <option value="all" {{ request('status') == 'all' ? 'selected' : '' }}>Semua Status
                            </option>
                            <option value="Menunggu Konfirmasi"
                                {{ request('status') == 'Menunggu Konfirmasi' ? 'selected' : '' }}>Menunggu
                                Konfirmasi</option>
                            <option value="Dalam Proses" {{ request('status') == 'Dalam Proses' ? 'selected' : '' }}>
                                Dalam Proses</option>
                            <option value="Selesai" {{ request('status') == 'Selesai' ? 'selected' : '' }}>Selesai
                            </option>
                            <option value="Dibatalkan" {{ request('status') == 'Dibatalkan' ? 'selected' : '' }}>
                                Dibatalkan</option>
                        </select>
                    </div>
                    <div>
                        <label for="filter_technician" class="block text-gray-700 text-sm font-bold mb-2">Filter
                            Teknisi:</label>
                        <select id="filter_technician" name="filter_technician" onchange="applyFilters()"
                            class="shadow border rounded py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                            <option value="all" {{ request('technician') == 'all' ? 'selected' : '' }}>Semua
                                Teknisi</option>
                            <option value="1" {{ request('technician') == '1' ? 'selected' : '' }}>Teknisi A
                            </option>
                            <option value="2" {{ request('technician') == '2' ? 'selected' : '' }}>Teknisi B
                            </option>
                            <option value="3" {{ request('technician') == '3' ? 'selected' : '' }}>Teknisi C
                            </option>
                        </select>
                    </div>
                </div>
            </form>
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th scope="col"
                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            ID Pesanan</th>
                        <th scope="col"
                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Pelanggan</th>
                        <th scope="col"
                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Jasa</th>
                        <th scope="col"
                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Status</th>
                        <th scope="col"
                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Teknisi</th>
                        <th scope="col"
                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Tanggal</th>
                        <th scope="col"
                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Aksi</th>
                    </tr>
                </thead>
                {{-- <tbody class="bg-white divide-y divide-gray-200">
                    <?php
                    
                    ?>
                    @foreach ($data as $d)
                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap">#{{ str_pad($d->id, 3, '0', STR_PAD_LEFT) }}</td>
                            <td class="px-6 py-4 whitespace-nowrap">{{ $d->user->name }}</td>
                            <td class="px-6 py-4 whitespace-nowrap">{{ $d->manageService->name }}</td>
                            <td class="px-6 py-4 whitespace-nowrap"><span
                                    class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full {{ $d->status == 'dibatalkan' ? 'bg-red-100 text-red-800' : ($d->status == 'selesai' ? 'bg-green-100 text-green-800' : ($d->status == 'menunggu_konfirmasi' ? 'bg-yellow-100 text-yellow-800' : 'bg-blue-100 text-blue-800')) }}">{{ $d->status }}</span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">{{ $d->teknisi->name ?? 'Belum Ditugaskan' }}</td>
                            <td class="px-6 py-4 whitespace-nowrap">{{ $d->appointment_date }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                <a href="{{ route('admin.admin.show', $d->id) }}"><button
                                        class="text-blue-600 hover:text-blue-900 mr-2">Detail</button></a>
                            </td>
                        </tr>
                    @endforeach

                </tbody> --}}
                <tbody class="bg-white divide-y divide-gray-200" id="order-table-body" data-url="{{ route('admin.admin.index') }} " data-action="{{ route('admin.admin.show', [':id']) }}">
                    <!-- Data will be populated here by JavaScript -->
                </tbody>
            </table>
        </div>
    </main>
@endsection
@section('js')
<script src="{{ asset('js/jquery-3.7.1.min.js') }}"></script>
    <script src="{{ asset('js/admin/dashboard.js') }}"></script>
@endsection
