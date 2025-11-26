<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Admin - VetCare Center</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gradient-to-br from-blue-50 via-purple-50 to-blue-50 min-h-screen">
    
    <!-- Sidebar -->
    <div class="flex">
        <aside class="w-64 bg-gradient-to-b from-blue-600 to-purple-600 min-h-screen text-white p-6">
            <div class="mb-8">
                <h1 class="text-2xl font-bold">🐾 VetCare</h1>
                <p class="text-blue-100 text-sm">Admin Panel</p>
            </div>
            
            <nav class="space-y-2">
                <a href="#" class="block py-3 px-4 bg-white bg-opacity-20 rounded-lg font-medium">
                    📊 Dashboard
                </a>
                <a href="#" class="block py-3 px-4 hover:bg-white hover:bg-opacity-10 rounded-lg transition">
                    🏥 Layanan
                </a>
                <a href="#" class="block py-3 px-4 hover:bg-white hover:bg-opacity-10 rounded-lg transition">
                    👨‍⚕️ Dokter
                </a>
                <a href="#" class="block py-3 px-4 hover:bg-white hover:bg-opacity-10 rounded-lg transition">
                    🐕 Pasien
                </a>
                <a href="#" class="block py-3 px-4 hover:bg-white hover:bg-opacity-10 rounded-lg transition">
                    📋 Kunjungan
                </a>
                <a href="#" class="block py-3 px-4 hover:bg-white hover:bg-opacity-10 rounded-lg transition">
                    ⚙️ Profil Klinik
                </a>
                <a href="#" class="block py-3 px-4 hover:bg-white hover:bg-opacity-10 rounded-lg transition text-red-200">
                    🚪 Logout
                </a>
            </nav>
        </aside>

        <!-- Main Content -->
        <main class="flex-1 p-8">
            <!-- Header -->
            <div class="mb-8">
                <h2 class="text-3xl font-bold text-gray-800 mb-2">Dashboard</h2>
                <p class="text-gray-600">Selamat datang di VetCare Center Admin Panel</p>
            </div>

            <!-- Stats Cards -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
                <!-- Total Pasien -->
                <div class="bg-white rounded-xl shadow-md p-6 border-l-4 border-blue-500">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-gray-500 text-sm font-medium mb-1">Total Pasien</p>
                            <h3 class="text-3xl font-bold text-gray-800">127</h3>
                            <p class="text-green-500 text-xs mt-2">↑ 12% dari bulan lalu</p>
                        </div>
                        <div class="bg-blue-100 p-4 rounded-full">
                            <span class="text-3xl">🐾</span>
                        </div>
                    </div>
                </div>

                <!-- Total Dokter -->
                <div class="bg-white rounded-xl shadow-md p-6 border-l-4 border-purple-500">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-gray-500 text-sm font-medium mb-1">Total Dokter</p>
                            <h3 class="text-3xl font-bold text-gray-800">8</h3>
                            <p class="text-blue-500 text-xs mt-2">Dokter aktif</p>
                        </div>
                        <div class="bg-purple-100 p-4 rounded-full">
                            <span class="text-3xl">👨‍⚕️</span>
                        </div>
                    </div>
                </div>

                <!-- Total Layanan -->
                <div class="bg-white rounded-xl shadow-md p-6 border-l-4 border-indigo-500">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-gray-500 text-sm font-medium mb-1">Total Layanan</p>
                            <h3 class="text-3xl font-bold text-gray-800">15</h3>
                            <p class="text-indigo-500 text-xs mt-2">Layanan tersedia</p>
                        </div>
                        <div class="bg-indigo-100 p-4 rounded-full">
                            <span class="text-3xl">🏥</span>
                        </div>
                    </div>
                </div>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                <!-- Jadwal Dokter Hari Ini -->
                <div class="bg-white rounded-xl shadow-md p-6">
                    <div class="flex items-center justify-between mb-4">
                        <h3 class="text-xl font-bold text-gray-800">📅 Jadwal Dokter Hari Ini</h3>
                        <span class="text-sm text-gray-500">Senin, 24 Nov 2025</span>
                    </div>
                    
                    <div class="space-y-4">
                        <!-- Dokter 1 -->
                        <div class="flex items-center p-4 bg-gradient-to-r from-blue-50 to-purple-50 rounded-lg">
                            <div class="bg-blue-500 text-white w-12 h-12 rounded-full flex items-center justify-center font-bold mr-4">
                                DR
                            </div>
                            <div class="flex-1">
                                <h4 class="font-semibold text-gray-800">dr. Rina Kusuma</h4>
                                <p class="text-sm text-gray-600">Spesialis Bedah</p>
                            </div>
                            <div class="text-right">
                                <p class="text-sm font-medium text-gray-700">08:00 - 14:00</p>
                                <span class="text-xs bg-green-100 text-green-700 px-2 py-1 rounded-full">Tersedia</span>
                            </div>
                        </div>

                        <!-- Dokter 2 -->
                        <div class="flex items-center p-4 bg-gradient-to-r from-blue-50 to-purple-50 rounded-lg">
                            <div class="bg-purple-500 text-white w-12 h-12 rounded-full flex items-center justify-center font-bold mr-4">
                                AB
                            </div>
                            <div class="flex-1">
                                <h4 class="font-semibold text-gray-800">dr. Ahmad Budi</h4>
                                <p class="text-sm text-gray-600">Dokter Umum</p>
                            </div>
                            <div class="text-right">
                                <p class="text-sm font-medium text-gray-700">09:00 - 15:00</p>
                                <span class="text-xs bg-green-100 text-green-700 px-2 py-1 rounded-full">Tersedia</span>
                            </div>
                        </div>

                        <!-- Dokter 3 -->
                        <div class="flex items-center p-4 bg-gradient-to-r from-blue-50 to-purple-50 rounded-lg">
                            <div class="bg-indigo-500 text-white w-12 h-12 rounded-full flex items-center justify-center font-bold mr-4">
                                SP
                            </div>
                            <div class="flex-1">
                                <h4 class="font-semibold text-gray-800">dr. Sari Pratiwi</h4>
                                <p class="text-sm text-gray-600">Spesialis Kulit</p>
                            </div>
                            <div class="text-right">
                                <p class="text-sm font-medium text-gray-700">13:00 - 18:00</p>
                                <span class="text-xs bg-yellow-100 text-yellow-700 px-2 py-1 rounded-full">Sibuk</span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Aktivitas Terbaru -->
                <div class="bg-white rounded-xl shadow-md p-6">
                    <h3 class="text-xl font-bold text-gray-800 mb-4">🔔 Aktivitas Terbaru</h3>
                    
                    <div class="space-y-4">
                        <!-- Aktivitas 1 -->
                        <div class="flex items-start pb-4 border-b border-gray-100">
                            <div class="bg-green-100 p-2 rounded-lg mr-3">
                                <span class="text-lg">✅</span>
                            </div>
                            <div class="flex-1">
                                <p class="text-sm text-gray-800 font-medium">Pasien baru terdaftar</p>
                                <p class="text-xs text-gray-500">Kucing "Momo" - Pemilik: Budi Santoso</p>
                                <p class="text-xs text-gray-400 mt-1">10 menit yang lalu</p>
                            </div>
                        </div>

                        <!-- Aktivitas 2 -->
                        <div class="flex items-start pb-4 border-b border-gray-100">
                            <div class="bg-blue-100 p-2 rounded-lg mr-3">
                                <span class="text-lg">🔄</span>
                            </div>
                            <div class="flex-1">
                                <p class="text-sm text-gray-800 font-medium">Status pasien diupdate</p>
                                <p class="text-xs text-gray-500">Anjing "Max" → Status: Pasca-Karantina</p>
                                <p class="text-xs text-gray-400 mt-1">1 jam yang lalu</p>
                            </div>
                        </div>

                        <!-- Aktivitas 3 -->
                        <div class="flex items-start pb-4 border-b border-gray-100">
                            <div class="bg-purple-100 p-2 rounded-lg mr-3">
                                <span class="text-lg">⚕️</span>
                            </div>
                            <div class="flex-1">
                                <p class="text-sm text-gray-800 font-medium">Operasi selesai</p>
                                <p class="text-xs text-gray-500">Kelinci "Fluffy" - dr. Rina Kusuma</p>
                                <p class="text-xs text-gray-400 mt-1">2 jam yang lalu</p>
                            </div>
                        </div>

                        <!-- Aktivitas 4 -->
                        <div class="flex items-start pb-4 border-b border-gray-100">
                            <div class="bg-yellow-100 p-2 rounded-lg mr-3">
                                <span class="text-lg">📋</span>
                            </div>
                            <div class="flex-1">
                                <p class="text-sm text-gray-800 font-medium">Booking baru</p>
                                <p class="text-xs text-gray-500">Hamster "Chippy" - Jadwal: 25 Nov 2025</p>
                                <p class="text-xs text-gray-400 mt-1">3 jam yang lalu</p>
                            </div>
                        </div>

                        <!-- Aktivitas 5 -->
                        <div class="flex items-start">
                            <div class="bg-red-100 p-2 rounded-lg mr-3">
                                <span class="text-lg">🏥</span>
                            </div>
                            <div class="flex-1">
                                <p class="text-sm text-gray-800 font-medium">Layanan baru ditambahkan</p>
                                <p class="text-xs text-gray-500">Vaksinasi Rabies - Rp 250.000</p>
                                <p class="text-xs text-gray-400 mt-1">5 jam yang lalu</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Quick Actions -->
            <div class="mt-8 bg-gradient-to-r from-blue-500 to-purple-600 rounded-xl shadow-md p-6 text-white">
                <h3 class="text-xl font-bold mb-4">⚡ Aksi Cepat</h3>
                <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                    <a href="#" class="bg-white bg-opacity-20 hover:bg-opacity-30 transition p-4 rounded-lg text-center">
                        <span class="text-2xl block mb-2">➕</span>
                        <span class="text-sm font-medium">Tambah Pasien</span>
                    </a>
                    <a href="#" class="bg-white bg-opacity-20 hover:bg-opacity-30 transition p-4 rounded-lg text-center">
                        <span class="text-2xl block mb-2">👨‍⚕️</span>
                        <span class="text-sm font-medium">Tambah Dokter</span>
                    </a>
                    <a href="#" class="bg-white bg-opacity-20 hover:bg-opacity-30 transition p-4 rounded-lg text-center">
                        <span class="text-2xl block mb-2">🏥</span>
                        <span class="text-sm font-medium">Tambah Layanan</span>
                    </a>
                    <a href="#" class="bg-white bg-opacity-20 hover:bg-opacity-30 transition p-4 rounded-lg text-center">
                        <span class="text-2xl block mb-2">📊</span>
                        <span class="text-sm font-medium">Lihat Laporan</span>
                    </a>
                </div>
            </div>
        </main>
    </div>

</body>
</html>