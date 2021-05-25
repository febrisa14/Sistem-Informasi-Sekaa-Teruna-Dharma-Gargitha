<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Baju;
use Auth;

class BajuController extends Controller
{
    public function index()
    {
        $baju = Baju::latest()->get();

        return view('user/pemesanan/baju/list', [
            'title' => 'List Baju | Sistem Informasi ST. Dharma Gargitha',
            'baju' => $baju
        ]);
    }

    public function show($id)
    {
        $baju = Baju::select('baju_id','nama_baju','deskripsi','foto_baju','harga')->where('baju_id',$id)->first();

        return view('user/pemesanan/baju/view', [
            'title' => 'Detail Baju | Sistem Informasi ST. Dharma Gargitha',
            'baju' => $baju
        ]);
    }
}
