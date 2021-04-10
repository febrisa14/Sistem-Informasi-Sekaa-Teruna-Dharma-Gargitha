<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DataTables;
use Illuminate\Support\Facades\Auth;
use App\Models\JenisKegiatan;

class JenisKegiatanController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax())
        {
            $data = JenisKegiatan::all();
            return DataTables::of($data)
            ->editColumn('created_at', function($data){
                return $data->created_at->format('d-m-Y');
            })
            ->addIndexColumn()
            ->addColumn('action', function($data){
                $actionBtn = '<a href="javascript:void(0)" data-id="'.$data->jenis_kegiatan_id.'" class="delete btn btn-sm btn-alt-danger" data-toggle="tooltip" title="Hapus Data"><i class="fa fa-fw fa-trash"></i> Hapus</a>';
                return $actionBtn;
            })
            ->rawColumns(['action'])->make(true);
        }

        return view('admin/kegiatan/jenis_kegiatan/jenis_kegiatan',[
            'title' => 'Data Jenis Kegiatan | Sistem Informasi Sekaa Teruna Dharma Gargitha',
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_jenis_kegiatan' => 'required'
        ]);

        JenisKegiatan::create([
            'nama_jenis_kegiatan' => $request->nama_jenis_kegiatan
        ]);

        return response()->json(['success' => true, 'message' => 'Berhasil Menambahkan Jenis Kegiatan.']);
    }

    public function destroy($id)
    {
        JenisKegiatan::where('jenis_kegiatan_id', $id)->delete();

        return response()->json(['success' => true, 'message' => 'Berhasil Menghapus Jenis Kegiatan.']);
    }
}
