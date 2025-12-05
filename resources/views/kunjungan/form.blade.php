<form method="POST" action="{{ $action }}">
    @csrf
    @if($method === 'PUT') @method('PUT') @endif

    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Pasien</label>
            <select name="id_pasien" required 
                    class="w-full rounded-lg border border-gray-300 px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                <option value="">-- Pilih Pasien --</option>
                @foreach($patients as $patient)
                    <option value="{{ $patient->id }}" 
                            {{ old('id_pasien', $kunjungan->id_pasien ?? '') == $patient->id ? 'selected' : '' }}>
                        {{ $patient->nama_hewan }} ({{ $patient->jenis_hewan }})
                    </option>
                @endforeach
            </select>
            @error('id_pasien')
                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Dokter</label>
            <select name="id_dokter" required 
                    class="w-full rounded-lg border border-gray-300 px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                <option value="">-- Pilih Dokter --</option>
                @foreach($doctors as $doctor)
                    <option value="{{ $doctor->id }}" 
                            {{ old('id_dokter', $kunjungan->id_dokter ?? '') == $doctor->id ? 'selected' : '' }}>
                        Dr. {{ $doctor->nama }} ({{ $doctor->spesialis }})
                    </option>
                @endforeach
            </select>
            @error('id_dokter')
                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
            @enderror
        </div>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Layanan</label>
            <select name="id_layanan" required id="layanan-select"
                    class="w-full rounded-lg border border-gray-300 px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                <option value="">-- Pilih Layanan --</option>
                @foreach($services as $service)
                    <option value="{{ $service->id }}" 
                            data-harga="{{ $service->harga }}"
                            {{ old('id_layanan', $kunjungan->id_layanan ?? '') == $service->id ? 'selected' : '' }}>
                        {{ $service->nama_layanan }} - Rp {{ number_format($service->harga, 0, ',', '.') }}
                    </option>
                @endforeach
            </select>
            @error('id_layanan')
                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Tanggal & Waktu Kunjungan</label>
            <input type="datetime-local" name="tanggal_kunjungan" 
                   value="{{ old('tanggal_kunjungan', $kunjungan->tanggal_kunjungan ?? now()->format('Y-m-d\TH:i')) }}" 
                   required
                   class="w-full rounded-lg border border-gray-300 px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
            @error('tanggal_kunjungan')
                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
            @enderror
        </div>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Total Biaya (Rp)</label>
            <input type="number" name="total_biaya" id="total-biaya" min="0" step="0.01"
                   value="{{ old('total_biaya', $kunjungan->total_biaya ?? '') }}" 
                   class="w-full rounded-lg border border-gray-300 px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
            @error('total_biaya')
                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Status Kunjungan</label>
            <select name="status_visit" required
                    class="w-full rounded-lg border border-gray-300 px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                @foreach(['Scheduled', 'In Progress', 'Completed', 'Cancelled'] as $status)
                    <option value="{{ $status }}" 
                            {{ old('status_visit', $kunjungan->status_visit ?? 'Scheduled') == $status ? 'selected' : '' }}>
                        {{ $status }}
                    </option>
                @endforeach
            </select>
            @error('status_visit')
                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
            @enderror
        </div>
    </div>

    <div class="mb-4">
        <label class="block text-sm font-medium text-gray-700 mb-1">Keluhan</label>
        <textarea name="keluhan" rows="2" 
                  class="w-full rounded-lg border border-gray-300 px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">{{ old('keluhan', $kunjungan->keluhan ?? '') }}</textarea>
        @error('keluhan')
            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
        @enderror
    </div>

    <div class="mb-4">
        <label class="block text-sm font-medium text-gray-700 mb-1">Diagnosis</label>
        <textarea name="diagnosis" rows="2" 
                  class="w-full rounded-lg border border-gray-300 px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">{{ old('diagnosis', $kunjungan->diagnosis ?? '') }}</textarea>
        @error('diagnosis')
            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
        @enderror
    </div>

    <div class="mb-4">
        <label class="block text-sm font-medium text-gray-700 mb-1">Tindakan</label>
        <textarea name="tindakan" rows="2" 
                  class="w-full rounded-lg border border-gray-300 px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">{{ old('tindakan', $kunjungan->tindakan ?? '') }}</textarea>
        @error('tindakan')
            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
        @enderror
    </div>

    <div class="mb-6">
        <label class="block text-sm font-medium text-gray-700 mb-1">Catatan</label>
        <textarea name="catatan" rows="2" 
                  class="w-full rounded-lg border border-gray-300 px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">{{ old('catatan', $kunjungan->catatan ?? '') }}</textarea>
        @error('catatan')
            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
        @enderror
    </div>

    <div class="flex justify-between">
        <button type="submit" 
                class="px-5 py-2.5 bg-blue-600 text-white rounded-lg font-semibold hover:bg-blue-700 transition shadow">
            {{ $kunjungan ?? false ? 'Update' : 'Simpan' }}
        </button>
        <a href="{{ route('kunjungan.index') }}" 
           class="px-5 py-2.5 bg-gray-200 text-gray-700 rounded-lg font-semibold hover:bg-gray-300 transition">
            Batal
        </a>
    </div>
</form>

<script>
    // Auto-fill biaya dari layanan
    document.getElementById('layanan-select').addEventListener('change', function() {
        const selectedOption = this.options[this.selectedIndex];
        const harga = selectedOption.getAttribute('data-harga');
        if (harga) {
            document.getElementById('total-biaya').value = harga;
        }
    });
</script>
