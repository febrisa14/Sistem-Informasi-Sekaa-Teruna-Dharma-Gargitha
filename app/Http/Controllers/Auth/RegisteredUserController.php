<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Anggota;
use Hash;
use Carbon\Carbon;
use App\Http\Requests\RegisterRequest;
// use Illuminate\Auth\Events\Registered;

class RegisteredUserController extends Controller
{
    public function create()
    {
        return view ('auth/register', [
            'title' => 'Register | Sistem Informasi Sekaa Teruna Dharma Gargitha'
        ]);
    }

    public function store(RegisterRequest $request)
    {
        $users = User::create([
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'name' => $request->name,
            'no_telp' => $request->no_telp,
            'role' => 'Anggota'
        ]);

        $userId = $users->user_id;

        $anggota = Anggota::create([
            'anggota_user_id' => $userId,
            'tgl_lahir' => $request->tgl_lahir,
            'jenis_kelamin' => $request->jenis_kelamin,
            'tempekan' => $request->tempekan,
            'umur' => now()->format('Y')-Carbon::parse($request->tgl_lahir)->format('Y'),
            'alamat' => $request->alamat
        ]);

        // event(new Registered($users));

        return redirect()->route('login')->with('success', 'Berhasil Register.');
    }
}
