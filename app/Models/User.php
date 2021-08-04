<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\Models\Anggota;
use App\Models\Pengurus;
use App\Models\Kegiatan;
use DB;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasFactory, Notifiable;

    protected $table = 'users';

    // public $timestamps = false;

    protected $primaryKey = 'user_id';

    public static function getAnggota()
    {
        $data = DB::table('users')->select
        (
            'users.name',
            'users.email',
            'users.no_telp',
            'anggota.alamat',
            'anggota.tgl_lahir',
            'anggota.jenis_kelamin',
            'anggota.umur',
            'anggota.tempekan'
        )
        ->rightJoin('anggota', 'anggota.anggota_user_id', '=', 'users.user_id')
        ->get();

        return $data;
    }

    public function Anggota()
    {
        return $this->hasOne(Anggota::class, 'anggota_user_id', 'user_id');
    }

    public function Pengurus()
    {
        return $this->hasOne(Pengurus::class, 'pengurus_user_id', 'user_id');
    }

    public function Kegiatan()
    {
        return $this->hasMany(Kegiatan::class, 'user_id', 'user_id');
    }

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
        'no_telp',
        'avatar'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password'
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
}
