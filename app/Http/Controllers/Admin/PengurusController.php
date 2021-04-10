<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\PengurusRequest;
use Illuminate\Http\Request;
use App\Models\Pengurus;
use App\Models\Jabatan;
use App\Models\User;
use DataTables;
use Hash;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class PengurusController extends Controller
{
    public function index(Request $request)
    {
        // nampilin datatables dari 3 table
        if ($request->ajax()) {
            $data = User::select
            ('users.user_id','users.name', 'pengurus.jenis_kelamin','jabatan.nama_jabatan', 'pengurus.umur')
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
                        $actionBtn = '<a href="javascript:void(0)" data-id="'.$data->user_id.'" class="detail btn btn-sm btn-alt-primary" data-toggle="tooltip" title="Lihat Data"><i class="far fa-fw fa-eye"></i> Lihat</a>';
                        return $actionBtn;
                    }
                    else if (Auth::User()->pengurus->jabatan->nama_jabatan == 'Ketua STT' || Auth::User()->pengurus->jabatan->nama_jabatan == 'Wakil Ketua STT')
                    {
                        $actionBtn = '<a href="javascript:void(0)" data-id="'.$data->user_id.'" class="detail btn btn-sm btn-alt-primary" data-toggle="tooltip" title="Lihat Data"><i class="far fa-fw fa-eye"></i> Lihat</a>';
                        $actionBtn = $actionBtn.' <a href="javascript:void(0)" class="edit btn btn-sm btn-alt-success" data-toggle="tooltip" title="Ubah Data"><i class="fa fa-fw fa-edit"></i> Ubah</a>';
                        $actionBtn = $actionBtn.' <a href="javascript:void(0)" data-id="'.$data->user_id.'" class="delete btn btn-sm btn-alt-danger" data-toggle="tooltip" title="Hapus Data"><i class="fa fa-fw fa-trash"></i> Hapus</a>';
                        return $actionBtn;
                    }
                }
            })
            ->rawColumns(['action'])->make(true);
        }

        //ngirim nama jabatan ke admin dashboard -> pengurus
        $jabatan = Auth::User()->pengurus->jabatan->nama_jabatan;

        return view('admin/pengurus/pengurus',[
            'title' => 'Data Pengurus | Sistem Informasi Sekaa Teruna Dharma Gargitha',
            'jabatan' => $jabatan
        ]);
    }

    public function create()
    {
        $jabatan = Jabatan::select
            ('jabatan.jabatan_id','nama_jabatan')
            ->leftJoin('pengurus', 'pengurus.pengurus_jabatan_id','=','jabatan.jabatan_id')
            ->whereNull('pengurus.pengurus_jabatan_id')
            ->get();

        return view('admin/pengurus/pengurus_add', [
            'title' => 'Add Data Pengurus | Sistem Informasi Sekaa Teruna Dharma Gargitha',
            'jabatan' => $jabatan
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

        User::find($id)->delete();

        return response()->json([
            'success' => true,
            'message' => 'Berhasil Menghapus Data Pengurus'
        ]);
    }
}
