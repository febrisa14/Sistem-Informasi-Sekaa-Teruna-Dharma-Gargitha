<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Kegiatan;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Kas;

class DashboardController extends Controller
{
    public function __invoke()
    {
        $nama = Auth::user()->name;
        $anggota = User::where('role','=','Anggota')->get();
        $pengurus = User::where('role','=','Pengurus')->get();
        $pengumumans = Kegiatan::select(
            'kegiatan_id', 'nama_kegiatan', 'nama_jenis_kegiatan', 'tgl_kegiatan'
        )
        ->leftjoin('jenis_kegiatan', 'jenis_kegiatan.jenis_kegiatan_id','=','kegiatan.jenis_kegiatan_id')
        ->orderBy('tgl_kegiatan','DESC')
        ->take(5)
        ->get();

        $pemasukan = Kas::where('type','=','Pemasukan')->sum('nominal');
        $pengeluaran = Kas::where('type','=','Pengeluaran')->sum('nominal');
        $saldo = $pemasukan - $pengeluaran;

        return view('dashboard', [
            'title' => 'Anggota Dashboard | Sistem Informasi Sekaa Teruna Dharma Gargitha',
            'anggota' => $anggota,
            'pengurus' => $pengurus,
            'nama' => $nama,
            'pengumumans' => $pengumumans,
            'saldo' => $saldo
        ]);
    }
}
