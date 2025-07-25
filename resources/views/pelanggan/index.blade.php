<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Buat Pesanan - Sistem Service Elektronik</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 font-sans leading-normal tracking-normal">

    <div class="flex h-screen bg-gray-200">
        <div class="flex-shrink-0 w-64 bg-gray-800 text-white p-4">
            <h1 class="text-3xl font-bold mb-6 text-center">Pelanggan Panel</h1>
            <nav>
                <ul>
                    <li class="mb-2">
                        <a href="#" class="block py-2 px-4 rounded hover:bg-gray-700 transition duration-200 ease-in-out bg-gray-700">Buat Pesanan</a>
                    </li>
                    <li class="mb-2">
                        <a href="#" class="block py-2 px-4 rounded hover:bg-gray-700 transition duration-200 ease-in-out">Riwayat Pesanan</a>
                    </li>
                    <li class="mb-2">
                        <a href="#" class="block py-2 px-4 rounded hover:bg-gray-700 transition duration-200 ease-in-out text-red-400">Logout</a>
                    </li>
                </ul>
            </nav>
        </div>

        <div class="flex-1 flex flex-col overflow-hidden">
            <header class="flex justify-between items-center p-4 bg-white shadow-md">
                <h2 class="text-2xl font-semibold">Buat Pesanan Baru</h2>
                <div class="flex items-center">
                    <span class="mr-4 text-gray-700">Budi Santoso</span>
                    <img src="https://via.placeholder.com/40" alt="Customer Avatar" class="rounded-full">
                </div>
            </header>

            <main class="flex-1 overflow-x-hidden overflow-y-auto bg-gray-100 p-6">
                <div class="bg-white p-8 rounded-lg shadow-md w-full max-w-2xl mx-auto">
                    <h3 class="text-xl font-semibold mb-6 text-center">Form Pemesanan Jasa</h3>
                    <form action="/orders" method="POST">
                        <div class="mb-4">
                            <label for="service_type" class="block text-gray-700 text-sm font-bold mb-2">Jenis Jasa</label>
                            <select id="service_type" name="service_type"
                                    class="shadow border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline
                                    ">
                                <option value="">Pilih Jenis Jasa</option>
                                <option value="laptop" {{ old('service_type') == 'laptop' ? 'selected' : '' }}>Service Laptop</option>
                                <option value="ac" {{ old('service_type') == 'ac' ? 'selected' : '' }}>Perbaikan AC</option>
                                <option value="tv" {{ old('service_type') == 'tv' ? 'selected' : '' }}>Service TV</option>
                                <option value="cctv" {{ old('service_type') == 'cctv' ? 'selected' : '' }}>Instalasi CCTV</option>
                            </select>
                            <p class="text-red-500 text-xs italic mt-1 hidden">Jenis jasa wajib dipilih.</p>
                        </div>

                        <div class="mb-4">
                            <label for="device_problem" class="block text-gray-700 text-sm font-bold mb-2">Deskripsi Masalah</label>
                            <textarea id="device_problem" name="device_problem" rows="4"
                                      class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline
                                      "
                                      placeholder="Jelaskan masalah perangkat Anda secara detail...">{{ old('device_problem') }}</textarea>
                            <p class="text-red-500 text-xs italic mt-1 hidden">Deskripsi masalah minimal 10 karakter.</p>
                        </div>

                        <div class="mb-4">
                            <label for="address" class="block text-gray-700 text-sm font-bold mb-2">Alamat Lengkap</label>
                            <input type="text" id="address" name="address" value="{{ old('address') }}"
                                   class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline
                                   "
                                   placeholder="Masukkan alamat lengkap Anda">
                            <p class="text-red-500 text-xs italic mt-1 hidden">Alamat lengkap wajib diisi.</p>
                        </div>

                        <div class="mb-6">
                            <label for="appointment_date" class="block text-gray-700 text-sm font-bold mb-2">Tanggal Janji Temu</label>
                            <input type="date" id="appointment_date" name="appointment_date" value="{{ old('appointment_date') }}"
                                   class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline
                                   ">
                            <p class="text-red-500 text-xs italic mt-1 hidden">Tanggal janji temu tidak boleh di masa lalu.</p>
                        </div>

                        <div class="flex items-center justify-between">
                            <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline w-full">
                                Buat Pesanan
                            </button>
                        </div>
                    </form>
                </div>

                <div class="bg-white p-6 rounded-lg shadow-md mt-6">
                    <h3 class="text-xl font-semibold mb-4">Riwayat Pesanan Anda</h3>
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">ID Pesanan</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Jasa</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tanggal</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap">#001</td>
                                <td class="px-6 py-4 whitespace-nowrap">Service Laptop</td>
                                <td class="px-6 py-4 whitespace-nowrap"><span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-yellow-100 text-yellow-800">Menunggu Konfirmasi</span></td>
                                <td class="px-6 py-4 whitespace-nowrap">2025-07-23</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                    <button class="text-blue-600 hover:text-blue-900 mr-2">Detail</button>
                                    <button class="text-red-600 hover:text-red-900">Batal</button>
                                </td>
                            </tr>
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap">#002</td>
                                <td class="px-6 py-4 whitespace-nowrap">Perbaikan AC</td>
                                <td class="px-6 py-4 whitespace-nowrap"><span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">Selesai</span></td>
                                <td class="px-6 py-4 whitespace-nowrap">2025-07-20</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                    <button class="text-blue-600 hover:text-blue-900">Detail</button>
                                </td>
                            </tr>
                            </tbody>
                    </table>
                </div>
            </main>
        </div>
    </div>
</body>
</html>