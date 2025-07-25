@extends('layout.app')

@section('title', 'Tambah User')

@section('main')
    <main class="flex-1 overflow-x-hidden overflow-y-auto bg-gray-100 p-6">
        <div class="max-w-xl mx-auto bg-white p-6 rounded shadow">
            <h2 class="text-2xl font-bold mb-4">Tambah User</h2>

            <form action="{{ route('user.store') }}" method="POST">
                @csrf

                <div class="mb-4">
                    <label class="block text-sm font-medium">Nama</label>
                    <input type="text" name="name" value="{{ old('name') }}"
                        class="w-full mt-1 p-2 border border-gray-300 rounded">
                    @error('name')
                        <small class="text-red-600">{{ $message }}</small>
                    @enderror
                </div>

                <div class="mb-4">
                    <label class="block text-sm font-medium">Email</label>
                    <input type="email" name="email" value="{{ old('email') }}"
                        class="w-full mt-1 p-2 border border-gray-300 rounded">
                    @error('email')
                        <small class="text-red-600">{{ $message }}</small>
                    @enderror
                </div>

                <div class="mb-4">
                    <label class="block text-sm font-medium">Password</label>
                    <input type="password" name="password" class="w-full mt-1 p-2 border border-gray-300 rounded">
                    @error('password')
                        <small class="text-red-600">{{ $message }}</small>
                    @enderror
                </div>

                <div class="mb-4">
                    <label class="block text-sm font-medium">Role</label>
                    <select name="role" class="w-full mt-1 p-2 border border-gray-300 rounded">
                        <option value="">-- Pilih Role --</option>
                        <option value="admin">Admin</option>
                        <option value="teknisi">Teknisi</option>
                    </select>
                    @error('role')
                        <small class="text-red-600">{{ $message }}</small>
                    @enderror
                </div>

                <div class="flex justify-between">
                    <a href="{{ route('user.index') }}" class="text-gray-600 hover:underline">Kembali</a>
                    <button type="submit"
                        class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">Simpan</button>
                </div>
            </form>
        </div>
    </main>
@endsection
