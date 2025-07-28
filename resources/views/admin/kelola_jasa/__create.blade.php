{{-- resources/views/admin/jasa/create.blade.php --}}
@extends('layout.app')

@section('title', 'Tambah Jasa Baru')
@section('nav', 'Admin Panel')

@section('main')
    <main class="flex-1 overflow-x-hidden overflow-y-auto bg-gray-100 p-6">
        <div class="max-w-xl mx-auto bg-white p-6 rounded shadow">
            <h2 class="text-2xl font-bold mb-4">Tambah Jasa Baru</h2>

            {{-- Form untuk menambahkan jasa --}}
            {{-- Sesuaikan action dengan route Anda, contoh: route('adminservice.store') --}}
            <form action="{{ route('adminadminkelola_jasa.store') }}" method="POST">
                @csrf

                <div class="mb-4">
                    <label class="block text-sm font-medium">Nama Jasa</label>
                    <input type="text" name="nama_jasa" value="{{ old('nama_jasa') }}"
                        class="w-full mt-1 p-2 border border-gray-300 rounded" required>
                    @error('nama_jasa')
                        <small class="text-red-600">{{ $message }}</small>
                    @enderror
                </div>

                <div class="mb-4">
                    <label class="block text-sm font-medium">Harga</label>
                    <input type="number" name="harga" value="{{ old('harga') }}"
                        class="w-full mt-1 p-2 border border-gray-300 rounded" required>
                    @error('harga')
                        <small class="text-red-600">{{ $message }}</small>
                    @enderror
                </div>

                <div class="flex justify-between mt-6">
                    {{-- Sesuaikan href dengan route daftar jasa Anda, contoh: route('adminservice.index') --}}
                    <a href="{{ route('adminadminkelola_jasa.index') }}" class="text-gray-600 hover:underline">Kembali</a>
                    <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">Simpan</button>
                </div>
            </form>
        </div>
    </main>
@endsection