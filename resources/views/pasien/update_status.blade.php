@extends('layouts.admin')
@section('header', 'Update Status Pasien')
@section('content')

<div class="max-w-2xl mx-auto">
    <div class="bg-white p-8 rounded-xl shadow-lg">
        <h2 class="text-2xl font-bold text-gray-800 mb-2">Update Status Pasien</h2>
        <p class="text-gray-600 mb-6">Pasien: <span class="font-semibold text-blue-600">{{ $pasien->nama_hewan }}</span></p>

        <form method="POST" action="{{ route('pasien.updateStatus', $pasien) }}">
            @csrf

            <!-- Status Saat Ini -->
            <div class="bg-blue-50 border border-blue-200 rounded-lg p-4 mb-6">
                <p class="text-sm text-blue-800 font-semibold mb-2">Status Saat Ini:</p>
                <span class="inline-block px-4 py-2 rounded-full text-sm font-bold border {{ \App\Models\Patient::getStatusColor($pasien->status) }}">
                    {{ $pasien->status }}
                </span>
            </div>

            <!-- Pilih Status Baru -->
            <div class="mb-6">
                <label class="block text-sm font-semibold text-gray-700 mb-2">Ubah Status Menjadi:</label>
                <div class="grid grid-cols-2 md:grid-cols-3 gap-3">
                    @foreach($statusList as $status)
                        <label class="cursor-pointer">
                            <input 
                                type="radio" 
                                name="status" 
                                value="{{ $status }}" 
                                {{ $pasien->status == $status ? 'checked' : '' }}
                                class="peer hidden"
                                required
                            >
                            <div class="p-3 rounded-lg border-2 text-center transition peer-checked:ring-2 peer-checked:ring-blue-500 peer-checked:border-blue-500 hover:bg-gray-50 {{ \App\Models\Patient::getStatusColor($status) }}">
                                <span class="text-xs font-semibold">{{ $status }}</span>
                            </div>
                        </label>
                    @endforeach
                </div>
                @error('status')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Catatan Tambahan -->
            <div class="mb-6">
                <label class="block text-sm font-semibold text-gray-700 mb-2">Catatan Perubahan Status (Opsional)</label>
                <textarea 
                    name="catatan_status" 
                    rows="3" 
                    placeholder="Contoh: Pasien menunjukkan perbaikan setelah operasi..."
                    class="w-full rounded-lg border border-gray-300 px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500"
                >{{ old('catatan_status') }}</textarea>
                <p class="text-xs text-gray-500 mt-1">Catatan ini akan ditambahkan ke riwayat perawatan pasien.</p>
            </div>

            <!-- Info Penting -->
            <div class="bg-yellow-50 border-l-4 border-yellow-400 p-4 mb-6">
                <p class="text-sm text-yellow-800">
                    <strong>⚠️ Perhatian:</strong> Status <strong>Kritis</strong> menandakan pasien dalam kondisi darurat. 
                    Status <strong>Meninggal</strong> bersifat permanen.
                </p>
            </div>

            <!-- Tombol Aksi -->
            <div class="flex gap-3">
                <button 
                    type="submit" 
                    class="px-6 py-3 bg-blue-600 text-white rounded-lg font-semibold hover:bg-blue-700 transition shadow">
                    💾 Simpan Perubahan
                </button>
                <a 
                    href="{{ route('pasien.show', $pasien) }}" 
                    class="px-6 py-3 bg-gray-200 text-gray-700 rounded-lg font-semibold hover:bg-gray-300 transition">
                    ← Batal
                </a>
            </div>
        </form>
    </div>
</div>

@endsection
