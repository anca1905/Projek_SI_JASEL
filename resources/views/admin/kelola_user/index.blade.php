@extends('layout.app')

@section('css')
    <style>
        /* Animasi modal tetap dipertahankan */
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

        /* Gaya baru untuk tampilan tabel yang lebih bersih */
        .table-container {
            border-radius: 0.75rem;
            /* rounded-xl */
            overflow: hidden;
            box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -2px rgba(0, 0, 0, 0.05);
            /* shadow-lg */
            border: 1px solid #e5e7eb;
            /* border-gray-200 */
        }
    </style>
@endsection

@section('title', 'Kelola Pengguna')
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
                <div class="flex items-center space-x-4 flex-wrap gap-2">
                    <h3 class="text-2xl font-bold text-gray-800">Daftar Pengguna</h3>
                    <a href="{{ route('admin.adminuser.create') }}"
                        class="inline-flex items-center bg-green-600 hover:bg-green-700 text-white font-bold py-2 px-4 rounded-lg shadow-sm transition-colors duration-200">
                        <i class="fas fa-plus mr-2"></i> Tambah Pengguna Baru
                    </a>
                </div>

                <form action="{{ route('admin.adminuser.index') }}" method="GET"
                    class="w-full md:w-auto flex flex-col sm:flex-row items-stretch sm:items-center space-y-2 sm:space-y-0 sm:space-x-2">
                    {{-- Input Search --}}
                    <div class="relative w-full sm:w-auto">
                        <input type="text" name="search" value="{{ request('search') }}"
                            placeholder="Cari nama atau email..."
                            class="border rounded-lg pl-10 pr-4 py-2 w-full text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                        <svg class="absolute left-3 top-1/2 transform -translate-y-1/2 w-4 h-4 text-gray-400" fill="none"
                            stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                        </svg>
                    </div>

                    {{-- Dropdown Filter Role --}}
                    <select name="role"
                        class="border rounded-lg px-4 py-2 w-full sm:w-auto text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                        <option value="">Semua Role</option>
                        <option value="admin" {{ request('role') == 'admin' ? 'selected' : '' }}>Admin</option>
                        <option value="teknisi" {{ request('role') == 'teknisi' ? 'selected' : '' }}>Teknisi</option>
                        <option value="pelanggan" {{ request('role') == 'pelanggan' ? 'selected' : '' }}>Pelanggan</option>
                    </select>

                    <div class="flex space-x-2 w-full sm:w-auto">
                        {{-- Tombol Submit --}}
                        <button type="submit"
                            class="flex-1 bg-blue-600 hover:bg-blue-700 text-white font-bold px-4 py-2 rounded-lg transition-colors duration-200">
                            Cari
                        </button>

                        {{-- Tombol Reset --}}
                        @if (request('search') || request('role'))
                            <a href="{{ route('admin.adminuser.index') }}"
                                class="flex-1 bg-gray-300 hover:bg-gray-400 text-gray-800 font-bold px-4 py-2 rounded-lg text-center transition-colors duration-200">
                                Reset
                            </a>
                        @endif
                    </div>
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
                                    Nama</th>
                                <th
                                    class="px-6 py-4 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">
                                    Email</th>
                                <th
                                    class="px-6 py-4 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">
                                    Role</th>
                                <th
                                    class="px-6 py-4 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">
                                    Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200 text-gray-700">
                            @foreach ($users as $user)
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap">{{ $loop->iteration + $users->firstItem() - 1 }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                        {{ $user->name }}</td>
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
                                        <div class="flex items-center space-x-2">
                                            @can('update', $user)
                                                <a href="{{ route('admin.adminuser.edit', $user->id) }}"
                                                    class="text-indigo-600 hover:text-indigo-900 transition-colors duration-200"
                                                    title="Edit">
                                                    <i class="fas fa-edit"></i>
                                                </a>
                                            @endcan
                                            @can('delete', $user)
                                                <form action="{{ route('admin.adminuser.destroy', $user->id) }}" method="POST"
                                                    onsubmit="return confirm('Apakah Anda yakin ingin menghapus user {{ $user->name }}?');">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="button"
                                                        class="text-red-600 hover:text-red-900 transition-colors duration-200"
                                                        title="Hapus"
                                                        onclick="confirmDelete('{{ route('admin.adminuser.destroy', $user->id) }}', '{{ $user->name }}')">
                                                        <i class="fas fa-trash-alt"></i>
                                                    </button>
                                                </form>
                                            @endcan
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="mt-6 flex flex-col md:flex-row justify-between items-center text-sm text-gray-700">
                <span class="mb-4 md:mb-0">Menampilkan {{ $users->firstItem() ?? 0 }} sampai
                    {{ $users->lastItem() ?? 0 }} dari {{ $users->total() }} entri</span>
                <div class="pagination-links">
                    {{ $users->links() }}
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
    {{-- Font Awesome CDN for icons --}}
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        function confirmDelete(deleteUrl, userName) {
            Swal.fire({
                title: 'Apakah Anda yakin?',
                html: `Anda akan menghapus user **${userName}**. Aksi ini tidak dapat dibatalkan.`,
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya, hapus!',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    // Buat form dinamis dan submit
                    let form = document.createElement('form');
                    form.action = deleteUrl;
                    form.method = 'POST';

                    // Tambahkan CSRF token
                    let csrfToken = document.createElement('input');
                    csrfToken.type = 'hidden';
                    csrfToken.name = '_token';
                    csrfToken.value = '{{ csrf_token() }}';
                    form.appendChild(csrfToken);

                    // Tambahkan method DELETE
                    let methodInput = document.createElement('input');
                    methodInput.type = 'hidden';
                    methodInput.name = '_method';
                    methodInput.value = 'DELETE';
                    form.appendChild(methodInput);

                    document.body.appendChild(form);
                    form.submit();
                }
            });
        }
    </script>
@endsection
