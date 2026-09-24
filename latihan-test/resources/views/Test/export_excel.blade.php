<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>{{ $title }}</title>
    <style>
        body { font-family: Arial, sans-serif; }
        table { border-collapse: collapse; width: 100%; margin-top: 20px; }
        th { background-color: #f2f2f2; font-weight: bold; }
        th, td { border: 1px solid #ddd; padding: 8px; text-align: left; }
        .header { text-align: center; margin-bottom: 30px; }
        .text-right { text-align: right; }
        .footer { margin-top: 30px; }
    </style>
</head>
<body>
    <div class="header">
        <h1>{{ $title }}</h1>
        <p>Tanggal: {{ $date }}</p>
        @if($search)
        <p><strong>Filter Pencarian:</strong> {{ $search }}</p>
        @endif
    </div>
    
    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Nama Produk</th>
                <th>Harga</th>
                <th>Stok</th>
                <th>Tanggal Dibuat</th>
            </tr>
        </thead>
        <tbody>
            @foreach($Test as $key => $item)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $item->nama }}</td>
                <td>Rp {{ number_format($item->harga, 0, ',', '.') }}</td>
                <td>{{ $item->stok }}</td>
                <td>{{ $item->created_at->format('d/m/Y H:i') }}</td>
            </tr>
            @endforeach
            @if($Test->isEmpty())
            <tr>
                <td colspan="5" style="text-align: center;">Tidak ada data</td>
            </tr>
            @endif
        </tbody>
    </table>
    
    <div class="footer">
        <p>Total Data: {{ $Test->count() }}</p>
        <p>Dicetak pada: {{ date('d/m/Y H:i:s') }}</p>
    </div>
    
    <script>
        window.onload = function() {
            window.print();
            setTimeout(function() {
                window.close();
            }, 500);
        }
    </script>
</body>
</html>