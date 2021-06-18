<?php

namespace App\Exports;

use App\Models\User;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithMapping;

class AnggotaExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */

    public function collection()
    {
        return User::all();
        // return collect([User::getAnggota()]);
    }

    // public function map($user): array
    // {
    //     return [
    //         $user->user_id,
    //         $user->email,
    //         $user->name,
    //         $user->anggota->tempekan,
    //     ];
    // }
}
