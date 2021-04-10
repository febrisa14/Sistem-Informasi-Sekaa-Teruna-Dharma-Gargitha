<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Kegiatan;

class JenisKegiatan extends Model
{
    use HasFactory;

    protected $table = 'jenis_kegiatan';

    protected $primaryKey = 'jenis_kegiatan_id';

    protected $fillable = ['nama_jenis_kegiatan'];

    protected $dates = [
        'created_at' => 'datetime',
    ];

    public function Kegiatan()
    {
        return $this->hasMany(Kegiatan::class, 'jenis_kegiatan_id', 'jenis_kegiatan_id');
    }
}
