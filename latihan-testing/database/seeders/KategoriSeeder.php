<?php

namespace Database\Seeders;

use App\Models\Kategori;
use Illuminate\Database\Seeder;

class KategoriSeeder extends Seeder
{
    public function run(): void
    {
        $kategoris = [
            ['nama' => 'Elektronik'],
            ['nama' => 'Pakaian'],
            ['nama' => 'Makanan'],
            ['nama' => 'Minuman'],
            ['nama' => 'Alat Tulis'],
            ['nama' => 'Perabotan'],
            ['nama' => 'Olahraga'],
            ['nama' => 'Kesehatan'],
            ['nama' => 'Kosmetik'],
            ['nama' => 'Buku'],
            ['nama' => 'Mainan'],
            ['nama' => 'Otomotif'],
            ['nama' => 'Pertanian'],
            ['nama' => 'Peternakan'],
            ['nama' => 'Ikan'],
            ['nama' => 'Perikanan'],
            ['nama' => 'Tekstil'],
            ['nama' => 'Kerajinan'],
            ['nama' => 'Seni'],
            ['nama' => 'Musik'],
            ['nama' => 'Film'],
            ['nama' => 'Fotografi'],
            ['nama' => 'Komputer'],
            ['nama' => 'Software'],
            ['nama' => 'Hardware'],
            ['nama' => 'Jaringan'],
            ['nama' => 'Keamanan'],
            ['nama' => 'Pendidikan'],
            ['nama' => 'Kursus'],
            ['nama' => 'Pelatihan'],
            ['nama' => 'Konsultan'],
            ['nama' => 'Jasa'],
            ['nama' => 'Transportasi'],
            ['nama' => 'Logistik'],
            ['nama' => 'Pariwisata'],
            ['nama' => 'Hotel'],
            ['nama' => 'Restoran'],
            ['nama' => 'Kafe'],
            ['nama' => 'Minuman Ringan'],
            ['nama' => 'Makanan Ringan'],
            ['nama' => 'Supermarket'],
            ['nama' => 'Toko'],
            ['nama' => 'Pasar'],
            ['nama' => 'Online'],
            ['nama' => 'Offline'],
            ['nama' => 'Digital'],
            ['nama' => 'Fisik'],
            ['nama' => 'Virtual'],
            ['nama' => 'Real'],
            ['nama' => 'Imajiner'],
            ['nama' => 'Abstrak'],
            ['nama' => 'Konkrer'],
            ['nama' => 'Tradisional'],
            ['nama' => 'Modern'],
            ['nama' => 'Kuno'],
            ['nama' => 'Baru'],
            ['nama' => 'Bekas'],
            ['nama' => 'Original'],
            ['nama' => 'Replika'],
            ['nama' => 'Premium'],
            ['nama' => 'Standar'],
            ['nama' => 'Ekonomis'],
            ['nama' => 'Luxury'],
        ];

        foreach ($kategoris as $kategori) {
            Kategori::updateOrCreate(['nama' => $kategori['nama']], $kategori);
        }
    }
}