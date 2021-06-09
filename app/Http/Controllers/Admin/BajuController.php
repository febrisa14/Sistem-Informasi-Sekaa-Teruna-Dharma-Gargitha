<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Baju;
use DataTables;
use Auth;
use Image;
use File;

class BajuController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function __construct()
    {
        $this->middleware('bendahara')->except('index','show');
    }

    public function index(Request $request)
    {
        if ($request->ajax())
        {
            $data = Baju::select('baju_id','nama_baju','foto_baju','harga')
            ->get();
            return DataTables::of($data)
            ->addIndexColumn()
            ->addColumn('action', function($data){
                if (Auth::User()->pengurus->jabatan->nama_jabatan == 'Sekretaris 1' ||
                    Auth::User()->pengurus->jabatan->nama_jabatan == 'Sekretaris 2')
                    {
                        $actionBtn = '<a href="/admin/baju/'. $data->baju_id .'" class="detail btn btn-sm btn-alt-primary" data-toggle="tooltip" title="Lihat Data"><i class="far fa-fw fa-eye"></i> Lihat</a>';
                        return $actionBtn;
                    }
                else if (Auth::User()->pengurus->jabatan->nama_jabatan == 'Ketua STT' ||
                Auth::User()->pengurus->jabatan->nama_jabatan == 'Bendahara 1' ||
                Auth::User()->pengurus->jabatan->nama_jabatan == 'Bendahara 2' || Auth::User()->pengurus->jabatan->nama_jabatan == 'Wakil Ketua STT')
                    {
                        $actionBtn = '<a href="/admin/baju/'. $data->baju_id .'" class="detail btn btn-sm btn-alt-primary" data-toggle="tooltip" title="Lihat Data"><i class="far fa-fw fa-eye"></i> Lihat</a>';
                        $actionBtn = $actionBtn.' <a href="/admin/baju/'. $data->baju_id .'/edit" class="edit btn btn-sm btn-alt-success" data-toggle="tooltip" title="Ubah Data"><i class="fa fa-fw fa-edit"></i> Ubah</a>';
                        $actionBtn = $actionBtn.' <a href="javascript:void(0)" data-id="'.$data->baju_id.'" class="delete btn btn-sm btn-alt-danger" data-toggle="tooltip" title="Hapus Data"><i class="fa fa-fw fa-trash"></i> Hapus</a>';
                        return $actionBtn;
                    }
            })
            ->rawColumns(['action'])->make(true);
        }

        return view('admin/pemesanan/baju/view',[
            'title' => 'Data Baju | Sistem Informasi Sekaa Teruna Dharma Gargitha'
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin/pemesanan/baju/create', [
            'title' => 'Tambah Data Baju | Sistem Informasi Sekaa Teruna Dharma Gargitha'
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama_baju' => 'required',
            'foto_baju' => 'required|image|mimes:jpeg,png,jpg|max:4096',
            'harga' => 'required',
            'tgl_batas_order' => 'required',
            'deskripsi' => 'required'
        ]);

        if ($request->has('foto_baju'))
        {
            $foto_baju = $request->file('foto_baju');
            $filename = time() . '.' . $foto_baju->getClientOriginalExtension();
            $foto_baju->move(public_path('baju'),$filename);
            $img = Image::make(public_path('baju/'.$filename))->fit('1063','1393');
            $img->save();
        }

        $baju = Baju::create([
            'baju_id' => 'BJU'.time(),
            'nama_baju' => $request->nama_baju,
            'deskripsi' => $request->deskripsi,
            'harga' => $request->harga,
            'tgl_batas_order' => $request->tgl_batas_order,
            'foto_baju' => $filename
        ]);

        return redirect()->route('admin.baju.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $baju = Baju::select('baju_id','deskripsi','nama_baju','foto_baju','harga')
        ->where('baju_id',$id)->first();

        return view('admin/pemesanan/baju/detail', [
            'title' => 'Detail Data Baju | Sistem Informasi Sekaa Teruna Dharma Gargitha',
            'baju' => $baju
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $baju = Baju::select('baju_id','deskripsi','nama_baju','foto_baju','harga','tgl_batas_order')
        ->where('baju_id',$id)->first();

        return view('admin/pemesanan/baju/edit', [
            'title' => 'Edit Data Baju | Sistem Informasi Sekaa Teruna Dharma Gargitha',
            'baju' => $baju
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_baju' => 'required',
            'harga' => 'required',
            'tgl_batas_order' => 'required',
            'deskripsi' => 'required'
        ]);

        $baju = Baju::select('baju_id','deskripsi','nama_baju','foto_baju','harga','tgl_batas_order')
        ->where('baju_id',$id)->first();

        if ($request->hasFile('foto_baju'))
        {
            $this->validate($request, [
                'foto_baju' => 'required|image|mimes:jpeg,png,jpg|max:4096',
            ]);
            File::delete('baju/'.$baju->foto_baju);
            $foto_baju = $request->file('foto_baju');
            $filename = time() . '.' . $foto_baju->getClientOriginalExtension();
            $foto_baju->move(public_path('baju'),$filename);
            $img = Image::make(public_path('baju/'.$filename))->fit('1063','1393');
            $img->save();
        }

        $baju->nama_baju = $request->nama_baju;
        $baju->deskripsi = $request->deskripsi;
        $baju->harga = $request->harga;
        $baju->tgl_batas_order = $request->tgl_batas_order;
        $baju->foto_baju = $request->hasFile('foto_baju') ? $filename : $baju->foto_baju;

        if ($baju->isDirty())
        {
            if ($request->hasFile('foto_baju'))
            {
                Baju::where('baju_id',$id)->update([
                    'nama_baju' => $request->nama_baju,
                    'deskripsi' => $request->deskripsi,
                    'harga' => $request->harga,
                    'tgl_batas_order' => $request->tgl_batas_order,
                    'foto_baju' => $filename,
                    'updated_at' => now()
                ]);
            }

            Baju::where('baju_id',$id)->update([
                'nama_baju' => $request->nama_baju,
                'deskripsi' => $request->deskripsi,
                'tgl_batas_order' => $request->tgl_batas_order,
                'harga' => $request->harga,
                'updated_at' => now()
            ]);

            return redirect()->route('admin.baju.index')->with('success', 'Berhasil Update Data baju.');
        }

        return back()->with('error', 'Kamu belum merubah data apapun !');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Baju::find($id)->delete();

        return response()->json([
            'success' => true,
            'message' => 'Berhasil Menghapus Data Baju'
        ]);
    }
}
