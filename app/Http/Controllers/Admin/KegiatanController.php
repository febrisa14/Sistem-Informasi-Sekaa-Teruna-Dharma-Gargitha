<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Kegiatan;
use DataTables;
use App\Models\JenisKegiatan;
use Auth;
use PDF;

class KegiatanController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax())
        {
            $data = Kegiatan::select(
                'kegiatan_id', 'nama_kegiatan', 'nama_jenis_kegiatan', 'tgl_kegiatan'
            )
            ->leftjoin('jenis_kegiatan', 'jenis_kegiatan.jenis_kegiatan_id','=','kegiatan.jenis_kegiatan_id')
            ->get();
            return DataTables::of($data)
            ->addIndexColumn()
            ->addColumn('action', function($data){
                if ($data->tgl_kegiatan < now()->format('d M Y'))
                {
                    $actionBtn = '<a href="/admin/kegiatan/'.$data->kegiatan_id.'" data-id="'.$data->kegiatan_id.'" class="detail btn btn-sm btn-alt-primary" data-toggle="tooltip" title="Lihat Data"><i class="far fa-fw fa-eye"></i> Lihat</a>';
                    return $actionBtn;
                }
                else
                {
                    $actionBtn = '<a href="/admin/kegiatan/'.$data->kegiatan_id.'" data-id="'.$data->kegiatan_id.'" class="detail btn btn-sm btn-alt-primary" data-toggle="tooltip" title="Lihat Data"><i class="far fa-fw fa-eye"></i> Lihat</a>';
                    $actionBtn = $actionBtn.' <a href="javascript:void(0)" class="edit btn btn-sm btn-alt-success" data-toggle="tooltip" title="Ubah Data"><i class="fa fa-fw fa-edit"></i> Ubah</a>';
                    $actionBtn = $actionBtn.' <a href="javascript:void(0)" data-id="'.$data->kegiatan_id.'" class="delete btn btn-sm btn-alt-danger" data-toggle="tooltip" title="Hapus Data"><i class="fa fa-fw fa-trash"></i> Hapus</a>';
                    return $actionBtn;
                }
            })
            ->rawColumns(['action'])->make(true);
        }

        $jeniskegiatans = JenisKegiatan::all();

        return view('admin/kegiatan/kegiatan/kegiatan',[
            'title' => 'Data Kegiatan | Sistem Informasi Sekaa Teruna Dharma Gargitha',
            'jeniskegiatans' => $jeniskegiatans
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_kegiatan' => 'required',
            'tgl_kegiatan' => 'required',
            'jenis_kegiatan_id' => 'required',
            'jam_kegiatan' => 'required',
            'lokasi' => 'required',
            'pakaian' => 'required'
        ]);

        Kegiatan::create([
            'nama_kegiatan' => $request->nama_kegiatan,
            'tgl_kegiatan' => $request->tgl_kegiatan,
            'jenis_kegiatan_id' => $request->jenis_kegiatan_id,
            'jam_kegiatan' => $request->jam_kegiatan,
            'lokasi' => $request->lokasi,
            'pakaian' => $request->pakaian,
            'user_id' => Auth::user()->user_id
        ]);

        return response()->json(['success' => true, 'message' => 'Berhasil Menambahkan Kegiatan.']);
    }

    public function show($id)
    {
        $kegiatans = Kegiatan::select(
            'kegiatan_id', 'pakaian', 'users.name' ,'kegiatan.created_at' ,'nama_kegiatan', 'nama_jenis_kegiatan', 'tgl_kegiatan', 'jam_kegiatan', 'lokasi', 'kegiatan.jenis_kegiatan_id'
        )
        ->leftjoin('jenis_kegiatan', 'jenis_kegiatan.jenis_kegiatan_id','=','kegiatan.jenis_kegiatan_id')
        ->leftjoin('users', 'users.user_id','=','kegiatan.user_id')
        ->where('kegiatan_id', $id)
        ->get();

        return view('admin/kegiatan/kegiatan/kegiatan_show', [
            'title' => 'Detail Kegiatan | Sistem Informasi ST. Dharma Gargitha',
            'kegiatans' => $kegiatans
        ]);
    }

    public function cetak($id)
    {
        $data = Kegiatan::select(
            'kegiatan_id', 'pakaian', 'nama_kegiatan', 'tgl_kegiatan', 'jam_kegiatan', 'lokasi', 'created_at'
        )
        ->where('kegiatan_id', $id)
        ->get();

        $pdf = PDF::loadView('admin/kegiatan/kegiatan/kegiatan_cetak', compact('data'));

        return $pdf->download('kegiatan_'.now().'.pdf');

        // return view('admin/kegiatan/kegiatan/kegiatan_cetak', compact('data'));
    }

    public function destroy($id)
    {
        Kegiatan::where('kegiatan_id','=',$id)->delete();

        return response()->json([
            'success' => true,
            'message' => 'Berhasil Menghapus Data Kegiatan'
        ]);
    }
}
