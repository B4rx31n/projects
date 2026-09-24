<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Data User</title>
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
        <a href="{{ route('user') }}" class="btn btn-secondary">Kembali</a>
    </div>

    <div class="print-header">
        <h1>LAPORAN DATA USER</h1>
        <p>{{ config('app.name') }}</p>
    </div>

    <div class="print-date">
        <p>Tanggal Cetak: {{ now()->format('d-m-Y H:i:s') }}</p>
    </div>

    <table>
        <thead>
            <tr>
                <th style="width: 5%;">No</th>
                <th style="width: 25%;">Nama</th>
                <th style="width: 35%;">Email</th>
                <th style="width: 15%;">Role</th>
                <th style="width: 20%;">Terdaftar</th>
            </tr>
        </thead>
        <tbody>
            @php $no = 1; @endphp
            @foreach ($user as $u)
                <tr>
                    <td>{{ $no++ }}</td>
                    <td>{{ $u->name }}</td>
                    <td>{{ $u->email }}</td>
                    <td>{{ strtoupper($u->role) }}</td>
                    <td>{{ $u->created_at->format('d-m-Y') }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <div class="print-footer">
        <p>Total Data: {{ count($user) }} User</p>
    </div>
</body>
</html>
