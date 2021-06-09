<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\PengurusRequest;
use Illuminate\Http\Request;
use App\Models\Pengurus;
use App\Models\Jabatan;
use App\Models\User;
use App\Models\Anggota;
use DataTables;
use Hash;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class PengurusController extends Controller
{
    public function __construct()
    {
        $this->middleware('ketua')->except('index','show');
    }

    public function index(Request $request)
    {
        // nampilin datatables dari 3 table
        if ($request->ajax()) {
            $data = User::select
            ('users.user_id','pengurus.pengurus_id','users.name', 'pengurus.jenis_kelamin','jabatan.nama_jabatan', 'pengurus.umur')
            ->rightjoin('pengurus', 'pengurus.pengurus_user_id','=','users.user_id')
            ->leftjoin('jabatan', 'jabatan.jabatan_id','=','pengurus.pengurus_jabatan_id')
            ->orderBy('jabatan.jabatan_id')
            ->get();
            return DataTables::of($data)
            ->addIndexColumn()
            ->addColumn('action', function($data){
                if (Auth::User()->user_id != $data->user_id)
                {
                    if (Auth::User()->pengurus->jabatan->nama_jabatan == 'Sekretaris 1' ||
                    Auth::User()->pengurus->jabatan->nama_jabatan == 'Sekretaris 2' ||
                    Auth::User()->pengurus->jabatan->nama_jabatan == 'Bendahara 1' ||
                    Auth::User()->pengurus->jabatan->nama_jabatan == 'Bendahara 2')
                    {
                        $actionBtn = '<a href="javascript:void(0)" data-id="'.$data->user_id.'" class="detail btn btn-sm btn-alt-primary" data-toggle="tooltip" title="Lihat Data"><i class="far fa-fw fa-eye"></i> Lihat Pengurus</a>';
                        return $actionBtn;
                    }
                    else if (Auth::User()->pengurus->jabatan->nama_jabatan == 'Ketua STT' || Auth::User()->pengurus->jabatan->nama_jabatan == 'Wakil Ketua STT')
                    {
                        $actionBtn = '<a href="javascript:void(0)" data-id="'.$data->user_id.'" class="detail btn btn-sm btn-alt-primary" data-toggle="tooltip" title="Lihat Data"><i class="far fa-fw fa-eye"></i> Lihat</a>';
                        $actionBtn = $actionBtn.' <a href="/admin/pengurus/'.$data->user_id.'/edit" class="edit btn btn-sm btn-alt-success" data-toggle="tooltip" title="Ubah Data"><i class="fa fa-fw fa-edit"></i> Ubah</a>';
                        $actionBtn = $actionBtn.' <a href="javascript:void(0)" data-id="'.$data->user_id.'" class="delete btn btn-sm btn-alt-danger" data-toggle="tooltip" title="Hapus Data"><i class="fa fa-fw fa-trash"></i> Hapus</a>';
                        return $actionBtn;
                    }
                }
            })
            ->rawColumns(['action'])->make(true);
        }

        //ngirim nama jabatan ke admin dashboard -> pengurus
        $jabatan = Auth::User()->pengurus->jabatan->nama_jabatan;

        // $cekJabatan = Jabatan::select
        //     ('jabatan.jabatan_id','nama_jabatan')
        //     ->leftJoin('pengurus', 'pengurus.pengurus_jabatan_id','=','jabatan.jabatan_id')
        //     ->whereNull('pengurus.pengurus_jabatan_id')
        //     ->count();
         $jumlah = Pengurus::select
            ('pengurus_id')
            ->count();

        // dd($cekJabatan);

        return view('admin/pengurus/pengurus',[
            'title' => 'Data Pengurus | Sistem Informasi Sekaa Teruna Dharma Gargitha',
            'jabatan' => $jabatan,
            'jumlah' => $jumlah
        ]);
    }

    public function create(Request $request)
    {
        if ($request->ajax()) {
            $data = User::select
                ('users.user_id', 'users.name', 'anggota.jenis_kelamin', 'anggota.tempekan', 'anggota.umur')
                ->rightJoin('anggota', 'anggota.anggota_user_id', '=', 'users.user_id')
                ->orderBy('users.created_at', 'DESC')
                ->get();
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($data) {
                    $actionBtn = '<a href="javascript:void(0)" data-id="' . $data->user_id . '" class="pilih btn btn-sm btn-primary" data-toggle="tooltip" title="Pilih Data"><i class="fa fa-chevron-right mr-1"></i> Pilih Anggota</a>';
                    return $actionBtn;
                })
                ->rawColumns(['action'])->make(true);
        }

        return view('admin/pengurus/pilih_anggota', [
            'title' => 'Pilih Data Anggota | Sistem Informasi Sekaa Teruna Dharma Gargitha'
        ]);

        // $jabatan = Jabatan::select
        //     ('jabatan.jabatan_id','nama_jabatan')
        //     ->leftJoin('pengurus', 'pengurus.pengurus_jabatan_id','=','jabatan.jabatan_id')
        //     ->whereNull('pengurus.pengurus_jabatan_id')
        //     ->get();

        // return view('admin/pengurus/pengurus_add', [
        //     'title' => 'Add Data Pengurus | Sistem Informasi Sekaa Teruna Dharma Gargitha',
        //     'jabatan' => $jabatan
        // ]);
    }

    public function transfer($id)
    {
        //dapetin data pengurus
        $data = Anggota::select('anggota_user_id','tgl_lahir','jenis_kelamin','umur','alamat')
        ->where('anggota_user_id', $id)->first();

        //ubah role pengurus jadi anggota
        $users = User::where('user_id',$id)->update([
            'role' => 'Pengurus'
        ]);

        //tambah data pengurus jadi anggota
        Pengurus::create([
            'pengurus_user_id' => $data->anggota_user_id,
            'tgl_lahir' => $data->tgl_lahir,
            'jenis_kelamin' => $data->jenis_kelamin,
            'pengurus_jabatan_id' => null,
            'umur' => $data->umur,
            'alamat' => $data->alamat
        ]);

        Anggota::where('anggota_user_id',$id)->delete();

        return response()->json([
            'success' => true,
            'message' => 'Berhasil Mengubah Anggota Menjadi Pengurus'
        ]);
    }

    public function store(PengurusRequest $request)
    {
        $users = User::create([
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'name' => $request->name,
            'no_telp' => $request->no_telp,
            'role' => 'Pengurus',
        ]);

        $usersId = $users->user_id;

        $pengurus = Pengurus::create([
            'pengurus_user_id' => $usersId,
            'tgl_lahir' => $request->tgl_lahir,
            'jenis_kelamin' => $request->jenis_kelamin,
            'pengurus_jabatan_id' => $request->pengurus_jabatan_id,
            'umur' => now()->format('Y')-Carbon::parse($request->tgl_lahir)->format('Y'),
            'alamat' => $request->alamat
        ]);

        return redirect()->route('admin.pengurus.index')->with('success', 'Menambahkan Pengurus.');
    }

    public function show($id)
    {
        return with([
            'users' => User::select
            ('users.name',
            'users.avatar',
            'users.no_telp',
            'pengurus.alamat',
            'pengurus.tgl_lahir',
            'pengurus.jenis_kelamin',
            'pengurus.umur',
            'jabatan.nama_jabatan')
            ->rightJoin('pengurus', 'pengurus.pengurus_user_id','=','users.user_id')
            ->leftJoin('jabatan', 'jabatan.jabatan_id','=','pengurus.pengurus_jabatan_id')
            ->where('users.user_id','=',$id)->first()
        ]);
    }

    public function edit($id)
    {
        $user = User::select
            ('users.user_id',
            'users.name',
            'pengurus.tgl_lahir',
            'pengurus.pengurus_jabatan_id',
            'users.email',
            'users.no_telp',
            'pengurus.alamat',
            'pengurus.tgl_lahir',
            'pengurus.jenis_kelamin')
            ->rightJoin('pengurus', 'pengurus.pengurus_user_id','=','users.user_id')
            ->leftJoin('jabatan', 'jabatan.jabatan_id','=','pengurus.pengurus_jabatan_id')
            ->where('users.user_id','=',$id)->first();

        $jabatan = Jabatan::select
            ('jabatan.jabatan_id','nama_jabatan')
            ->leftJoin('pengurus', 'pengurus.pengurus_jabatan_id','=','jabatan.jabatan_id')
            ->whereNull('pengurus.pengurus_jabatan_id')
            ->get();

        return view('admin/pengurus/pengurus_edit',[
            'title' => 'Edit Data Pengurus | Sistem Informasi Sekaa Teruna Dharma Gargitha',
            'user' => $user,
            'jabatan' => $jabatan
        ]);
    }

    public function update(Request $request, $id)
    {
       $request->validate([
            'email' => 'required|email|unique:users,email,'.$id.',user_id',
            'no_telp' => 'required',
            'alamat' => 'required',
            'name' => 'required',
            'tgl_lahir' => 'required',
            'jenis_kelamin' => 'required',
            'pengurus_jabatan_id' => 'required'
       ]);

       $user = User::where('user_id', $id)->select('email','name','no_telp')->first();

       $user->name = $request->name;
       $user->email = $request->email;
       $user->no_telp = $request->no_telp;

       $pengurus = Pengurus::where('pengurus_user_id', $id)->select('tgl_lahir','jenis_kelamin','alamat','pengurus_jabatan_id')->first();

       $pengurus->tgl_lahir = $request->tgl_lahir;
       $pengurus->jenis_kelamin = $request->jenis_kelamin;
       $pengurus->alamat = $request->alamat;
       $pengurus->pengurus_jabatan_id = $request->pengurus_jabatan_id;

       if ($user->isDirty() || $pengurus->isDirty())
       {
           User::where('user_id', $id)->update([
                'name' => $request->name,
                'email' => $request->email,
                'no_telp' => $request->no_telp,
                'updated_at' => now()
           ]);

           Pengurus::where('pengurus_user_id', $id)->update([
                'tgl_lahir' => $request->tgl_lahir,
                'jenis_kelamin' => $request->jenis_kelamin,
                'pengurus_jabatan_id' => $request->pengurus_jabatan_id,
                'umur' => now()->format('Y')-Carbon::parse($request->tgl_lahir)->format('Y'),
                'alamat' => $request->alamat,
                'updated_at' => now()
           ]);

            return redirect()->route('admin.pengurus.index')->with('success', 'Berhasil Update Pengurus.');
        }

        return back()->with('error', 'Kamu belum merubah data apapun !');

    }

    public function destroy($id)
    {
        $jabatan = Pengurus::select('jabatan.nama_jabatan')
                ->rightJoin('jabatan', 'jabatan.jabatan_id','=','pengurus.pengurus_jabatan_id')
                ->where('pengurus_user_id','=',$id)->first();

        if ($jabatan->nama_jabatan == 'Ketua STT')
        {
            return response()->json([
                'success' => false,
                'message' => 'Tidak Dapat Menghapus Ketua STT'
            ]);
        }

        //dapetin data pengurus
        $data = Pengurus::select('pengurus_user_id','tgl_lahir','jenis_kelamin','umur','alamat')
        ->where('pengurus_user_id', $id)->first();

        //ubah role pengurus jadi anggota
        $users = User::where('user_id',$id)->update([
            'role' => 'Anggota'
        ]);

        //tambah data pengurus jadi anggota
        Anggota::create([
            'anggota_user_id' => $data->pengurus_user_id,
            'tgl_lahir' => $data->tgl_lahir,
            'jenis_kelamin' => $data->jenis_kelamin,
            'tempekan' => null,
            'umur' => $data->umur,
            'alamat' => $data->alamat
        ]);

        Pengurus::where('pengurus_user_id',$id)->delete();

        return response()->json([
            'success' => true,
            'message' => 'Berhasil Menghapus Data Pengurus'
        ]);
    }
}
