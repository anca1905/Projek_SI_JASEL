@extends('layout.app')

@section('css')
@endsection

@section('title', 'Restore Pengguna')
@section('nav', 'Admin Panel')

@section('main')
    <div class="space-y-6">
        @if (session('success'))
        @endif

        <div class="bg-white p-8 rounded-xl shadow-lg border border-gray-200">
            <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-6 gap-4">
                <div class="flex items-center space-x-4 flex-wrap gap-2">
                    <h3 class="text-2xl font-bold text-gray-800">Pengguna Dihapus (Soft Deleted)</h3>
                    <a href="{{ route('admin.adminuser.index') }}"
                        class="inline-flex items-center bg-gray-600 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded-lg shadow-sm transition-colors duration-200">
                        <i class="fas fa-arrow-left mr-2"></i> Kembali ke Daftar Pengguna
                    </a>
                </div>

                {{-- ... Salin bagian form pencarian dari index.blade.php ... --}}
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
                                    Nama</th>
                                <th
                                    class="px-6 py-4 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">
                                    Email</th>
                                <th
                                    class="px-6 py-4 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">
                                    Role</th>
                                <th
                                    class="px-6 py-4 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">
                                    Pulihkan</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200 text-gray-700">
                            @foreach ($deletedUsers as $user)
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        {{ $loop->iteration + $deletedUsers->firstItem() - 1 }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                        {{ $user->name }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $user->email }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        @php
                                            $roleClass = match ($user->role) {
                                                'admin' => 'bg-red-100 text-red-800',
                                                'teknisi' => 'bg-purple-100 text-purple-800',
                                                'pelanggan' => 'bg-blue-100 text-blue-800',
                                                default => 'bg-gray-100 text-gray-800',
                                            };
                                        @endphp
                                        <span
                                            class="px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-full capitalize {{ $roleClass }}">
                                            {{ $user->role }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                        <form action="{{ route('admin.adminuser.restore', $user->id) }}" method="POST"
                                            onsubmit="return confirm('Apakah Anda yakin ingin memulihkan user {{ $user->name }}?');">
                                            @csrf
                                            @method('PUT')
                                            <button type="submit"
                                                class="text-green-600 hover:text-green-900 transition-colors duration-200"
                                                title="Pulihkan">
                                                <i class="fas fa-trash-restore"></i>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="mt-6 flex flex-col md:flex-row justify-between items-center text-sm text-gray-700">
                <span class="mb-4 md:mb-0">Menampilkan {{ $deletedUsers->firstItem() ?? 0 }} sampai
                    {{ $deletedUsers->lastItem() ?? 0 }} dari {{ $deletedUsers->total() }} entri</span>
                <div class="pagination-links">
                    {{ $deletedUsers->links() }}
                </div>
            </div>
        </div>
    </div>
@endsection
