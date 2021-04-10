<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class Anggota extends Model
{
    use HasFactory;

    protected $table = 'anggota';

    protected $primaryKey = 'anggota_id';

    protected $fillable = [
        'anggota_user_id','tgl_lahir','jenis_kelamin','alamat','tempekan','umur'
    ];

    public function User()
    {
        return $this->belongsTo(User::class, 'user_id', 'anggota_user_id');
    }
}
