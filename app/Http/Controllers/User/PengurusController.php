<?php

namespace App\Http\Controllers\User;

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
                $actionBtn = '<a href="javascript:void(0)" data-id="'.$data->user_id.'" class="detail btn btn-sm btn-alt-primary" data-toggle="tooltip" title="Lihat Data"><i class="far fa-fw fa-eye"></i> Lihat</a>';
                return $actionBtn;
            })
            ->rawColumns(['action'])->make(true);
        }

        return view('user/pengurus/pengurus',[
            'title' => 'Data Pengurus | Sistem Informasi Sekaa Teruna Dharma Gargitha'
        ]);
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
}
