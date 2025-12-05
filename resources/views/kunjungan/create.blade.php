@extends('layouts.admin')
@section('header', 'Tambah Kunjungan')
@section('content')

<div class="max-w-2xl mx-auto bg-white p-6 rounded-xl shadow-lg">
    <h2 class="font-bold text-xl mb-4 text-blue-700">Tambah Kunjungan Baru</h2>

    {{-- ✅ Notifikasi jika status pasien otomatis diubah --}}
    @if(session('info'))
        <div class="bg-blue-50 border-l-4 border-blue-500 text-blue-700 p-4 mb-4 rounded">
            <div class="flex items-start">
                <svg class="w-5 h-5 mr-2 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
                <div>
                    <p class="font-semibold">{{ session('info') }}</p>
                    <p class="text-sm mt-1">Pasien sekarang dapat menerima layanan klinik.</p>
                </div>
            </div>
        </div>
    @endif

    <form method="POST" action="{{ route('kunjungan.store') }}" class="space-y-4">
        @csrf

        <h3 class="text-lg font-bold text-gray-800 mb-2">🐾 Informasi Pasien</h3>

        {{-- ✅ Dropdown Pasien dengan Select2 (FIXED) --}}
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Pilih Pasien</label>
            <select name="id_pasien" id="id_pasien" required
                    class="w-full rounded-lg border-2 border-gray-300 py-2.5 px-3 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 bg-white">
                <option value="">-- Pilih Pasien --</option>
                @foreach($patients as $p)
                    <option value="{{ $p->id }}" 
                            {{ (request('patient_id') == $p->id || old('id_pasien') == $p->id) ? 'selected' : '' }}>
                        🐾 {{ $p->nama_hewan }} ({{ $p->jenis_hewan }})
                        @if($p->nama_pemilik)
                            | 👤 {{ $p->nama_pemilik }}
                        @endif
                        | 📊 {{ $p->status }}
                    </option>
                @endforeach
            </select>
            <p class="text-xs text-gray-500 mt-1">
                💡 Ketik nama hewan, jenis, atau pemilik untuk mencari dengan cepat
            </p>
            @error('id_pasien')
                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
            @enderror
        </div>

        <hr class="my-6 border-gray-300">

        <h3 class="text-lg font-bold text-gray-800 mb-2">👨‍⚕️ Informasi Medis</h3>

        <div class="grid grid-cols-2 gap-4">
            {{-- ✅ Dropdown Dokter (FIXED) --}}
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Pilih Dokter</label>
                <select name="id_dokter" id="id_dokter" required
                        class="w-full rounded-lg border-2 border-gray-300 py-2.5 px-3 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 bg-white">
                    <option value="">-- Pilih Dokter --</option>
                    @foreach($doctors as $d)
                        <option value="{{ $d->id }}" {{ old('id_dokter') == $d->id ? 'selected' : '' }}>
                            {{ $d->nama }} - {{ $d->spesialisasi ?? '' }}
                        </option>
                    @endforeach
                </select>
                @error('id_dokter')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            {{-- ✅ Dropdown Layanan (FIXED) --}}
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Pilih Layanan</label>
                <select name="id_layanan" id="id_layanan" required
                        class="w-full rounded-lg border-2 border-gray-300 py-2.5 px-3 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 bg-white">
                    <option value="">-- Pilih Layanan --</option>
                    @foreach($services as $s)
                        <option value="{{ $s->id }}" {{ old('id_layanan') == $s->id ? 'selected' : '' }}>
                            {{ $s->nama_layanan }} (Rp {{ number_format($s->harga, 0, ',', '.') }})
                        </option>
                    @endforeach
                </select>
                @error('id_layanan')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>
        </div>

        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Tanggal Kunjungan</label>
            <input type="date" name="tanggal_kunjungan" value="{{ old('tanggal_kunjungan', date('Y-m-d')) }}" required
                   class="w-full rounded-lg border-2 border-gray-300 py-2.5 px-3 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
            @error('tanggal_kunjungan')
                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Keluhan</label>
            <textarea name="keluhan" rows="3" required placeholder="Keluhan atau gejala yang dialami hewan"
                      class="w-full rounded-lg border-2 border-gray-300 py-2.5 px-3 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">{{ old('keluhan') }}</textarea>
            @error('keluhan')
                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Diagnosis (Opsional)</label>
            <textarea name="diagnosis" rows="3" placeholder="Hasil pemeriksaan dokter"
                      class="w-full rounded-lg border-2 border-gray-300 py-2.5 px-3 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">{{ old('diagnosis') }}</textarea>
            @error('diagnosis')
                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Tindakan (Opsional)</label>
            <textarea name="tindakan" rows="3" placeholder="Tindakan yang dilakukan dokter"
                      class="w-full rounded-lg border-2 border-gray-300 py-2.5 px-3 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">{{ old('tindakan') }}</textarea>
            @error('tindakan')
                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Catatan Tambahan (Opsional)</label>
            <textarea name="catatan" rows="2" placeholder="Catatan atau informasi tambahan"
                      class="w-full rounded-lg border-2 border-gray-300 py-2.5 px-3 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">{{ old('catatan') }}</textarea>
            @error('catatan')
                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div class="grid grid-cols-2 gap-4">
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Total Biaya (Rp)</label>
                <input type="number" name="total_biaya" min="0" value="{{ old('total_biaya', 0) }}" required
                       class="w-full rounded-lg border-2 border-gray-300 py-2.5 px-3 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                @error('total_biaya')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Status Kunjungan</label>
                <select name="status_visit" id="status_visit" required
                        class="w-full rounded-lg border-2 border-gray-300 py-2.5 px-3 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 bg-white">
                    <option value="Scheduled" {{ old('status_visit') == 'Scheduled' ? 'selected' : '' }}>Scheduled (Dijadwalkan)</option>
                    <option value="In Progress" {{ old('status_visit') == 'In Progress' ? 'selected' : '' }}>In Progress (Sedang Berlangsung)</option>
                    <option value="Completed" {{ old('status_visit') == 'Completed' ? 'selected' : '' }}>Completed (Selesai)</option>
                    <option value="Cancelled" {{ old('status_visit') == 'Cancelled' ? 'selected' : '' }}>Cancelled (Dibatalkan)</option>
                </select>
                @error('status_visit')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>
        </div>

        <div class="flex justify-between mt-6">
            <button type="submit" class="px-6 py-2.5 bg-blue-600 text-white rounded-lg hover:bg-blue-700 font-semibold transition shadow">
                💾 Simpan Kunjungan
            </button>
            <a href="{{ route('kunjungan.index') }}" class="px-6 py-2.5 bg-gray-200 text-gray-700 rounded-lg hover:bg-gray-300 font-semibold transition">
                ← Batal
            </a>
        </div>
    </form>
</div>

@endsection

{{-- ✅ STYLES untuk Select2 --}}
@push('styles')
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<style>
    /* Custom styling Select2 agar match dengan Tailwind */
    .select2-container--default .select2-selection--single {
        height: 44px !important;
        border: 2px solid #d1d5db !important;
        border-radius: 0.5rem !important;
        padding: 0.625rem 0.75rem !important;
    }
    .select2-container--default .select2-selection--single .select2-selection__rendered {
        line-height: 20px !important;
        color: #374151 !important;
        padding-left: 0 !important;
    }
    .select2-container--default .select2-selection--single .select2-selection__arrow {
        height: 42px !important;
    }
    .select2-container--default.select2-container--focus .select2-selection--single {
        border-color: #3b82f6 !important;
        box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.1) !important;
    }
    .select2-container {
        width: 100% !important;
    }
    .select2-dropdown {
        border: 2px solid #d1d5db !important;
        border-radius: 0.5rem !important;
    }
    .select2-results__option--highlighted[aria-selected] {
        background-color: #3b82f6 !important;
    }
</style>
@endpush

{{-- ✅ SCRIPTS untuk Select2 (FIXED ID SELECTOR) --}}
@push('scripts')
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script>
$(document).ready(function() {
    // ✅ Aktifkan Select2 untuk dropdown pasien (ID yang benar: id_pasien)
    $('#id_pasien').select2({
        placeholder: '🔍 Ketik nama hewan, pemilik, atau jenis...',
        allowClear: true,
        width: '100%'
    });

    // ✅ Aktifkan Select2 untuk dropdown dokter (ID yang benar: id_dokter)
    $('#id_dokter').select2({
        placeholder: '👨‍⚕️ Pilih Dokter',
        allowClear: true,
        width: '100%'
    });

    // ✅ Aktifkan Select2 untuk dropdown layanan (ID yang benar: id_layanan)
    $('#id_layanan').select2({
        placeholder: '💉 Pilih Layanan',
        allowClear: true,
        width: '100%'
    });
});
</script>
@endpush
