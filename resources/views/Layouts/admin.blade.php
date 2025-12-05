<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Dashboard') - VetCare Center</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        primary: {
                            50: '#eff6ff',
                            100: '#dbeafe',
                            200: '#bfdbfe',
                            300: '#93c5fd',
                            400: '#60a5fa',
                            500: '#3b82f6',
                            600: '#2563eb',
                            700: '#1d4ed8',
                            800: '#1e40af',
                            900: '#1e3a8a',
                        },
                        secondary: {
                            400: '#c084fc',
                            500: '#a855f7',
                            600: '#9333ea',
                            700: '#7e22ce',
                            800: '#6b21a8',
                        }
                    }
                }
            }
        }
    </script>
    @stack('styles')
</head>

<body class="bg-gray-50">
    <div class="flex h-screen overflow-hidden">
        <!-- Sidebar Kiri -->
        <aside class="w-64 bg-gradient-to-b from-blue-600 to-purple-700 text-white flex-shrink-0">
            <div class="p-6">
                <h1 class="text-2xl font-bold">VetCare</h1>
                <p class="text-blue-100 text-sm">Sistem Klinik Hewan</p>
            </div>

            <!-- ✅ NAVIGATION dengan Active State -->
            <nav class="mt-6">
                <!-- Dashboard -->
                <a href="{{ route('dashboard') }}"
                    class="flex items-center px-6 py-3 hover:bg-white hover:bg-opacity-10 transition rounded-lg
                           {{ request()->routeIs('dashboard') ? 'bg-white bg-opacity-25 border-l-4 border-white' : '' }}">
                    <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 3 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6">
                        </path>
                    </svg>
                    Dashboard
                </a>

                <!-- Pasien -->
                <a href="{{ route('pasien.index') }}"
                    class="flex items-center px-6 py-3 hover:bg-white hover:bg-opacity-10 transition rounded-lg
                           {{ request()->routeIs('pasien.*') ? 'bg-white bg-opacity-25 border-l-4 border-white' : '' }}">
                    <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z">
                        </path>
                    </svg>
                    Pasien
                </a>

                <!-- Dokter -->
                <a href="{{ route('dokter.index') }}"
                    class="flex items-center px-6 py-3 hover:bg-white hover:bg-opacity-10 transition rounded-lg
                           {{ request()->routeIs('dokter.*') ? 'bg-white bg-opacity-25 border-l-4 border-white' : '' }}">
                    <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                    </svg>
                    Dokter
                </a>

                <!-- Layanan -->
                <a href="{{ route('layanan.index') }}"
                    class="flex items-center px-6 py-3 hover:bg-white hover:bg-opacity-10 transition rounded-lg
                           {{ request()->routeIs('layanan.*') ? 'bg-white bg-opacity-25 border-l-4 border-white' : '' }}">
                    <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10">
                        </path>
                    </svg>
                    Layanan
                </a>

                <!-- Kunjungan -->
                <a href="{{ route('kunjungan.index') }}"
                    class="flex items-center px-6 py-3 hover:bg-white hover:bg-opacity-10 transition rounded-lg
                           {{ request()->routeIs('kunjungan.*') ? 'bg-white bg-opacity-25 border-l-4 border-white' : '' }}">
                    <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2">
                        </path>
                    </svg>
                    Kunjungan
                </a>

                <div class="border-t border-white border-opacity-20 my-4"></div>

                <!-- Logout -->
                <a href="#"
                    class="flex items-center px-6 py-3 hover:bg-white hover:bg-opacity-10 transition rounded-lg text-red-200">
                    <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1">
                        </path>
                    </svg>
                    Logout
                </a>
            </nav>

            <!-- User Profile (Bottom) -->
            <div class="absolute bottom-0 w-64 p-6 bg-black bg-opacity-20">
                <div class="flex items-center">
                    <div class="w-10 h-10 rounded-full bg-white bg-opacity-20 flex items-center justify-center">
                        <span class="text-lg font-bold">A</span>
                    </div>
                    <div class="ml-3">
                        <p class="text-sm font-semibold">Admin VetCare</p>
                        <p class="text-xs text-blue-200">Administrator</p>
                    </div>
                </div>
            </div>
        </aside>

        <!-- Content Area (Kanan) -->
        <div class="flex-1 flex flex-col overflow-hidden">
            <!-- Header -->
            <header class="bg-white shadow-sm z-10">
                <div class="px-6 py-4 flex items-center justify-between">
                    <h2 class="text-xl font-semibold text-gray-800">@yield('header', 'Dashboard')</h2>
                    <div class="flex items-center space-x-4">
                        <span class="text-sm text-gray-600">{{ now()->format('d M Y, H:i') }} WIB</span>
                    </div>
                </div>
            </header>

            <!-- Main Content (Scrollable) -->
            <main class="flex-1 overflow-y-auto p-6 bg-gray-50">
                @yield('content')
            </main>

            <!-- Footer -->
            <footer class="bg-white border-t border-gray-200 px-6 py-3">
                <p class="text-sm text-gray-600 text-center">© 2025 VetCare Center - Sistem Informasi Klinik Hewan</p>
            </footer>
        </div>
    </div>
    @stack('scripts')
</body>

</html>
