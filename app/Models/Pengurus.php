<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Jabatan;
use App\Models\User;
use App\Models\Kas;

class Pengurus extends Model
{
    use HasFactory;

    protected $table = 'pengurus';

    // public $timestamps = false;

    protected $primaryKey = 'pengurus_id';

    protected $fillable = [
        'pengurus_user_id','tgl_lahir','jenis_kelamin','alamat','pengurus_jabatan_id','umur'
    ];

    public function User()
    {
        return $this->belongsTo(User::class, 'user_id', 'pengurus_user_id');
    }

    public function Jabatan()
    {
        return $this->hasOne(Jabatan::class, 'jabatan_id', 'pengurus_jabatan_id');
    }

    public function Kas()
    {
        return $this->hasMany(Kas::class);
    }

}
