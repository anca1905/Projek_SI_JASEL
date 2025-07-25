@extends('layout.app')
@section('title', 'Teknisi Panel')
@section('main')
    <main class="flex-1 overflow-x-hidden overflow-y-auto bg-gray-100 p-6">
        <div class="bg-white p-6 rounded-lg shadow-md">
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
                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    <tr>
                        <td class="px-6 py-4 whitespace-nowrap">#001</td>
                        <td class="px-6 py-4 whitespace-nowrap">Budi Santoso</td>
                        <td class="px-6 py-4 whitespace-nowrap">Service Laptop</td>
                        <td class="px-6 py-4 whitespace-nowrap">Jl. Melati No. 123</td>
                        <td class="px-6 py-4 whitespace-nowrap"><span
                                class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-yellow-100 text-yellow-800">Menunggu
                                Konfirmasi</span></td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                            <button class="text-indigo-600 hover:text-indigo-900 mr-2">Ambil</button>
                            <button class="text-gray-600 hover:text-gray-900">Detail</button>
                        </td>
                    </tr>
                    <tr>
                        <td class="px-6 py-4 whitespace-nowrap">#003</td>
                        <td class="px-6 py-4 whitespace-nowrap">Joko Susilo</td>
                        <td class="px-6 py-4 whitespace-nowrap">Instalasi CCTV</td>
                        <td class="px-6 py-4 whitespace-nowrap">Perumahan Indah Blok C</td>
                        <td class="px-6 py-4 whitespace-nowrap"><span
                                class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-yellow-100 text-yellow-800">Menunggu
                                Konfirmasi</span></td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                            <button class="text-indigo-600 hover:text-indigo-900 mr-2">Ambil</button>
                            <button class="text-gray-600 hover:text-gray-900">Detail</button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </main>
@endsection
