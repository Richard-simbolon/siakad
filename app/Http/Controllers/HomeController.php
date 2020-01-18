<?php

namespace App\Http\Controllers;

use App\DosenModel;
use App\KelasPerkuliahanModel;
use App\MataKuliahModel;
use App\SemesterModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\MahasiswaModel;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Cache;

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
        $menu_active = 'dashboard';

        $login_type = Auth::user()->login_type;
        
        $semester_aktif = SemesterModel::where('status_semester' , 'enable')->first();
        
        if(strtolower($login_type)=="mahasiswa"){
            
            if(Cache::get('underconstuctormode') == '1'){
                return abort(404);
            }
            $kurikulum = MahasiswaModel::join('master_kelas' ,'master_kelas.id' ,'mahasiswa.kelas_id')
            ->select('master_kelas.*','mahasiswa.nama','mahasiswa.id')
            ->where('nim' , Auth::user()->id)->first();
            $data = MahasiswaModel::where('nim' , '=', Auth::user()->id)
                ->join('master_kelas', 'master_kelas.id', '=', 'mahasiswa.kelas_id')
                ->join('master_semester', 'master_semester.id', '=', 'mahasiswa.id_periode_masuk')
                ->join('master_jurusan', 'master_jurusan.id', '=', 'mahasiswa.jurusan_id')
                ->select('mahasiswa.id', 'mahasiswa.nik', 'mahasiswa.nama', 'mahasiswa.nim','mahasiswa.email','master_kelas.title as kelas', 'master_semester.id_tahun_ajaran as angkatan', 'master_jurusan.title as jurusan')
                ->first();
            $semester = SemesterModel::where('status_semester','=', 'enable')->first();
            $id = MahasiswaModel::where('nim' , Auth::user()->id)->first();

            $data_nilai = DB::select('call profile_ip_mhs_proc('.$id->id.' , '.$kurikulum->kurikulum_id.')');
            
            if(count($data_nilai) > 0) {
                $ip = $this->generate_ip($data_nilai , $semester->id);
            }else{
                $ip = [0,0,0];
            }


            $total_sks_kurikulum = DB::table('view_total_bobot_matakuliah')->select('total_sks')->where('kelas_id' , $id->kelas_id)->first()->total_sks;

            return view('home', compact('data','semester' ,'ip' , 'total_sks_kurikulum','menu_active'));

        }else if(strtolower($login_type)=="dosen") {

            if(Cache::get('underconstuctormode') == '1'){
                return abort(503, 'Sedang dalam perbaikan.');
            }

            $data = DosenModel::where('nidn_nup_nidk' , '=', Auth::user()->id)
                ->leftJoin('master_jenis_pegawai', 'master_jenis_pegawai.id', '=', 'dosen.jenis_pegawai')
                ->select('dosen.*','master_jenis_pegawai.title as nama_jenis_pegawai')
                ->first();
            $semester = SemesterModel::where('status_semester','=', 'enable')->first();

            $matakuliah = KelasPerkuliahanModel::where('semester_id', $semester['id'])->where('kelas_perkuliahan_mata_kuliah.dosen_id', '=', $data['id'])
                ->join('kelas_perkuliahan_mata_kuliah', 'kelas_perkuliahan_mata_kuliah.kelas_perkuliahan_id', '=', 'kelas_perkuliahan.id')
                ->select('kelas_perkuliahan_mata_kuliah.mata_kuliah_id')
                ->distinct('kelas_perkuliahan_mata_kuliah.mata_kuliah_id')
                ->count('kelas_perkuliahan_mata_kuliah.mata_kuliah_id');

            $sks = KelasPerkuliahanModel::where('semester_id', $semester['id'])->where('kelas_perkuliahan_mata_kuliah.dosen_id', '=', $data['id'])
                ->join('kelas_perkuliahan_mata_kuliah', 'kelas_perkuliahan_mata_kuliah.kelas_perkuliahan_id', '=', 'kelas_perkuliahan.id')
                ->join('mata_kuliah', 'mata_kuliah.id', '=', 'kelas_perkuliahan_mata_kuliah.mata_kuliah_id')
                ->select('mata_kuliah.*')
                ->distinct()
                ->get();

            $jumlah_sks = 0;
            foreach ($sks as $item){
                $matkul = MataKuliahModel::where('id','=', $item['id'])->first();
                $jumlah_sks += $matkul['bobot_mata_kuliah'];
            }

            $kelas = KelasPerkuliahanModel::where('semester_id', $semester['id'])->where('kelas_perkuliahan_mata_kuliah.dosen_id', '=', $data['id'])
                ->join('kelas_perkuliahan_mata_kuliah', 'kelas_perkuliahan_mata_kuliah.kelas_perkuliahan_id', '=', 'kelas_perkuliahan.id')
                ->select('kelas_perkuliahan.kelas_id')
                ->distinct('kelas_perkuliahan.kelas_id')
                ->count('kelas_perkuliahan.kelas_id');

            return view('home_dosen', compact('data','semester', 'matakuliah','jumlah_sks', 'kelas','menu_active'));
        }

        return view('home_admin', compact('menu_active'));
    }

    public function getCalender(){
        $today = date("Y-m-d");
        $kalender = DB::table("kalender_akademik")
            ->where("row_status", 'active')
            ->where("start","<=", $today)
            ->where("end", ">=", $today)
            ->select("kalender_akademik.id",'kalender_akademik.title', 'kalender_akademik.start','kalender_akademik.end')
            ->get();
        $result = [];
        foreach ($kalender as $item){
            $item->start = date('Y-m-d', strtotime($item->start));
            $item->end = date('Y-m-d', strtotime($item->end));
            array_push($result, $item);
        }

        return json_encode($result);
    }
}
