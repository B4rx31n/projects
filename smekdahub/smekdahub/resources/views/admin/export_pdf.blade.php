<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Laporan Admin SmekdaHub - {{ date('d F Y') }}</title>
    <style>
        /* Reset and Base Styles */
        @page {
            margin: 50px 40px;
        }
        
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            font-size: 11px;
            line-height: 1.6;
            color: #1f2937;
            margin: 0;
            padding: 0;
            background-color: #ffffff;
        }
        
        /* Header Section */
        .header {
            text-align: center;
            margin-bottom: 30px;
            padding-bottom: 20px;
            border-bottom: 3px solid #1e40af;
            position: relative;
        }
        
        .header::after {
            content: '';
            position: absolute;
            bottom: -3px;
            left: 0;
            right: 0;
            height: 1px;
            background: linear-gradient(90deg, transparent, #3b82f6, transparent);
        }
        
        .header h1 {
            margin: 0 0 5px 0;
            font-size: 22px;
            font-weight: 700;
            color: #1e40af;
            letter-spacing: 0.5px;
        }
        
        .header h2 {
            margin: 0 0 10px 0;
            font-size: 14px;
            font-weight: 500;
            color: #4b5563;
        }
        
        .meta-info {
            display: flex;
            justify-content: center;
            gap: 30px;
            margin-top: 10px;
            font-size: 10px;
            color: #6b7280;
        }
        
        .meta-item {
            display: flex;
            align-items: center;
            gap: 5px;
        }
        
        .meta-item i {
            font-size: 10px;
            color: #3b82f6;
        }
        
        /* Stats Section */
        .stats-container {
            margin-bottom: 25px;
        }
        
        .stats-grid {
            display: grid;
            grid-template-columns: repeat(6, 1fr);
            gap: 10px;
            margin-bottom: 15px;
        }
        
        .stat-card {
            background: linear-gradient(135deg, #f8fafc 0%, #e2e8f0 100%);
            border-radius: 8px;
            padding: 12px 8px;
            text-align: center;
            border: 1px solid #e5e7eb;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.05);
            transition: all 0.2s ease;
        }
        
        .stat-card:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }
        
        .stat-card:nth-child(1) { border-top: 3px solid #3b82f6; }
        .stat-card:nth-child(2) { border-top: 3px solid #ef4444; }
        .stat-card:nth-child(3) { border-top: 3px solid #f97316; }
        .stat-card:nth-child(4) { border-top: 3px solid #eab308; }
        .stat-card:nth-child(5) { border-top: 3px solid #10b981; }
        .stat-card:nth-child(6) { border-top: 3px solid #8b5cf6; }
        
        .stat-number {
            font-size: 16px;
            font-weight: 800;
            color: #1e40af;
            display: block;
            margin-bottom: 3px;
        }
        
        .stat-card:nth-child(2) .stat-number { color: #dc2626; }
        .stat-card:nth-child(3) .stat-number { color: #ea580c; }
        .stat-card:nth-child(4) .stat-number { color: #ca8a04; }
        .stat-card:nth-child(5) .stat-number { color: #059669; }
        .stat-card:nth-child(6) .stat-number { color: #7c3aed; }
        
        .stat-label {
            font-size: 9px;
            color: #4b5563;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.3px;
        }
        
        /* Summary Section */
        .summary-box {
            background: linear-gradient(135deg, #f0f9ff 0%, #e0f2fe 100%);
            border-radius: 10px;
            padding: 15px;
            border: 1px solid #bae6fd;
            margin-bottom: 20px;
        }
        
        .summary-title {
            font-size: 11px;
            font-weight: 700;
            color: #0369a1;
            margin-bottom: 8px;
            display: flex;
            align-items: center;
            gap: 6px;
        }
        
        .summary-content {
            font-size: 10px;
            color: #0c4a6e;
            line-height: 1.5;
        }
        
        /* Table Styles */
        .table-container {
            margin-top: 10px;
            overflow: hidden;
        }
        
        table {
            width: 100%;
            border-collapse: separate;
            border-spacing: 0;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.06);
        }
        
        thead {
            background: linear-gradient(135deg, #1e40af 0%, #1d4ed8 100%);
        }
        
        th {
            padding: 12px 10px;
            text-align: left;
            font-weight: 700;
            font-size: 10px;
            color: white;
            text-transform: uppercase;
            letter-spacing: 0.3px;
            border-bottom: 2px solid #1e3a8a;
        }
        
        th:first-child {
            border-top-left-radius: 8px;
        }
        
        th:last-child {
            border-top-right-radius: 8px;
        }
        
        tbody tr {
            background-color: #ffffff;
            transition: background-color 0.2s ease;
        }
        
        tbody tr:nth-child(even) {
            background-color: #f9fafb;
        }
        
        tbody tr:hover {
            background-color: #f0f9ff;
        }
        
        td {
            padding: 10px;
            font-size: 10px;
            border-bottom: 1px solid #e5e7eb;
            vertical-align: top;
        }
        
        tbody tr:last-child td {
            border-bottom: none;
        }
        
        /* Badge Styles */
        .badge {
            padding: 4px 8px;
            border-radius: 6px;
            font-size: 9px;
            font-weight: 600;
            display: inline-block;
            text-transform: uppercase;
            letter-spacing: 0.2px;
            box-shadow: 0 1px 2px rgba(0, 0, 0, 0.1);
        }
        
        .badge-danger {
            background: linear-gradient(135deg, #ef4444 0%, #dc2626 100%);
            color: white;
            border: 1px solid #dc2626;
        }
        
        .badge-warning {
            background: linear-gradient(135deg, #fbbf24 0%, #f59e0b 100%);
            color: #78350f;
            border: 1px solid #f59e0b;
        }
        
        .badge-info {
            background: linear-gradient(135deg, #60a5fa 0%, #3b82f6 100%);
            color: white;
            border: 1px solid #3b82f6;
        }
        
        .badge-success {
            background: linear-gradient(135deg, #10b981 0%, #059669 100%);
            color: white;
            border: 1px solid #059669;
        }
        
        .badge-primary {
            background: linear-gradient(135deg, #38bdf8 0%, #0ea5e9 100%);
            color: white;
            border: 1px solid #0ea5e9;
        }
        
        /* User Info */
        .user-info {
            display: flex;
            align-items: center;
            gap: 6px;
        }
        
        .user-avatar {
            width: 24px;
            height: 24px;
            border-radius: 6px;
            background: linear-gradient(135deg, #3b82f6 0%, #1d4ed8 100%);
            color: white;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: bold;
            font-size: 10px;
        }
        
        .user-details {
            flex: 1;
        }
        
        .user-name {
            font-weight: 600;
            color: #1f2937;
        }
        
        .user-role {
            font-size: 8px;
            color: #6b7280;
            background: #f3f4f6;
            padding: 1px 6px;
            border-radius: 10px;
            display: inline-block;
        }
        
        /* Report Content */
        .report-title {
            font-weight: 700;
            color: #1f2937;
            margin-bottom: 3px;
        }
        
        .report-excerpt {
            font-size: 9px;
            color: #6b7280;
            line-height: 1.4;
        }
        
        /* Responses Section */
        .responses {
            font-size: 9px;
        }
        
        .response-count {
            display: inline-block;
            background: #f3f4f6;
            padding: 2px 8px;
            border-radius: 12px;
            margin-bottom: 4px;
            font-weight: 600;
        }
        
        .response-item {
            padding-left: 10px;
            position: relative;
            margin-top: 3px;
        }
        
        .response-item::before {
            content: '•';
            position: absolute;
            left: 0;
            color: #3b82f6;
            font-weight: bold;
        }
        
        .response-text {
            color: #4b5563;
            line-height: 1.3;
        }
        
        /* Date Styling */
        .date-cell {
            font-weight: 600;
            color: #374151;
            white-space: nowrap;
        }
        
        /* Footer */
        .footer {
            margin-top: 30px;
            padding-top: 15px;
            border-top: 2px solid #e5e7eb;
            text-align: center;
            font-size: 9px;
            color: #6b7280;
        }
        
        .footer-info {
            display: flex;
            justify-content: space-between;
            margin-bottom: 10px;
        }
        
        .footer-item {
            display: flex;
            align-items: center;
            gap: 5px;
        }
        
        .footer-copyright {
            font-size: 8px;
            color: #9ca3af;
            margin-top: 5px;
        }
        
        /* Page Break */
        .page-break {
            page-break-before: always;
        }
        
        /* Print Optimizations */
        @media print {
            body {
                font-size: 10px;
            }
            
            .header h1 {
                font-size: 20px;
            }
            
            .stat-number {
                font-size: 14px;
            }
            
            th, td {
                padding: 8px 6px;
            }
            
            .badge {
                padding: 3px 6px;
                font-size: 8px;
            }
        }
    </style>
</head>
<body>
    <!-- Header -->
    <div class="header">
        <h1>LAPORAN ADMINISTRASI SMEKDAHUB</h1>
        <h2>Monitoring dan Analisis Laporan Sistem</h2>
        <div class="meta-info">
            <div class="meta-item">
                <span>📅</span>
                <span>Dibuat: {{ date('d F Y, H:i') }}</span>
            </div>
            <div class="meta-item">
                <span>📊</span>
                <span>Total Laporan: {{ $laporans->count() }}</span>
            </div>
            <div class="meta-item">
                <span>👤</span>
                <span>Role: Administrator</span>
            </div>
        </div>
    </div>

    <!-- Stats Overview -->
    <div class="stats-container">
        <div class="stats-grid">
            <div class="stat-card">
                <span class="stat-number">{{ $laporans->count() }}</span>
                <span class="stat-label">Total Laporan</span>
            </div>
            <div class="stat-card">
                <span class="stat-number">{{ $laporans->where('prioritas', 'tinggi')->count() }}</span>
                <span class="stat-label">Prioritas Tinggi</span>
            </div>
            <div class="stat-card">
                <span class="stat-number">{{ $laporans->where('prioritas', 'sedang')->count() }}</span>
                <span class="stat-label">Prioritas Sedang</span>
            </div>
            <div class="stat-card">
                <span class="stat-number">{{ $laporans->where('status', 'pending')->count() }}</span>
                <span class="stat-label">Status Pending</span>
            </div>
            <div class="stat-card">
                <span class="stat-number">{{ $laporans->where('status', 'selesai')->count() }}</span>
                <span class="stat-label">Status Selesai</span>
            </div>
            <div class="stat-card">
                <span class="stat-number">{{ $laporans->where('status', 'proses')->count() }}</span>
                <span class="stat-label">Dalam Proses</span>
            </div>
        </div>
        
        <div class="summary-box">
            <div class="summary-title">📈 Ringkasan Statistik</div>
            <div class="summary-content">
                • Laporan dengan prioritas tinggi memerlukan perhatian segera<br>
                • {{ $laporans->where('status', 'pending')->count() }} laporan masih menunggu tindakan<br>
                • Rata-rata {{ number_format($laporans->where('status', 'selesai')->count() / max($laporans->count(), 1) * 100, 1) }}% laporan telah diselesaikan<br>
                • Total {{ $laporans->count() }} laporan terdaftar dalam sistem
            </div>
        </div>
    </div>

    <!-- Data Table -->
    <div class="table-container">
        <table>
            <thead>
                <tr>
                    <th style="width: 4%">No</th>
                    <th style="width: 15%">Pelapor</th>
                    <th style="width: 25%">Laporan</th>
                    <th style="width: 10%">Prioritas</th>
                    <th style="width: 10%">Status</th>
                    <th style="width: 20%">Tanggapan</th>
                    <th style="width: 8%">Tanggal</th>
                </tr>
            </thead>
            <tbody>
                @foreach($laporans as $index => $laporan)
                <tr>
                    <td style="font-weight: 700; text-align: center;">{{ $index + 1 }}</td>
                    <td>
                        <div class="user-info">
                            <div class="user-avatar">
                                {{ strtoupper(substr($laporan->user->name, 0, 1)) }}
                            </div>
                            <div class="user-details">
                                <div class="user-name">{{ $laporan->user->name }}</div>
                                <span class="user-role">{{ ucfirst($laporan->user->role) }}</span>
                            </div>
                        </div>
                    </td>
                    <td>
                        <div class="report-title">{{ $laporan->judul }}</div>
                        <div class="report-excerpt">{{ Str::limit($laporan->isi_laporan, 120) }}</div>
                    </td>
                    <td>
                        @if($laporan->prioritas == 'tinggi')
                            <span class="badge badge-danger">TINGGI</span>
                        @elseif($laporan->prioritas == 'sedang')
                            <span class="badge badge-warning">SEDANG</span>
                        @else
                            <span class="badge badge-info">RENDAH</span>
                        @endif
                    </td>
                    <td>
                        @if($laporan->status == 'pending')
                            <span class="badge badge-warning">PENDING</span>
                        @elseif($laporan->status == 'proses')
                            <span class="badge badge-primary">PROSES</span>
                        @else
                            <span class="badge badge-success">SELESAI</span>
                        @endif
                    </td>
                    <td>
                        <div class="responses">
                            @if($laporan->tanggapans->count() > 0)
                                <span class="response-count">{{ $laporan->tanggapans->count() }} tanggapan</span>
                                @foreach($laporan->tanggapans->take(2) as $tanggapan)
                                    <div class="response-item">
                                        <div class="response-text">{{ Str::limit($tanggapan->isi_tanggapan, 60) }}</div>
                                    </div>
                                @endforeach
                                @if($laporan->tanggapans->count() > 2)
                                    <div class="response-item">
                                        <div class="response-text">...dan {{ $laporan->tanggapans->count() - 2 }} tanggapan lainnya</div>
                                    </div>
                                @endif
                            @else
                                <span class="response-count" style="background: #fee2e2; color: #dc2626;">Belum ada tanggapan</span>
                            @endif
                        </div>
                    </td>
                    <td class="date-cell">{{ $laporan->created_at->format('d/m/Y') }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <!-- Footer -->
    <div class="footer">
        <div class="footer-info">
            <div class="footer-item">
                <span>📧</span>
                <span>smekdahub@school.edu</span>
            </div>
            <div class="footer-item">
                <span>🕒</span>
                <span>Dibuat secara otomatis oleh sistem</span>
            </div>
            <div class="footer-item">
                <span>📄</span>
                <span>Halaman 1</span>
            </div>
        </div>
        <div class="footer-copyright">
            &copy; {{ date('Y') }} SmekdaHub - Sistem Informasi Pelaporan Sekolah | Dokumen ini bersifat rahasia dan hanya untuk penggunaan internal
        </div>
    </div>
</body>
</html>