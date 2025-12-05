<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Struk Perawatan - {{ $pasien->nama_hewan }}</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body {
            font-family: 'Arial', sans-serif;
            font-size: 12px;
            line-height: 1.6;
            color: #333;
            padding: 20px;
        }
        
        .header {
            text-align: center;
            border-bottom: 3px solid #2563eb;
            padding-bottom: 15px;
            margin-bottom: 20px;
        }
        
        .header h1 {
            color: #2563eb;
            font-size: 24px;
            margin-bottom: 5px;
        }
        
        .header p {
            color: #666;
            font-size: 11px;
        }
        
        .invoice-info {
            background: #f3f4f6;
            padding: 12px;
            border-radius: 5px;
            margin-bottom: 20px;
        }
        
        .invoice-info table {
            width: 100%;
        }
        
        .invoice-info td {
            padding: 4px 0;
        }
        
        .invoice-info td:first-child {
            font-weight: bold;
            width: 180px;
        }
        
        .section-title {
            background: #2563eb;
            color: white;
            padding: 8px 12px;
            font-weight: bold;
            font-size: 13px;
            margin-top: 20px;
            margin-bottom: 10px;
            border-radius: 3px;
        }
        
        .info-table {
            width: 100%;
            margin-bottom: 15px;
        }
        
        .info-table td {
            padding: 6px 0;
            vertical-align: top;
        }
        
        .info-table td:first-child {
            font-weight: bold;
            width: 150px;
            color: #555;
        }
        
        .detail-box {
            border: 1px solid #e5e7eb;
            padding: 10px;
            border-radius: 5px;
            background: #fafafa;
            margin-bottom: 10px;
        }
        
        .detail-box strong {
            color: #2563eb;
            display: block;
            margin-bottom: 5px;
        }
        
        .total-section {
            margin-top: 20px;
            padding-top: 15px;
            border-top: 2px solid #2563eb;
        }
        
        .total-row {
            background: #eff6ff;
            padding: 12px;
            border-radius: 5px;
            text-align: center;
        }
        
        .total-label {
            font-size: 14px;
            font-weight: bold;
            color: #1e40af;
            display: block;
            margin-bottom: 5px;
        }
        
        .total-amount {
            font-size: 20px;
            font-weight: bold;
            color: #2563eb;
        }
        
        .footer {
            margin-top: 30px;
            padding-top: 15px;
            border-top: 1px solid #e5e7eb;
            text-align: center;
            color: #666;
            font-size: 11px;
        }
        
        .footer p {
            margin: 3px 0;
        }
        
        .status-badge {
            display: inline-block;
            padding: 4px 12px;
            border-radius: 12px;
            font-size: 11px;
            font-weight: bold;
            background: #10b981;
            color: white;
        }
    </style>
</head>
<body>
    <!-- Header -->
    <div class="header">
        <h1>🐾 VETCARE CENTER</h1>
        <p>Klinik Kesehatan Hewan Profesional</p>
        <p>Jl. Contoh No. 123, Jember | Telp: (0331) 123456 | Email: info@vetcare.id</p>
    </div>
    
    <!-- Invoice Info -->
    <div class="invoice-info">
        <table>
            <tr>
                <td><strong>Nomor Invoice:</strong></td>
                <td>{{ $invoiceNumber }}</td>
            </tr>
            <tr>
                <td><strong>Status Perawatan:</strong></td>
                <td><span class="status-badge">{{ $pasien->status }}</span></td>
            </tr>
            <tr>
                <td><strong>Tanggal Kunjungan Terakhir:</strong></td>
                <td>{{ \Carbon\Carbon::parse($kunjungan->tanggal_kunjungan)->format('d F Y') }}</td>
            </tr>
            <tr>
                <td><strong>Dicetak:</strong></td>
                <td>{{ $tanggalCetak }}</td>
            </tr>
        </table>
    </div>
    
    <!-- Data Pasien -->
    <div class="section-title">📋 DATA PASIEN</div>
    <table class="info-table">
        <tr>
            <td>Nama Hewan</td>
            <td>: {{ $pasien->nama_hewan }}</td>
        </tr>
        <tr>
            <td>Jenis Hewan</td>
            <td>: {{ $pasien->jenis_hewan }}</td>
        </tr>
        <tr>
            <td>Ras</td>
            <td>: {{ $pasien->ras ?? '-' }}</td>
        </tr>
        <tr>
            <td>Umur</td>
            <td>: {{ $pasien->umur_lengkap }}</td>
        </tr>
        <tr>
            <td>Jenis Kelamin</td>
            <td>: {{ $pasien->jenis_kelamin }}</td>
        </tr>
        <tr>
            <td>Pemilik</td>
            <td>: {{ $pasien->nama_pemilik ?? '-' }}</td>
        </tr>
        <tr>
            <td>Telepon Pemilik</td>
            <td>: {{ $pasien->telepon_pemilik ?? '-' }}</td>
        </tr>
    </table>
    
    @if($pasien->judul_perawatan)
    <div class="detail-box">
        <strong>Judul Perawatan:</strong>
        {{ $pasien->judul_perawatan }}
    </div>
    @endif
    
    <!-- Data Kunjungan Terakhir -->
    <div class="section-title">👨‍⚕️ DATA KUNJUNGAN TERAKHIR</div>
    <table class="info-table">
        <tr>
            <td>Tanggal</td>
            <td>: {{ \Carbon\Carbon::parse($kunjungan->tanggal_kunjungan)->format('d/m/Y') }}</td>
        </tr>
        <tr>
            <td>Dokter</td>
            <td>: {{ $kunjungan->doctor->nama }}</td>
        </tr>
        <tr>
            <td>Layanan</td>
            <td>: {{ $kunjungan->service->nama_layanan }}</td>
        </tr>
    </table>
    
    <!-- Detail Medis -->
    <div class="detail-box">
        <strong>Keluhan:</strong>
        {{ $kunjungan->keluhan }}
    </div>
    
    @if($kunjungan->diagnosis)
    <div class="detail-box">
        <strong>Diagnosis:</strong>
        {{ $kunjungan->diagnosis }}
    </div>
    @endif
    
    @if($kunjungan->tindakan)
    <div class="detail-box">
        <strong>Tindakan:</strong>
        {{ $kunjungan->tindakan }}
    </div>
    @endif
    
    @if($kunjungan->catatan)
    <div class="detail-box">
        <strong>Catatan:</strong>
        {{ $kunjungan->catatan }}
    </div>
    @endif
    
    <!-- Total Biaya -->
    <div class="total-section">
        <div class="total-row">
            <span class="total-label">TOTAL BIAYA PERAWATAN</span>
            <span class="total-amount">Rp {{ number_format($kunjungan->total_biaya, 0, ',', '.') }}</span>
        </div>
    </div>
    
    <!-- Footer -->
    <div class="footer">
        <p><strong>Terima kasih atas kepercayaan Anda kepada VetCare Center</strong></p>
        <p>Semoga {{ $pasien->nama_hewan }} segera sehat kembali</p>
        <p style="margin-top: 10px; font-size: 10px;">Struk ini dicetak secara otomatis oleh sistem VetCare Center</p>
    </div>
</body>
</html>
