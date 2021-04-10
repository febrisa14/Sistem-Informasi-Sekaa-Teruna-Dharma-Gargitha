<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function __invoke()
    {
        $nama = Auth::user()->name;
        $anggota = User::where('role','=','Anggota')->get();
        $pengurus = User::where('role','=','Pengurus')->get();

        return view('dashboard', [
            'title' => 'Dashboard | Sistem Informasi Sekaa Teruna Dharma Gargitha',
            'anggota' => $anggota,
            'pengurus' => $pengurus,
            'nama' => $nama
        ]);
    }
}
