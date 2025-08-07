@extends('layout.app')

@section('title', 'Ajukan Jadi Teknisi')
@section('nav', 'Costumer Panel')

@section('main')
    <main class="flex-1 overflow-x-hidden overflow-y-auto bg-gray-50 p-6">
        <div class="max-w-2xl mx-auto">
            <div class="bg-white p-8 rounded-2xl shadow-xl border border-gray-200">
                <div class="text-center mb-6">
                    <h3 class="text-3xl font-bold text-gray-800 mb-2">Ajukan Jadi Teknisi</h3>
                    <p class="text-gray-500">Isi formulir ini untuk mengajukan diri sebagai teknisi.</p>
                </div>

                {{-- Alert Sections (using SweetAlert2 for consistency) --}}
                @section('js')
                    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
                    @if (session('success'))
                        <script>
                            Swal.fire({
                                icon: 'success',
                                title: 'Berhasil!',
                                text: '{{ session('success') }}',
                                timer: 2500,
                                showConfirmButton: false
                            });
                        </script>
                    @endif
                    @if (session('error'))
                        <script>
                            Swal.fire({
                                icon: 'error',
                                title: 'Gagal!',
                                text: '{{ session('error') }}',
                                timer: 2500,
                                showConfirmButton: false
                            });
                        </script>
                    @endif
                @endsection

                <form action="{{ route('costumer.apply_as_teknisi.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                    @csrf
                    <p class="text-gray-600">
                        Permohonan Anda akan ditinjau oleh tim admin. Pastikan data yang Anda masukkan akurat.
                    </p>

                    {{-- Dynamic Address Fields --}}
                    <div>
                        <label for="province" class="block text-gray-700 text-sm font-medium mb-1">Provinsi</label>
                        <select name="province" id="province"
                            class="block w-full px-4 py-2 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition duration-200">
                            <option value="">Pilih Provinsi</option>
                            @foreach ($provinces['data'] as $province)
                                <option value="{{ $province['code'] }}">{{ $province['name'] }}</option>
                            @endforeach
                        </select>
                        {{-- @error('province') --}}
                            <p class="text-red-500 text-xs italic mt-1 hidden">Provinsi wajib diisi.</p>
                        {{-- @enderror --}}
                    </div>

                    <div id="kabupaten-container" class="hidden">
                        <label for="kabupaten" class="block text-gray-700 text-sm font-medium mb-1">Kabupaten</label>
                        <select name="kabupaten" id="kabupaten"
                            class="block w-full px-4 py-2 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition duration-200"></select>
                    </div>

                    <div id="kecamatan-container" class="hidden">
                        <label for="kecamatan" class="block text-gray-700 text-sm font-medium mb-1">Kecamatan</label>
                        <select name="kecamatan" id="kecamatan"
                            class="block w-full px-4 py-2 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition duration-200"></select>
                    </div>

                    <div id="kelurahan-container" class="hidden">
                        <label for="kelurahan" class="block text-gray-700 text-sm font-medium mb-1">Kelurahan / Desa</label>
                        <select name="kelurahan" id="kelurahan"
                            class="block w-full px-4 py-2 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition duration-200"></select>
                    </div>

                    {{-- Other Form Fields --}}
                    <div>
                        <label for="phone_number" class="block text-gray-700 text-sm font-medium mb-1">Nomor Telepon</label>
                        <input type="text" id="phone_number" name="phone_number" value="{{ old('phone_number') }}"
                            class="block w-full px-4 py-2 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition duration-200"
                            placeholder="Masukkan nomor telepon aktif">
                        {{-- @error('phone_number') --}}
                            <p class="text-red-500 text-xs italic mt-1 hidden">Nomor telepon wajib diisi.</p>
                        {{-- @enderror --}}
                    </div>

                    <div>
                        <label for="resume" class="block text-gray-700 text-sm font-medium mb-1">Upload CV/Resume</label>
                        <input type="file" id="resume" name="resume"
                            class="block w-full text-gray-700 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition duration-200 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-semibold file:bg-gray-100 file:text-gray-700 hover:file:bg-gray-200">
                        <p class="text-xs text-gray-500 mt-1">Format file: PDF, DOCX (Max 2MB)</p>
                        {{-- @error('resume') --}}
                            <p class="text-red-500 text-xs italic mt-1 hidden">File resume wajib diunggah.</p>
                        {{-- @enderror --}}
                    </div>

                    <div>
                        <label for="reason" class="block text-gray-700 text-sm font-medium mb-1">Alasan Pengajuan</label>
                        <textarea id="reason" name="reason" rows="4"
                            class="block w-full px-4 py-2 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition duration-200"
                            placeholder="Jelaskan mengapa Anda ingin menjadi teknisi dan keahlian yang Anda miliki.">{{ old('reason') }}</textarea>
                        {{-- @error('reason') --}}
                            <p class="text-red-500 text-xs italic mt-1 hidden">Alasan pengajuan minimal 10 karakter.</p>
                        {{-- @enderror --}}
                    </div>

                    <div class="pt-2">
                        <button type="submit"
                            class="w-full bg-green-600 hover:bg-green-700 text-white py-3 rounded-lg font-semibold shadow-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500 transition duration-200">
                            <i class="fas fa-paper-plane mr-2"></i> Kirim Pengajuan
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </main>
@endsection
@section('js')
    <script src="{{ asset('js/costumer/apply_as_teknisi.js') }}"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap');
        body {
            font-family: 'Poppins', sans-serif;
        }
    </style>
@endsection