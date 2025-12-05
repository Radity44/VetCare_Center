<?php

namespace App\Http\Controllers;

use App\Models\Patient;
use App\Models\Visit;      // ← TAMBAH INI!
use Illuminate\Http\Request;
use Carbon\Carbon;
use Barryvdh\DomPDF\Facade\Pdf;

class PatientController extends Controller
{
    public function index(Request $request)
    {
        $query = Patient::query();
        
        // 🔍 Search
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('nama_hewan', 'like', "%{$search}%")
                  ->orWhere('nama_pemilik', 'like', "%{$search}%")
                  ->orWhere('jenis_hewan', 'like', "%{$search}%")
                  ->orWhere('ras', 'like', "%{$search}%");
            });
        }
        
        // 🎯 Filter: Status
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }
        
        // 🎯 Filter: Jenis Hewan
        if ($request->filled('jenis_hewan')) {
            $query->where('jenis_hewan', 'like', "%{$request->jenis_hewan}%");
        }
        
        $patients = $query->orderByDesc('created_at')->paginate(10);
        $statusList = Patient::getStatusList();
        
        return view('pasien.index', compact('patients', 'statusList'));
    }

    public function create()
    {
        return view('pasien.create');
    }

    // ✅ FIXED: Tanpa auto-create Visit
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama_hewan' => 'required|string|max:255',
            'jenis_hewan' => 'required|string|max:255',
            'ras' => 'nullable|string|max:255',
            'tanggal_lahir' => 'nullable|date',
            'umur' => 'nullable|string|max:50',
            'jenis_kelamin' => 'required|in:Jantan,Betina',
            'status' => 'required|string',
            'judul_perawatan' => 'nullable|string|max:255',
            'riwayat_perawatan' => 'nullable|string',
            'nama_pemilik' => 'nullable|string|max:255',
            'telepon_pemilik' => 'nullable|string|max:20',
            'alamat_pemilik' => 'nullable|string',
        ]);

        $pasien = Patient::create($validated);

        return redirect()->route('pasien.index')
            ->with('success', 'Pasien berhasil ditambahkan. Silakan buat kunjungan dari detail pasien.');
    }

    public function show(Patient $pasien)
    {
        $pasien->load([
            'visits' => function($query) {
                $query->orderBy('tanggal_kunjungan', 'desc')
                      ->orderBy('created_at', 'desc');
            }, 
            'visits.doctor', 
            'visits.service'
        ]);
        
        return view('pasien.show', compact('pasien'));
    }

    public function edit(Patient $pasien)
    {
        $pasien->load([
            'visits' => function($query) {
                $query->orderBy('tanggal_kunjungan', 'desc')
                      ->orderBy('created_at', 'desc');
            }, 
            'visits.doctor', 
            'visits.service'
        ]);
        
        return view('pasien.edit', compact('pasien'));
    }

    public function update(Request $request, Patient $pasien)
    {
        $validated = $request->validate([
            'nama_hewan'        => 'required|string|max:100',
            'jenis_hewan'       => 'required|string|max:30',
            'ras'               => 'nullable|string|max:50',
            'tanggal_lahir'     => 'nullable|date|before_or_equal:today|required_without:umur_hewan',
            'umur_hewan'        => 'nullable|integer|min:0|required_without:tanggal_lahir',
            'jenis_kelamin'     => 'required|in:Jantan,Betina',
            'nama_pemilik'      => 'nullable|string|max:100',
            'telepon_pemilik'   => 'nullable|string|max:20',
            'alamat_pemilik'    => 'nullable|string',
            'riwayat_perawatan' => 'nullable|string',
            'status'            => 'required|in:' . implode(',', Patient::getStatusList()),
            'judul_perawatan'   => 'nullable|string|max:100',
        ]);
        
        if ($request->tanggal_lahir) {
            $validated['umur_hewan'] = Carbon::parse($request->tanggal_lahir)->age;
        }
        
        $pasien->update($validated);
        
        return redirect()->route('pasien.index')
                         ->with('success', 'Data pasien berhasil diupdate!');
    }

    public function editStatus(Patient $pasien)
    {
        $statusList = Patient::getStatusList();
        return view('pasien.update_status', compact('pasien', 'statusList'));
    }

    public function updateStatus(Request $request, Patient $pasien)
    {
        $request->validate([
            'status'         => 'required|in:' . implode(',', Patient::getStatusList()),
            'catatan_status' => 'nullable|string',
        ]);

        $pasien->update([
            'status' => $request->status,
        ]);

        if ($request->catatan_status) {
            $pasien->riwayat_perawatan = ($pasien->riwayat_perawatan ? $pasien->riwayat_perawatan . "\n\n" : '') 
                . "[" . now()->format('d M Y H:i') . "] Status: " . $request->status . " - " . $request->catatan_status;
            $pasien->save();
        }

        return redirect()->route('pasien.show', $pasien)
                         ->with('success', 'Status pasien berhasil diupdate!');
    }

    public function destroy(Patient $pasien)
    {
        $pasien->delete();
        
        return redirect()->route('pasien.index')
                         ->with('success', 'Data pasien berhasil dihapus!');
    }

    public function strukPasien(Patient $pasien)
    {
        if ($pasien->status !== 'Selesai') {
            return redirect()->back()->with('error', 'Struk hanya bisa dilihat untuk pasien dengan status "Selesai".');
        }
        
        $kunjungan = $pasien->visits()->latest('tanggal_kunjungan')->first();
        
        if (!$kunjungan) {
            return redirect()->back()->with('error', 'Pasien belum memiliki riwayat kunjungan.');
        }
        
        $kunjungan->load('patient', 'doctor', 'service');
        
        $invoiceNumber = 'INV-' . $pasien->id . '-P-' . date('Ymd');
        
        $data = [
            'kunjungan' => $kunjungan,
            'pasien' => $pasien,
            'invoiceNumber' => $invoiceNumber,
            'tanggalCetak' => now()->format('d F Y, H:i') . ' WIB'
        ];
        
        return view('pasien.struk-preview', $data);
    }

    public function downloadStrukPasien(Patient $pasien)
    {
        if ($pasien->status !== 'Selesai') {
            return redirect()->back()->with('error', 'Struk hanya bisa dicetak untuk pasien dengan status "Selesai".');
        }
        
        $kunjungan = $pasien->visits()->latest('tanggal_kunjungan')->first();
        
        if (!$kunjungan) {
            return redirect()->back()->with('error', 'Pasien belum memiliki riwayat kunjungan.');
        }
        
        $kunjungan->load('patient', 'doctor', 'service');
        
        $invoiceNumber = 'INV-' . $pasien->id . '-P-' . date('Ymd');
        
        $data = [
            'kunjungan' => $kunjungan,
            'pasien' => $pasien,
            'invoiceNumber' => $invoiceNumber,
            'tanggalCetak' => now()->format('d F Y, H:i') . ' WIB'
        ];
        
        $pdf = Pdf::loadView('pasien.struk-pdf', $data);
        $pdf->setPaper('A4', 'portrait');
        
        return $pdf->download('Struk-Pasien-' . $pasien->nama_hewan . '-' . $invoiceNumber . '.pdf');
    }
}
