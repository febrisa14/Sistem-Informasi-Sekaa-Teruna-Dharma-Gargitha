<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Anggota;
use App\Models\User;
use DataTables;
use Illuminate\Support\Facades\Auth;
use Hash;
use Carbon\Carbon;
use App\Http\Requests\AnggotaRequest;
use App\Http\Requests\UpdateAnggotaRequest;

class AnggotaController extends Controller
{
    public function __construct()
    {
        $this->middleware('sekretaris')->except('index','show');
    }

    public function index(Request $request)
    {
        if ($request->ajax()) {
            if ($request->tempekan) //filter tempekan
            {
                $data = User::select
                    ('users.user_id', 'users.name', 'anggota.jenis_kelamin', 'anggota.tempekan', 'anggota.umur')
                    ->rightJoin('anggota', 'anggota.anggota_user_id', '=', 'users.user_id')
                    ->where('tempekan', $request->tempekan)
                    ->orderBy('users.created_at', 'DESC')
                    ->get();
            } else {
                $data = User::select
                    ('users.user_id', 'users.name', 'anggota.jenis_kelamin', 'anggota.tempekan', 'anggota.umur')
                    ->rightJoin('anggota', 'anggota.anggota_user_id', '=', 'users.user_id')
                    ->orderBy('users.created_at', 'DESC')
                    ->get();
            }
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($data) {
                    if (Auth::User()->pengurus->jabatan->nama_jabatan == 'Sekretaris 1' ||
                    Auth::User()->pengurus->jabatan->nama_jabatan == 'Sekretaris 2' ||
                    Auth::User()->pengurus->jabatan->nama_jabatan == 'Ketua STT' ||
                    Auth::User()->pengurus->jabatan->nama_jabatan == 'Wakil Ketua STT')
                    {
                        $actionBtn = '<a href="javascript:void(0)" data-id="' . $data->user_id . '" class="detail btn btn-sm btn-alt-primary" data-toggle="tooltip" title="Show Data"><i class="far fa-fw fa-eye"></i> Lihat</a>';
                        $actionBtn = $actionBtn . ' <a href="/admin/anggota/'.$data->user_id.'/edit" data-id="' . $data->user_id . '"class="editdata btn btn-sm btn-alt-success" data-toggle="tooltip" title="Edit Data"><i class="fa fa-fw fa-edit"></i> Ubah</a>';
                        $actionBtn = $actionBtn . ' <a href="javascript:void(0)" data-id="' . $data->user_id . '" class="delete btn btn-sm btn-alt-danger" data-toggle="tooltip" title="Delete Data"><i class="fa fa-fw fa-trash"></i> Hapus</a>';
                        return $actionBtn;
                    }
                    else if (Auth::User()->pengurus->jabatan->nama_jabatan == 'Bendahara 1' || Auth::User()->pengurus->jabatan->nama_jabatan == 'Bendahara 2')
                    {
                        $actionBtn = '<a href="javascript:void(0)" data-id="' . $data->user_id . '" class="detail btn btn-sm btn-alt-primary" data-toggle="tooltip" title="Show Data"><i class="far fa-fw fa-eye"></i> Lihat Anggota</a>';
                        return $actionBtn;
                    }
                })
                ->rawColumns(['action'])->make(true);
        }

        return view('admin/anggota/anggota', [
            'title' => 'Data Anggota | Sistem Informasi Sekaa Teruna Dharma Gargitha'
        ]);
    }

    public function show($id)
    {
        return with([
            'users' => User::select
                (
                    'users.name',
                    'users.avatar',
                    'users.no_telp',
                    'anggota.alamat',
                    'anggota.tgl_lahir',
                    'anggota.jenis_kelamin',
                    'anggota.umur',
                    'anggota.tempekan'
                )
                ->rightJoin('anggota', 'anggota.anggota_user_id', '=', 'users.user_id')
                ->where('users.user_id', '=', $id)->first()
        ]);
    }

    public function create()
    {
        return view('admin/anggota/anggota_add', [
            'title' => 'Tambah Data Anggota | Sistem Informasi Sekaa Teruna Dharma Gargitha'
        ]);
    }

    public function store(AnggotaRequest $request)
    {
        $users = User::create([
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'name' => $request->name,
            'no_telp' => $request->no_telp,
            'role' => 'Anggota',
        ]);

        $usersId = $users->user_id;

        Anggota::create([
            'anggota_user_id' => $usersId,
            'tgl_lahir' => $request->tgl_lahir,
            'jenis_kelamin' => $request->jenis_kelamin,
            'tempekan' => $request->tempekan,
            'umur' => now()->format('Y') - Carbon::parse($request->tgl_lahir)->format('Y'),
            'alamat' => $request->alamat
        ]);

        return redirect()->route('admin.anggota.index')->with('success', 'Menambahkan Anggota.');
    }

    public function edit($id)
    {
        $user = User::select(
            'users.user_id',
            'users.email',
            'users.name',
            'users.no_telp',
            'anggota.alamat',
            'anggota.tgl_lahir',
            'anggota.jenis_kelamin',
            'anggota.tempekan'
        )
        ->rightJoin('anggota', 'anggota.anggota_user_id', '=', 'users.user_id')
        ->where('users.user_id', '=', $id)->first();

        return view('admin/anggota/anggota_edit', [
            'title' => 'Edit Data Anggota | Sistem Informasi Sekaa Teruna Dharma Gargitha',
            'user' => $user
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
            'tempekan' => 'required'
       ]);

        $user = User::where('user_id', $id)->update([
            'email' => $request->email,
            'name' => $request->name,
            'no_telp' => $request->no_telp,
            'updated_at' => \DB::raw('updated_at')
        ]);

        $anggota = Anggota::where('anggota_user_id', $id)->update([
            'tgl_lahir' => $request->tgl_lahir,
            'jenis_kelamin' => $request->jenis_kelamin,
            'tempekan' => $request->tempekan,
            'umur' => now()->format('Y') - Carbon::parse($request->tgl_lahir)->format('Y'),
            'alamat' => $request->alamat,
            'updated_at' => \DB::raw('updated_at')
        ]);

        if ($user > 0 || $anggota > 0)
        {
            User::where('user_id', $id)
            ->update([
                'updated_at' => now()
            ]);

            Anggota::where('anggota_user_id', $id)
            ->update([
                'updated_at' => now()
            ]);

            return redirect()->route('admin.anggota.index')->with('success', 'Berhasil Memperbarui Data Anggota.');
        }

        return back()->with('error', 'Kamu belum merubah data apapun !');

    }

    public function destroy($id)
    {
        User::find($id)->delete();

        return response()->json([
            'success' => true,
            'message' => 'Berhasil Menghapus Data Anggota'
        ]);
    }
}
