<?php

namespace App\Http\Controllers;

use App\DosenModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\MahasiswaModel;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $login_type = Auth::user()->login_type;

        if(strtolower($login_type)=="mahasiswa"){
            $data = MahasiswaModel::where('nim' , '=',Auth::user()->id)
                ->join('master_kelas', 'master_kelas.id', '=', 'mahasiswa.kelas_id')
                ->join('master_angkatan', 'master_angkatan.id', '=', 'mahasiswa.angkatan')
                ->join('master_jurusan', 'master_jurusan.id', '=', 'mahasiswa.jurusan_id')
                ->select('mahasiswa.id', 'mahasiswa.nik', 'mahasiswa.nama', 'mahasiswa.nim','mahasiswa.email','mahasiswa.angkatan', 'master_kelas.title as kelas', 'master_angkatan.title as angkatan', 'master_jurusan.title as jurusan')
                ->first();

            return view('home', compact('data'));
        }else if(strtolower($login_type)=="dosen") {
            $data = DosenModel::where('nik' , '=',Auth::user()->id)
            ->select('dosen.*')
            ->first();

            return view('home_admin', compact('data'));
        }

        return view('home_admin', compact('data'));
    }
}
