<?php

namespace App\Http\Controllers;

use App\Models\Test;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;

class TestController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');
        
        $Test = Test::when($search, function ($query, $search) {
            return $query->where('nama', 'like', "%{$search}%")
                ->orWhere('harga', 'like', "%{$search}%")
                ->orWhere('stok', 'like', "%{$search}%");
        })->get();
        
        return view('Test.index', compact('Test', 'search'));
    }

    public function create()
    {
        return view('Test.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama'  => 'required',
            'harga' => 'required|numeric',
            'stok'  => 'required|integer',
        ]);

        Test::create($request->all());

        return redirect()->route('Test.index')
                         ->with('success', 'Produk berhasil ditambahkan');
    }

    public function show(string $id)
    {
        $Test = Test::findOrFail($id);
        return view('Test.show', compact('Test'));
    }

    public function edit(string $id)
    {
        $Test = Test::findOrFail($id);
        return view('Test.edit', compact('Test'));
    }

    public function update(Request $request, string $id)
    {
        $request->validate([
            'nama'  => 'required',
            'harga' => 'required|numeric',
            'stok'  => 'required|integer',
        ]);

        $Test = Test::findOrFail($id);
        $Test->update($request->all());

        return redirect()->route('Test.index')
                         ->with('success', 'Produk berhasil diupdate');
    }

    public function destroy(string $id)
    {
        $Test = Test::findOrFail($id);
        $Test->delete();

        return redirect()->route('Test.index')
                         ->with('success', 'Produk berhasil dihapus');
    }

    /**
     * Export data ke CSV
     */
    public function exportCSV(Request $request)
    {
        $search = $request->input('search');
        
        $Test = Test::when($search, function ($query, $search) {
            return $query->where('nama', 'like', "%{$search}%")
                ->orWhere('harga', 'like', "%{$search}%")
                ->orWhere('stok', 'like', "%{$search}%");
        })->get();
        
        $fileName = 'data-produk-' . date('Y-m-d') . '.csv';
        
        $headers = array(
            "Content-type"        => "text/csv",
            "Content-Disposition" => "attachment; filename=$fileName",
            "Pragma"              => "no-cache",
            "Cache-Control"       => "must-revalidate, post-check=0, pre-check=0",
            "Expires"             => "0"
        );
        
        $columns = array('No', 'Nama Produk', 'Harga', 'Stok', 'Tanggal Dibuat');
        
        $callback = function() use($Test, $columns) {
            $file = fopen('php://output', 'w');
            fputcsv($file, $columns);
            
            $no = 1;
            foreach ($Test as $item) {
                $row = array(
                    $no++,
                    $item->nama,
                    'Rp ' . number_format($item->harga, 0, ',', '.'),
                    $item->stok,
                    $item->created_at->format('d/m/Y H:i')
                );
                
                fputcsv($file, $row);
            }
            
            fclose($file);
        };
        
        return response()->stream($callback, 200, $headers);
    }
    
    /**
     * Export data ke Excel (HTML Table)
     */
    public function exportExcel(Request $request)
    {
        $search = $request->input('search');
        
        $Test = Test::when($search, function ($query, $search) {
            return $query->where('nama', 'like', "%{$search}%")
                ->orWhere('harga', 'like', "%{$search}%")
                ->orWhere('stok', 'like', "%{$search}%");
        })->get();
        
        $data = [
            'title' => 'Laporan Data Produk',
            'date' => date('d/m/Y'),
            'Test' => $Test,
            'search' => $search
        ];
        
        return view('Test.export_excel', $data);
    }
}