{{-- resources/views/admin/edit_jasa.blade.php --}}
@extends('layout.app')

@section('title', 'Edit Jasa')
@section('nav', 'Admin Panel')

@section('main')
    <div class="flex-1 overflow-x-hidden overflow-y-auto bg-gray-100 p-6">
        <div class="max-w-xl mx-auto bg-white p-8 rounded-xl shadow-lg border border-gray-200">
            <h2 class="text-3xl font-bold text-gray-800 mb-6">Edit Jasa</h2>

            <form action="{{ route('admin.adminkelola_jasa.update', $service->id) }}" method="POST" class="space-y-6">
                @csrf
                @method('PUT')

                <div>
                    <label for="name" class="block text-sm font-medium text-gray-700 mb-1">Nama Jasa</label>
                    <input type="text" name="name" id="name" value="{{ old('name', $service->name) }}"
                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 transition duration-150 ease-in-out sm:text-sm">
                    @error('name')
                        <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="price" class="block text-sm font-medium text-gray-700 mb-1">Harga (Rp)</label>
                    <input type="text" name="price" id="rupiah" value="{{ old('price', $service->price) }}"
                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 transition duration-150 ease-in-out sm:text-sm"
                        min="0">
                    @error('price')
                        <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div class="flex justify-between items-center pt-4 border-t border-gray-200">
                    <a href="{{ route('admin.adminkelola_jasa.index') }}" class="text-gray-600 hover:text-gray-900 font-medium transition-colors duration-200">
                        Kembali
                    </a>
                    <button type="submit"
                        class="inline-flex items-center px-6 py-3 border border-transparent text-sm font-medium rounded-lg shadow-sm text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-colors duration-200">
                        Update Jasa
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection

@section('js')
    <script src="{{ asset('js/admin/kelola_jasa/create.js') }}"></script>
@endsection