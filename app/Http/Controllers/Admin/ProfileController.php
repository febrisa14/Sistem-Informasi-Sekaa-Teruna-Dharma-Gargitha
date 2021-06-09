<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use App\Models\Jabatan;
use App\Models\Pengurus;
use App\Models\User;
use App\Http\Requests\UpdateProfileRequest;
use File;
use Image;

class ProfileController extends Controller
{
    public function index()
    {
        $id = Auth::User()->user_id;
        $users = User::select
            (
                'users.user_id',
                'users.name',
                'users.avatar',
                // 'users.email_verified_at',
                'users.no_telp',
                'users.email',
                'pengurus.alamat',
                'pengurus.tgl_lahir',
                'pengurus.jenis_kelamin',
                'jabatan.nama_jabatan'
            )
            ->rightJoin('pengurus', 'pengurus.pengurus_user_id', '=', 'users.user_id')
            ->leftJoin('jabatan', 'jabatan.jabatan_id', '=', 'pengurus.pengurus_jabatan_id')
            ->where('users.user_id', '=', $id)->first();

        return view('admin/profile/profile', [
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
        ->select('email')->first(); //ambil email berdasarkan auth user id

        $emailUpdate->email = $request->email; // cek inputan email apakah sama

        $user = User::where('user_id', Auth::user()->user_id)
        ->select('name','no_telp')->first();

        $user->name = $request->name;
        $user->no_telp = $request->no_telp;

        $pengurus = Pengurus::where('pengurus_user_id', Auth::user()->user_id)
        ->select('tgl_lahir','alamat','jenis_kelamin')->first();

        $pengurus->tgl_lahir = $request->tgl_lahir;
        $pengurus->alamat = $request->alamat;
        $pengurus->jenis_kelamin = $request->jenis_kelamin;

        if ($user->isDirty() || $pengurus->isDirty() || $emailUpdate->isDirty())
        {
            if ($emailUpdate->isDirty()) // jika inputan nya berubah maka diupdate
            {
                User::where('user_id', Auth::user()->user_id)
                ->update([
                    'email' => $request->email,
                    // 'email_verified_at' => NULL
                ]);
            }

            User::where('user_id', Auth::user()->user_id)
            ->update([
                'name' => $request->name,
                'no_telp' => $request->no_telp,
                'updated_at' => now()
            ]);

            Pengurus::where('pengurus_user_id', Auth::user()->user_id)
            ->update([
                'tgl_lahir' => $request->tgl_lahir,
                'alamat' => $request->alamat,
                'jenis_kelamin' => $request->jenis_kelamin,
                'updated_at' => now()
            ]);

            return back()->with('success', 'Berhasil Update Profile.');
        }

        //jika tidak ada merubah inputan maka muncul pesan
        return back()->with('error', 'Kamu belum merubah data apapun !');
    }
}
