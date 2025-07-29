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
            <form action="{{ route('admin.adminkelola_jasa.store') }}" method="POST">
                @csrf

                <div class="mb-4">
                    <label class="block text-sm font-medium">Nama Jasa</label>
                    <input type="text" name="name" value="{{ old('name') }}"
                        class="w-full mt-1 p-2 border border-gray-300 rounded" >
                    @error('name')
                        <small class="text-red-600">{{ $message }}</small>
                    @enderror
                </div>

                <div class="mb-4">
                    <label class="block text-sm font-medium">Harga</label>
                    <input type="text" id="rupiah" name="price" value="{{ old('price') }}"
                        class="w-full mt-1 p-2 border border-gray-300 rounded" >
                    @error('price')
                        <small class="text-red-600">{{ $message }}</small>
                    @enderror
                </div>

                <div class="flex justify-between mt-6">
                    {{-- Sesuaikan href dengan route daftar jasa Anda, contoh: route('adminservice.index') --}}
                    <a href="{{ route('admin.adminkelola_jasa.index') }}" class="text-gray-600 hover:underline">Kembali</a>
                    <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">Simpan</button>
                </div>
            </form>
        </div>
    </main>
@endsection
@section('js')
    <script src="{{ asset('js/admin/kelola_jasa/create.js') }}"></script>
@endsection