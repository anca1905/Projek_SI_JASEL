{{-- resources/views/admin/applicant_review.blade.php --}}
{{--
    This Blade template is for the admin panel to review technician applications.
    It extends the main application layout and displays details of a single applicant.
--}}
@extends('layout.app')

@section('title', 'Tinjau Pengajuan Teknisi')
@section('nav', 'Panel Admin')

@section('main')
    <main class="flex-1 overflow-x-hidden overflow-y-auto bg-gray-50 p-4 sm:p-6">
        <div class="container mx-auto max-w-2xl">
            <h2 class="text-3xl font-bold text-gray-900 mb-6">Tinjau Pengajuan Teknisi</h2>
            
            <div class="bg-white rounded-2xl shadow-xl p-6 sm:p-8 border border-gray-200">
                {{-- Applicant's Name and Avatar Section --}}
                <div class="flex flex-col sm:flex-row items-center sm:space-x-6 mb-8 text-center sm:text-left">
                    <img src="https://ui-avatars.com/api/?name={{ urlencode($data->user->name) }}&background=E0E7FF&color=4338CA" alt="Avatar Pelamar" class="w-24 h-24 rounded-full object-cover border-4 border-blue-500 shadow-sm mb-4 sm:mb-0">
                    <div>
                        <h3 class="text-2xl font-bold text-gray-900">{{ $data->user->name }}</h3>
                        <p class="text-gray-600">{{ $data->user->email }}</p>
                    </div>
                </div>

                {{-- Applicant's Details --}}
                <div class="space-y-4 mb-8">
                    <div>
                        <p class="text-sm font-medium text-gray-500">Nomor Telepon</p>
                        <p class="text-base text-gray-800 font-semibold">{{ $data->phone_number }}</p>
                    </div>
                    <div>
                        <p class="text-sm font-medium text-gray-500">Alamat</p>
                        <p class="text-base text-gray-800 font-semibold">{{ $data->province_code . ', ' . $data->regency_code . ', Kec.' . $data->subdistrict_code . ', ' . $data->village_code }}</p>
                    </div>
                    <div>
                        <p class="text-sm font-medium text-gray-500">Keterangan Tambahan</p>
                        <p class="text-base text-gray-800 font-semibold italic">"{{ $data->reason }}"</p>
                    </div>
                </div>

                {{-- Action Buttons (Approve, Reject, Back) --}}
                <div class="flex flex-col sm:flex-row gap-4">
                    {{-- Form to approve the applicant --}}
                    {{-- Replace '#' with the appropriate route, for example: route('admin.applicants.approve', $applicant->id) --}}
                    <form action="#" method="POST" class="w-full">
                        @csrf
                        <button type="submit" class="w-full inline-flex items-center justify-center px-6 py-3 border border-transparent rounded-lg shadow-sm text-base font-medium text-white bg-green-600 hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500 transition-colors duration-200">
                            Setujui
                        </button>
                    </form>

                    {{-- Form to reject the applicant --}}
                    {{-- Replace '#' with the appropriate route, for example: route('admin.applicants.reject', $applicant->id) --}}
                    <form action="#" method="POST" class="w-full">
                        @csrf
                        <button type="submit" class="w-full inline-flex items-center justify-center px-6 py-3 border border-transparent rounded-lg shadow-sm text-base font-medium text-white bg-red-600 hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500 transition-colors duration-200">
                            Tolak
                        </button>
                    </form>

                    <a href="{{ url()->previous() }}" class="w-full inline-flex items-center justify-center px-6 py-3 border border-gray-300 rounded-lg shadow-sm text-base font-medium text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transition-colors duration-200">
                        Kembali
                    </a>
                </div>
            </div>
        </div>
    </main>
@endsection
