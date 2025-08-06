@extends('layout.app')

@section('title', 'Ajukan Jadi Teknisi')
@section('nav', 'Costumer Panel')

@section('main')
    <main class="flex-1 overflow-x-hidden overflow-y-auto bg-gray-100 p-6">
        @if (session('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
                <strong class="font-bold">Sukses!</strong>
                <span class="block sm:inline">{{ session('success') }}</span>
            </div>
        @endif

        @if (session('error'))
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4" role="alert">
                <strong class="font-bold">Error!</strong>
                <span class="block sm:inline">{{ session('error') }}</span>
            </div>
        @endif

        <div class="bg-white p-8 rounded-lg shadow-md w-full max-w-2xl mx-auto">
            <h3 class="text-xl font-semibold mb-6 text-center">Form Pengajuan Menjadi Teknisi</h3>
            <form action="{{ route('costumer.apply_as_teknisi.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <p class="mb-4 text-gray-600">
                    Isi formulir di bawah ini untuk mengajukan diri sebagai teknisi. Permohonan Anda akan ditinjau oleh
                    admin.
                </p>

                <div class="mb-4">
                    <label for="address" class="block text-gray-700 text-sm font-bold mb-2">Provinsi</label>
                    <select name="province" id="province"
                        class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                        <option value="">Pilih Provinsi</option>
                        @foreach ($provinces['data'] as $province)
                            <option value="{{ $province['code'] }}">{{ $province['name'] }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-4" id="kabupaten-container" style="display: none;">
                    <label for="address" class="block text-gray-700 text-sm font-bold mb-2">Kabupaten</label>
                    <select name="kabupaten" id="kabupaten"
                        class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                    </select>
                </div>

                <div class="mb-4" id="kecamatan-container" style="display: none;">
                    <label for="address" class="block text-gray-700 text-sm font-bold mb-2">Kecamatan</label>
                    <select name="kecamatan" id="kecamatan"
                        class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                    </select>
                </div>

                <div class="mb-4" id="kelurahan-container" style="display: none;">
                    <label for="address" class="block text-gray-700 text-sm font-bold mb-2">Kelurahan / Desa</label>
                    <select name="kelurahan" id="kelurahan"
                        class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                    </select>
                </div>

                <div class="mb-4">
                    <label for="phone_number" class="block text-gray-700 text-sm font-bold mb-2">Nomor Telepon</label>
                    <input type="text" id="phone_number" name="phone_number" value="{{ old('phone_number') }}"
                        class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                        placeholder="Masukkan nomor telepon aktif">
                </div>

                <div class="mb-4">
                    <label for="resume" class="block text-gray-700 text-sm font-bold mb-2">Upload CV/Resume</label>
                    <input type="file" id="resume" name="resume"
                        class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                    <p class="text-xs text-gray-500 mt-1">Format file: PDF, DOCX (Max 2MB)</p>
                </div>

                <div class="mb-6">
                    <label for="reason" class="block text-gray-700 text-sm font-bold mb-2">Alasan Pengajuan</label>
                    <textarea id="reason" name="reason" rows="4"
                        class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                        placeholder="Jelaskan mengapa Anda ingin menjadi teknisi dan keahlian yang Anda miliki.">{{ old('reason') }}</textarea>
                </div>

                <div class="flex items-center justify-between">
                    <button type="submit"
                        class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline w-full">
                        Kirim Pengajuan
                    </button>
                </div>
            </form>
        </div>
    </main>
@endsection
@section('js')
    <script src="{{ asset('js/costumer/apply_as_teknisi.js') }}"></script>
@endsection
