<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Kegiatan;
use DataTables;

class PengumumanController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax())
        {
            $data = Kegiatan::select(
                'kegiatan_id', 'nama_kegiatan', 'nama_jenis_kegiatan', 'tgl_kegiatan'
            )
            ->leftjoin('jenis_kegiatan', 'jenis_kegiatan.jenis_kegiatan_id','=','kegiatan.jenis_kegiatan_id')
            ->orderBy('tgl_kegiatan','DESC')
            ->get();
            return DataTables::of($data)
            ->editColumn('tgl_kegiatan', function ($data){
                return date('d M, Y', strtotime($data->tgl_kegiatan));
            })
            ->addIndexColumn()
            ->addColumn('action', function($data){
                $actionBtn = '<a href="/anggota/pengumuman/'.$data->kegiatan_id.'" data-id="'.$data->kegiatan_id.'" class="detail btn btn-sm btn-alt-primary" data-toggle="tooltip" title="Lihat Data"><i class="far fa-fw fa-eye"></i> Detail Pengumuman</a>';
                return $actionBtn;
            })
            ->rawColumns(['action'])->make(true);
        }

        return view('user/pengumuman/pengumuman',[
            'title' => 'Data Pengumuman | Sistem Informasi Sekaa Teruna Dharma Gargitha'
        ]);
    }

    public function show($id)
    {
        $pengumumans = Kegiatan::select(
            'kegiatan_id', 'lampiran', 'pakaian', 'users.name' ,'kegiatan.created_at' ,'nama_kegiatan', 'nama_jenis_kegiatan', 'tgl_kegiatan', 'jam_kegiatan', 'lokasi', 'kegiatan.jenis_kegiatan_id'
        )
        ->leftjoin('jenis_kegiatan', 'jenis_kegiatan.jenis_kegiatan_id','=','kegiatan.jenis_kegiatan_id')
        ->leftJoin('pengurus', 'pengurus.pengurus_id', '=', 'kegiatan.pengurus_id')
        ->leftJoin('users', 'users.user_id', '=', 'pengurus.pengurus_user_id')
        ->where('kegiatan_id', $id)
        ->get();

        return view('user/pengumuman/pengumuman_detail', [
            'title' => 'Detail Kegiatan | Sistem Informasi ST. Dharma Gargitha',
            'pengumumans' => $pengumumans
        ]);
    }
}
