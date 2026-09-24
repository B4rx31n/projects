<?php

namespace App\Http\Controllers;

use App\Models\Pengiriman;
use App\Models\Anggota;
use App\Models\Produk;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class PengirimanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = Pengiriman::with(['anggota','produk'])->get();
        return view('pengiriman.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $anggota = Anggota::all();
        $produk = Produk::all();
        
        return view('pengiriman.create', compact('anggota', 'produk'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // 1. Validasi input
        $request->validate([
            'anggota_id' => 'required|exists:anggotas,id',
            'produk_id' => 'required|exists:produks,id',
            'jumlah_kiriman' => 'required|integer|min:1',
            'tanggal_pemesanan' => 'required|date',
        ]);

        // 2. Ambil data produk untuk cek stok
        $produk = Produk::findOrFail($request->produk_id);

        // 3. Cek apakah stok mencukupi
        if ($produk->jumlah < $request->jumlah_kiriman) {
            return back()->with('error', "Stok tidak cukup! Sisa stok {$produk->nama_barang} hanya {$produk->jumlah}.");
        }

        // 4. Proses Transaksi
        try {
            DB::transaction(function () use ($request, $produk) {
                // Simpan ke tabel pengiriman
                Pengiriman::create([
                    'anggota_id'       => $request->anggota_id,
                    'produk_id'        => $request->produk_id,
                    'jumlah_kiriman'   => $request->jumlah_kiriman,
                    'tanggal_pemesanan'=> $request->tanggal_pemesanan,
                    'status_pembayaran'=> 'belum_dibayar',
                    'keterangan'       => $request->keterangan,
                ]);

                // Kurangi stok produk saat order dibuat
                $produk->decrement('jumlah', $request->jumlah_kiriman);
            });

            return redirect()->route('pengiriman.index')->with('success', 'Pengiriman berhasil dicatat! Stok produk berkurang.');

        } catch (\Exception $e) {
            return back()->with('error', 'Terjadi kesalahan sistem: ' . $e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Pengiriman $pengiriman)
    {
        $pengiriman->load(['anggota', 'produk']);
        return view('pengiriman.detail', compact('pengiriman'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Pengiriman $pengiriman)
    {
        // Hanya bisa edit jika belum dibayar
        if ($pengiriman->status_pembayaran == 'sudah_dibayar') {
            return redirect()->route('pengiriman.index')->with('error', 'Tidak bisa edit pesanan yang sudah dibayar!');
        }

        $anggota = Anggota::all();
        $produk = Produk::all();
        
        return view('pengiriman.edit', compact('pengiriman', 'anggota', 'produk'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Pengiriman $pengiriman)
    {
        // Hanya bisa update jika belum dibayar
        if ($pengiriman->status_pembayaran == 'sudah_dibayar') {
            return redirect()->route('pengiriman.index')->with('error', 'Tidak bisa update pesanan yang sudah dibayar!');
        }

        // 1. Validasi input
        $request->validate([
            'anggota_id' => 'required|exists:anggotas,id',
            'produk_id' => 'required|exists:produks,id',
            'jumlah_kiriman' => 'required|integer|min:1',
            'tanggal_pemesanan' => 'required|date',
        ]);

        // 2. Proses Transaksi
        try {
            DB::transaction(function () use ($request, $pengiriman) {
                // Kembalikan stok produk lama
                $pengiriman->produk()->increment('jumlah', $pengiriman->jumlah_kiriman);

                // Update data pesanan
                $pengiriman->update([
                    'anggota_id'       => $request->anggota_id,
                    'produk_id'        => $request->produk_id,
                    'jumlah_kiriman'   => $request->jumlah_kiriman,
                    'tanggal_pemesanan'=> $request->tanggal_pemesanan,
                    'keterangan'       => $request->keterangan,
                ]);

                // Kurangi stok produk baru
                $produk_baru = Produk::findOrFail($request->produk_id);
                if ($produk_baru->jumlah < $request->jumlah_kiriman) {
                    throw new \Exception("Stok tidak cukup! Sisa stok {$produk_baru->nama_barang} hanya {$produk_baru->jumlah}.");
                }
                $produk_baru->decrement('jumlah', $request->jumlah_kiriman);
            });

            return redirect()->route('pengiriman.index')->with('success', 'Pesanan berhasil diupdate!');

        } catch (\Exception $e) {
            return back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Pengiriman $pengiriman)
    {
        //
    }

    /**
     * Konfirmasi pembayaran
     */
    public function bayar($id)
    {
        $pengiriman = Pengiriman::findOrFail($id);

        if ($pengiriman->status_pembayaran == 'belum_dibayar') {
            DB::transaction(function () use ($pengiriman) {
                // Ubah status dan isi tanggal pengiriman
                $pengiriman->update([
                    'status_pembayaran' => 'sudah_dibayar',
                    'tanggal_pengiriman' => now()
                ]);

                // Tambahkan stok produk kembali (konfirmasi pesanan)
                $pengiriman->produk()->increment('jumlah', $pengiriman->jumlah_kiriman);
            });

            return redirect()->back()->with('success', 'Pembayaran berhasil! Pesanan dikonfirmasi, stok produk ditambahkan.');
        }

        return redirect()->back()->with('error', 'Pengiriman sudah pernah dibayar sebelumnya.');
    }
}
