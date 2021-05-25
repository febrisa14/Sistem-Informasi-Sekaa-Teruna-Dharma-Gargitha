<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use App\Models\Order;
use App\Models\Anggota;
use App\Models\Baju;
use DataTables;

class OrderController extends Controller
{
    public function prosesOrder(Request $request, $id)
    {
        $request->validate([
            'size' => 'required'
        ]);

        $baju = Baju::select('baju_id','harga')->where('baju_id',$id)->first();

        $checkOrder = Order::where('baju_id',$id)->where('anggota_id','=',Auth::user()->anggota->anggota_id)->count();

        if ($checkOrder == 0)
        {
            $prosesOrder = Order::create([
                'no_pesanan' => 'ORDER'.time(),
                'anggota_id' => Auth::user()->anggota->anggota_id,
                'baju_id' => $baju->baju_id,
                'size' => $request->size,
                'tgl_pesanan' => now(),
                'status' => 'Menunggu',
                'total' => $baju->harga
            ]);

            return redirect()->route('user.pesanan')->with('success','Berhasil Melakukan Pesanan');
        }

        return redirect()->back()->with('error','Kamu Tidak Dapat Memesan Baju Ini Lebih Dari 2x');
    }

    public function pesananSaya(Request $request)
    {
        if ($request->ajax())
        {
            $data = Order::select('no_pesanan','baju.nama_baju','tgl_pesanan','size','harga','status')
            ->leftJoin('baju', 'baju.baju_id', '=', 'pemesanan.baju_id')
            ->where('pemesanan.anggota_id','=',Auth::user()->anggota->anggota_id)
            ->get();
            return DataTables::of($data)
            ->addIndexColumn()
            ->addColumn('action', function($data){
                $actionBtn = '<a href="javascript:void(0)" data-id="'.$data->no_pesanan.'" class="detail btn btn-sm btn-alt-primary" data-toggle="tooltip" title="Lihat Data"><i class="far fa-fw fa-eye"></i> Lihat</a>';
                return $actionBtn;
            })
            ->rawColumns(['action'])->make(true);
        }

        return view('user/pemesanan/baju/pesanan',[
            'title' => 'Pesanan Saya | Sistem Informasi Sekaa Teruna Dharma Gargitha'
        ]);
    }
}
