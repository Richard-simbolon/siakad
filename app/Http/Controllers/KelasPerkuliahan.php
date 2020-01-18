<?php

namespace App\Http\Controllers;

use App\KelasModel;
use App\RuanganModel;
use App\SemesterModel;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\KelasPerkuliahanModel;
use App\AngkatanModel;
use App\JurusanModel;
use Yajra\DataTables\DataTables;
use App\MahasiswaModel;
use App\MataKuliahModel;
use App\DosenModel;
use App\KurikulumModel;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use App\AbsensiMahasiswaModel;
use App\SinkronisasiModel;
use App\NilaiMahasiswaModel;

class KelasPerkuliahan extends Controller
{
    static $Tableshow = ["id" => ["table" => ["tablename" =>"null" , "field"=> "id"] , "record"=>"Id"],
                        "row_status" => ["table" => ["tablename" =>"null" , "field"=> "row_status"] , "record"=>"status"],
                        "program_studi_id" => ["table" => ["tablename" =>"null" , "field"=> "program_studi_id"] , "record"=>"ProgramStudi"],
                        "semester_id" => ["table" => ["tablename" =>"null" , "field"=> "semester_id"] , "record"=>"Semester"],
                        "mata_kuliah_id" => ["table" => ["tablename" =>"null" , "field"=> "mata_kuliah_id"] , "record"=>"MataKuliah"],
                        "kelas_id" => ["table" => ["tablename" =>"null" , "field"=> "kelas_id"] , "record"=>"Kelas"],
                        "pembahasan" => ["table" => ["tablename" =>"null" , "field"=> "pembahasan"] , "record"=>"pembahasan"],
                        "tanggal_efektif" => ["table" => ["tablename" =>"null" , "field"=> "tanggal_efektif"] , "record"=>"tanggal_efektif"],
                        "tanggal_akhir_efektif" => ["table" => ["tablename" =>"null" , "field"=> "tanggal_akhir_efektif"] , "record"=>"tanggal_akhir_efektif"],

    ];

    static $exclude = ["id","created_at","updated_at","created_by","update_by"];
    static $tablename = "kelas_perkuliahan";

    static $webservice = [
        'program_studi_id' => 'id_prodi',
        'semester_id' => 'id_semester',
        'id_matkul' => 'id_matkul',
        'title' => 'nama_kelas_kuliah',
        'pembahasan' => 'bahasan',
        'tanggal_mulai_efektif' => 'tanggal_mulai_efektif',
        'tanggal_akhir_efektif' => 'tanggal_akhir_efektif',
    ];

    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            $this->user = Auth::user();
            if(!$this->user){
                Redirect::to('login')->send();
            }
            if($this->user->login_type != 'admin'){
                return abort(404);
            }else{
                return $next($request);
            }
        });
        
    }

    public function index()
    {
        $master = array(
            'jurusan' => JurusanModel::where('row_status' , 'active')->get(),
            'angkatan' => MahasiswaModel::where('mahasiswa.row_status' , 'active')
                ->join('master_semester','master_semester.id', '=', 'mahasiswa.id_periode_masuk')
                ->select('master_semester.id_tahun_ajaran')
                ->distinct()
                ->orderBy('id_tahun_ajaran','desc')
                ->get(),
            'kelas' => KelasModel::where('row_status' , 'active')->get(),
            'semester'=> SemesterModel::where('row_status', 'active')
                ->orderBy('id','desc')
                ->get(),
        );

        $data = DB::table('view_kelas_perkuliahan')->get();
        $title = ucfirst(request()->segment(1))." ".ucfirst(request()->segment(2));
        $tableid = "KelasPerkuliahan";
        $table_display = DB::getSchemaBuilder()->getColumnListing(static::$tablename);
        $exclude = static::$exclude;
        $Tableshow = static::$Tableshow;
        return view("data/kelas_perkuliahan" , compact("data" , "title" ,"table_display" ,"exclude" ,"Tableshow","tableid", "master"));

    }

    public function sinc_kelas_perkuliahan(){
        $token = $this->check_auth_siakad();
        //echo $token; exit;
        $data = array('act'=>"GetDetailKelasKuliah" , "token"=>$token, "filter"=> "","limit"=>"20" , "offset" =>0);
        $result_string = $this->runWS($data, 'json');
        $result = json_decode($result_string , true);
        //print_r($result); exit;
        if(array_key_exists('data' , $result)){
            DB::beginTransaction();
            try{
                foreach($result['data'] as $item){
                    $service_data = [];
                    foreach(static::$webserviceriwayatpendidikan as $key=>$val){         
                        if($item[$val]){
                            $service_data[$key] = $item[$val];
                        }
                    }
                    MahasiswaModel::where('id_mahasiswa', $item['id_mahasiswa'])->update($service_data);
                }
                DB::commit();
                DB::table('sinkronisasi_logs')
                ->insert(array('title' => 'GetListKelasKuliah' ,'created_by'=> Auth::user()->id ,'created_at'=>date('Y-m-d H:i:s')));
                return json_encode(array('status' => 'success' , 'msg' => 'Data Berhasil Disinkronisai.'));
            } catch(\Exception $e){
                    DB::rollBack(); 
                    throw $e;
                    return json_encode(array('status' => 'error' , 'msg' => 'Terjadi kesalahan mensinkronkan data, silahkan coba lagi.'));
                }
            }
    }


    public function fail_sync($api = '' , $response = ''){
        SinkronisasiModel::where('sync_code' ,'like','%sinc_kelas_perkulaihan_mata_kuliah%')->update(array('last_sync_status'=>'gagal', 'last_sync' => date('Y-m-d H:i:s')));
        DB::table('sinkronisasi_logs')
                    ->insert(array('title' => $api ,'created_by'=> Auth::user()->id ,'created_at'=>date('Y-m-d H:i:s') , 'message' => $response));
        return json_encode(array('status' => 'error' , 'msg' => $response));
    }

    public function success_sync(){
        SinkronisasiModel::where('sync_code' ,'like','%sinc_kelas_perkulaihan_mata_kuliah%')->update(array('last_sync_status'=>'sukses', 'last_sync' => date('Y-m-d H:i:s')));
        DB::table('sinkronisasi_logs')
                    ->insert(array('title' => 'Kelas Perkuliahan' ,'created_by'=> Auth::user()->id ,'created_at'=>date('Y-m-d H:i:s') , 'message' => 'Data Kelas Perkuliahan berhasil di sinkronisasi'));
        return json_encode(array('status' => 'success' , 'msg' => 'Data Berhasil Disinkronisai.'));
    }

    public function sinc_kelas_perkulaihan_mata_kuliah(){
        $token = $this->check_auth_siakad();
        $data_kelas = DB::table('kelas_perkuliahan_mata_kuliah')
        ->select('kelas_perkuliahan_mata_kuliah.*' ,'master_kelas.title', 'kelas_perkuliahan.program_studi_id', 'kelas_perkuliahan.semester_id' , 'mata_kuliah.id_matkul', 'mata_kuliah.sks_mata_kuliah as sks_substansi_total', 'mata_kuliah.tipe_mata_kuliah' ,'kelas_perkuliahan.tanggal_mulai_efektif' ,'kelas_perkuliahan.tanggal_akhir_efektif' ,'dosen.id_dosen' ,'dosen_penugasan.id_registrasi as id_registrasi_dosen')
        ->leftJoin('kelas_perkuliahan' ,'kelas_perkuliahan.id' ,'kelas_perkuliahan_mata_kuliah.kelas_perkuliahan_id')
        ->join('master_kelas' , 'master_kelas.id' , 'kelas_perkuliahan.kelas_id')
        ->leftJoin('mata_kuliah' , 'mata_kuliah.id' , 'kelas_perkuliahan_mata_kuliah.mata_kuliah_id')
        ->leftJoin('dosen' , 'dosen.id' , '=' ,'kelas_perkuliahan_mata_kuliah.dosen_id')
        ->leftJoin('dosen_penugasan' , 'dosen_penugasan.dosen_id' , '=' ,'kelas_perkuliahan_mata_kuliah.dosen_id')
        ->where('kelas_perkuliahan_mata_kuliah.is_sinc' ,'0')
        ->get();
        $evaluasi = DB::table('master_jenis_evaluasi')->first();
        //print_r($data_kelas); exit;
        foreach($data_kelas as $item){

            foreach(static::$webservice as $key => $val){
                $data[$val] = $item->$key;
            }

            $realisasi = AbsensiMahasiswaModel::where('kelas_perkuliahan_detail_id' , $item->id)->count();
            $item->realisasi_tatap_muka = $realisasi;
            $item->id_jenis_evaluasi = $evaluasi->id_jenis_evaluasi;
            if($item->row_status != 'deleted'){
                if(strlen($item->id_kelas_kuliah) > 8){
                    unset($data['id_kelas_kuliah']);
                    $action = array('act'=>"UpdateKelasKuliah" , "token"=>$token ,'key' => array('id_kelas_kuliah' => $item->id_kelas_kuliah), "record"=> $data);
                    $response = $this->runWS($action, 'json');
                    $result = json_decode($response , true);
                    
                    $dosen_sync = $this->sinc_dosen_kelas_perkuliahan('update', $item);
                    $mahasiswa_sync = $this->sinc_mahasiswa_kelas_perkuliahan($item);
                    //$result_1 = json_decode($mahasiswa_sync , true);
                    if(!$dosen_sync){
                        return json_encode(array('status' => 'error' , 'msg' => 'Data Tidak Berhasil Disinkronisai , Cek sinkronisasi logs untuk melihat detail.'));
                    }
                    if(!DB::table('kelas_perkuliahan_mata_kuliah')->where('id' ,$item->id)->update(array('id_kelas_kuliah'=>$item->id_kelas_kuliah , 'is_sinc' =>'1'))){
                        DB::table('sinkronisasi_logs')
                        ->insert(array('title' => 'InsertKelasKuliah' ,'created_by'=> Auth::user()->id ,'created_at'=>date('Y-m-d H:i:s')));
                        $this->fail_sync('Kelas perkuliahan' , 'Data tidak berhasil disinkronisai.' . $result['error_desc']);
                        return json_encode(array('status' => 'error' , 'msg' => 'Data Tidak Berhasil Disinkronisai.'));
                    }
                }else{
                    unset($data['id_kelas_kuliah']);
                    $action = array('act'=>"InsertKelasKuliah" , "token"=>$token, "record"=> $data);
                    $response = $this->runWS($action, 'json');
                    $result = json_decode($response , true);
                    if($result['error_code'] == 0){
                        $id_kelas_kuliah = $result['data']['id_kelas_kuliah'];
                        if($id_kelas_kuliah){
                            DB::table('kelas_perkuliahan_mata_kuliah')->where('id' ,$item->id)->update(array('id_kelas_kuliah'=>$id_kelas_kuliah));
                            $item->id_kelas_kuliah = $id_kelas_kuliah;
                            $dosen_sync = $this->sinc_dosen_kelas_perkuliahan('insert' , $item);
                            $mahasiswa_sync = $this->sinc_mahasiswa_kelas_perkuliahan($item);
                            //$result_2 = json_decode($mahasiswa_sync , true);;
                            if(!$dosen_sync){
                                //$this->fail_sync('Kelas perkuliahan' , 'Data tidak berhasil disinkronisai.' . $result['error_desc']);
                                return json_encode(array('status' => 'error' , 'msg' => 'Data Tidak Berhasil Disinkronisai , Cek sinkronisasi logs untuk melihat detail.'));
                            }
                            if(!DB::table('kelas_perkuliahan_mata_kuliah')->where('id' ,$item->id)->update(array('id_kelas_kuliah'=>$id_kelas_kuliah , 'is_sinc' =>'1'))){
                                DB::table('sinkronisasi_logs')
                                ->insert(array('title' => 'InsertKelasKuliah' ,'created_by'=> Auth::user()->id ,'created_at'=>date('Y-m-d H:i:s')));
                                $this->fail_sync('Kelas perkuliahan' , 'Data tidak berhasil disinkronisai.' . $result['error_desc']);
                                return json_encode(array('status' => 'error' , 'msg' => 'Data Tidak Berhasil Disinkronisai.'));
                            }
                        }
                    }else{
                        $this->fail_sync('Kelas perkuliahan' , 'Data tidak berhasil disinkronisai.' . $result['error_desc']);
                        return json_encode(array('status' => 'error' , 'msg' => 'Data tidak berhasil disinkronisai.' . $result['error_desc']));
                    }
                    
                }
            }else{
                if(strlen($item->id_kelas_kuliah) > 8){

                    // cek jika ada mahasiswa dan dosen yang telah di insert
                    // dosen
                    if(strlen($item->id_aktivitas_mengajar) > 8){
                        // hapus dosen pengajar
                        $action = array('act'=>"DeleteDosenPengajarKelasKuliah" , "token"=>$token ,'key' => array('id_aktivitas_mengajar' => $item->id_aktivitas_mengajar));
                        $response = $this->runWS($action, 'json');
                        $result = json_decode($response , true);
                        if($result['error_code'] != 0){
                            $this->fail_sync('Kelas perkuliahan' , 'Data tidak berhasil disinkronisai.' . $result['error_desc']);
                            return json_encode(array('status' => 'error' , 'msg' => 'Data tidak berhasil disinkronisai.' . $result['error_desc']));
                        }
                        //print_r($result);
                    }
                    // hapus mahasiswa jika ada
                    $data_mahasiswa_per_kelas = AbsensiMahasiswaModel::select('mahasiswa.id_registrasi_mahasiswa as id_registrasi_mahasiswa')
                    ->leftJoin('absensi_mahasiswa_detail' ,'absensi_mahasiswa_detail.absensi_id','absensi_mahasiswa.id')
                    ->leftJoin('mahasiswa' , 'mahasiswa.id' ,'absensi_mahasiswa_detail.mahasiswa_id')
                    ->where('kelas_perkuliahan_detail_id' , '38')->groupBy('absensi_mahasiswa_detail.mahasiswa_id')->get();
                    if($data_mahasiswa_per_kelas){
                        // hapus nilai mahasiswa
                        // hapus semua mahasiswa
                        foreach($data_mahasiswa_per_kelas as $m_item){
                            $action = array('act'=>"DeletePesertaKelasKuliah" , "token"=>$token , "key"=> array('id_kelas_kuliah' => $item->id_kelas_kuliah , 'id_registrasi_mahasiswa' => $m_item->id_registrasi_mahasiswa));
                            $response = $this->runWS($action, 'json');
                            $result_3 = json_decode($response , true);
                            //print_r($result);
                            if($result_3['error_code'] != 0){
                                $this->fail_sync('Kelas perkuliahan' , 'Data tidak berhasil disinkronisai.' . $result_3['error_desc']);
                                return json_encode(array('status' => 'error' , 'msg' => 'Data tidak berhasil disinkronisai.' . $result_3['error_desc']));
                            }
                        }
                    }

                    $action = array('act'=>"DeleteKelasKuliah" , "token"=>$token ,'key' => array('id_kelas_kuliah' => $item->id_kelas_kuliah));
                    $response = $this->runWS($action, 'json');
                    $result_4 = json_decode($response , true);
                    //print_r($result);
                    if($result_4['error_code'] != '0'){
                        if(!DB::table('kelas_perkuliahan_mata_kuliah')->where('id' ,$item->id)->update(array('is_sinc' =>'0'))){
                            DB::table('sinkronisasi_logs')
                            ->insert(array('title' => 'DeleteKelasKuliah' ,'created_by'=> Auth::user()->id ,'created_at'=>date('Y-m-d H:i:s')));
                            $this->fail_sync('Kelas perkuliahan' , 'Data tidak berhasil disinkronisai.' . $result_4['error_desc']);
                            return json_encode(array('status' => 'error' , 'msg' => 'Data Tidak Berhasil Disinkronisai.'));
                        }
                    }else{
                        DB::table('kelas_perkuliahan_mata_kuliah')->where('id' ,$item->id)->update(array('is_sinc' =>'1' , 'id_kelas_kuliah' => '' ,'id_aktivitas_mengajar' => ''));
                    }
                    
                    
                }else{
                    DB::table('kelas_perkuliahan_mata_kuliah')->where('id' ,$item->id)->update(array('is_sinc' =>'1' , 'id_kelas_kuliah' => ''));
                }
            }
        }
        $this->success_sync();
        return json_encode(array('status' => 'success' , 'msg' => 'Data Berhasil Disinkronisai.'));
        
    }

    public function sinc_mahasiswa_kelas_perkuliahan($data){
        $token = $this->check_auth_siakad();
        $data_mahasiswa_per_kelas = 
        AbsensiMahasiswaModel::select('mahasiswa.id_registrasi_mahasiswa as id_registrasi_mahasiswa' , 'mahasiswa.id')
        ->leftJoin('absensi_mahasiswa_detail' ,'absensi_mahasiswa_detail.absensi_id','absensi_mahasiswa.id')
        ->leftJoin('mahasiswa' , 'mahasiswa.id' ,'absensi_mahasiswa_detail.mahasiswa_id')
        ->where('kelas_perkuliahan_detail_id' , $data->id)->groupBy('absensi_mahasiswa_detail.mahasiswa_id')->get();
        if($data_mahasiswa_per_kelas){
            // hapus semua mahasiswa
            foreach($data_mahasiswa_per_kelas as $m_item){
                $action = array('act'=>"InsertPesertaKelasKuliah" , "token"=>$token , "record"=> array('id_kelas_kuliah' => $data->id_kelas_kuliah , 'id_registrasi_mahasiswa' => $m_item->id_registrasi_mahasiswa));
                $response = $this->runWS($action, 'json');
                $result = json_decode($response , true);
                //print_r($result);
                if($result['error_code'] == '0'){
                    $nilai = NilaiMahasiswaModel::where('kelas_perkuliahan_detail_id' ,$data->id)->where('mahasiswa_id' ,$m_item->id)->first();
                    if($nilai){
                        $nangka = 0;
                        $nhuruf = 'E';
                        $nuts = $nilai->nilai_uts > 0 ? $nilai->nilai_uts : 0;
                        $nuas = $nilai->nilai_uas > 0 ? $nilai->nilai_uas : 0;
                        $ntgs = $nilai->nilai_tugas > 0 ? $nilai->nilai_tugas : 0;
                        $nlapopkl = $nilai->nilai_laporan_pkl > 0 ? $nilai->nilai_laporan_pkl : 0;
                        $nlapo = $nilai->nilai_laporan > 0 ? $nilai->nilai_laporan : 0;
                        $nujian = $nilai->nilai_ujian > 0 ? $nilai->nilai_ujian : 0;

                        if($data->tipe_mata_kuliah == 'praktek'){
                            $nangka = ( (($ntgs * 20) / 100) + (($nuts * 40) / 100) + (($nuas * 40)/100));
                        }elseif ($data->tipe_mata_kuliah == 'teori') {
                            $nangka = ( (($ntgs * 30) / 100) + (($nuts * 30) / 100) + (($nuas * 40)/100));
                        }elseif ($data->tipe_mata_kuliah == 'seminar') {
                            $nangka = ( (($ntgs * 40) / 100) + (($nuts * 30) / 100) + (($nuas * 30)/100));
                        }elseif ($data->tipe_mata_kuliah == 'pkl') {
                            $nangka = ( (($ntgs * 20) / 100) + (($nuts * 20) / 100) + (($nuas * 40)/100) + (($nlapopkl * 20) / 100));
                        }elseif ($data->tipe_mata_kuliah == 'skripsi') {
                            $nangka = ( (($ntgs * 30) / 100) + (($nuts * 20) / 100) + (($nuas * 10)/100) + (($nlapopkl * 10) / 100) + (($nujian * 20) / 100) + (($nlapo * 10) / 100));
                        }

                        if($nangka < 45){
                            $nhuruf = 'E';
                            $nindex = 0;
                        }elseif($nangka > 44 && $nangka<= 59){
                            $nhuruf = 'D';
                            $nindex = 1;
                        }elseif($nangka > 59 && $nangka<= 69){
                            $nhuruf = 'C';
                            $nindex = 2;
                        }elseif($nangka > 69 && $nangka<= 79){
                            $nhuruf = 'B';
                            $nindex = 3;
                        }elseif($nangka > 79 && $nangka<= 100){
                            $nhuruf = 'A';
                            $nindex = 4;
                        }else{
                            $nhuruf = 'E';
                            $nindex = 0;
                        }
                        
                    }else{
                        $nangka = 0;
                        $nhuruf = 'E';
                        $nindex = 0;
                    }
                    $update_nilai = array('act'=>"UpdateNilaiPerkuliahanKelas" , "token"=>$token , "key"=> array('id_kelas_kuliah' => $data->id_kelas_kuliah , 'id_registrasi_mahasiswa' => $m_item->id_registrasi_mahasiswa) , 'record' => array('nilai_angka' => $nangka , 'nilai_huruf'=>$nhuruf ,'nilai_indeks'=>$nindex));
                    $response_nilai = $this->runWS($update_nilai, 'json');
                    $result = json_decode($response_nilai , true);
                    if($result['error_code'] != '0'){
                        $this->fail_sync('Kelas perkuliahan' , 'Data tidak berhasil disinkronisai.' . $result['error_desc']);
                    }
                    //print_r($result);
                }

            }
        }
    }

    public function sinc_dosen_kelas_perkuliahan($status = '' , $data){
        
        $token = $this->check_auth_siakad();
        $data_dosen_pengajar = [
            'id_registrasi_dosen' => $data->id_registrasi_dosen,
            'id_kelas_kuliah' => $data->id_kelas_kuliah,
            'sks_substansi_total' => $data->sks_substansi_total,
            'rencana_tatap_muka' => $data->pertemuan,
            'realisasi_tatap_muka' => $data->realisasi_tatap_muka,
            'id_jenis_evaluasi' => $data->id_jenis_evaluasi,
        ];
        if($status == 'insert'){
            $action = array('act'=>"InsertDosenPengajarKelasKuliah" , "token"=>$token, "record"=> $data_dosen_pengajar);
            $response = $this->runWS($action, 'json');
            $result = json_decode($response , true);
            //print_r($result);
            $id_aktivitas_mengajar = $result['data']['id_aktivitas_mengajar'];
            //DB::table('kelas_perkuliahan_mata_kuliah')->where('id' ,$data->id)->update(array('id_kelas_kuliah'=>$id_aktivitas_mengajar));
            DB::table('kelas_perkuliahan_mata_kuliah')->where('id' ,$data->id)->update(array('id_aktivitas_mengajar'=>$id_aktivitas_mengajar));
            if($result['error_code'] != '0'){
                $this->fail_sync('Kelas perkuliahan' , 'Data tidak berhasil disinkronisai.' . $result['error_desc']);
                SinkronisasiModel::where('sync_code' ,'like','%sync_dosen_pengajar_kelas_kuliah%')->update(array('last_sync_status'=>'gagal'));
                DB::table('sinkronisasi_logs')
                    ->insert(array('title' => 'InsertDosenPengajarKelasKuliah' ,'created_by'=> Auth::user()->id ,'created_at'=>date('Y-m-d H:i:s') , 'message' => $response));
                return false;
            }else{
                SinkronisasiModel::where('sync_code' ,'like','%sync_dosen_pengajar_kelas_kuliah%')->update(array('last_sync_status'=>'sukses'));
                DB::table('sinkronisasi_logs')
                ->insert(array('title' => 'InsertDosenPengajarKelasKuliah' ,'created_by'=> Auth::user()->id ,'created_at'=>date('Y-m-d H:i:s') , 'message' => $response));
                return true;
            }
        }elseif($status == 'update'){
            //print_r($data);
            if(strlen($data->id_aktivitas_mengajar) > 8){
                // UPDATE
                $action = array('act'=>"UpdateDosenPengajarKelasKuliah" , "token"=>$token, 'key' => array('id_aktivitas_mengajar' => $data->id_aktivitas_mengajar), "record"=> $data_dosen_pengajar);
                $response = $this->runWS($action, 'json');
                $result = json_decode($response , true);
                //print_r($result);
                //$id_aktivitas_mengajar = $result['data']['id_aktivitas_mengajar'];
                //echo $id_aktivitas_mengajar;
                //DB::table('kelas_perkuliahan_mata_kuliah')->where('id' ,$data->id)->update(array('id_aktivitas_mengajar'=>$id_aktivitas_mengajar));
                if($result['error_code'] != '0'){
                    $this->fail_sync('Kelas perkuliahan' , 'Data tidak berhasil disinkronisai.' . $result['error_desc']);
                    SinkronisasiModel::where('sync_code' ,'like','%sync_dosen_pengajar_kelas_kuliah%')->update(array('last_sync_status'=>'gagal'));
                    DB::table('sinkronisasi_logs')
                        ->insert(array('title' => 'UpdateDosenPengajarKelasKuliah' ,'created_by'=> Auth::user()->id ,'created_at'=>date('Y-m-d H:i:s') , 'message' => $response));
                    return false;
                }else{
                    SinkronisasiModel::where('sync_code' ,'like','%sync_dosen_pengajar_kelas_kuliah%')->update(array('last_sync_status'=>'sukses'));
                    DB::table('sinkronisasi_logs')
                    ->insert(array('title' => 'UpdateDosenPengajarKelasKuliah' ,'created_by'=> Auth::user()->id ,'created_at'=>date('Y-m-d H:i:s') , 'message' => $response));
                    return true;
                }
            }else{
                // INSERT
                $action = array('act'=>"InsertDosenPengajarKelasKuliah" , "token"=>$token, "record"=> $data_dosen_pengajar);
                $response = $this->runWS($action, 'json');
                $result = json_decode($response , true);
                //print_r($result);
                $id_aktivitas_mengajar = $result['data']['id_aktivitas_mengajar'];
                DB::table('kelas_perkuliahan_mata_kuliah')->where('id' ,$data->id)->update(array('id_aktivitas_mengajar'=>$id_aktivitas_mengajar));
                if($result['error_code'] != '0'){
                    $this->fail_sync('Kelas perkuliahan' , 'Data tidak berhasil disinkronisai.' . $result['error_desc']);
                    SinkronisasiModel::where('sync_code' ,'like','%sync_dosen_pengajar_kelas_kuliah%')->update(array('last_sync_status'=>'gagal'));
                    DB::table('sinkronisasi_logs')
                        ->insert(array('title' => 'InsertDosenPengajarKelasKuliah' ,'created_by'=> Auth::user()->id ,'created_at'=>date('Y-m-d H:i:s') , 'message' => $response));
                    return false;
                }else{
                    SinkronisasiModel::where('sync_code' ,'like','%sync_dosen_pengajar_kelas_kuliah%')->update(array('last_sync_status'=>'sukses'));
                    DB::table('sinkronisasi_logs')
                    ->insert(array('title' => 'InsertDosenPengajarKelasKuliah' ,'created_by'=> Auth::user()->id ,'created_at'=>date('Y-m-d H:i:s') , 'message' => $response));
                    return true;
                }
            }
        }

    }


    public function filtering_kelas_perkuliahan_index(Request $request){
        $post = $request->all();
        //print_r($post);
        $where = [];
        foreach($post['filter'] as $key=>$val){
            if($val){
                $where[$key] = $val;
            }
        }

        //print_r($where);
        if(count($where) > 0){
            $data = DB::table('view_kelas_perkuliahan')->where($where)->get();
        }else{
            $data = DB::table('view_kelas_perkuliahan')->get();
        }
        $html = '';
        $i = 0;
        foreach($data as $item){
            $i++;
            $html .= '<tr>
                        <td align="center">'.$i.'</td>
                        <td align="center">'.$item->angkatan.'</td>
                        <td>'.$item->semester.'</td>
                        <td style="vertical-align: center;">'.$item->jurusan.'</td>
                        <td align="center">'.$item->kelas.'</td>
                        <td align="center">'.$item->sks.'</td>
                        <td align="center">'.$item->total_mhs.'</td>
                        <td>Edit/View</td>
                     </tr>';
        }

        return $html ? $html : '<tr><td colspan="8" align="center">Tidak ada record.</td></tr>';

        
    }

    public function create(){
        $master = array(
            'jurusan' => JurusanModel::where('row_status' , 'active')->get(),
            //'kelas' => KelasModel::where('row_status' , 'active')->get(),
            'angkatan' => MahasiswaModel::where('mahasiswa.row_status' , 'active')
                ->join('master_semester','master_semester.id', '=', 'mahasiswa.id_periode_masuk')
                ->select('master_semester.id_tahun_ajaran')
                ->distinct()
                ->orderBy('id_tahun_ajaran','desc')
                ->get(),
            'semester'=> SemesterModel::where('row_status', 'active')
                ->orderBy('id','desc')
                ->get(),

        );
        $title = "Tambah ".ucfirst(request()->segment(1))." ".ucfirst(request()->segment(2));

        return view("data/kelas_perkuliahan_create" , compact("title"  ,'master'));

    }

    public function save_kelas_perkuliahan(Request $request){
        $post = $request->all();
        //print_r($post); exit;
        $validation = Validator::make($post, [
            'semester_id' => 'required',
            'angkatan_id' => 'required',
            'pertemuan' => 'numeric',
            'program_studi_id' => 'required',
            'kelas_id' => 'required'
        ]);

        if ($validation->fails()) {
            return json_encode(['status'=> 'error', 'message'=> $validation->messages()]);
        }

        // CHECK IF SEMERSTER IS AVAILABLE FOR THIS KELAS
        if(KelasPerkuliahanModel::where('semester_id' , $post['semester_id'])
        ->where('program_studi_id' , $post['program_studi_id'])
        ->where('kelas_id' , $post['kelas_id'])->exists()){
             return json_encode(['status'=> 'error', 'message'=> array('msg' =>['Data untuk semester sudah ada periksa kembali.'])]);
        }
        
        $detail = [];
        foreach($post['item'] as $val){
            if(array_key_exists('mata_kuliah_id' , $val) ){
                if($val['dosen_id'] == '' || $val['hari_id'] == '' || $val['ruangan'] == ''|| $val['jam'] == ''){
                    return json_encode(['status'=> 'error', 'message'=> array('msg' =>['Silahkan isi semua field kolom.'])]);
                }else{
                    $detail[] = $val;
                }
            }
        }
        //print_r($post['item']);
        if(count($detail) < 1){
            return json_encode(['status'=> 'error', 'message'=> array('msg' =>['Silahkan beri tanda ceklis pada matakuliah.'])]);
        }

        $master = [
            'semester_id' => $post['semester_id'],
            'angkatan_id' => $post['angkatan_id'],
            'program_studi_id' => $post['program_studi_id'],
            'kelas_id' => $post['kelas_id']
        ];
        DB::beginTransaction();
        try{

            // SAVE TO TABLE kelas perkulahan
            $perkuliahanid = KelasPerkuliahanModel::create($master);
            $items = [];
            // save to table kelas perkuliahan mata kuliah
            foreach($detail as $item){

                $validation2 = Validator::make($items, [
                    'dosen_id' => 'required',
                    'hari_id' => 'required',
                    'ruangan' => 'numeric',
                    'jam' => 'required',
                    'pertemuan' => 'required'
                ]);
        
                if ($validation2->fails()) {
                    //return json_encode(['status'=> 'error', 'message'=> $validation->messages()]);
                }

                $item['kelas_perkuliahan_id'] = $perkuliahanid->id;
                $items[] = $item;
            }
            DB::table('kelas_perkuliahan_mata_kuliah')->insert($items);

            DB::commit();
            return json_encode(array('status' => 'success' , 'message' => 'Data berhasil disimpan.'));

        } catch(\Exception $e){
            DB::rollBack(); 
            
            return json_encode(array('status' => 'error' , 'message' => 'Terjadi kesalahan saat menyimpan, silahkan coba lagi.'));
        }
        
    }


    public function update_kelas_perkuliahan(Request $request){
        $post = $request->all();
        $detail = [];
        foreach($post['item'] as $val){
            if(array_key_exists('mata_kuliah_id' , $val) ){
                if($val['dosen_id'] == '' || $val['hari_id'] == '' || $val['ruangan'] == ''|| $val['jam'] == ''){
                    return json_encode(['status'=> 'error', 'message'=> array('msg' =>['Silahkan isi semua field kolom.'])]);
                }else{
                    $detail[] = $val;
                }
            }
        }
        DB::beginTransaction();
        try{
            DB::table('kelas_perkuliahan_mata_kuliah')->where('kelas_perkuliahan_id' , $post['update'])->delete();
            $items = [];
            foreach($detail as $item){
                $item['kelas_perkuliahan_id'] = $post['update'];
                $items[] = $item;
            }
            DB::table('kelas_perkuliahan_mata_kuliah')->insert($items);
            DB::commit();
            return json_encode(array('status' => 'success' , 'message' => 'Data berhasil disimpan.'));
        } catch(\Exception $e){
            DB::rollBack(); 
            throw $e;
            return json_encode(array('status' => 'error' , 'message' => 'Terjadi kesalahan saat menyimpan, silahkan coba lagi.'));
        }
        
    }

    public function update_kelas_perkuliahan_table(Request $request){
        $post = $request->all();
        $data = KelasPerkuliahanModel::join('master_angkatan' , 'master_angkatan.id' ,'=' ,'kelas_perkuliahan.angkatan_id')
        ->join('master_jurusan' , 'master_jurusan.id' ,'=' ,'kelas_perkuliahan.program_studi_id')
        ->join('master_kelas' , 'master_kelas.id' ,'=' ,'kelas_perkuliahan.kelas_id')
        ->join('master_semester' , 'master_semester.id' ,'=' ,'kelas_perkuliahan.semester_id')
        ->join('mahasiswa' , 'mahasiswa.kelas_id' ,'=' ,'kelas_perkuliahan.kelas_id')
        ->select('kelas_perkuliahan.id',
        DB::raw('(SELECT count(mahasiswa.id) as mahasiswa FROM mahasiswa WHERE kelas_id = 5) as mahasiswa') 
        ,'master_angkatan.title as angktan' ,'master_kelas.title as kelas' ,'master_jurusan.title as jurusan' ,'master_semester.title as semester')
        ->where('kelas_perkuliahan.row_status', 'active')->get();

    }


    public function view($id){
        $master = array(
            'dosen' => DosenModel::where('row_status' , 'active')->get(),
            'ruangan' => RuanganModel::where('row_status' , 'active')->get(),
        );
        
        $kurikulum = DB::table('kelas_perkuliahan')
            ->join('master_kelas' , 'master_kelas.id' , '=' , 'kelas_perkuliahan.kelas_id')
            ->join('kurikulum' , 'kurikulum.id' , '=' , 'master_kelas.kurikulum_id')
            //->join('master_angkatan' , 'master_angkatan.id' , '=' , 'kelas_perkuliahan.angkatan_id')
            ->join('master_jurusan' , 'master_jurusan.id' , '=' , 'kelas_perkuliahan.program_studi_id')
            ->join('master_semester' , 'master_semester.id' , '=' , 'kelas_perkuliahan.semester_id')
            ->where('kelas_perkuliahan.id' ,$id)
            ->select('kurikulum.nama_kurikulum','master_semester.title as nama_semester','master_jurusan.title as nama_jurusan','kelas_perkuliahan.angkatan_id as nama_angkatan','master_kelas.title as nama_kelas','kurikulum.id as kurikulum_id', 'kelas_perkuliahan.*')->first();
        if(!$kurikulum){
            return 'data tidak di temukan';
        }
        $kur_id = $kurikulum->id;

        $matakuliah = DB::table('kurikulum_mata_kuliah')
        ->join('mata_kuliah' , 'mata_kuliah.id' , '=' , 'kurikulum_mata_kuliah.mata_kuliah_id')
        ->leftJoin('kelas_perkuliahan_mata_kuliah', function ($join ) use($id) {
            $join->on('kelas_perkuliahan_mata_kuliah.mata_kuliah_id', '=', 'mata_kuliah.id')
                 ->where('kelas_perkuliahan_mata_kuliah.kelas_perkuliahan_id', '=', $id , DB::raw('AND'));
        })
        ->where('kurikulum_mata_kuliah.row_status' , 'active')
        ->where('kurikulum_mata_kuliah.kurikulum_id',$kurikulum->kurikulum_id)
        ->select('mata_kuliah.*' ,'mata_kuliah.id as matakuliah_id','kurikulum_mata_kuliah.semester','kelas_perkuliahan_mata_kuliah.*')
        ->get();
        $title = "Edit ".ucfirst(request()->segment(1))." ".ucfirst(request()->segment(2));
        return view("data/kelas_perkuliahan_view" , compact("title" , "matakuliah" ,"kurikulum",'master'));
    }

    public function listmatakuliah(Request $request){
        $post = $request->all();
        $dosen = DosenModel::where('row_status' , 'active')->get();
        $dosen_html = '<option value="0"> -- Pilih dosen --</option>';
        foreach($dosen as $item){
            $dosen_html .= '<option value="'.$item['id'].'"> '.$item['nidn_nup_nidk'].' - ' .$item['nama'].'</option>';
        }
        $ruangan = RuanganModel::where('row_status', 'active')->get();
        $ruangan_html = '<option value="0"> -- Pilih Ruangan --</option>';
        foreach($ruangan as $item){
            $ruangan_html .= '<option value="'.$item['id'].'"> '.$item['kode_ruangan'].' - '.$item['nama_ruangan'].'</option>';
        }

        $kurikulum = KurikulumModel::where('id' ,$post['kelas'])->select('nama_kurikulum')->first();
        $matakuliah = DB::table('kurikulum_mata_kuliah')->join('mata_kuliah' , 'mata_kuliah.id' , '=' , 'kurikulum_mata_kuliah.mata_kuliah_id')
        ->where('kurikulum_mata_kuliah.row_status' , 'active')
        ->where('kurikulum_mata_kuliah.kurikulum_id',$post['kelas'])
        ->select('mata_kuliah.*' ,'kurikulum_mata_kuliah.semester')
        ->get();
        $html = '';
        foreach($matakuliah as $item){
            $html .= '
                    <tr>
                        <td align="center"><input type="checkbox" name="item['.$item->id.'][mata_kuliah_id]" value="'.$item->id.'" class="form-control-sm"></td></td>
                        <td>'.$item->kode_mata_kuliah.'</td>
                        <td>'.$item->nama_mata_kuliah.'</td>
                        <td align="center">'.$item->sks_mata_kuliah.'</td>
                        <td align="center">'.$item->semester.'</td>
                        <td>
                            <select class="form-control  form-control-sm kt-select2" name="item['.$item->id.'][dosen_id]">
                                '.$dosen_html.'
                            </select>
                        </td>
                        <td align="center"><input type="text" name="item['.$item->id.'][asisten]" class="form-control form-control-sm" /> </td>
                        <td align="center">
                        <!--<input type="text" class="form-control" name="item['.$item->id.'][ruangan]">-->
                            <select class="form-control form-control kt-select2" name="item['.$item->id.'][ruangan]">
                                '.$ruangan_html.'
                            </select>
                        </td>
                        <td align="center">
                            <select style="min-width: 75px" class="form-control form-control-sm" name="item['.$item->id.'][hari_id]">
                                <option value="1">Senin</option>
                                <option value="2">Selasa</option>
                                <option value="3">Rabu</option>
                                <option value="4">Kamis</option>
                                <option value="5">Jumat</option>
                                <option value="6">Sabtu</option>
                            </select>
                        </td>
                        <td align="center">
                            <div class="input-group timepicker">
                                <input style="width: 80px" type="text" name="item['.$item->id.'][jam]" class="form-control form-control-sm m-input time-picker" placeholder="Pilih Jam" type="text"/>
                            </div>
                        </td>
                        <td align="center">
                        <div class="input-group timepicker">
                            <input style="width: 80px" type="text" name="item['.$item->id.'][selesai]" class="form-control form-control-sm m-input time-picker" placeholder="Pilih Jam" type="text"/>
                        </div>
                        </td>
                       
                        <td>
                            <input style="max-width: 75px" type="number"class="form-control form-control-sm" min="1"  value="14"  name="item['.$item->id.'][pertemuan]"/>
                        </td>
                    </tr>
        ';
        }

        $htmls =   '<div style="overflow-x: auto"><table class="table table-striped table-bordered table-hover" id="table-matakuliah">
                        <thead>
                        <tr>
                            <th>Pilih</th>
                            <th>Kode</th>
                            <th>Matakuliah</th>
                            <th>SKS</th>
                            <th>Semester</th>
                            <th>Dosen</th>
                            <th>Asisten</th>
                            <th>Hari</th>                            
                            <th>Jam</th>
                            <th>Selesai</th>
                            <th>Ruangan</th>
                            <th>Pertemuan</th>
                        </tr>
                        </thead>
                        <tbody>
                            '.$html.'
                        </tbody>
                    </table></div> ';
        return array('html'=>$htmls , 'nama' => $kurikulum->nama_kurikulum);
        
        
       
    }
}
