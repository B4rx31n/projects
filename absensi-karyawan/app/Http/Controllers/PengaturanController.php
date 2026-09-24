<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PengaturanController extends Controller
{
    protected $settingsFile = 'settings.json';

    public function index()
    {
        if (Storage::exists($this->settingsFile)) {
            $settings = json_decode(Storage::get($this->settingsFile), true);
        } else {
            $settings = [];
        }

        return view('pengaturan', compact('settings'));
    }

    public function save(Request $request)
    {
        $data = $request->validate([
            'app_name' => 'required|string|max:255',
            'jam_masuk' => 'required|string',
            'admin_pass' => 'nullable|string',
        ]);

        // Load existing settings
        $existingSettings = [];
        if (Storage::exists($this->settingsFile)) {
            $existingSettings = json_decode(Storage::get($this->settingsFile), true);
        }

        // Update settings data selectively
        $existingSettings['app_name'] = $data['app_name'];
        $existingSettings['jam_masuk'] = $data['jam_masuk'];

        if (!empty($data['admin_pass'])) {
            // Store password hash if you want security. For demo, store plain text (Not recommended).
            $existingSettings['admin_pass'] = $data['admin_pass'];
        }

        // Save back to file
        Storage::put($this->settingsFile, json_encode($existingSettings, JSON_PRETTY_PRINT));

        return redirect()->route('pengaturan.index')->with('success', 'Pengaturan berhasil disimpan.');
    }
}
