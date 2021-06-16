<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\JenisKegiatan;
use App\Models\User;
use Carbon\Carbon;

class Kegiatan extends Model
{
    use HasFactory;

    protected $table = 'kegiatan';

    protected $primaryKey = 'kegiatan_id';

    protected $fillable = [
        'nama_kegiatan', 'jenis_kegiatan_id', 'tgl_kegiatan', 'jam_kegiatan', 'lokasi', 'user_id', 'pakaian', 'pengurus_id', 'lampiran'
    ];

    public function getCreatedAtAttribute($date)
    {
        return Carbon::createFromFormat('Y-m-d H:i:s', $date)->format('d M Y');
    }

    // public function getTglKegiatanAttribute($date)
    // {
    //     return Carbon::createFromFormat('d-m-Y', $date)->format('d M Y');
    // }

    protected $dates = [
        'created_at' => 'datetime',
    ];

    public function jenis_kegiatan()
    {
        return $this->belongsTo(JenisKegiatan::class, 'jenis_kegiatan_id', 'jenis_kegiatan_id');
    }

    public function User()
    {
        return $this->belongsTo(User::class, 'user_id', 'user_id');
    }
}
