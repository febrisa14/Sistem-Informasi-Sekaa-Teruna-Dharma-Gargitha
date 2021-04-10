<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Pengurus;

class Jabatan extends Model
{
    use HasFactory;

    protected $table = 'jabatan';

    protected $primaryKey = 'jabatan_id';

    public function Pengurus()
    {
        $this->belongsTo(Pengurus::class, 'pengurus_jabatan_id', 'jabatan_id');
    }
}
