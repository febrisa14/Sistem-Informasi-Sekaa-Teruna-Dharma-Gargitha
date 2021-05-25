<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Pengurus;

class Kas extends Model
{
    use HasFactory;

    protected $table = 'kas';

    // public $timestamps = false;

    protected $primaryKey = 'no_transaksi_kas';

    public $incrementing = false;

    protected $fillable = [
        'no_transaksi_kas','tgl_transaksi', 'nominal', 'type', 'deskripsi','pengurus_id'
    ];

    public function pengurus()
    {
        return $this->belongsTo(Pengurus::class);
    }
}
