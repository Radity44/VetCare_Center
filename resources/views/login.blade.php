<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <script src="https://cdn.tailwindcss.com"></script>
    <title>Login</title>
</head>

<body>
    <section id="login-page"
        class="min-h-screen flex items-center justify-center bg-gradient-to-br from-blue-50 to-blue-100">
        <div class="w-full max-w-md">
            <div class="bg-white rounded-2xl shadow-2xl px-8 py-10">
                <div class="mb-6 text-center">
                    <h2 class="text-2xl font-bold text-gray-900 mb-1">Selamat datang!</h2>
                    <p class="text-gray-500 text-sm">Masuk untuk mengelola hewan dan appointment Anda</p>
                </div>

                <form id="login-form" onsubmit="handleLogin(event)">
                    <div class="mb-4">
                        <label for="login-email" class="block text-sm font-medium text-gray-700 mb-1">Email</label>
                        <input type="email" id="login-email" placeholder="email@example.com"
                            class="w-full rounded-xl border border-gray-300 px-4 py-2 text-base outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                            required />
                    </div>

                    <div class="mb-6">
                        <label for="login-password"
                            class="block text-sm font-medium text-gray-700 mb-1">Password</label>
                        <input type="password" id="login-password"
                            class="w-full rounded-xl border border-gray-300 px-4 py-2 text-base outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                            required />
                    </div>

                    <button type="submit"
                        class="w-full rounded-full bg-gradient-to-r from-blue-600 to-indigo-700 text-white py-2 font-semibold text-base transition hover:shadow-lg hover:opacity-95">
                        Masuk
                    </button>
                </form>

                <p class="text-gray-500 text-center text-sm mt-6">
                    Belum punya akun?
                    <button type="button" class="text-blue-600 font-semibold hover:underline ml-1"
                        onclick="showRegister()">Daftar dulu</button>
                </p>
            </div>
        </div>
    </section>
</body>

</html>
