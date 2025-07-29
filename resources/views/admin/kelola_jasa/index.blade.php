{{-- resources/views/admin/kelola_jasa.blade.php --}}
@extends('layout.app')

@section('title', 'Kelola Jasa')
@section('nav', 'Admin Panel')

@section('main')
    <main class="flex-1 overflow-x-hidden overflow-y-auto bg-gray-100 p-6">
        {{-- Success/Error Messages --}}
        @if (session('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
                <strong class="font-bold">Sukses!</strong>
                <span class="block sm:inline">{{ session('success') }}</span>
            </div>
        @endif

        @if (session('error'))
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4" role="alert">
                <strong class="font-bold">Error!</strong>
                <span class="block sm:inline">{{ session('error') }}</span>
            </div>
        @endif

        <div class="bg-white p-6 rounded-lg shadow-md">
            <div class="flex flex-wrap justify-between items-center mb-4 gap-4">
                {{-- Left: Title + Add Button --}}
                <div class="flex items-center space-x-4">
                    <h3 class="text-xl font-semibold">Daftar Jasa</h3>
                    <a href="{{ route('admin.adminkelola_jasa.create') }}"
                        class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">
                        Tambah Jasa Baru
                    </a>
                </div>

                {{-- Right: Search Form --}}
                <form action="{{ route('admin.adminkelola_jasa.index') }}" method="GET"
                    class="flex items-center space-x-2">
                    {{-- Input Search --}}
                    <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari nama jasa..."
                        class="border rounded px-3 py-2 focus:outline-none focus:ring focus:border-blue-300">

                    {{-- Tombol Submit --}}
                    <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold px-4 py-2 rounded">
                        Cari
                    </button>

                    {{-- Tombol Reset --}}
                    @if (request('search'))
                        <a href="{{ route('teknisiservice.index') }}" class="text-sm text-blue-500 hover:underline ml-2">
                            Reset
                        </a>
                    @endif
                </form>
            </div>

            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">ID
                            </th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nama
                                Jasa
                            </th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Harga
                            </th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi
                            </th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        {{-- Example static data --}}
                        <?php
                        $no = 1;
                        ?>

                        @foreach ($data as $d)
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap">{{ $no++ }}</td>
                                <td class="px-6 py-4 whitespace-nowrap">{{ $d->name }}</td>
                                <td class="px-6 py-4 whitespace-nowrap">{{ $d->price }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                    <a href="{{ route('admin.adminkelola_jasa.edit', $d->id) }}"
                                        class="text-indigo-600 hover:text-indigo-900 mr-2">
                                        Edit
                                    </a>
                                    <form action="{{ route('admin.adminkelola_jasa.destroy', $d->id) }}" method="POST"
                                        class="inline-block"
                                        onsubmit="return confirm('Apakah Anda yakin ingin menghapus jasa Service Laptop?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-600 hover:text-red-900">Hapus</button>
                                    </form>
                                </td>
                            </tr>
                            @empty($data)
                                <tr>
                                    <td colspan="4" class="px-6 py-4 text-center text-gray-500">Tidak ada jasa yang
                                        ditemukan.
                                    </td>
                                </tr>
                            @endempty
                        @endforeach
                    </tbody>
                </table>
                <br>
                <div class="mt-4 flex justify-between items-center">
                    {{-- Placeholder for pagination details --}}
                    <span class="text-sm text-gray-700">Menampilkan 1 sampai 3 dari 3 entri</span>
                    {{-- Replace with actual pagination if using Laravel Paginator --}}
                    {{-- {{ $services->links() }} --}}
                </div>
            </div>
        </div>
    </main>
@endsection
