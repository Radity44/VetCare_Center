<?php

namespace App\Http\Controllers;

use App\Models\Patient;
use App\Models\Doctor;
use App\Models\Service;
use App\Models\Visit;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        // Statistik utama
        $totalPatients = Patient::count();
        $totalDoctors = Doctor::where('is_active', true)->count();
        $totalServices = Service::where('is_active', true)->count();
        $totalVisits = Visit::count();

        // Pasien terbaru (5 terakhir)
        $recentPatients = Patient::orderBy('created_at', 'desc')
            ->take(5)
            ->get();

        // Kunjungan terbaru (5 terakhir)
        $recentVisits = Visit::with(['patient', 'doctor', 'service'])
            ->orderBy('tanggal_kunjungan', 'desc')
            ->take(5)
            ->get();

        // Statistik status pasien
        $statusStats = Patient::selectRaw('status, count(*) as total')
            ->groupBy('status')
            ->pluck('total', 'status')
            ->toArray();

        return view('dashboard.index', compact(
            'totalPatients',
            'totalDoctors',
            'totalServices',
            'totalVisits',
            'recentPatients',
            'recentVisits',
            'statusStats'
        ));
    }
}
