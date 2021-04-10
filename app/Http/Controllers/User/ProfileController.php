<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use App\Models\Anggota;
use App\Models\User;
use File;
use Image;
use App\Http\Requests\UpdateProfileRequest;

class ProfileController extends Controller
{
    public function index()
    {
        $id = Auth::User()->user_id;
        $users = \DB::table('users')
            ->select(
                'users.user_id',
                'users.name',
                'users.avatar',
                'users.no_telp',
                'users.email_verified_at',
                'anggota.alamat',
                'anggota.tgl_lahir',
                'anggota.jenis_kelamin',
                'anggota.tempekan',
                'users.email',
                'users.role'
            )
            ->rightJoin('anggota', 'anggota.anggota_user_id', '=', 'users.user_id')
            ->where('users.user_id', '=', $id)->first();

        return view('user/profile/profile', [
            'title' => 'Profile | Sistem Informasi Sekaa Teruna Dharma Gargitha',
            'users' => $users
        ]);
    }

    public function changeFotoProfile(Request $request)
    {
        $this->validate($request, [
            'avatar' => 'required|image|mimes:jpeg,png,jpg|max:4096'
        ]);

        if (Auth::user()->avatar != "default.png") {
            File::delete('avatar/'.Auth::User()->avatar);
            // Storage::delete('/public/avatar/' . Auth::user()->avatar);
        }

        $avatar = $request->file('avatar');
        $filename = time() . '.' . $avatar->getClientOriginalExtension();
        $avatar->move(public_path('avatar'),$filename);
        $update = User::where('user_id', Auth::User()->user_id)->update([
            'avatar' => $filename
        ]);

        //resize foto
        $img = Image::make(public_path('avatar/'.$filename))->fit('500','500');
        $img->save();

        return redirect()->back()->with('success', 'Berhasil Update Foto Profile.');
    }

    public function deleteFotoProfile()
    {
        if (Auth::user()->avatar == "default.png") {
            return redirect()->back()->with('error', 'Kamu Menggunakan Foto Profile Bawaan.');
        }

        File::delete('avatar/'.Auth::User()->avatar);
        // Storage::delete('/public/avatar/' . Auth::user()->avatar);

        $update = User::where('user_id', Auth::User()->user_id)->update([
            'avatar' => 'default.png'
        ]);

        return redirect()->back()->with('success', 'Berhasil Delete Foto Profile.');
    }

    public function updateProfile(UpdateProfileRequest $request)
    {
        $emailUpdate = User::where('user_id', Auth::user()->user_id)
        ->update([
            'email' => $request->email,
            'updated_at' => \DB::raw('updated_at')
        ]);

        $user = User::where('user_id', Auth::user()->user_id)
        ->update([
            // 'email' => $request->email,
            'no_telp' => $request->no_telp,
            'updated_at' => \DB::raw('updated_at')
        ]);

        $anggota = Anggota::where('anggota_user_id', Auth::user()->user_id)
        ->update([
            'alamat' => $request->alamat,
            'tgl_lahir' => $request->tgl_lahir,
            'jenis_kelamin' => $request->jenis_kelamin,
            'updated_at' => \DB::raw('updated_at')
        ]);

        if ($emailUpdate > 0 || $user > 0 || $anggota > 0)
        {
            if ($emailUpdate > 0)
            {
                User::where('user_id', Auth::user()->user_id)
                ->update([
                    'email_verified_at' => NULL,
                ]);
            }

            $user = User::where('user_id', Auth::user()->user_id)
            ->update([
                'updated_at' => now()
            ]);

            $anggota = Anggota::where('anggota_user_id', Auth::user()->user_id)
            ->update([
                'updated_at' => now()
            ]);

            return back()->with('success', 'Berhasil Update Email.');
        }

        return back()->with('error', 'Kamu tidak merubah data apapun !');
    }
}
