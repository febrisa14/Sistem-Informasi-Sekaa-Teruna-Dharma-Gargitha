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

        $baju = Baju::select('baju_id','harga','tgl_batas_order')->where('baju_id',$id)->first();

        $checkOrder = Order::where('baju_id',$id)->where('anggota_id','=',Auth::user()->anggota->anggota_id)->count();

        $tglSekarang = date('Y-m-d');

        //check baju apakah bisa diorder di tgl skrg?
        if ($baju->tgl_batas_order <= $tglSekarang)
        {
            return redirect()->back()->with('error','Anda Tidak Dapat Memesan Pada Periode Ini !');
        }

        //check jika dia order lebih dari sekali?
        if ($checkOrder == 0)
        {
            $prosesOrder = Order::create([
                'no_pesanan' => 'ORDER'.time(),
                'anggota_id' => Auth::user()->anggota->anggota_id,
                'baju_id' => $baju->baju_id,
                'size' => $request->size,
                'tgl_pesanan' => now(),
                'tgl_bayar' => null,
                'status' => 'Menunggu',
                'total' => $baju->harga
            ]);

            return redirect()->route('user.pesanan')->with('success','Berhasil Melakukan Pesanan');
        }

        return redirect()->back()->with('error','Baju Hanya Bisa Dibeli Sekali !');
    }

    public function pesananSaya(Request $request)
    {
        if ($request->ajax())
        {
            $data = Order::select('pemesanan.no_pesanan', 'baju.nama_baju','tgl_pesanan','size','total','status','baju.tgl_batas_order')
            ->leftJoin('baju', 'baju.baju_id', '=', 'pemesanan.baju_id')
            ->where('pemesanan.anggota_id','=',Auth::user()->anggota->anggota_id)
            ->get();
            return DataTables::of($data)
            ->addIndexColumn()
            ->addColumn('action', function($data){
                if ($data->tgl_batas_order >= date('Y-m-d'))
                {
                    $actionBtn = '<a href="/anggota/pesanan_saya/'.$data->no_pesanan.'/edit" class="edit btn btn-sm btn-alt-success" data-toggle="tooltip" title="Ubah Data"><i class="fa fa-fw fa-edit"></i> Ubah</a>';
                    $actionBtn = $actionBtn.' <a href="javascript:void(0)" data-id="'.$data->no_pesanan.'" class="delete btn btn-sm btn-alt-danger" data-toggle="tooltip" title="Hapus Data"><i class="fa fa-fw fa-trash"></i> Hapus</a>';
                    return $actionBtn;
                }
            })
            ->rawColumns(['action'])->make(true);
        }

        return view('user/pemesanan/baju/pesanan',[
            'title' => 'Pesanan Saya | Sistem Informasi Sekaa Teruna Dharma Gargitha'
        ]);
    }

    public function editPesanan($id)
    {
        $pemesan = Order::select('no_pesanan','baju.nama_baju','tgl_pesanan','size','total','status','users.name')
        ->leftJoin('baju', 'baju.baju_id', '=', 'pemesanan.baju_id')
        ->leftJoin('anggota', 'anggota.anggota_id', '=', 'pemesanan.anggota_id')
        ->leftJoin('users', 'users.user_id', '=', 'anggota.anggota_user_id')
        ->where('no_pesanan', $id)->first();

        return view('user/pemesanan/baju/pesanan_edit', [
            'title' => 'Edit Data Pemesanan | Sistem Informasi Sekaa Teruna Dharma Gargitha',
            'pemesan' => $pemesan
        ]);
    }

    public function update(Request $request,$id)
    {
        $request->validate([
            'size' => 'required'
        ]);

        $pemesanan = Order::where('no_pesanan',$id)
                    ->select('size')
                    ->first();

        $pemesanan->size = $request->size;

        if ($pemesanan->isDirty())
        {
            Order::where('no_pesanan',$id)->update([
                'size' => $request->size,
                'updated_at' => now()
            ]);

            return redirect()->route('user.pesanan')->with('success', 'Berhasil Update Data Pesanan.');
        }

        return back()->with('error', 'Kamu belum merubah data apapun !');
    }

    public function destroy($id)
    {
        Order::find($id)->delete();

        return response()->json([
            'success' => true,
            'message' => 'Berhasil Menghapus Data Pesanan'
        ]);
    }
}
