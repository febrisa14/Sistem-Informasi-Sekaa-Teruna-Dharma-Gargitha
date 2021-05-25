<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use App\Models\Kas;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function __invoke()
    {
        $nama = Auth::user()->name;
        $anggota = User::where('role','=','Anggota')->get();
        $pengurus = User::where('role','=','Pengurus')->get();

        $pemasukan = Kas::where('type','=','Pemasukan')->sum('nominal');
        $pengeluaran = Kas::where('type','=','Pengeluaran')->sum('nominal');
        $saldo = $pemasukan - $pengeluaran;

        return view('dashboard', [
            'title' => 'Admin Dashboard | Sistem Informasi Sekaa Teruna Dharma Gargitha',
            'anggota' => $anggota,
            'pengurus' => $pengurus,
            'nama' => $nama,
            'saldo' => $saldo,
            'pemasukan' => $pemasukan,
            'pengeluaran' => $pengeluaran
        ]);
    }
}
