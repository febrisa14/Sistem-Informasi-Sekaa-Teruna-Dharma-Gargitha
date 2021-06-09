<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DataTables;
use App\Models\Kas;
use Auth;
use Carbon\Carbon;

class PemasukanController extends Controller
{
    public function __construct()
    {
        $this->middleware('bendahara')->except('index','show');
    }


    public function index(Request $request)
    {
        if ($request->ajax())
        {
            $data = Kas::select('no_transaksi_kas','deskripsi','tgl_transaksi','nominal')
            ->where('type','=','Pemasukan')
            ->get();
            return DataTables::of($data)
            ->addIndexColumn()
            ->addColumn('action', function($data){
                if (Auth::User()->pengurus->jabatan->nama_jabatan == 'Sekretaris 1' ||
                    Auth::User()->pengurus->jabatan->nama_jabatan == 'Sekretaris 2')
                {
                    $actionBtn = '<a href="javascript:void(0)" data-id="' . $data->no_transaksi_kas . '" class="detail btn btn-sm btn-alt-primary" data-toggle="tooltip" title="Lihat Data"><i class="far fa-fw fa-eye"></i> Lihat</a>';
                    return $actionBtn;
                }
                else if (Auth::User()->pengurus->jabatan->nama_jabatan == 'Ketua STT'
                        || Auth::User()->pengurus->jabatan->nama_jabatan == 'Wakil Ketua STT'
                        || Auth::User()->pengurus->jabatan->nama_jabatan == 'Bendahara 1'
                        || Auth::User()->pengurus->jabatan->nama_jabatan == 'Bendahara 2')
                {
                    $actionBtn = '<a href="javascript:void(0)" data-id="' . $data->no_transaksi_kas . '" class="detail btn btn-sm btn-alt-primary" data-toggle="tooltip" title="Lihat Data"><i class="far fa-fw fa-eye"></i> Lihat</a>';
                    $actionBtn = $actionBtn.' <a href="/admin/kas/pemasukan/'. $data->no_transaksi_kas .'/edit" class="edit btn btn-sm btn-alt-success" data-toggle="tooltip" title="Ubah Data"><i class="fa fa-fw fa-edit"></i> Ubah</a>';
                    $actionBtn = $actionBtn.' <a href="javascript:void(0)" data-id="' . $data->no_transaksi_kas . '" class="delete btn btn-sm btn-alt-danger" data-toggle="tooltip" title="Hapus Data"><i class="fa fa-fw fa-trash"></i> Hapus</a>';
                    return $actionBtn;
                }
            })
            ->rawColumns(['action'])->make(true);
        }

        return view('admin/kas/pemasukan/index',[
            'title' => 'Data Pemasukan Kas | Sistem Informasi Sekaa Teruna Dharma Gargitha'
        ]);
    }

    public function create()
    {
        return view('admin/kas/pemasukan/create',[
            'title' => 'Tambah Pemasukan Kas | Sistem Informasi Sekaa Teruna Dharma Gargitha'
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'tgl_transaksi' => 'required',
            'nominal' => 'required',
            'deskripsi' => 'required'
        ]);

        $pengurusId = Auth::user()->pengurus->pengurus_id;

        Kas::create([
            'no_transaksi_kas' => 'TX'.time(),
            'pengurus_id' => $pengurusId,
            'type' => 'Pemasukan',
            'tgl_transaksi' => $request->tgl_transaksi,
            'nominal' => $request->nominal,
            'deskripsi' => $request->deskripsi
        ]);

        return redirect()->route('admin.pemasukan.index')->with('success', 'Menambahkan Pemasukan.');
    }

    public function show($id)
    {
        return with([
            'pemasukan' => Kas::select
                (
                    'kas.no_transaksi_kas',
                    'kas.tgl_transaksi',
                    'kas.deskripsi',
                    'kas.nominal',
                    'users.name'
                )
                ->leftJoin('pengurus', 'pengurus.pengurus_id', '=', 'kas.pengurus_id')
                ->leftJoin('users', 'users.user_id', '=', 'pengurus.pengurus_user_id')
                ->where('kas.no_transaksi_kas', '=', $id)->first()
        ]);
    }

    public function edit($id)
    {
        $pemasukan = Kas::select('no_transaksi_kas','deskripsi','tgl_transaksi','nominal')
        ->where('type','=','Pemasukan')->where('no_transaksi_kas',$id)->first();

        return view('admin/kas/pemasukan/edit', [
            'title' => 'Edit Data Pemasukan | Sistem Informasi Sekaa Teruna Dharma Gargitha',
            'pemasukan' => $pemasukan
        ]);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'tgl_transaksi' => 'required',
            'deskripsi' => 'required',
            'nominal' => 'required'
        ]);

        $pemasukan = Kas::where('no_transaksi_kas',$id)
                    ->select('tgl_transaksi','deskripsi','nominal')
                    ->first();

        $pemasukan->tgl_transaksi = $request->tgl_transaksi;
        $pemasukan->deskripsi = $request->deskripsi;
        $pemasukan->nominal = $request->nominal;

        if ($pemasukan->isDirty())
        {
            Kas::where('no_transaksi_kas',$id)->update([
                'tgl_transaksi' => $request->tgl_transaksi,
                'deskripsi' => $request->deskripsi,
                'nominal' => $request->nominal,
                'updated_at' => now()
            ]);

            return redirect()->route('admin.pemasukan.index')->with('success', 'Berhasil Update Data Pemasukan.');
        }

        return back()->with('error', 'Kamu belum merubah data apapun !');
    }

    public function destroy($id)
    {
        Kas::find($id)->delete();

        return response()->json([
            'success' => true,
            'message' => 'Berhasil Menghapus Data Pemasukan'
        ]);
    }
}
