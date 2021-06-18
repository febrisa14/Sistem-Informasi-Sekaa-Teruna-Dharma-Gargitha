<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DataTables;
use App\Models\Kas;
use Auth;
use Carbon\Carbon;

class PengeluaranController extends Controller
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
            ->where('type','=','Pengeluaran')
            ->get();
            return DataTables::of($data)
            ->editColumn('tgl_transaksi', function($data){
                return Carbon::createFromFormat('Y-m-d', $data->tgl_transaksi)->format('d M Y');
            })
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
                    $actionBtn = $actionBtn.' <a href="/admin/kas/pengeluaran/'. $data->no_transaksi_kas .'/edit" class="edit btn btn-sm btn-alt-success" data-toggle="tooltip" title="Ubah Data"><i class="fa fa-fw fa-edit"></i> Ubah</a>';
                    $actionBtn = $actionBtn.' <a href="javascript:void(0)" data-id="' . $data->no_transaksi_kas . '" class="delete btn btn-sm btn-alt-danger" data-toggle="tooltip" title="Hapus Data"><i class="fa fa-fw fa-trash"></i> Hapus</a>';
                    return $actionBtn;
                }
            })
            ->rawColumns(['action'])->make(true);
        }

        return view('admin/kas/pengeluaran/index',[
            'title' => 'Data Pengeluaran Kas | Sistem Informasi Sekaa Teruna Dharma Gargitha'
        ]);
    }

    public function create()
    {
        return view('admin/kas/pengeluaran/create',[
            'title' => 'Tambah Pengeluaran Kas | Sistem Informasi Sekaa Teruna Dharma Gargitha'
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'tgl_transaksi' => 'required',
            'nominal' => 'required|numeric',
            'deskripsi' => 'required'
        ]);

        $pengurusId = Auth::user()->pengurus->pengurus_id;

        Kas::create([
            'no_transaksi_kas' => 'OUT'.time(),
            'pengurus_id' => $pengurusId,
            'type' => 'Pengeluaran',
            'tgl_transaksi' => $request->tgl_transaksi,
            'nominal' => $request->nominal,
            'deskripsi' => $request->deskripsi
        ]);

        return redirect()->route('admin.pengeluaran.index')->with('success', 'Menambahkan Pengeluaran.');
    }

    public function show($id)
    {
        return with([
            'pengeluaran' => Kas::select
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
        $pengeluaran = Kas::select('no_transaksi_kas','deskripsi','tgl_transaksi','nominal')
        ->where('type','=','Pengeluaran')->where('no_transaksi_kas',$id)->first();

        return view('admin/kas/pengeluaran/edit', [
            'title' => 'Edit Data Pengeluaran | Sistem Informasi Sekaa Teruna Dharma Gargitha',
            'pengeluaran' => $pengeluaran
        ]);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'tgl_transaksi' => 'required',
            'deskripsi' => 'required',
            'nominal' => 'required'
        ]);

        $pengeluaran = Kas::where('no_transaksi_kas',$id)
                    ->select('tgl_transaksi','deskripsi','nominal')
                    ->first();

        $pengeluaran->tgl_transaksi = $request->tgl_transaksi;
        $pengeluaran->deskripsi = $request->deskripsi;
        $pengeluaran->nominal = $request->nominal;

        if ($pengeluaran->isDirty())
        {
            Kas::where('no_transaksi_kas',$id)->update([
                'tgl_transaksi' => $request->tgl_transaksi,
                'deskripsi' => $request->deskripsi,
                'nominal' => $request->nominal,
                'updated_at' => now()
            ]);

            return redirect()->route('admin.pengeluaran.index')->with('success', 'Berhasil Update Data Pengeluaran.');
        }

        return back()->with('error', 'Kamu belum merubah data apapun !');
    }

    public function destroy($id)
    {
        Kas::find($id)->delete();

        return response()->json([
            'success' => true,
            'message' => 'Berhasil Menghapus Data Pengeluaran'
        ]);
    }
}
