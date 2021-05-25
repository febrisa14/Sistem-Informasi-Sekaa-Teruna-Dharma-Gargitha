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
            $data = Order::select('no_pesanan','baju_ogoh_ogoh.nama_baju','tgl_pesanan','size','total','status','users.name')
            ->leftJoin('baju_ogoh_ogoh', 'baju_ogoh_ogoh.baju_id', '=', 'pemesanan.baju_id')
            ->leftJoin('anggota', 'anggota.anggota_id', '=', 'pemesanan.anggota_id')
            ->leftJoin('users', 'users.user_id', '=', 'anggota.anggota_user_id')
            ->get();
            return DataTables::of($data)
            ->addIndexColumn()
            ->addColumn('action', function($data){
                $actionBtn = '<a href="javascript:void(0)" data-id="'.$data->no_pesanan.'" class="detail btn btn-sm btn-alt-primary" data-toggle="tooltip" title="Lihat Data"><i class="far fa-fw fa-eye"></i> Lihat</a>';
                return $actionBtn;
            })
            ->rawColumns(['action'])->make(true);
        }

        return view('admin/pemesanan/order/view',[
            'title' => 'List Pemesan | Sistem Informasi Sekaa Teruna Dharma Gargitha'
        ]);
    }
}
