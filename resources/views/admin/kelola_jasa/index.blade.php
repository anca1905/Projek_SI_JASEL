{{-- resources/views/admin/kelola_jasa.blade.php --}}
@extends('layout.app')

@section('title', 'Kelola Jasa')
@section('nav', 'Admin Panel')

@section('main')
    <div class="space-y-6">
        {{-- Success/Error Messages --}}
        @if (session('success'))
            <div class="bg-green-50 border-l-4 border-green-400 text-green-700 p-4 rounded-lg shadow-md transition-all duration-300 ease-in-out"
                role="alert">
                <div class="flex items-center">
                    <div class="py-1">
                        <svg class="fill-current h-6 w-6 text-green-500 mr-4" xmlns="http://www.w3.org/2000/svg"
                            viewBox="0 0 20 20">
                            <path
                                d="M2.93 17.07A10 10 0 1 1 17.07 2.93 10 10 0 0 1 2.93 17.07zm12.73-1.41A8 8 0 1 0 4.34 4.34a8 8 0 0 0 11.32 11.32zM9 11V9h2v6H9v-4zm0-6h2v2H9V5z" />
                        </svg>
                    </div>
                    <div>
                        <p class="font-bold">Sukses!</p>
                        <p class="text-sm">{{ session('success') }}</p>
                    </div>
                </div>
            </div>
        @endif

        @if (session('error'))
            <div class="bg-red-50 border-l-4 border-red-400 text-red-700 p-4 rounded-lg shadow-md transition-all duration-300 ease-in-out"
                role="alert">
                <div class="flex items-center">
                    <div class="py-1">
                        <svg class="fill-current h-6 w-6 text-red-500 mr-4" xmlns="http://www.w3.org/2000/svg"
                            viewBox="0 0 20 20">
                            <path
                                d="M2.93 17.07A10 10 0 1 1 17.07 2.93 10 10 0 0 1 2.93 17.07zm12.73-1.41A8 8 0 1 0 4.34 4.34a8 8 0 0 0 11.32 11.32zM9 11V9h2v6H9v-4zm0-6h2v2H9V5z" />
                        </svg>
                    </div>
                    <div>
                        <p class="font-bold">Error!</p>
                        <p class="text-sm">{{ session('error') }}</p>
                    </div>
                </div>
            </div>
        @endif

        <div class="bg-white p-8 rounded-xl shadow-lg border border-gray-200">
            <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-6 gap-4">
                {{-- Left: Title + Add Button --}}
                <div class="flex items-center space-x-4 flex-wrap gap-2">
                    <h3 class="text-2xl font-bold text-gray-800">Daftar Jasa</h3>
                    <a href="{{ route('admin.adminkelola_jasa.create') }}"
                        class="inline-flex items-center bg-green-600 hover:bg-green-700 text-white font-bold py-2 px-4 rounded-lg shadow-sm transition-colors duration-200">
                        <i class="fas fa-plus mr-2"></i> Tambah Jasa Baru
                    </a>
                </div>

                {{-- Right: Search Form --}}
                <form action="{{ route('admin.adminkelola_jasa.index') }}" method="GET"
                    class="w-full md:w-auto flex flex-col sm:flex-row items-stretch sm:items-center space-y-2 sm:space-y-0 sm:space-x-2">
                    {{-- Input Search --}}
                    <div class="relative w-full sm:w-auto">
                        <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari nama jasa..."
                            class="border rounded-lg pl-10 pr-4 py-2 w-full text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                        <svg class="absolute left-3 top-1/2 transform -translate-y-1/2 w-4 h-4 text-gray-400" fill="none"
                            stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                        </svg>
                    </div>

                    {{-- Tombol Submit --}}
                    <button type="submit"
                        class="flex-1 bg-blue-600 hover:bg-blue-700 text-white font-bold px-4 py-2 rounded-lg transition-colors duration-200">
                        Cari
                    </button>

                    {{-- Tombol Reset --}}
                    @if (request('search'))
                        <a href="{{ route('admin.adminkelola_jasa.index') }}"
                            class="flex-1 bg-gray-300 hover:bg-gray-400 text-gray-800 font-bold px-4 py-2 rounded-lg text-center transition-colors duration-200">
                            Reset
                        </a>
                    @endif
                </form>
            </div>

            <div class="table-container">
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th
                                    class="px-6 py-4 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">
                                    No</th>
                                <th
                                    class="px-6 py-4 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">
                                    Nama Jasa</th>
                                <th
                                    class="px-6 py-4 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">
                                    Harga</th>
                                <th
                                    class="px-6 py-4 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">
                                    Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            <?php
                            $no = 1;
                            ?>
                            @forelse ($data as $d)
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <?= $no++ ?></td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                        {{ $d->name }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                        Rp{{ $d->price }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                        <div class="flex items-center space-x-2">
                                            <a href="{{ route('admin.adminkelola_jasa.edit', $d->id) }}"
                                                class="text-indigo-600 hover:text-indigo-900 transition-colors duration-200"
                                                title="Edit">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            <form action="{{ route('admin.adminkelola_jasa.destroy', $d->id) }}"
                                                method="POST" class="inline-block"
                                                onsubmit="return confirm('Apakah Anda yakin ingin menghapus jasa {{ $d->name }}?');">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit"
                                                    class="text-red-600 hover:text-red-900 transition-colors duration-200"
                                                    title="Hapus">
                                                    <i class="fas fa-trash-alt"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="px-6 py-4 text-center text-gray-500">Tidak ada jasa yang
                                        ditemukan.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="mt-6 flex flex-col md:flex-row justify-between items-center text-sm text-gray-700">
            </div>
        </div>
    </div>
@endsection

@section('js')
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
@endsection
