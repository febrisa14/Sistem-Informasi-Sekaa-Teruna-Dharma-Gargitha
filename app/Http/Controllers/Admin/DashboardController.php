<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use App\Models\Kas;
use DB;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function __invoke()
    {
        $nama = Auth::user()->name;
        $anggota = User::where('role','=','Anggota')->get();
        $pengurus = User::where('role','=','Pengurus')->get();

        $pemasukan = DB::table('kas')->select(DB::raw('SUM(nominal) as total_pemasukan'))->where('type','=','Pemasukan')->get();
        $pengeluaran = DB::table('kas')->select(DB::raw('SUM(nominal) as total_pengeluaran'))->where('type','=','Pengeluaran')->get();
        // $pemasukan = Kas::where('type','=','Pemasukan')->sum('nominal');
        // $pengeluaran = Kas::where('type','=','Pengeluaran')->sum('nominal');
        $saldo = $pemasukan->total_pemasukan - $pengeluaran->total_pengeluaran;

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
