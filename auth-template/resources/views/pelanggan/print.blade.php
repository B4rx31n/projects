<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Data Pelanggan</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
        }
        .print-header {
            text-align: center;
            margin-bottom: 30px;
            border-bottom: 2px solid #000;
            padding-bottom: 20px;
        }
        .print-header h1 {
            margin: 0;
            font-size: 24px;
        }
        .print-header p {
            margin: 5px 0;
            font-size: 12px;
        }
        .print-date {
            text-align: right;
            margin-bottom: 20px;
            font-size: 12px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        table th {
            background-color: #f0f0f0;
            border: 1px solid #000;
            padding: 10px;
            text-align: left;
            font-weight: bold;
            font-size: 12px;
        }
        table td {
            border: 1px solid #000;
            padding: 10px;
            font-size: 12px;
        }
        table tr:nth-child(even) {
            background-color: #f9f9f9;
        }
        .print-footer {
            margin-top: 40px;
            text-align: right;
            font-size: 12px;
        }
        @media print {
            body {
                margin: 0;
            }
            .no-print {
                display: none;
            }
        }
        .btn-container {
            margin-bottom: 20px;
        }
    </style>
</head>
<body>
    <div class="btn-container no-print">
        <button onclick="window.print()" class="btn btn-primary"><i class="bi bi-printer"></i> Cetak</button>
        <a href="{{ route('pelanggan') }}" class="btn btn-secondary">Kembali</a>
    </div>

    <div class="print-header">
        <h1>LAPORAN DATA PELANGGAN</h1>
        <p>{{ config('app.name') }}</p>
    </div>

    <div class="print-date">
        <p>Tanggal Cetak: {{ now()->format('d-m-Y H:i:s') }}</p>
    </div>

    <table>
        <thead>
            <tr>
                <th style="width: 5%;">No</th>
                <th style="width: 20%;">Nama</th>
                <th style="width: 20%;">Email</th>
                <th style="width: 15%;">No. Telepon</th>
                <th style="width: 15%;">Kota</th>
                <th style="width: 15%;">Provinsi</th>
                <th style="width: 10%;">Kode Pos</th>
            </tr>
        </thead>
        <tbody>
            @php $no = 1; @endphp
            @forelse($pelanggans as $pelanggan)
                <tr>
                    <td>{{ $no++ }}</td>
                    <td>{{ $pelanggan->nama }}</td>
                    <td>{{ $pelanggan->email }}</td>
                    <td>{{ $pelanggan->no_telepon ?? '-' }}</td>
                    <td>{{ $pelanggan->kota ?? '-' }}</td>
                    <td>{{ $pelanggan->provinsi ?? '-' }}</td>
                    <td>{{ $pelanggan->kode_pos ?? '-' }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="7" style="text-align: center;">Tidak ada data pelanggan</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <div class="print-footer">
        <p>Total Data: {{ count($pelanggans) }} Pelanggan</p>
    </div>
</body>
</html>
