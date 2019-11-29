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
        $semester_aktif = SemesterModel::where('status_semester' , 'enable')->first();
        if(strtolower($login_type)=="mahasiswa"){
            $data = MahasiswaModel::where('nim' , '=', Auth::user()->id)
                ->join('master_kelas', 'master_kelas.id', '=', 'mahasiswa.kelas_id')
                ->join('master_angkatan', 'master_angkatan.id', '=', 'mahasiswa.angkatan')
                ->join('master_jurusan', 'master_jurusan.id', '=', 'mahasiswa.jurusan_id')
                ->select('mahasiswa.id', 'mahasiswa.nik', 'mahasiswa.nama', 'mahasiswa.nim','mahasiswa.email','mahasiswa.angkatan', 'master_kelas.title as kelas', 'master_angkatan.title as angkatan', 'master_jurusan.title as jurusan')
                ->first();

            $semester = SemesterModel::where('status_semester','=', 'enable')->first();
            $id = MahasiswaModel::where('nim' , Auth::user()->id)->first();
            $data_nilai = DB::select('call ip_mhs_proc('.$id->id.' , '.$id->kelas_id.' ,'.$semester_aktif->id.')');
            $nilai = 0;
            $sks = 0;
            $ips = 0;
            $persemsester_nilai = [];
            $persemsester_sks = [];
            if($data_nilai){
                foreach($data_nilai as $val ){
                    $persemsester_nilai[$val->semester_id][] = ($this->konversi_nilai($val->nilai_akhir)['value'] * $val->bobot_mata_kuliah) ;
                    $persemsester_sks[$val->semester_id][] = $val->bobot_mata_kuliah ;
                    $nilai += ($this->konversi_nilai($val->nilai_akhir)['value'] * $val->bobot_mata_kuliah) ;
                    $sks += $val->bobot_mata_kuliah;
                }
            }
            if(count($persemsester_nilai) > 0 && count($persemsester_sks) > 0){
                $smstr = max(array_keys($persemsester_nilai));
                $ips = round(array_sum($persemsester_nilai[$smstr]) / array_sum($persemsester_sks[$smstr]) , 2);
            }
            $total_sks_diambil = $sks;
            $total_sks_kurikulum = DB::table('view_total_bobot_matakuliah')->select('total_sks')->where('kelas_id' , $id->kelas_id)->first()->total_sks;
            $ipk = $nilai && $sks ? round($nilai / $sks, 2) : 0;
            return view('home', compact('data','semester' ,'ipk' ,'total_sks_diambil' , 'total_sks_kurikulum' , 'ips'));

        }else if(strtolower($login_type)=="dosen") {
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

            return view('home_dosen', compact('data','semester', 'matakuliah','jumlah_sks', 'kelas'));
        }

        return view('home_admin', compact('data'));
    }

    public function getCalender(){
        $today = date("Y-m-d");
        $kalender = DB::table("kalender_akademik")
            ->where("row_status", 'active')
            ->where("start",">=", $today)
            ->where("end", ">=", $today)
            ->select("kalender_akademik.id",'kalender_akademik.title', 'kalender_akademik.start')
            ->get();
        $result = [];
        foreach ($kalender as $item){
            $item->start = date('Y-m-d', strtotime($item->start));
            array_push($result, $item);
        }

        return json_encode($result);
    }
}
