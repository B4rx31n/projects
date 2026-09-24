<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class GameController extends Controller
{
    private function defaultGame()
    {
        return [
            ['judul' => 'Mobile Legends', 'genre' => 'MOBA', 'tahun_rilis' => 2016],
            ['judul' => 'PUBG', 'genre' => 'Battle Royale', 'tahun_rilis' => 2017],
            ['judul' => 'Minecraft', 'genre' => 'Sandbox', 'tahun_rilis' => 2011],
        ];
    }

    public function index(Request $request)
    {
        $listGame = session('listGame', $this->defaultGame());

        return view('game.index', [
            'listGame' => $listGame
        ]);
    }

    public function create()
    {
        return view('game.create');
    }

    public function store(Request $request)
    {
        $listGame = session('listGame', $this->defaultGame());

        $listGame[] = [
            'judul' => $request->judul,
            'genre' => $request->genre,
            'tahun_rilis' => $request->tahun_rilis,
        ];

        session(['listGame' => $listGame]);

        return redirect()->route('game.index');
    }
}
