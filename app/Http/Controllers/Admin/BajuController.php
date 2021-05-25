<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Baju;
use DataTables;
use Auth;
use Image;

class BajuController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
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
                    Auth::User()->pengurus->jabatan->nama_jabatan == 'Sekretaris 2' ||
                    Auth::User()->pengurus->jabatan->nama_jabatan == 'Bendahara 1' ||
                    Auth::User()->pengurus->jabatan->nama_jabatan == 'Bendahara 2')
                    {
                        $actionBtn = '<a href="javascript:void(0)" data-id="'.$data->baju_id.'" class="detail btn btn-sm btn-alt-primary" data-toggle="tooltip" title="Lihat Data"><i class="far fa-fw fa-eye"></i> Lihat</a>';
                        return $actionBtn;
                    }
                else if (Auth::User()->pengurus->jabatan->nama_jabatan == 'Ketua STT' || Auth::User()->pengurus->jabatan->nama_jabatan == 'Wakil Ketua STT')
                    {
                        $actionBtn = '<a href="javascript:void(0)" data-id="'.$data->baju_id.'" class="detail btn btn-sm btn-alt-primary" data-toggle="tooltip" title="Lihat Data"><i class="far fa-fw fa-eye"></i> Lihat</a>';
                        $actionBtn = $actionBtn.' <a href="javascript:void(0)" class="edit btn btn-sm btn-alt-success" data-toggle="tooltip" title="Ubah Data"><i class="fa fa-fw fa-edit"></i> Ubah</a>';
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
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
