@extends('layout.app')

@section('title', 'Alat Database')
@section('nav', 'Database')

@section('main')
    <div style="margin-bottom: 20px">
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
    </div>
    <div class="space-y-8 p-6 bg-white rounded-xl shadow-lg">
        <div class="border-b border-gray-200 pb-4">
            <h3 class="text-2xl font-bold text-gray-800">Ekspor Database</h3>
            <p class="text-gray-600 mt-2">Buat cadangan database Anda menjadi file .sql yang dapat diunduh.</p>
        </div>
        <div class="flex items-center justify-between p-6 bg-gray-50 rounded-lg border border-gray-200">
            <p class="text-gray-700 font-medium">Klik tombol di bawah untuk memulai proses ekspor.</p>
            <form action="{{ route('admin.admin.admin.export.database') }}" method="POST">
                @csrf
                <button type="submit"
                    class="px-6 py-3 bg-blue-600 text-white rounded-full font-semibold hover:bg-blue-700 transition-all duration-300 transform hover:scale-105 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 shadow-lg flex items-center">
                    <i class="fas fa-download mr-2"></i>
                    Ekspor Database
                </button>
            </form>
        </div>

        <div class="border-b border-gray-200 pt-8 pb-4">
            <h3 class="text-2xl font-bold text-gray-800">Impor Database</h3>
            <p class="text-gray-600 mt-2">Pilih file .sql dari komputer Anda untuk memulihkan database.</p>
        </div>
        <div class="p-6 bg-gray-50 rounded-lg border border-gray-200">
            <form id="importForm" action="{{ route('admin.admin.import.database') }}" method="POST"
                enctype="multipart/form-data" class="space-y-4">
                @csrf
                <div>
                    <label for="sql_file" class="block text-sm font-medium text-gray-700 mb-2">Pilih file .sql</label>
                    <input type="file" name="sql_file" id="sql_file" accept=".sql" required
                        class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-white focus:outline-none file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100 transition-colors duration-200">
                    <p class="mt-1 text-xs text-gray-500">Pastikan file yang diunggah adalah file cadangan database MySQL
                        (.sql).</p>
                </div>
                <button type="submit"
                    class="w-full px-6 py-3 bg-indigo-600 text-white rounded-full font-semibold hover:bg-indigo-700 transition-all duration-300 transform hover:scale-105 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 shadow-lg flex items-center justify-center">
                    <i class="fas fa-upload mr-2"></i>
                    Impor Database
                </button>
            </form>
        </div>
    </div>
@endsection

@section('js')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Handle form submission with SweetAlert2 for a better UX
            const importForm = document.getElementById('importForm');

            importForm.addEventListener('submit', function(event) {
                event.preventDefault();

                const formData = new FormData(importForm);
                const xhr = new XMLHttpRequest();

                Swal.fire({
                    title: 'Mengunggah file...',
                    html: '<progress id="uploadProgress" value="0" max="100" style="width:100%"></progress>',
                    allowOutsideClick: false,
                    didOpen: () => Swal.showLoading()
                });

                xhr.upload.onprogress = function(e) {
                    if (e.lengthComputable) {
                        let percent = (e.loaded / e.total) * 100;
                        document.getElementById('uploadProgress').value = percent;
                    }
                };

                xhr.onload = function() {
                    if (xhr.status === 200) {
                        Swal.fire('Sukses!', 'File berhasil diunggah & diproses.', 'success')
                            .then(() => window.location.reload());
                    } else {
                        Swal.fire('Error!', 'Gagal mengimpor database.', 'error');
                    }
                };

                xhr.open('POST', importForm.action, true);
                xhr.setRequestHeader('X-CSRF-TOKEN', '{{ csrf_token() }}');
                xhr.send(formData);
            });

        });
    </script>
@endsection
