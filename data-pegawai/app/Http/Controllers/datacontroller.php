<?php

namespace App\Http\Controllers;

use App\Models\data;
use Illuminate\Http\Request;
use App\Http\Requests\datarequest;
use App\Http\Requests\updaterequest;

class datacontroller extends Controller
{
    public function index()
    {
        $data = data::all();
        return view('home', compact('data'));
    }

    public function tambahdata()
    {
        return view('tambahdata');
    }

    public function simpan(datarequest $r)
    {
        $validated = $r->validated();
        data::create($validated);
        return redirect('/')->with('success', 'Data berhasil disimpan');
    }

    public function edit($id)
    {
        $data = data::findOrFail($id);
        return view('edit', compact('data'));
    }

    public function update(datarequest $r, $id)
    {
        $validated = $r->validated();
        $data = data::findOrFail($id);
        $data->update($validated);
        return redirect('/')->with('success', 'Data berhasil diperbarui');
    }

    public function destroy($id)
    {
        $data = data::findOrFail($id);
        $data->delete();
        return redirect('/')->with('success', 'Data berhasil dihapus');
    }
}
