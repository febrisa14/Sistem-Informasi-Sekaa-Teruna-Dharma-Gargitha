<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Anggota;
use App\Models\User;
use DataTables;
use Illuminate\Support\Facades\Auth;

class AnggotaController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            if($request->tempekan)//filter tempekan
            {
                $data = User::select
                (
                    'users.user_id',
                    'users.name',
                    'anggota.jenis_kelamin',
                    'anggota.tempekan',
                    'anggota.umur',
                )
                ->rightJoin('anggota', 'anggota.anggota_user_id','=','users.user_id')
                ->where('tempekan', $request->tempekan)
                ->orderBy('users.created_at', 'DESC')
                ->get();
            }
            else
            {
                $data = User::select
                (
                    'users.user_id',
                    'users.name',
                    'anggota.jenis_kelamin',
                    'anggota.tempekan',
                    'anggota.umur',
                )
                ->rightJoin('anggota', 'anggota.anggota_user_id','=','users.user_id')
                ->orderBy('users.created_at', 'DESC')
                ->get();
            }
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function($data){
                    if (Auth::User()->user_id != $data->user_id)
                    {
                        $actionBtn = '<a href="javascript:void(0)" data-id="'.$data->user_id.'" class="detail btn btn-sm btn-alt-primary" data-toggle="tooltip" title="Show Data"><i class="far fa-fw fa-eye"></i> Lihat</a>';
                        return $actionBtn;
                    }
                })
            ->rawColumns(['action'])->make(true);
        }

        $tempekanKauh = Anggota::where('tempekan','=','Kauh')->count();
        $tempekanKubu = Anggota::where('tempekan','=','Kubu')->count();
        $tempekanKangin = Anggota::where('tempekan','=','Kangin')->count();

        return view('user/anggota/anggota', [
            'title' => 'List Anggota | Sistem Informasi Sekaa Teruna Dharma Gargitha',
            'tempekanKauh' => $tempekanKauh,
            'tempekanKubu' => $tempekanKubu,
            'tempekanKangin' => $tempekanKangin,
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
            ->rightJoin('anggota', 'anggota.anggota_user_id','=','users.user_id')
            ->where('users.user_id','=',$id)->first()
        ]);
    }
}
