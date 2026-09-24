<?php
ob_start(); // Mencegah output sebelum PDF

// Koneksi ke database
$koneksi = new mysqli("localhost", "root", "", "db_login");
if ($koneksi->connect_error) {
    die("Koneksi gagal: " . $koneksi->connect_error);
}

// Load TCPDF
require_once __DIR__ . '/TCPDF-main/tcpdf.php';

// Membuat objek PDF baru
$pdf = new TCPDF('P', 'mm', 'A4', true, 'UTF-8', false);

// Informasi dokumen
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('Sistem Login');
$pdf->SetTitle('Laporan Data Siswa');
$pdf->SetSubject('Laporan PDF');
$pdf->SetKeywords('TCPDF, PDF, laporan, siswa');

// Set margin
$pdf->SetMargins(15, 20, 15);
$pdf->SetAutoPageBreak(TRUE, 20);

// Tambah halaman
$pdf->AddPage();

// Judul Laporan
$pdf->SetFont('helvetica', 'B', 16);
$pdf->Cell(0, 10, 'LAPORAN DATA SISWA', 0, 1, 'C');
$pdf->Ln(5);

// Ambil data dari database
$query = $koneksi->query("SELECT * FROM data_siswa");
$no = 1;

$html = '
<table border="1" cellpadding="5">
    <tr style="background-color:#f2f2f2;">
        <th width="20">No</th>
        <th width="60">Nama</th>
        <th width="60">Asal Sekolah</th>
        <th width="60">Universitas</th>
        <th width="30">Tahun PKL</th>
        <th width="30">Lama PKL</th>
        <th width="40">Kehadiran</th>
    </tr>
';

while ($row = $query->fetch_assoc()) {
    $html .= '
    <tr>
        <td>'.$no++.'</td>
        <td>'.$row['nama'].'</td>
        <td>'.$row['asal_sekolah'].'</td>
        <td>'.$row['universitas'].'</td>
        <td>'.$row['Tahun_PKL'].'</td>
        <td>'.$row['lama_pkl'].'</td>
        <td>'.$row['kehadiran'].'</td>
    </tr>';
}

$html .= '</table>';

// Tulis HTML ke PDF
$pdf->SetFont('helvetica', '', 10);
$pdf->writeHTML($html, true, false, true, false, '');

// Bersihkan output buffer
ob_end_clean();

// Output PDF ke browser
$pdf->Output('laporan_siswa.pdf', 'I');
