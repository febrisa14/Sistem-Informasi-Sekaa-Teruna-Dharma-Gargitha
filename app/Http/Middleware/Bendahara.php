<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Auth;

class Bendahara
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if (Auth::User()->pengurus->jabatan->nama_jabatan == 'Ketua STT'
        || Auth::User()->pengurus->jabatan->nama_jabatan == 'Wakil Ketua STT'
        || Auth::User()->pengurus->jabatan->nama_jabatan == 'Bendahara 1'
        || Auth::User()->pengurus->jabatan->nama_jabatan == 'Bendahara 2')
        {
            return $next($request);
        }
        return back();
    }
}
