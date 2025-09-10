@extends('layout.app')

@section('title', 'Edit Pengguna')
@section('nav', 'Admin Panel')

@section('main')
<div class="flex-1 overflow-x-hidden overflow-y-auto bg-gray-100 p-6">
    <div class="max-w-xl mx-auto bg-white p-8 rounded-xl shadow-lg border border-gray-200">
        <h2 class="text-3xl font-bold text-gray-800 mb-6">Edit Pengguna</h2>

        <form action="{{ route('admin.adminuser.update', $user->id) }}" method="POST" class="space-y-6">
            @csrf
            @method('PUT')

            <div>
                <label for="name" class="block text-sm font-medium text-gray-700 mb-1">Nama</label>
                <input type="text" id="name" name="name" value="{{ old('name', $user->name) }}"
                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 transition duration-150 ease-in-out sm:text-sm">
                @error('name')
                    <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Email</label>
                <input type="email" id="email" name="email" value="{{ old('email', $user->email) }}"
                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 transition duration-150 ease-in-out sm:text-sm">
                @error('email')
                    <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="password" class="block text-sm font-medium text-gray-700 mb-1">Password (Kosongkan jika tidak diubah)</label>
                <input type="password" id="password" name="password"
                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 transition duration-150 ease-in-out sm:text-sm" value="{{ $user->password }}">
                @error('password')
                    <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                @enderror
            </div>

            @can('role', $user)
            <div>
                <label for="role" class="block text-sm font-medium text-gray-700 mb-1">Role</label>
                <select id="role" name="role"
                    class="mt-1 p-2 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 transition duration-150 ease-in-out sm:text-sm">
                    <option value="admin" {{ $user->role == 'admin' ? 'selected' : '' }}>Admin</option>
                    <option value="teknisi" {{ $user->role == 'teknisi' ? 'selected' : '' }}>Teknisi</option>
                    <option value="pelanggan" {{ $user->role == 'pelanggan' ? 'selected' : '' }}>Pelanggan</option>
                </select>
                @error('role')
                    <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                @enderror
            </div>
            @endcan

            <div class="flex justify-between items-center pt-4 border-t border-gray-200">
                <a href="{{ route('admin.adminuser.index') }}"
                    class="text-gray-600 hover:text-gray-900 font-medium transition-colors duration-200">
                    Kembali
                </a>
                <button type="submit"
                    class="inline-flex items-center px-6 py-3 border border-transparent text-sm font-medium rounded-lg shadow-sm text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-colors duration-200">
                    Update Pengguna
                </button>
            </div>
        </form>
    </div>
</div>
@endsection