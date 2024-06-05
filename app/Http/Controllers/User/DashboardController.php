<?php

namespace App\Http\Controllers\User;

use App\Models\Kas;
use App\Models\User;
use App\Models\Kegiatan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    const TYPE_PEMASUKAN = 'Pemasukan';
    const TYPE_PENGELUARAN = 'Pengeluaran';

    public function __invoke()
    {
        $nama = Auth::user()->name;
        $anggota = User::where('role', '=', 'Anggota')->get();
        $pengurus = User::where('role', '=', 'Pengurus')->get();
        $pengumumans = Kegiatan::select(
            'kegiatan_id',
            'nama_kegiatan',
            'nama_jenis_kegiatan',
            'tgl_kegiatan'
        )
            ->leftjoin('jenis_kegiatan', 'jenis_kegiatan.jenis_kegiatan_id', '=', 'kegiatan.jenis_kegiatan_id')
            ->orderBy('tgl_kegiatan', 'DESC')
            ->take(5)
            ->get();

        $sums = Kas::select(DB::raw('type, SUM(nominal) as total'))
            ->whereIn('type', [$this::TYPE_PEMASUKAN, $this::TYPE_PENGELUARAN])
            ->groupBy('type')
            ->pluck('total', 'type');

        // Extract the sums
        $pemasukan = $sums[$this::TYPE_PEMASUKAN] ?? 0;
        $pengeluaran = $sums[$this::TYPE_PENGELUARAN] ?? 0;

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
