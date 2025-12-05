@extends('layouts.admin')
@section('header', 'Tambah Pasien')
@section('content')
<form method="POST" action="{{ route('pasien.store') }}" class="max-w-2xl mx-auto bg-white p-6 rounded-xl shadow-lg space-y-4">
    @csrf

    <h2 class="text-xl font-bold text-gray-800 mb-4">📋 Data Hewan</h2>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Nama Hewan</label>
            <input 
                name="nama_hewan" 
                value="{{ old('nama_hewan') }}" 
                required 
                class="block w-full rounded-lg border border-gray-300 px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
            @error('nama_hewan')
                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Jenis Hewan</label>
            <input 
                name="jenis_hewan" 
                value="{{ old('jenis_hewan') }}" 
                required 
                placeholder="Contoh: Kucing, Anjing, Kelinci"
                class="block w-full rounded-lg border border-gray-300 px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
            @error('jenis_hewan')
                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
            @enderror
        </div>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Ras</label>
            <input 
                name="ras" 
                value="{{ old('ras') }}" 
                placeholder="Contoh: Persian, Golden Retriever"
                class="block w-full rounded-lg border border-gray-300 px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
            @error('ras')
                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Tanggal Lahir</label>
            <input 
                type="date" 
                name="tanggal_lahir" 
                value="{{ old('tanggal_lahir') }}" 
                max="{{ date('Y-m-d') }}"
                class="block w-full rounded-lg border border-gray-300 px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
            <p class="text-xs text-gray-500 mt-1">Umur akan dihitung otomatis dari tanggal lahir</p>
            @error('tanggal_lahir')
                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
            @enderror
        </div>
    </div>

    <div>
        <label class="block text-sm font-medium text-gray-700 mb-1">
            Umur Manual (jika tanggal lahir tidak diketahui)
        </label>
        <div class="flex gap-2 items-center">
            <input 
                type="number" 
                name="umur_hewan" 
                value="{{ old('umur_hewan') }}" 
                min="0"
                placeholder="0"
                class="block w-32 rounded-lg border border-gray-300 px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
            <span class="text-gray-600">tahun</span>
        </div>
        <p class="text-xs text-gray-500 mt-1">Isi ini hanya jika tanggal lahir tidak diketahui</p>
        @error('umur_hewan')
            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
        @enderror
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Jenis Kelamin</label>
            <select 
                name="jenis_kelamin" 
                required 
                class="block w-full rounded-lg border border-gray-300 px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                <option value="">-- Pilih --</option>
                <option value="Jantan" {{ old('jenis_kelamin')=='Jantan' ? 'selected' : '' }}>Jantan</option>
                <option value="Betina" {{ old('jenis_kelamin')=='Betina' ? 'selected' : '' }}>Betina</option>
            </select>
            @error('jenis_kelamin')
                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Status</label>
            <select 
                name="status" 
                required
                class="block w-full rounded-lg border border-gray-300 px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                @foreach(\App\Models\Patient::getStatusList() as $s)
                    <option value="{{ $s }}" {{ old('status', 'Booking') == $s ? 'selected' : '' }}>
                        {{ $s }}
                    </option>
                @endforeach
            </select>
            @error('status')
                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
            @enderror
        </div>
    </div>

    <div>
        <label class="block text-sm font-medium text-gray-700 mb-1">Judul Perawatan</label>
        <input 
            name="judul_perawatan" 
            value="{{ old('judul_perawatan') }}" 
            placeholder="Contoh: Operasi Kaki, Vaksinasi Rabies, Perawatan Luka"
            class="block w-full rounded-lg border border-gray-300 px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
        <p class="text-xs text-gray-500 mt-1">Isi dengan jenis perawatan yang akan/sedang dilakukan</p>
        @error('judul_perawatan')
            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
        @enderror
    </div>

    <hr class="my-6 border-gray-300">
    
    <h2 class="text-xl font-bold text-gray-800 mb-4">👤 Data Pemilik</h2>

    <div>
        <label class="block text-sm font-medium text-gray-700 mb-1">Nama Pemilik</label>
        <input 
            name="nama_pemilik" 
            value="{{ old('nama_pemilik') }}" 
            placeholder="Nama lengkap pemilik hewan"
            class="block w-full rounded-lg border border-gray-300 px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
        @error('nama_pemilik')
            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
        @enderror
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Telepon Pemilik</label>
            <input 
                name="telepon_pemilik" 
                value="{{ old('telepon_pemilik') }}" 
                placeholder="08xxxxxxxxxx"
                class="block w-full rounded-lg border border-gray-300 px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
            @error('telepon_pemilik')
                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Alamat Pemilik</label>
            <input 
                name="alamat_pemilik" 
                value="{{ old('alamat_pemilik') }}" 
                placeholder="Alamat lengkap"
                class="block w-full rounded-lg border border-gray-300 px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
            @error('alamat_pemilik')
                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
            @enderror
        </div>
    </div>

    <hr class="my-6 border-gray-300">

    <div>
        <label class="block text-sm font-medium text-gray-700 mb-1">Riwayat Perawatan</label>
        <textarea 
            name="riwayat_perawatan" 
            rows="3"
            placeholder="Catatan riwayat perawatan sebelumnya (jika ada)"
            class="block w-full rounded-lg border border-gray-300 px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">{{ old('riwayat_perawatan') }}</textarea>
        @error('riwayat_perawatan')
            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
        @enderror
    </div>

    <div class="flex justify-between pt-4">
        <button class="px-6 py-2.5 bg-blue-600 text-white rounded-lg hover:bg-blue-700 font-semibold transition shadow" type="submit">
            💾 Simpan
        </button>
        <a href="{{ route('pasien.index') }}" class="px-6 py-2.5 bg-gray-200 text-gray-700 rounded-lg hover:bg-gray-300 font-semibold transition">
            ← Batal
        </a>
    </div>
</form>
@endsection
