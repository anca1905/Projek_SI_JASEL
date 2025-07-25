@extends('layout.app')

@section('css')
    <style>
        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(-20px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .modal {
            animation: fadeIn 0.3s ease-out forwards;
        }
    </style>
@endsection

@section('title', 'Kelola User')

@section('main')
    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if (session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    <main class="flex-1 overflow-x-hidden overflow-y-auto bg-gray-100 p-6">
        <div class="bg-white p-6 rounded-lg shadow-md">
            <div class="flex flex-wrap justify-between items-center mb-4 gap-4">
                <!-- Kiri: Judul + Tombol Tambah -->
                <div class="flex items-center space-x-4">
                    <h3 class="text-xl font-semibold">Daftar Pengguna</h3>
                    <a href="{{ route('adminuser.create') }}"
                        class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">
                        Tambah User Baru
                    </a>
                </div>

                <!-- Kanan: Form Pencarian -->
                <form action="{{ route('adminuser.index') }}" method="GET" class="flex items-center space-x-2">
                    {{-- Input Search --}}
                    <input type="text" name="search" value="{{ request('search') }}"
                        placeholder="Cari nama atau email..."
                        class="border rounded px-3 py-2 focus:outline-none focus:ring focus:border-blue-300">

                    {{-- Dropdown Filter Role --}}
                    <select name="role"
                        class="border rounded px-3 py-2 focus:outline-none focus:ring focus:border-blue-300">
                        <option value="">Semua Role</option>
                        <option value="admin" {{ request('role') == 'admin' ? 'selected' : '' }}>Admin</option>
                        <option value="teknisi" {{ request('role') == 'teknisi' ? 'selected' : '' }}>Teknisi</option>
                        <option value="pelanggan" {{ request('role') == 'pelanggan' ? 'selected' : '' }}>Pelanggan</option>
                    </select>

                    {{-- Tombol Submit --}}
                    <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold px-4 py-2 rounded">
                        Cari
                    </button>

                    {{-- Tombol Reset --}}
                    @if (request('search') || request('role'))
                        <a href="{{ route('adminuser.index') }}" class="text-sm text-blue-500 hover:underline ml-2">
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
                            </th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Email
                            </th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Role
                            </th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi
                            </th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        <?php $no = 0; ?>
                        @foreach ($users as $user)
                            <tr>
                                <?php $no++; ?>
                                <td class="px-6 py-4 whitespace-nowrap">{{ $no }}</td>
                                <td class="px-6 py-4 whitespace-nowrap">{{ $user->name }}</td>
                                <td class="px-6 py-4 whitespace-nowrap">{{ $user->email }}</td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    @php
                                        $roleClass = match ($user->role) {
                                            'admin' => 'bg-red-100 text-red-800',
                                            'teknisi' => 'bg-purple-100 text-purple-800',
                                            default => 'bg-blue-100 text-blue-800',
                                        };
                                    @endphp
                                    <span
                                        class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full {{ $roleClass }}">
                                        {{ ucfirst($user->role) }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                    <a href="{{ route('adminuser.edit', $user->id) }}"
                                        class="text-indigo-600 hover:text-indigo-900 mr-2">
                                        Edit
                                    </a>
                                    <form action="{{ route('adminuser.destroy', $user->id) }}" method="POST"
                                        class="inline-block"
                                        onsubmit="return confirm('Apakah Anda yakin ingin menghapus user {{ $user->name }}?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-600 hover:text-red-900">Hapus</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <br>
                <div class="mt-4 flex justify-between items-center">
                    <span class="text-sm text-gray-700">Menampilkan {{ $users->firstItem() ?? 0 }} sampai
                        {{ $users->lastItem() ?? 0 }} dari {{ $users->total() }} entri</span>
                    {{ $users->links() }}
                </div>
            </div>


        </div>
    </main>



@endsection
