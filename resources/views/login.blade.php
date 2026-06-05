@extends('layouts.auth')

@section('title', 'Login')

@section('content')
    <div class="w-full max-w-md">
        <div class="bg-white rounded-2xl shadow-2xl px-8 py-10">
            <div class="mb-6 text-center">
                <h2 class="text-2xl font-bold text-gray-900 mb-1">Selamat datang!</h2>
                <p class="text-gray-500 text-sm">Masuk untuk mengelola hewan dan appointment Anda</p>
            </div>

            <form method="POST" action="{{ route('login.process') }}">
                @csrf

                <div class="mb-4">
                    <label for="login-email" class="block text-sm font-medium text-gray-700 mb-1">Email</label>
                    <input type="email" id="login-email" name="email" placeholder="email@example.com" value="{{ old('email') }}"
                        class="w-full rounded-xl border @error('email') border-red-500 @else border-gray-300 @enderror px-4 py-2 text-base outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors"
                        required />
                    @error('email')
                        <p class="text-red-500 text-xs mt-1 font-medium">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-6">
                    <label for="login-password" class="block text-sm font-medium text-gray-700 mb-1">Password</label>
                    <input type="password" id="login-password" name="password"
                        class="w-full rounded-xl border @error('password') border-red-500 @else border-gray-300 @enderror px-4 py-2 text-base outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors"
                        required />
                    @error('password')
                        <p class="text-red-500 text-xs mt-1 font-medium">{{ $message }}</p>
                    @enderror
                </div>

                <button type="submit"
                    class="w-full rounded-full bg-gradient-to-r from-blue-600 to-indigo-700 text-white py-2 font-semibold text-base transition hover:shadow-lg hover:opacity-95">
                    Masuk
                </button>
            </form>

            <p class="text-gray-500 text-center text-sm mt-6">
                Klik masuk untuk login!
            </p>
        </div>
    </div>
@endsection
