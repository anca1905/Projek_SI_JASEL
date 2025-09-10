@extends('layout.app')

@section('title', 'Selamat Datang, ' . $user->name . '!')
@section('nav', 'Admin Panel')

@section('main')
    <div class="space-y-8">
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
            <div class="bg-white p-6 rounded-xl shadow-lg border border-gray-200 flex items-center justify-between">
                <div>
                    <h3 class="text-lg font-semibold text-gray-500">Total Pesanan</h3>
                    <p class="text-4xl font-bold text-blue-700 mt-1">{{ $total }}</p>
                </div>
                <div class="p-3 bg-blue-100 rounded-full text-blue-600">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01" />
                    </svg>
                </div>
            </div>

            <div class="bg-white p-6 rounded-xl shadow-lg border border-gray-200 flex items-center justify-between">
                <div>
                    <h3 class="text-lg font-semibold text-gray-500">Pesanan Baru</h3>
                    <p class="text-4xl font-bold text-green-700 mt-1">{{ $newOrdersCount }}</p>
                </div>
                <div class="p-3 bg-green-100 rounded-full text-green-600">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                    </svg>
                </div>
            </div>

            <div class="bg-white p-6 rounded-xl shadow-lg border border-gray-200 flex items-center justify-between">
                <div>
                    <h3 class="text-lg font-semibold text-gray-500">Teknisi Aktif</h3>
                    <p class="text-4xl font-bold text-indigo-700 mt-1">{{ $teknisiCount }}</p>
                </div>
                <div class="p-3 bg-indigo-100 rounded-full text-indigo-600">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M13 10V3L4 14h7v7l9-11h-7z" />
                    </svg>
                </div>
            </div>
        </div>

        <div class="bg-white p-8 rounded-xl shadow-lg border border-gray-200">
            <h3 class="text-2xl font-bold text-gray-800 mb-6">Daftar Pesanan</h3>

            <form action="{{ route('admin.admin.index') }}" method="get" class="mb-6">
                <div class="flex flex-wrap items-end gap-4">
                    <div class="flex-1 min-w-[200px]">
                        <label for="filter_status" class="block text-sm font-medium text-gray-700 mb-1">Filter
                            Status:</label>
                        <select id="filter_status" name="filter_status" 
                            class="mt-1 p-2 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 transition duration-150 ease-in-out sm:text-sm">
                            <option value="">Semua Status</option>
                            <option value="menunggu_konfirmasi">Menunggu Konfirmasi</option>
                            <option value="Dalam Proses">Dalam Proses</option>
                            <option value="Selesai">Selesai</option>
                            <option value="Dibatalkan">Dibatalkan</option>
                        </select>
                    </div>
                    <div class="flex-1 min-w-[200px]">
                        <label for="filter_technician" class="block text-sm font-medium text-gray-700 mb-1">Filter
                            Teknisi:</label>
                        <select id="filter_technician" name="filter_technician" 
                            class="mt-1 p-2 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 transition duration-150 ease-in-out sm:text-sm">
                            <option value="">Semua Teknisi</option>
                            @foreach ($teknisiList as $d)
                                <option value="{{ $d->id }}">{{ $d->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </form>

            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th scope="col"
                                class="px-6 py-4 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">
                                ID Pesanan</th>
                            <th scope="col"
                                class="px-6 py-4 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">
                                Pelanggan</th>
                            <th scope="col"
                                class="px-6 py-4 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">
                                Jasa</th>
                            <th scope="col"
                                class="px-6 py-4 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">
                                Status</th>
                            <th scope="col"
                                class="px-6 py-4 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">
                                Teknisi</th>
                            <th scope="col"
                                class="px-6 py-4 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">
                                Tanggal</th>
                            <th scope="col"
                                class="px-6 py-4 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">
                                Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200 text-gray-700" id="order-table-body"
                        data-url="{{ route('admin.admin.index') }}" data-action="{{ route('admin.admin.show', [':id']) }}">
                        {{-- The provided code is already using JavaScript to populate the table, so this section is left for the dynamic content. I've commented out the static PHP loop to reflect this. --}}
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script src="{{ asset('js/admin/dashboard.js') }}"></script>
@endsection
