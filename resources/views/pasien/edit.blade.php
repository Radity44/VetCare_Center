@extends('layouts.admin')
@section('header', 'Edit Data Pasien')
@section('content')
<div class="max-w-2xl mx-auto bg-white p-6 rounded-xl shadow-lg">
    <h2 class="font-bold text-xl mb-4 text-blue-700">Edit Pasien: <span class="text-gray-800">{{ $pasien->nama_hewan }}</span></h2>

    <form method="POST" action="{{ route('pasien.update', $pasien) }}" class="space-y-4">
        @csrf
        @method('PUT')

        <h3 class="text-lg font-bold text-gray-800 mb-2">📋 Data Hewan</h3>

        <div class="grid grid-cols-2 gap-4">
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Nama Hewan</label>
                <input name="nama_hewan" value="{{ old('nama_hewan', $pasien->nama_hewan) }}" required 
                       class="w-full rounded-lg border border-gray-300 py-2 px-3 focus:outline-none focus:ring-2 focus:ring-blue-500">
                @error('nama_hewan')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Jenis Hewan</label>
                <input name="jenis_hewan" value="{{ old('jenis_hewan', $pasien->jenis_hewan) }}" required 
                       class="w-full rounded-lg border border-gray-300 py-2 px-3 focus:outline-none focus:ring-2 focus:ring-blue-500">
                @error('jenis_hewan')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>
        </div>

        <div class="grid grid-cols-2 gap-4">
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Ras</label>
                <input name="ras" value="{{ old('ras', $pasien->ras) }}" 
                       class="w-full rounded-lg border border-gray-300 py-2 px-3 focus:outline-none focus:ring-2 focus:ring-blue-500">
                @error('ras')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>
            
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Tanggal Lahir</label>
                <input 
                    type="date" 
                    name="tanggal_lahir" 
                    value="{{ old('tanggal_lahir', $pasien->tanggal_lahir?->format('Y-m-d')) }}" 
                    max="{{ date('Y-m-d') }}"
                    class="w-full rounded-lg border border-gray-300 py-2 px-3 focus:outline-none focus:ring-2 focus:ring-blue-500">
                <p class="text-xs text-gray-500 mt-1">Umur akan dihitung otomatis</p>
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
                    min="0" 
                    value="{{ old('umur_hewan', $pasien->umur_hewan) }}" 
                    class="w-32 rounded-lg border border-gray-300 py-2 px-3 focus:outline-none focus:ring-2 focus:ring-blue-500">
                <span class="text-gray-600">tahun</span>
            </div>
            @error('umur_hewan')
                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div class="grid grid-cols-2 gap-4">
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Jenis Kelamin</label>
                <select name="jenis_kelamin" required 
                        class="w-full rounded-lg border border-gray-300 py-2 px-3 focus:outline-none focus:ring-2 focus:ring-blue-500">
                    <option value="Jantan" {{ $pasien->jenis_kelamin=='Jantan'?'selected':'' }}>Jantan</option>
                    <option value="Betina" {{ $pasien->jenis_kelamin=='Betina'?'selected':'' }}>Betina</option>
                </select>
                @error('jenis_kelamin')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Status</label>
                <select name="status" required
                        class="block w-full rounded-lg border border-gray-300 px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                    @foreach(\App\Models\Patient::getStatusList() as $s)
                        <option value="{{ $s }}" {{ old('status', $pasien->status ?? 'Booking') == $s ? 'selected' : '' }}>
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
                value="{{ old('judul_perawatan', $pasien->judul_perawatan) }}" 
                placeholder="Contoh: Operasi Kaki, Vaksinasi Rabies, Perawatan Luka"
                class="w-full rounded-lg border border-gray-300 py-2 px-3 focus:outline-none focus:ring-2 focus:ring-blue-500">
            <p class="text-xs text-gray-500 mt-1">Isi dengan jenis perawatan yang akan/sedang dilakukan</p>
            @error('judul_perawatan')
                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
            @enderror
        </div>

        <hr class="my-6 border-gray-300">

        <h3 class="text-lg font-bold text-gray-800 mb-2">👤 Data Pemilik</h3>

        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Nama Pemilik</label>
            <input name="nama_pemilik" value="{{ old('nama_pemilik', $pasien->nama_pemilik) }}" 
                   class="w-full rounded-lg border border-gray-300 py-2 px-3 focus:outline-none focus:ring-2 focus:ring-blue-500">
            @error('nama_pemilik')
                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div class="grid grid-cols-2 gap-4">
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Telepon Pemilik</label>
                <input name="telepon_pemilik" value="{{ old('telepon_pemilik', $pasien->telepon_pemilik) }}" 
                       class="w-full rounded-lg border border-gray-300 py-2 px-3 focus:outline-none focus:ring-2 focus:ring-blue-500">
                @error('telepon_pemilik')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Alamat Pemilik</label>
                <input name="alamat_pemilik" value="{{ old('alamat_pemilik', $pasien->alamat_pemilik) }}" 
                       class="w-full rounded-lg border border-gray-300 py-2 px-3 focus:outline-none focus:ring-2 focus:ring-blue-500">
                @error('alamat_pemilik')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>
        </div>

        <hr class="my-6 border-gray-300">

        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Riwayat Perawatan</label>
            <textarea name="riwayat_perawatan" rows="3" 
                      class="w-full rounded-lg border border-gray-300 py-2 px-3 focus:outline-none focus:ring-2 focus:ring-blue-500">{{ old('riwayat_perawatan', $pasien->riwayat_perawatan) }}</textarea>
            @error('riwayat_perawatan')
                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div class="flex justify-between mt-6">
            <button type="submit" class="px-6 py-2.5 bg-blue-600 text-white rounded-lg hover:bg-blue-700 font-semibold transition shadow">
                💾 Update
            </button>
            <a href="{{ route('pasien.index') }}" class="px-6 py-2.5 bg-gray-200 text-gray-700 rounded-lg hover:bg-gray-300 font-semibold transition">
                ← Batal
            </a>
        </div>
    </form>
</div>

<!-- Riwayat Kunjungan (DI LUAR FORM) -->
<div class="max-w-2xl mx-auto bg-white rounded-lg shadow-md p-6 mt-6">
    <h3 class="text-lg font-semibold text-gray-800 mb-4 flex items-center">
        <svg class="w-5 h-5 mr-2 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path>
        </svg>
        Riwayat Kunjungan
    </h3>

    @if($pasien->visits->count() > 0)
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">Tanggal</th>
                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">Dokter</th>
                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">Layanan</th>
                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">Keluhan</th>
                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">Diagnosis</th>
                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">Status</th>
                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">Biaya</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @foreach($pasien->visits as $visit)
                    <tr class="hover:bg-gray-50 transition">
                        <td class="px-4 py-3 text-sm text-gray-900">
                            {{ \Carbon\Carbon::parse($visit->tanggal_kunjungan)->format('d/m/Y') }}
                        </td>
                        <td class="px-4 py-3 text-sm text-gray-900">
                            {{ $visit->doctor->nama ?? '-' }}
                        </td>
                        <td class="px-4 py-3 text-sm text-gray-900">
                            {{ $visit->service->nama_layanan ?? '-' }}
                        </td>
                        <td class="px-4 py-3 text-sm text-gray-600">
                            <div class="max-w-xs truncate" title="{{ $visit->keluhan }}">
                                {{ Str::limit($visit->keluhan, 30) }}
                            </div>
                        </td>
                        <td class="px-4 py-3 text-sm text-gray-600">
                            <div class="max-w-xs truncate" title="{{ $visit->diagnosis }}">
                                {{ Str::limit($visit->diagnosis, 30) }}
                            </div>
                        </td>
                        <td class="px-4 py-3 text-sm">
                            @php
                                $statusColors = [
                                    'Scheduled' => 'bg-blue-100 text-blue-800',
                                    'In Progress' => 'bg-yellow-100 text-yellow-800',
                                    'Completed' => 'bg-green-100 text-green-800',
                                    'Cancelled' => 'bg-red-100 text-red-800',
                                ];
                            @endphp
                            <span class="px-2 py-1 rounded-full text-xs font-medium {{ $statusColors[$visit->status] ?? 'bg-gray-100 text-gray-800' }}">
                                {{ $visit->status }}
                            </span>
                        </td>
                        <td class="px-4 py-3 text-sm font-semibold text-gray-900">
                            Rp {{ number_format($visit->total_biaya, 0, ',', '.') }}
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <!-- Summary -->
        <div class="mt-4 pt-4 border-t border-gray-200 flex justify-between items-center">
            <p class="text-sm text-gray-600">
                <span class="font-semibold">Total Kunjungan:</span> {{ $pasien->visits->count() }} kali
            </p>
            <p class="text-sm text-gray-600">
                <span class="font-semibold">Total Biaya:</span> 
                <span class="text-lg font-bold text-purple-600">
                    Rp {{ number_format($pasien->visits->sum('total_biaya'), 0, ',', '.') }}
                </span>
            </p>
        </div>
    @else
        <!-- Empty State -->
        <div class="text-center py-8">
            <svg class="w-16 h-16 mx-auto text-gray-300 mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
            </svg>
            <p class="text-gray-500 font-medium">Belum ada riwayat kunjungan</p>
            <p class="text-sm text-gray-400 mt-1">Pasien ini belum pernah melakukan kunjungan ke klinik</p>
        </div>
    @endif
</div>
@endsection
