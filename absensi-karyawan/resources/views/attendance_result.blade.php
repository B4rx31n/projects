<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Sistem Absensi Karyawan</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        
        body {
            background: linear-gradient(135deg, #6a11cb 0%, #2575fc 100%);
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 20px;
        }
        
        .container {
            width: 100%;
            max-width: 500px;
            background: white;
            border-radius: 16px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.15);
            overflow: hidden;
        }
        
        .header {
            background: #4e73df;
            color: white;
            padding: 25px;
            text-align: center;
        }
        
        .header h1 {
            font-size: 24px;
            font-weight: 600;
            margin-bottom: 5px;
        }
        
        .header p {
            font-size: 14px;
            opacity: 0.9;
        }
        
        .content {
            padding: 30px;
        }
        
        .result-card {
            text-align: center;
            padding: 20px;
            border-radius: 12px;
            margin-bottom: 25px;
            background: #f8f9fc;
            border-left: 4px solid;
        }
        
        .success {
            color: #1cc88a;
            border-color: #1cc88a;
        }
        
        .warning {
            color: #f6c23e;
            border-color: #f6c23e;
        }
        
        .error {
            color: #e74a3b;
            border-color: #e74a3b;
        }
        
        .result-card i {
            font-size: 50px;
            margin-bottom: 15px;
        }
        
        .result-card h3 {
            font-size: 22px;
            margin-bottom: 10px;
        }
        
        .result-card p {
            color: #5a5c69;
            margin-bottom: 15px;
        }
        
        .btn {
            display: inline-block;
            padding: 12px 24px;
            background: #4e73df;
            color: white;
            text-decoration: none;
            border-radius: 6px;
            font-weight: 500;
            transition: all 0.3s;
            border: none;
            cursor: pointer;
            font-size: 16px;
        }
        
        .btn:hover {
            background: #2e59d9;
            transform: translateY(-2px);
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        
        .btn-outline {
            background: transparent;
            color: #4e73df;
            border: 1px solid #4e73df;
        }
        
        .btn-outline:hover {
            background: #4e73df;
            color: white;
        }
        
        .info-box {
            background: #f8f9fc;
            border-radius: 8px;
            padding: 15px;
            margin-top: 20px;
            text-align: left;
        }
        
        .info-box p {
            margin-bottom: 8px;
            display: flex;
            justify-content: space-between;
        }
        
        .info-box span {
            font-weight: 500;
            color: #4e73df;
        }
        
        .footer {
            text-align: center;
            padding: 20px;
            color: #858796;
            font-size: 14px;
            border-top: 1px solid #eaecf4;
        }
        
        @media (max-width: 576px) {
            .container {
                border-radius: 12px;
            }
            
            .content {
                padding: 20px;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1><i class="fas fa-fingerprint"></i> Sistem Absensi</h1>
            <p>PT. Perusahaan Contoh - Divisi IT</p>
        </div>
        
        <div class="content">
            @if($status === 'error')
                <div class="result-card error">
                    <i class="fas fa-times-circle"></i>
                    <h3>{{ $messageTitle }}</h3>
                    <p>{{ $messageBody }}</p>
                    <a href="{{ url()->previous() }}" class="btn">Kembali</a>
                </div>
            @elseif($status === 'warning')
                <div class="result-card warning">
                    <i class="fas fa-exclamation-triangle"></i>
                    <h3>{{ $messageTitle }}</h3>
                    <p>{{ $messageBody }}</p>
                    <div class="info-box">
                        <p>Tanggal: <span>{{ $tanggal }}</span></p>
                        <p>Jam: <span>{{ $jam }}</span></p>
                    </div>
                    <a href="{{ url('/') }}" class="btn">Kembali ke Beranda</a>
                </div>
            @elseif($status === 'success')
                <div class="result-card success">
                    <i class="fas fa-check-circle"></i>
                    <h3>{{ $messageTitle }}</h3>
                    <p>{{ $messageBody }}</p>
                    <div class="info-box">
                        <p>Nama: <span>{{ $karyawan['nama'] }}</span></p>
                        <p>Divisi: <span>{{ $karyawan['divisi'] }}</span></p>
                        <p>Tanggal: <span>{{ $tanggal }}</span></p>
                        <p>Jam: <span>{{ $jam }}</span></p>
                    </div>
                    <a href="{{ url('/') }}" class="btn">Kembali ke Beranda</a>
                </div>
            @endif
        </div>
        
        <div class="footer">
            <p>&copy; 2023 Sistem Absensi Karyawan | Divisi IT</p>
        </div>
    </div>
</body>
</html>
