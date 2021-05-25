<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Baju;

class Order extends Model
{
    use HasFactory;

    protected $table = 'pemesanan';

    protected $primaryKey = 'no_pesanan';

    public $incrementing = false;

    protected $fillable = [
        'no_pesanan','anggota_id', 'baju_id', 'size','status','tgl_pesanan','total'
    ];

    public function baju()
    {
        return $this->belongsTo(Baju::class);
    }
}
