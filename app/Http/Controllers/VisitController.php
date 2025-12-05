<?php

namespace App\Http\Controllers;

use App\Models\Visit;
use App\Models\Patient;
use App\Models\Doctor;
use App\Models\Service;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;


class VisitController extends Controller
{
    public function index()
    {
        $visits = Visit::with(['patient', 'doctor', 'service'])
            ->orderBy('tanggal_kunjungan', 'desc')
            ->paginate(15);
        
        return view('kunjungan.index', compact('visits'));
    }

public function create(Request $request)
{
    $selectedPatient = null;
    
    // Jika ada parameter patient_id (dari halaman detail pasien)
    if ($request->has('patient_id')) {
        $selectedPatient = Patient::findOrFail($request->patient_id);
        
        // Jika pasien "Selesai"/"Meninggal", auto-update ke "Booking"
        if (in_array($selectedPatient->status, ['Selesai', 'Meninggal'])) {
            $oldStatus = $selectedPatient->status;
            $selectedPatient->update(['status' => 'Booking']);
            
            // Catat di riwayat perawatan
            $selectedPatient->riwayat_perawatan = ($selectedPatient->riwayat_perawatan ? $selectedPatient->riwayat_perawatan . "\n\n" : '') 
                . "[" . now()->format('d M Y H:i') . "] Status otomatis diubah dari '{$oldStatus}' ke 'Booking' karena kunjungan baru akan dibuat.";
            $selectedPatient->save();
            
            // Notifikasi ke admin
            session()->flash('info', "Status pasien {$selectedPatient->nama_hewan} otomatis diubah dari '{$oldStatus}' ke 'Booking'");
        }
    }
    
    // Filter: Hanya pasien yang masih aktif (bukan Selesai/Meninggal)
    $patients = Patient::whereNotIn('status', ['Selesai', 'Meninggal'])
                       ->orderBy('nama_hewan')
                       ->get();
    
    $doctors = Doctor::orderBy('nama')->get();
    $services = Service::orderBy('nama_layanan')->get();

    return view('kunjungan.create', compact('patients', 'doctors', 'services', 'selectedPatient'));
}



    public function store(Request $request)
    {
        $validated = $request->validate([
            'id_pasien' => 'required|exists:patients,id',
            'id_dokter' => 'required|exists:doctors,id',
            'id_layanan' => 'required|exists:services,id',
            'tanggal_kunjungan' => 'required|date',
            'keluhan' => 'required|string',
            'diagnosis' => 'nullable|string',
            'tindakan' => 'nullable|string',
            'catatan' => 'nullable|string',
            'total_biaya' => 'required|numeric|min:0',
            'status_visit' => 'required|in:Scheduled,In Progress,Completed,Cancelled',
        ]);

        // Buat kunjungan
        $visit = Visit::create($validated);

        // ✅ AUTO-SYNC: Reset status pasien ke "Booking" saat kunjungan baru dibuat
        // (Ini handle kasus: Pasien "Selesai" datang lagi untuk kunjungan baru)
        $patient = Patient::find($validated['id_pasien']);
    
        // Hanya reset ke Booking jika pasien sebelumnya "Selesai"
        if ($patient->status === 'Selesai') {
            $patient->update(['status' => 'Booking']);
        }

        return redirect()->route('kunjungan.index')
            ->with('success', 'Kunjungan berhasil ditambahkan. Status pasien direset ke Booking.');
    }


    public function show(Visit $kunjungan)
    {
        $kunjungan->load(['patient', 'doctor', 'service']);
        return view('kunjungan.show', compact('kunjungan'));
    }

    public function edit(Visit $kunjungan)
    {
        $patients = Patient::orderBy('nama_hewan')->get();
        $doctors = Doctor::where('is_active', true)->orderBy('nama')->get();
        $services = Service::where('is_active', true)->orderBy('nama_layanan')->get();
        
        return view('kunjungan.edit', compact('kunjungan', 'patients', 'doctors', 'services'));
    }

    public function update(Request $request, Visit $kunjungan)
    {
        $validated = $request->validate([
        'id_pasien' => 'required|exists:patients,id',
        'id_dokter' => 'required|exists:doctors,id',
        'id_layanan' => 'required|exists:services,id',
        'tanggal_kunjungan' => 'required|date',
        'keluhan' => 'required|string',
        'diagnosis' => 'nullable|string',
        'tindakan' => 'nullable|string',
        'catatan' => 'nullable|string',
        'total_biaya' => 'required|numeric|min:0',
        'status_visit' => 'required|in:Scheduled,In Progress,Completed,Cancelled',
    ]);

    $kunjungan->update($validated);

    $patient = $kunjungan->patient;
    if ($validated['status_visit'] === 'Completed') {
        $patient->update(['status' => 'Selesai']);
    } elseif ($validated['status_visit'] === 'Cancelled') {
        $patient->update(['status' => 'Booking']);
    }

    return redirect()->route('kunjungan.index')
        ->with('success', 'Kunjungan berhasil diperbarui.');
    }



    public function destroy(Visit $kunjungan)
    {
        $kunjungan->delete();
        
        return redirect()->route('kunjungan.index')
            ->with('success', 'Data kunjungan berhasil dihapus!');
    }
     public function previewStruk(Visit $kunjungan)
    {
        // Load relasi
        $kunjungan->load('patient', 'doctor', 'service');
        
        // Generate nomor invoice
        $invoiceNumber = 'INV-' . $kunjungan->id . '-' . date('Ymd', strtotime($kunjungan->tanggal_kunjungan));
        
        // Data untuk view
        $data = [
            'kunjungan' => $kunjungan,
            'invoiceNumber' => $invoiceNumber,
            'tanggalCetak' => now()->format('d F Y, H:i') . ' WIB'
        ];
        
        // Return HTML view
        return view('kunjungan.struk-preview', $data);
    }

    public function downloadStruk(Visit $kunjungan)
    {
        // Load relasi
        $kunjungan->load('patient', 'doctor', 'service');
        
        // Generate nomor invoice
        $invoiceNumber = 'INV-' . $kunjungan->id . '-' . date('Ymd', strtotime($kunjungan->tanggal_kunjungan));
        
        // Data untuk PDF
        $data = [
            'kunjungan' => $kunjungan,
            'invoiceNumber' => $invoiceNumber,
            'tanggalCetak' => now()->format('d F Y, H:i') . ' WIB'
        ];
        
        // Generate PDF
        $pdf = Pdf::loadView('kunjungan.struk-pdf', $data);
        $pdf->setPaper('A4', 'portrait');
        
        // Download PDF
        return $pdf->download('Struk-Kunjungan-' . $invoiceNumber . '.pdf');
    }

//     public function generateStruk(Visit $kunjungan)
// {
//     // Pastikan kunjungan sudah Completed
//     if ($kunjungan->status !== 'Completed') {
//         return redirect()->back()->with('error', 'Struk hanya bisa dicetak untuk kunjungan yang sudah selesai.');
//     }
    
//     // Load relasi
//     $kunjungan->load('patient', 'doctor', 'service');
    
//     // Generate nomor invoice
//     $invoiceNumber = 'INV-' . $kunjungan->id . '-' . date('Ymd', strtotime($kunjungan->tanggal_kunjungan));
    
//     // Data untuk PDF
//     $data = [
//         'kunjungan' => $kunjungan,
//         'invoiceNumber' => $invoiceNumber,
//         'tanggalCetak' => now()->format('d F Y, H:i') . ' WIB'
//     ];
    
//     // Generate PDF
//     $pdf = Pdf::loadView('kunjungan.struk', $data);
    
//     // Set paper size & orientation
//     $pdf->setPaper('A4', 'portrait');
    
//     // Download PDF
//     return $pdf->download('Struk-Kunjungan-' . $invoiceNumber . '.pdf');
    
//     // Atau untuk preview di browser (tidak langsung download):
//     // return $pdf->stream('Struk-Kunjungan-' . $invoiceNumber . '.pdf');
// }
}
