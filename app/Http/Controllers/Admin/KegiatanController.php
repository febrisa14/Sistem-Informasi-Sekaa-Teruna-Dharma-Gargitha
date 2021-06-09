<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Kegiatan;
use DataTables;
use App\Models\JenisKegiatan;
use Auth;
use PDF;
use App\Models\User;
use Carbon\Carbon;

class KegiatanController extends Controller
{
    public function __construct()
    {
        $this->middleware('sekretaris')->except('index','show');
    }

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
            ->editColumn('tgl_kegiatan', function($data){
                return Carbon::createFromFormat('Y-m-d', $data->tgl_kegiatan)->format('d M Y');
            })
            ->addIndexColumn()
            ->addColumn('action', function($data){
                if (Auth::User()->pengurus->jabatan->nama_jabatan == 'Bendahara 1'
                    || Auth::User()->pengurus->jabatan->nama_jabatan == 'Bendahara 2')
                {
                    $actionBtn = '<a href="/admin/kegiatan/'.$data->kegiatan_id.'" data-id="' . $data->kegiatan_id . '" class="detail btn btn-sm btn-alt-primary" data-toggle="tooltip" title="Lihat Data"><i class="far fa-fw fa-eye"></i> Lihat Kegiatan</a>';
                    return $actionBtn;
                }
                else if (Auth::User()->pengurus->jabatan->nama_jabatan == 'Ketua STT'
                        || Auth::User()->pengurus->jabatan->nama_jabatan == 'Wakil Ketua STT'
                        || Auth::User()->pengurus->jabatan->nama_jabatan == 'Sekretaris 1' ||
                        Auth::User()->pengurus->jabatan->nama_jabatan == 'Sekretaris 2')
                {
                    $actionBtn = '<a href="/admin/kegiatan/'.$data->kegiatan_id.'" data-id="' . $data->kegiatan_id . '" class="detail btn btn-sm btn-alt-primary" data-toggle="tooltip" title="Lihat Data"><i class="far fa-fw fa-eye"></i> Lihat</a>';
                    $actionBtn = $actionBtn.' <a href="/admin/kegiatan/'.$data->kegiatan_id.'/edit" class="edit btn btn-sm btn-alt-success" data-toggle="tooltip" title="Ubah Data"><i class="fa fa-fw fa-edit"></i> Ubah</a>';
                    $actionBtn = $actionBtn.' <a href="javascript:void(0)" data-id="' . $data->kegiatan_id . '" class="delete btn btn-sm btn-alt-danger" data-toggle="tooltip" title="Hapus Data"><i class="fa fa-fw fa-trash"></i> Hapus</a>';
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
            'pengurus_id' => Auth::user()->pengurus->pengurus_id
        ]);

        return response()->json(['success' => true, 'message' => 'Berhasil Menambahkan Kegiatan.']);
    }

    public function show($id)
    {
        $pengumumans = Kegiatan::select(
            'kegiatan_id', 'pakaian', 'users.name' ,'kegiatan.created_at' ,'nama_kegiatan', 'nama_jenis_kegiatan', 'tgl_kegiatan', 'jam_kegiatan', 'lokasi', 'kegiatan.jenis_kegiatan_id'
        )
        ->leftjoin('jenis_kegiatan', 'jenis_kegiatan.jenis_kegiatan_id','=','kegiatan.jenis_kegiatan_id')
        ->leftJoin('pengurus', 'pengurus.pengurus_id', '=', 'kegiatan.pengurus_id')
        ->leftJoin('users', 'users.user_id', '=', 'pengurus.pengurus_user_id')
        ->where('kegiatan_id', $id)
        ->get();

        return view('admin/kegiatan/kegiatan/kegiatan_show', [
            'title' => 'Detail Kegiatan | Sistem Informasi ST. Dharma Gargitha',
            'kegiatans' => $pengumumans
        ]);
    }

    public function edit($id)
    {
        $kegiatan = Kegiatan::select(
            'kegiatan_id', 'pakaian' ,'kegiatan.created_at' ,'nama_kegiatan', 'nama_jenis_kegiatan', 'tgl_kegiatan', 'jam_kegiatan', 'lokasi', 'kegiatan.jenis_kegiatan_id'
        )
        ->leftjoin('jenis_kegiatan', 'jenis_kegiatan.jenis_kegiatan_id','=','kegiatan.jenis_kegiatan_id')
        ->where('kegiatan_id', $id)->first();

        return view('admin/kegiatan/kegiatan/kegiatan_edit', [
            'title' => 'Edit Data Kegiatan | Sistem Informasi Sekaa Teruna Dharma Gargitha',
            'kegiatan' => $kegiatan
        ]);
    }

    public function update(Request $request,$id)
    {
        $request->validate([
            'nama_kegiatan' => 'required',
            'tgl_kegiatan' => 'required',
            'jam_kegiatan' => 'required',
            'lokasi' => 'required',
            'pakaian' => 'required'
        ]);

        $kegiatan = Kegiatan::where('kegiatan_id',$id)
                    ->select('nama_kegiatan','tgl_kegiatan','jam_kegiatan','lokasi','pakaian')
                    ->first();

        $kegiatan->nama_kegiatan = $request->nama_kegiatan;
        $kegiatan->tgl_kegiatan = $request->tgl_kegiatan;
        $kegiatan->jam_kegiatan = $request->jam_kegiatan;
        $kegiatan->lokasi = $request->lokasi;
        $kegiatan->pakaian = $request->pakaian;

        if ($kegiatan->isDirty())
        {
            Kegiatan::where('kegiatan_id',$id)->update([
                'nama_kegiatan' => $request->nama_kegiatan,
                'tgl_kegiatan' => $request->tgl_kegiatan,
                'jam_kegiatan' => $request->jam_kegiatan,
                'lokasi' => $request->lokasi,
                'pakaian' => $request->pakaian,
                'updated_at' => now()
            ]);

            return redirect()->route('admin.kegiatan.index')->with('success', 'Berhasil Update Kegiatan.');
        }

        return back()->with('error', 'Kamu belum merubah data apapun !');
    }

    public function cetak($id)
    {
        $kegiatan = Kegiatan::select(
            'kegiatan_id', 'pakaian', 'nama_kegiatan', 'tgl_kegiatan', 'jam_kegiatan', 'lokasi', 'created_at'
        )
        ->where('kegiatan_id', $id)
        ->first();

        $KetuaSTT = User::select
        ('users.user_id','users.name','jabatan.nama_jabatan')
        ->rightjoin('pengurus', 'pengurus.pengurus_user_id','=','users.user_id')
        ->leftjoin('jabatan', 'jabatan.jabatan_id','=','pengurus.pengurus_jabatan_id')
        ->where('jabatan.jabatan_id','1')
        ->first();

        $Sekretaris = User::select
        ('users.user_id','users.name','jabatan.nama_jabatan')
        ->rightjoin('pengurus', 'pengurus.pengurus_user_id','=','users.user_id')
        ->leftjoin('jabatan', 'jabatan.jabatan_id','=','pengurus.pengurus_jabatan_id')
        ->where('jabatan.jabatan_id','3')
        ->first();

        // $pdf = PDF::loadView('admin/kegiatan/kegiatan/kegiatan_cetak', compact('data'));

        // return $pdf->download('kegiatan_'.now().'.pdf');

        return view('admin/kegiatan/kegiatan/kegiatan_cetak',[
            'kegiatan' => $kegiatan,
            'KetuaSTT' => $KetuaSTT,
            'Sekretaris' => $Sekretaris
        ]);
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
