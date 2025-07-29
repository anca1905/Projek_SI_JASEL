{{-- resources/views/admin/edit_jasa.blade.php --}}
@extends('layout.app')

@section('title', 'Edit Jasa')
@section('nav', 'Admin Panel')

@section('main')
    <main class="flex-1 overflow-x-hidden overflow-y-auto bg-gray-100 p-6">
        <div class="max-w-xl mx-auto bg-white p-6 rounded shadow">
            <h2 class="text-2xl font-bold mb-4">Edit Jasa</h2>

            {{-- Pastikan variabel $service dikirim dari controller --}}
            <form action="{{ route('admin.adminkelola_jasa.update', $service->id) }}" method="POST">
                @csrf
                @method('PUT') {{-- Gunakan method PUT untuk update --}}

                <div class="mb-4">
                    <label for="name" class="block text-sm font-medium text-gray-700">Nama Jasa</label>
                    <input type="text" name="name" id="name" value="{{ old('name', $service->name) }}"
                        class="w-full mt-1 p-2 border border-gray-300 rounded focus:outline-none focus:ring focus:border-blue-300">
                    @error('name')
                        <small class="text-red-600">{{ $message }}</small>
                    @enderror
                </div>

                <div class="mb-4">
                    <label for="price" class="block text-sm font-medium text-gray-700">Harga (Rp)</label>
                    <input type="text" name="price" id="rupiah" value="{{ old('price', $service->price) }}"
                        class="w-full mt-1 p-2 border border-gray-300 rounded focus:outline-none focus:ring focus:border-blue-300"
                        min="0">
                    @error('price')
                        <small class="text-red-600">{{ $message }}</small>
                    @enderror
                </div>

                <div class="flex justify-between mt-6">
                    <a href="{{ route('admin.adminkelola_jasa.index') }}" class="text-gray-600 hover:underline">Kembali</a>
                    <button type="submit"
                        class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 transition duration-200 ease-in-out">Update Jasa</button>
                </div>
            </form>
        </div>
    </main>
@endsection
@section('js')
    <script src="{{ asset('js/admin/kelola_jasa/create.js') }}"></script>
@endsection