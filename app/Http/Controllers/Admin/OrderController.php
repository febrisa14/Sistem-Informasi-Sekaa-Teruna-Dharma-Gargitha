<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use App\Models\Order;
use App\Models\Anggota;
use App\Models\Baju;
use App\Models\User;
use DataTables;

class OrderController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax())
        {
            $data = Order::select('no_pesanan','baju.nama_baju','tgl_pesanan','size','total','status','users.name')
            ->leftJoin('baju', 'baju.baju_id', '=', 'pemesanan.baju_id')
            ->leftJoin('anggota', 'anggota.anggota_id', '=', 'pemesanan.anggota_id')
            ->leftJoin('users', 'users.user_id', '=', 'anggota.anggota_user_id')
            ->get();
            return DataTables::of($data)
            ->addIndexColumn()
            ->addColumn('action', function($data){
                if (Auth::User()->pengurus->jabatan->nama_jabatan == 'Sekretaris 1' ||
                    Auth::User()->pengurus->jabatan->nama_jabatan == 'Sekretaris 2')
                {

                }
                else if (Auth::User()->pengurus->jabatan->nama_jabatan == 'Ketua STT'
                        || Auth::User()->pengurus->jabatan->nama_jabatan == 'Wakil Ketua STT'
                        || Auth::User()->pengurus->jabatan->nama_jabatan == 'Bendahara 1'
                        || Auth::User()->pengurus->jabatan->nama_jabatan == 'Bendahara 2')
                {
                    $actionBtn = '<a href="javascript:void(0)" class="edit btn btn-sm btn-alt-success" data-toggle="tooltip" title="Ubah Data"><i class="fa fa-fw fa-edit"></i> Ubah</a>';
                    $actionBtn = $actionBtn.' <a href="javascript:void(0)" data-id="' . $data->no_pesanan . '" class="delete btn btn-sm btn-alt-danger" data-toggle="tooltip" title="Hapus Data"><i class="fa fa-fw fa-trash"></i> Hapus</a>';
                    return $actionBtn;
                }
            })
            ->rawColumns(['action'])->make(true);
        }

        return view('admin/pemesanan/order/view',[
            'title' => 'Data Pemesan | Sistem Informasi Sekaa Teruna Dharma Gargitha'
        ]);
    }
}
