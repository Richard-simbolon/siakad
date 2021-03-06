<?php
namespace App\Http\Controllers;
use App\DosenModel;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\ MahasiswaModel;
use App\MahasiswaOrangtuaModel;
use App\MahasiswaOrangtuawaliModel;
use App\MahasiswaKebutuhanModel;
use App\AgamaModel;
use App\AlatTransportasiModel;
use App\KebutuhanKhususModel;
use App\JurusanModel;
use App\JenispendaftaranModel;
use App\JenisPembiayaanModel;
use App\AsalProgramStudiModel;
use App\JalurPendaftaranModel;
use App\TinggalModel;
use App\PenghasilanModel;
use App\PendidikanModel;
use App\StatusMahasiswaModel;
use App\PekerjaanModel;
use App\AngkatanModel;
use App\MahasiswaPendidikanModel;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\Auth;
use App\KelasModel;
use App\SemesterModel;
use App\JadwalPerkuliahanModel;
use App\KurikulumModel;
use PhpParser\Node\Expr\Print_;
use App\ReportSettingModel;
use PDF;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Hash;
use App\NegaraModel;
use App\ProfilePTModel;
use App\SinkronisasiModel;
use App\WilayahModel;

class Mahasiswa extends Controller
{
    static $Tableshow = ["id" => ["table" => ["tablename" =>"null" , "field"=> "id"] , "record"=>"Id"],
        ];
    static $html = ["id"=>["type"=>"null" , "value"=>"null" , "validation" => ""] ,
];
    static $exclude = ["id","created_at","updated_at","created_by","update_by"];
    static $tablename = "Mahasiswa";


    static $webservice = [ 
                           'mahasiswa' => 
                            [
                                'id_mahasiswa' => 'id_mahasiswa' ,
                                'nama' => 'nama_mahasiswa' , 
                                'jk' => 'jenis_kelamin' , 
                                'tempat_lahir' => 'tempat_lahir' , 
                                'tanggal_lahir' => 'tanggal_lahir' , 
                                'agama' => 'id_agama' , 
                                'nik' => 'nik' , 
                                'nisn' => 'nisn' , 
                                'npwp' => 'npwp' , 
                                //'kewarganegaraan' => 'id_negara' , 
                                'alamat' => 'jalan' , 
                                'dusun' => 'dusun' , 
                                'rt' => 'rt' , 
                                'rw' => 'rw' ,
                                'kelurahan' => 'kelurahan' , 
                                'kode_pos' => 'kode_pos' , 
                                'id_wilayah' => 'id_wilayah',
                                'jenis_tinggal' => 'id_jenis_tinggal' , 
                                'alat_transportasi' => 'id_alat_transportasi' , 
                                'no_telepon' => 'telepon' , 
                                'no_hp' => 'handphone' , 
                                'email' => 'email' , 
                                'is_penerima_kps' => 'penerima_kps' , 
                                'no_kps' => 'nomor_kps' , 
                                'kewarganegaraan'=>'kewarganegaraan',
                                //'kecamatan' => 'kecamatan' , 
                                //'nama_ibu' => 'nama_ibu_kandung', 
                                /*'kelas_id' => 'kelas_id' , 
                                'angkatan' => 'angkatan' , 
                                'status' => 'status' , 
                                'nama_ibu' => 'nama_ibu' , 
                                'password' => 'password' , 
                                'pembimbing_akademik' => 'pembimbing_akademik' , 
                                'biaya_masuk' => 'jenis_pembiayaan' , 
                                'kecamatan' => 'kecamatan' , 
                                'created_at' => 'created_at' , 
                                'created_by' => 'created_by' , 
                                'updated_at' => 'updated_at' , 
                                'modified_by' => 'modified_by' , 
                                'is_sinc' => 'is_sinc',*/
                            ],
                            'ibu' =>
                            [
                                'nama' =>'nama_ibu_kandung' , 
                                'nik' => 'nik_ibu', 
                                'tanggal_lahir'=>'tanggal_lahir_ibu',
                                'pendidikan_id'=>'id_pendidikan_ibu',
                                'pekerjaan_id' => 'id_pekerjaan_ibu',
                                'penghasilan' => 'id_penghasilan_ibu',
                                
                            ],
                            'ayah' =>
                            [
                                'nama' =>'nama_ayah' , 
                                'nik' => 'nik_ayah', 
                                
                                'tanggal_lahir'=>'tanggal_lahir_ayah',
                                'pendidikan_id'=>'id_pendidikan_ayah',
                                'pekerjaan_id' => 'id_pekerjaan_ayah',
                                'penghasilan' => 'id_penghasilan_ayah',
                            ],
                            'wali' =>
                            [
                                'nama' =>'nama_wali' ,
                                'tanggal_lahir'=>'tanggal_lahir_wali',
                                'pendidikan_id'=>'id_pendidikan_wali',
                                'pekerjaan_id' => 'id_pekerjaan_wali',
                                'penghasilan' => 'id_penghasilan_wali'
                            ],
                            'kebutuhan_khusus' =>
                            [
                                'kebutuhan_ayah' => 'id_kebutuhan_khusus_ayah',
                                'kebutuhan_ibu' => 'id_kebutuhan_khusus_ibu',
                                'kebutuhan_mahasiswa' => 'id_kebutuhan_khusus_mahasiswa',
                            ]
                        ];
    static $webserviceriwayatpendidikan = [
                                            'id_registrasi_mahasiswa' => 'id_registrasi_mahasiswa',
                                            'id_mahasiswa' => 'id_mahasiswa' ,
                                            'nim' => 'nim' , 
                                            'jenis_pendaftaran' => 'id_jenis_daftar' , 
                                            'jalur_pendaftaran' => 'id_jalur_daftar' , 
                                            'jurusan_id' => 'id_prodi' , 
                                            'id_semester' => 'id_periode_masuk',
                                            'tanggal_masuk' => 'tanggal_daftar' ,
                                            //'id_perguruan_tinggi' =>'id_perguruan_tinggi',
                                            'jumlah_sks_diakui' => 'sks_diakui' , 
                                            'asal_perguruan_tinggi' => 'id_perguruan_tinggi_asal' , 
                                            'asal_program_studi' => 'id_prodi_asal' , 
                                            'jenis_pembiayaan' => 'id_pembiayaan'
                                          ];

    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            $this->user = Auth::user();
            if(!$this->user){
                Redirect::to('login')->send();
            }
            if($this->user->login_type != 'admin' && $this->user->login_type != 'jurusan'){
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
            'jenis_pendaftaran' => JenisPendaftaranModel::where('row_status' , 'active')->get(),
            'jalur_pendaftaran' => JalurPendaftaranModel::where('row_status' , 'active')->get(),
            'asal_studi' => AsalProgramStudiModel::where('row_status' , 'active')->get(),
            'jenis_tinggal' => TinggalModel::where('row_status' , 'active')->get(),
            'alat_transportasi' => AlatTransportasiModel::where('row_status' , 'active')->get(),
            'pendidikan' => PendidikanModel::where('row_status' , 'active')->get(),
            'jenis_pembiayaan' => JenisPembiayaanModel::where('row_status' , 'active')->get(),
            'kelas' => KelasModel::where('row_status' , 'active')->get(),
            'pekerjaan' => PekerjaanModel::where('row_status' , 'active')->get(),
            'penghasilan' => PenghasilanModel::where('row_status' , 'active')->get(),
            'kebutuhan' => KebutuhanKhususModel::where('row_status' , 'active')->get(),
            'agama' => AgamaModel::where('row_status' , 'active')->get(),
            'angkatan' => AngkatanModel::where('row_status' , 'active')->get(),
            'periode_masuk' => SemesterModel::where('row_status' , 'active')->get(),
            'status_mahasiswa' => StatusMahasiswaModel::where('row_status' , 'active')->get()
        );
        

        /*$master = array(
            'jurusan' => JurusanModel::where('row_status' , 'active')->get(),
            'jenis_kelamin' => array('Laki-Laki' , 'Perempuan'),
            'status_kuliah' => StatusMahasisiwa::where('row_status' , 'active')->get(),
            'angkatan' => Angkatan::where('row_status' , 'active')->get(),
            'agama' => AgamaModel::where('row_status' , 'active')->get()
        );*/
        $data = MahasiswaModel::get();
        $title = ucfirst(request()->segment(1))." ".ucfirst(request()->segment(2));
        $tableid = "Mahasiswa";
        $table_display = DB::getSchemaBuilder()->getColumnListing("mahasiswa");
        $exclude = static::$exclude;
        $Tableshow = static::$Tableshow;
        return view("data/mahasiswa" , compact("data" , "title" ,"table_display" ,"exclude" ,"master","tableid"));

    }


    public function sinc(){
        ini_set('max_execution_time', 300);
        $token = $this->check_auth_siakad();
        //echo $token; exit;
        $data = array('act'=>"GetBiodataMahasiswa" , "token"=>$token, "filter"=> "","limit"=>"" , "offset" =>0);
        $result_string = $this->runWS($data, 'json');
        $result = json_decode($result_string , true);
        if(!$result){
            $this->sinkron_log('sync_mahasiswa_get','gagal', 0);
            return json_encode(array('status' => 'error' , 'msg' => 'Terjadi kesalahan mensinkronkan data, silahkan coba lagi.'));
        }
        if(array_key_exists('data' , $result)){
            foreach($result['data'] as $item){
                DB::beginTransaction();
                try{
                    $service_data = [];
                    foreach(static::$webservice as $key=>$val){
                        foreach(static::$webservice[$key] as $key2=>$val2){
                            if($val2 == 'nama_ibu_kandung'){
                               $service_data[$key][$key2] = $item['nama_ibu'];
                            }else{
                                $service_data[$key][$key2] = $item[$val2];
                            }
                            
                        }
                    }
                    $service_data['mahasiswa']['password'] = Hash::make($item['tanggal_lahir']);
                    $mahasiswa = MahasiswaModel::updateOrCreate(array('id_mahasiswa' => $service_data['mahasiswa']['id_mahasiswa']), $service_data['mahasiswa']);
                    $service_data['ibu']['mahasiswa_id'] = $mahasiswa->id;
                    $service_data['ibu']['kategori'] = 'ibu';
                    $service_data['ayah']['mahasiswa_id'] = $mahasiswa->id;
                    $service_data['ayah']['kategori'] = 'ayah';
                    $service_data['wali']['mahasiswa_id'] = $mahasiswa->id;
                    $service_data['wali']['kategori'] = 'wali';
                    $service_data['kebutuhan_khusus']['mahasiswa_id'] = $mahasiswa->id;
                    MahasiswaOrangtuawaliModel::updateOrCreate(array('mahasiswa_id' => $mahasiswa->id , 'kategori' => 'ibu') , $service_data['ibu']);
                    MahasiswaOrangtuawaliModel::updateOrCreate(array('mahasiswa_id' => $mahasiswa->id , 'kategori' => 'ayah') , $service_data['ayah']);
                    MahasiswaOrangtuawaliModel::updateOrCreate(array('mahasiswa_id' => $mahasiswa->id, 'kategori' => 'wali') , $service_data['wali']);
                    MahasiswaKebutuhanModel::updateOrCreate(array('mahasiswa_id' => $mahasiswa->id), $service_data['kebutuhan_khusus']);
                    DB::table('sinkronisasi_logs')
                    ->insert(array('title' => 'GetBiodataMahasiswa' ,'created_by'=> Auth::user()->id ,'created_at'=>date('Y-m-d H:i:s')));
                    //$this->sinkron_log('sync_semester','sukses', count($result['data']));
                    DB::commit();
                    //
                } catch(\Exception $e){
                    DB::rollBack(); 
                    throw $e;
                    return json_encode(array('status' => 'error' , 'msg' => 'Terjadi kesalahan mensinkronkan data, silahkan coba lagi.'));
                }  
            }
            
        }
        return json_encode(array('status' => 'success' , 'msg' => 'Data Berhasil Disinkronisai.'));
        
    }

    public function profilePT(){
        return ProfilePTModel::select('id_perguruan_tinggi')->first();
    }

    public function sinc_insert(){
        //$token = $this->check_auth_siakad();
        //echo $token; 
        //exit;
        $data = [];
        $data_sinc = MahasiswaModel::select('id','id_mahasiswa','id_registrasi_mahasiswa')->where("is_sinc" ,"0")->get();
        //print_r($data_sinc); exit;
        foreach($data_sinc as $item){
            $bio = MahasiswaModel::leftJoin('mahasiswa_kebutuhan_khusu','mahasiswa_kebutuhan_khusu.mahasiswa_id','=','mahasiswa.id')
            ->leftJoin('master_semester' ,'master_semester.id' ,'=' ,'mahasiswa.id_periode_masuk')
            ->select('mahasiswa.*','kebutuhan_ayah','kebutuhan_ibu','kebutuhan_mahasiswa','kewarganegaraan','nama_ibu' ,'master_semester.id_semester')
            ->where('mahasiswa.id' , $item->id)->first();
            //print_r($bio);exit;
            if($bio){
                foreach(static::$webservice['mahasiswa'] as $key => $val){
                    if($bio->$key){
                        $data[$val] = $bio->$key;
                    }
                    
                }
                foreach(static::$webservice['kebutuhan_khusus'] as $key => $val){
                    $data[$val] = $bio->$key;
                }
            }
            $ibu = MahasiswaOrangtuawaliModel::select('nama','nik','tanggal_lahir','pendidikan_id','pekerjaan_id','penghasilan')->where('mahasiswa_id',$item->id)->where('kategori' ,"ibu")->first();
            if($ibu){
                foreach(static::$webservice['ibu'] as $key => $val){
                    if($ibu->$key){
                        $data[$val] = $ibu->$key;
                    }
                }
            }

            $ayah = MahasiswaOrangtuawaliModel::select('nama','nik','tanggal_lahir','pendidikan_id','pekerjaan_id','penghasilan')->where('mahasiswa_id',$item->id)->where('kategori' ,"ayah")->first();
            if($ayah){
                foreach(static::$webservice['ayah'] as $key => $val){
                    if($ayah->$key){
                        $data[$val] = $ayah->$key;
                    }
                }
            }
            $wali = MahasiswaOrangtuawaliModel::select('nama','nik','tanggal_lahir','pendidikan_id','pekerjaan_id','penghasilan')->where('mahasiswa_id',$item->id)->where('kategori' ,"wali")->first();
            if($wali){
                foreach(static::$webservice['wali'] as $key => $val){
                    if($wali->$key){
                        $data[$val] = $wali->$key;
                    }
                }
            }
            $data_pendidikan = [];
            if($bio){
                foreach(static::$webserviceriwayatpendidikan as $key => $val){
                    $data_pendidikan[$val] = $bio->$key;
                    $data_pendidikan['id_perguruan_tinggi'] = $this->profilePT()->id_perguruan_tinggi;
                }
            }
            unset($data_pendidikan['id_registrasi_mahasiswa']);
            //print_r($data); exit;
            if($item->row_status != 'deleted'){
                if(strlen($item->id_mahasiswa) > 8){
                    unset($data_pendidikan['id_mahasiswa']);
                    unset($data['id_mahasiswa']);
                    $token = $this->check_auth_siakad();
                    $action_bio = array('act'=>"UpdateBiodataMahasiswa" , "token"=>$token ,'key' => array('id_mahasiswa' => $item->id_mahasiswa), "record"=> $data);
                    $response_bio = $this->runWS($action_bio, 'json');
                    $res1 = json_decode($response_bio);
                    if(strlen($item->id_registrasi_mahasiswa) > 8){
                        $action_rwyt_pend = array('act'=>"UpdateRiwayatPendidikanMahasiswa" ,'key'=>array('id_registrasi_mahasiswa'=>$item->id_registrasi_mahasiswa) , "token"=>$token, "record"=> $data_pendidikan);
                        $response_rwyt_pend = $this->runWS($action_rwyt_pend, 'json');
                        $res2 = json_decode($response_rwyt_pend);
                        if($res2['error_code'] == '0'){
                            if(MahasiswaModel::where('id' ,$item->id)->update(array('id_registrasi_mahasiswa' => $item->id_registrasi_mahasiswa))){
                                MahasiswaModel::where('id' ,$item->id)->update(array('is_sinc'=>'1'));
                            }
                        }else{
                            return $this->fail_sync('InsertRiwayatPendidikanMahasiswa' , 'Terjadi kesalahan pada saat sinkron riwayat pendidikan mahasiswa dengan nama <b>'.$data['nama_mahasiswa'].'</b> . '.$res2['error_desc']);
                        }

                    }else{
                        $data_pendidikan['id_mahasiswa'] = $item->id_mahasiswa;
                        $action_rwyt_pend = array('act'=>"InsertRiwayatPendidikanMahasiswa" , "token"=>$token, "record"=> $data_pendidikan);
                        $response_rwyt_pend = $this->runWS($action_rwyt_pend, 'json');
                        $result_rwyt_pend = json_decode($response_rwyt_pend , true);
                        //print_r($result_rwyt_pend);
                        
                        if($result_rwyt_pend['error_code'] == '0'){
                            $id_registrasi = $result_rwyt_pend['data']['id_registrasi_mahasiswa'];
                            if(MahasiswaModel::where('id' ,$item->id)->update(array('id_registrasi_mahasiswa' => $id_registrasi))){
                                MahasiswaModel::where('id' ,$item->id)->update(array('is_sinc'=>'1'));
                            }
                        }else{
                            return $this->fail_sync('InsertRiwayatPendidikanMahasiswa' , 'Terjadi kesalahan pada saat sinkron riwayat pendidikan mahasiswa dengan nama <b>'.$data['nama_mahasiswa'].'</b> . '.$result_rwyt_pend['error_desc']);
                        }
                    }
                    
                }else{
                    $token = $this->check_auth_siakad();
                    unset($data['id_mahasiswa']);
                    $action_bio = array('act'=>"InsertBiodataMahasiswa" , "token"=>$token, "record"=> $data);
                    $response_bio = $this->runWS($action_bio, 'json');
                    $result_mhs = json_decode($response_bio , true);
                    //print_r($result_mhs);
                    if($result_mhs['error_code'] == '0'){
                        $id_mahasiswa = $result_mhs['data']['id_mahasiswa'];
                        // INSERT TO BIO
                        if(MahasiswaModel::where('id' ,$item->id)->update(array('id_mahasiswa'=>$id_mahasiswa))){
                            $data_pendidikan['id_mahasiswa'] = $id_mahasiswa;
                            $action_rwyt_pend = array('act'=>"InsertRiwayatPendidikanMahasiswa" , "token"=>$token, "record"=> $data_pendidikan);
                            $response_rwyt_pend = $this->runWS($action_rwyt_pend, 'json');
                            $result_rwyt_pend = json_decode($response_rwyt_pend , true);
                            //print_r($response_rwyt_pend);
                            if($result_rwyt_pend['error_code'] == '0'){
                                $id_registrasi = $result_rwyt_pend['data']['id_registrasi_mahasiswa'];
                                if(MahasiswaModel::where('id' ,$item->id)->update(array('id_registrasi_mahasiswa' => $id_registrasi))){
                                    MahasiswaModel::where('id' ,$item->id)->update(array('is_sinc'=>'1'));
                                }
                            }else{
                                return $this->fail_sync('InsertRiwayatPendidikanMahasiswa' , 'Terjadi kesalahan pada saat sinkron riwayat pendidikan mahasiswa dengan nama <b>'.$data['nama_mahasiswa'].'</b> .'.$response_rwyt_pend['error_desc']);
                            }
                        }
                    }else{
                        return $this->fail_sync('InsertBiodataMahasiswa' , 'Terjadi kesalahan pada saat sinkron riwayat pendidikan mahasiswa dengan nama <b>'.$data['nama_mahasiswa'].'</b> . '.$result_mhs['error_desc']);
                    }
                }
            }else{
                
            }
        }

        return $this->success_sync();

    }

    public function success_sync(){
        SinkronisasiModel::where('sync_code' ,'like','%sync_mahasiswa%')->update(array('last_sync_status'=>'sukses'));
        DB::table('sinkronisasi_logs')
                    ->insert(array('title' => 'BiodataMahasiswa' ,'created_by'=> Auth::user()->id ,'created_at'=>date('Y-m-d H:i:s') , 'message' => 'Data Mahasiswa berhasil di sinkronisasi'));
        return json_encode(array('status' => 'success' , 'msg' => 'Data Berhasil Disinkronisai.'));
    }

    public function fail_sync($api = '' , $response = ''){
        SinkronisasiModel::where('sync_code' ,'like','%sync_mahasiswa%')->update(array('last_sync_status'=>'gagal'));
        DB::table('sinkronisasi_logs')
                    ->insert(array('title' => $api ,'created_by'=> Auth::user()->id ,'created_at'=>date('Y-m-d H:i:s') , 'message' => $response));
        return json_encode(array('status' => 'error' , 'msg' => $response));
    }

    public function sinc_riwayat_pend(){
          
        $token = $this->check_auth_siakad();
        //echo $token; exit;
        $data = array('act'=>"GetListRiwayatPendidikanMahasiswa" , "token"=>$token, "filter"=> "","limit"=>"" , "offset" =>0);
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
                    //print_r($service_data);
                    MahasiswaModel::where('id_mahasiswa', $item['id_mahasiswa'])->update($service_data);
                }
                DB::commit();
                DB::table('sinkronisasi_logs')
                ->insert(array('title' => 'GetListRiwayatPendidikanMahasiswa' ,'created_by'=> Auth::user()->id ,'created_at'=>date('Y-m-d H:i:s')));
                return json_encode(array('status' => 'success' , 'msg' => 'Data Berhasil Disinkronisai.'));
            } catch(\Exception $e){
                    DB::rollBack(); 
                    throw $e;
                    return json_encode(array('status' => 'error' , 'msg' => 'Terjadi kesalahan mensinkronkan data, silahkan coba lagi.'));
                }
            }
        
    }

    public function create(){
        //print_r(implode( ',', DB::getSchemaBuilder()->getColumnListing("mahasiswa"))); exit;

        $master = array(
            'jurusan' => JurusanModel::where('row_status' , 'active')->get(),
            'jenis_pendaftaran' => JenisPendaftaranModel::where('row_status' , 'active')->get(),
            'jalur_pendaftaran' => JalurPendaftaranModel::where('row_status' , 'active')->get(),
            'asal_studi' => AsalProgramStudiModel::where('row_status' , 'active')->get(),
            'jenis_tinggal' => TinggalModel::where('row_status' , 'active')->get(),
            'alat_transportasi' => AlatTransportasiModel::where('row_status' , 'active')->get(),
            'pendidikan' => PendidikanModel::where('row_status' , 'active')->get(),
            'kelas' => KelasModel::where('row_status' , 'active')->get(),
            'jenis_pembiayaan' => JenisPembiayaanModel::where('row_status' , 'active')->get(),
            'pekerjaan' => PekerjaanModel::where('row_status' , 'active')->get(),
            'penghasilan' => PenghasilanModel::where('row_status' , 'active')->get(),
            'kebutuhan' => KebutuhanKhususModel::where('row_status' , 'active')->get(),
            'agama' => AgamaModel::where('row_status' , 'active')->get(),
            'angkatan' => AngkatanModel::where('row_status' , 'active')->get(),
            'negara' => NegaraModel::get(),
            'wilayah' => WilayahModel::get(),
            'periode_masuk' => SemesterModel::orderby('id_tahun_ajaran' ,'DESC')->get(),
            'dosen'=> DosenModel::where('dosen.row_status', 'active')
                ->select('dosen.id', 'dosen.nidn_nup_nidk', 'dosen.nama')
                ->get()
        );
        $title = "Tambah ".ucfirst(request()->segment(1))." ".ucfirst(request()->segment(2));
        $table = array_diff(DB::getSchemaBuilder()->getColumnListing("mahasiswa"), static::$exclude);
        $exclude = static::$exclude;
        $Tableshow = static::$Tableshow;
        $html = static::$html;
        $column = 1;
        return view("data/mhs_create" , compact("table" ,"exclude" , "Tableshow" , "title" , "html", "column" ,'master'));
    }

    public function save(Request $request){
        $data = $request->all();
        $validation = Validator::make($data['mahasiswa'], [
            'id_periode_masuk' => 'required',
            'nama' => 'required',
            'nama_ibu' => 'required|max:100',
            'email'=> 'required | email',
            'nim' => 'required',
            'email' => 'required|email|unique:mahasiswa',
            'jurusan_id'=>'required',
            'kelas_id' => 'required',
            'agama'=> 'required',
            'no_hp'=>'required|min:10',
            'nik'=>'required|max:16',
            'kewarganegaraan'=>'required',
            'id_wilayah'=>'required'
        ]);

        if ($validation->fails()) {
            return json_encode(['status'=> 'false', 'message'=> $validation->messages()]);
        }
        DB::beginTransaction();
        try{

            if(array_key_exists('mahasiswa' , $data)){
                // SAVE TO TABLE mahasiswa
                if($data['mahasiswa']['is_penerima_kps'] == 'on'){
                    $data['mahasiswa']['is_penerima_kps'] = '1';
                }else{
                    $data['mahasiswa']['is_penerima_kps'] = '0';
                }

                if($data['mahasiswa']['tanggal_lahir'] != '' && $data['mahasiswa']['tanggal_lahir'] != null){
                    $data['mahasiswa']['tanggal_lahir'] = date($data['mahasiswa']['tanggal_lahir']);
                }
                $password = $this->generate_password();
                $data['mahasiswa']['password']= $password['hash'];
                $this->send_password_mail($data['mahasiswa']['email'],$data['mahasiswa']['nama'], $password['pass']);
                
                $mahasiswa = MahasiswaModel::create($data['mahasiswa']);
            }
            // SAVE TO TABLE mahasiswa_orang_tua_wali
            if(array_key_exists('mahasiswa_orang_tua_wali' , $data)){
                foreach($data['mahasiswa_orang_tua_wali'] as $key=>$val){
                    $data['mahasiswa_orang_tua_wali'][$key]['mahasiswa_id'] = $mahasiswa->id;
                    $data['mahasiswa_orang_tua_wali'][$key]['kategori'] = $key;
                    MahasiswaOrangtuawaliModel::create($data['mahasiswa_orang_tua_wali'][$key]);
                }
            }
            // SAVE TO TABLE mahasiswa_kebutuhan_khusus
            /*$data_kebutuhan_khusus = array(
                'mahasiswa_id' => $mahasiswa->id,
                'row_status' => 'active',
                'created_by' => 1,
                'updated_by' => 1,
                'kebutuhan_mahasiswa' => array_key_exists('mahasiswa_kh' , $data) ? json_encode(array('mahasiswa' => $data['mahasiswa_kh'])) : json_encode(array('mahasiswa' =>[])),
                'kebutuhan_ayah' =>array_key_exists('ayah_kh' , $data) ? json_encode(array('ayah' =>$data['ayah_kh'])) : json_encode(array('ayah' =>[])),
                'kebutuhan_ibu' =>array_key_exists('ibu_kh' , $data) ? json_encode(array('ibu'=>$data['ibu_kh'])) : json_encode(array('ibu' =>[])),
                'kebutuhan_wali' => array_key_exists('wali_kh' , $data) ? json_encode(array('wali'=>$data['wali_kh'])) : json_encode(array('wali' =>[]))
            );*/
            $data_kebutuhan_khusus = array(
                'mahasiswa_id' => $mahasiswa->id,
                'row_status' => 'active',
                'created_by' => 1,
                'updated_by' => 1,
                'kebutuhan_mahasiswa' => '0' ,
                'kebutuhan_ayah' =>'0',
                'kebutuhan_ibu' =>'0',
                'kebutuhan_wali' => '0'
            );
            MahasiswaKebutuhanModel::create($data_kebutuhan_khusus);
            DB::commit();
            return json_encode(array('status' => 'success' , 'message' => 'Data berhasil disimpan.'));
        } catch(\Exception $e){
            
            DB::rollBack(); 
            throw $e;
            return json_encode(array('status' => 'error' , 'message' => 'Terjadi kesalahan saat menyimpan, silahkan coba lagi.'));
        }
    }

    public function edit(Request $request){

    }

    public function view($id){
        //echo $id; exit;
        $master = array(
            'jurusan' => JurusanModel::where('row_status' , 'active')->get(),
            'jenis_pendaftaran' => JenisPendaftaranModel::where('row_status' , 'active')->get(),
            'jalur_pendaftaran' => JalurPendaftaranModel::where('row_status' , 'active')->get(),
            'asal_studi' => AsalProgramStudiModel::where('row_status' , 'active')->get(),
            'jenis_tinggal' => TinggalModel::where('row_status' , 'active')->get(),
            'alat_transportasi' => AlatTransportasiModel::where('row_status' , 'active')->get(),
            'kelas' => KelasModel::where('row_status' , 'active')->get(),
            'pendidikan' => PendidikanModel::where('row_status' , 'active')->get(),
            'jenis_pembiayaan' => JenisPembiayaanModel::where('row_status' , 'active')->get(),
            'pekerjaan' => PekerjaanModel::where('row_status' , 'active')->get(),
            'penghasilan' => PenghasilanModel::where('row_status' , 'active')->get(),
            'kebutuhan' => KebutuhanKhususModel::where('row_status' , 'active')->get(),
            'agama' => AgamaModel::where('row_status' , 'active')->get(),
            'semester' => SemesterModel::where('row_status' , 'active')->get(),
            'negara' => NegaraModel::get(),
            'wilayah' => WilayahModel::get(),
            'status_mahasiswa' => StatusMahasiswaModel::where('row_status' , 'active')->get(),
            'dosen'=> DosenModel::where('dosen.row_status', 'active')
                ->select('dosen.id', 'dosen.nidn_nup_nidk', 'dosen.nama')
                ->get()
        );

        $data = MahasiswaModel::join('master_jurusan', 'master_jurusan.id', '=', 'mahasiswa.jurusan_id')
            //->leftJoin('master_angkatan' ,'master_angkatan.id' ,'=' ,'mahasiswa.angkatan')
            ->leftJoin('master_semester', 'master_semester.id', '=', 'mahasiswa.id_periode_masuk')
            ->leftJoin('master_kelas' ,'master_kelas.id' ,'=' ,'mahasiswa.kelas_id')
            //->leftJoin('master_status_mahasiswa' ,'master_status_mahasiswa.id' ,'=' ,'mahasiswa.status')
            ->leftJoin('dosen', 'dosen.id' ,'=', 'mahasiswa.pembimbing_akademik')
            ->leftJoin('master_agama', 'master_agama.id', '=', 'mahasiswa.agama')
            ->select('mahasiswa.*', 'master_agama.title as nama_agama' ,'dosen.nama as nama_dosen', 'master_jurusan.title' ,'master_jurusan.id as id_jurusan' ,'master_kelas.title as kelas_title' , 'master_semester.id_tahun_ajaran as angkatan_title' ,'nama_status_mahasiswa as status_mhs')
            ->where('mahasiswa.id' , $id)->first();
        $orangtuawali = MahasiswaOrangtuawaliModel::where('mahasiswa_id' , $id)->get();
        $kebutuhan_selected = MahasiswaKebutuhanModel::where('mahasiswa_id' , $id)->first();
        $title = ucfirst(request()->segment(1))." ".ucfirst(request()->segment(2));
        $tableid = "Mahasiswa";
        $global['id'] = $id;
        return view("data/mhs_view" , compact("data","master" ,"orangtuawali" ,"kebutuhan_selected" ,"global"));
    }

    public function paging(Request $request){
        return Datatables::of(MahasiswaModel::where('mahasiswa.row_status', 'active')
        ->leftJoin('master_jurusan', 'master_jurusan.id', '=', 'mahasiswa.jurusan_id')
        ->leftJoin('master_agama', 'mahasiswa.agama', '=', 'master_agama.id')
        ->leftJoin('master_kelas', 'mahasiswa.kelas_id', '=', 'master_kelas.id')
        ->leftJoin('kurikulum', 'master_kelas.kurikulum_id', '=', 'kurikulum.id')
        ->leftJoin('view_total_sks_by_kurikulum', 'view_total_sks_by_kurikulum.id', '=', 'kurikulum.id')
        ->leftJoin('master_status_mahasiswa','master_status_mahasiswa.id', '=', 'mahasiswa.status' )
        //->leftJoin('master_angkatan','master_angkatan.id', '=', 'mahasiswa.angkatan')
        ->leftJoin('master_semester', 'master_semester.id', '=', 'mahasiswa.id_periode_masuk')
        ->select("mahasiswa.id" ,"master_agama.title as t_agama","nim" ,"mahasiswa.jurusan_id" , "master_jurusan.title", "agama" , "mahasiswa.nama_status_mahasiswa as status","nama","nik","nisn","tanggal_lahir","jk", "master_semester.id_tahun_ajaran as angkatan" , DB::raw("IF(view_total_sks_by_kurikulum.total_sks > 0 , view_total_sks_by_kurikulum.total_sks ,'0') as total_sks "))
        ->get())->addIndexColumn()->make(true);
    }

    public function validatewizard(Request $request){
        $data = $request->all();

        if(isset($data['step'])){
            if($data['step'] == '1'){
                $validation = Validator::make($data['mahasiswa'], [
                    'id_periode_masuk' => 'required',
                    'nama' => 'required',
                    'nama_ibu' => 'required|max:100',
                    'email'=> 'required | email',
                    'nim' => 'required',
                    'email' => 'required|email|unique:mahasiswa',
                    'jurusan_id'=>'required',
                    'kelas_id' => 'required',
                    'agama'=> 'required',
                    'no_hp'=>'required|min:10',
                    'tempat_lahir'=>'required',
                    'tanggal_lahir'=>'required',
                ]);
            }elseif($data['step'] == '2'){
                $validation = Validator::make($data['mahasiswa'], [
                    'nik'=>'required|max:16',
                    'kewarganegaraan'=>'required',
                    'id_wilayah'=>'required'
                ]);
            }else{
                $validation = Validator::make($data['mahasiswa'], [

                ]);
            }
            if ($validation->fails()) {
                return json_encode(['status'=> 'false', 'message'=> $validation->messages()]);
            }
        }else{
            return json_encode(['result' =>'false']);
        }

        return json_encode(['status'=> 'true', 'message'=> []]);
    }

    public function update(Request $request){
        $data = $request->all();
        //print_r($data); exit;
        $id = $data['mahasiswa']['id'];
        unset($data['mahasiswa']['id']);
        if($id != '' ){
            $validation = Validator::make($data['mahasiswa'], [
                'angkatan' => 'required',
                'nama' => 'required|max:100',
                'email'=> 'required | email',
                'nim' => 'required',
                //'email' => 'required|email|unique:mahasiswa',
                'jurusan_id'=>'required'
                //'kelas_id' => 'required'
            ]);

            if ($validation->fails()) {
                return json_encode(['status'=> 'false', 'message'=> $validation->messages()]);
            }

            if(MahasiswaModel::where('email', $data['mahasiswa']['email'])->where('id', '!=', $id)->first()){
                return json_encode(["status"=> "false", "message"=> array(["Email ini sudah digunakan mahasiswa lain"])]);
            }

            DB::beginTransaction();
            try{

                if(array_key_exists('mahasiswa' , $data)){
                    // SAVE TO TABLE mahasiswa
                    if($data['mahasiswa']['tanggal_lahir'] != '' && $data['mahasiswa']['tanggal_lahir'] != null){
                        $data['mahasiswa']['tanggal_lahir'] = date($data['mahasiswa']['tanggal_lahir']);
                    }
                    if($data['mahasiswa']['is_penerima_kps'] == 'on'){
                        $data['mahasiswa']['is_penerima_kps'] = '1';
                    }else{
                        $data['mahasiswa']['is_penerima_kps'] = '0';
                    }
                    $data['mahasiswa']['is_sinc'] = '0'; 
                    $mahasiswa = MahasiswaModel::where('id' , $id)->update($data['mahasiswa']);
                }
                // SAVE TO TABLE mahasiswa_orang_tua_wali
                if(array_key_exists('mahasiswa_orang_tua_wali' , $data)){
                    foreach($data['mahasiswa_orang_tua_wali'] as $key=>$val){
                        $data['mahasiswa_orang_tua_wali'][$key]['kategori'] = $key;
                        MahasiswaOrangtuawaliModel::where('mahasiswa_id' , $id)->where('kategori' , $key)->update($data['mahasiswa_orang_tua_wali'][$key]);
                    }
                }
                // SAVE TO TABLE mahasiswa_kebutuhan_khusus
                /*$data_kebutuhan_khusus = array(
                    'row_status' => 'active',
                    'created_by' => 1,
                    'updated_by' => 1,
                    'kebutuhan_mahasiswa' => array_key_exists('mahasiswa_kh' , $data) ? json_encode(array('mahasiswa' => $data['mahasiswa_kh'])) : json_encode(array('mahasiswa' =>[])),
                    'kebutuhan_ayah' =>array_key_exists('ayah_kh' , $data) ? json_encode(array('ayah' =>$data['ayah_kh'])) : json_encode(array('ayah' =>[])),
                    'kebutuhan_ibu' =>array_key_exists('ibu_kh' , $data) ? json_encode(array('ibu'=>$data['ibu_kh'])) : json_encode(array('ibu' =>[])),
                    'kebutuhan_wali' => array_key_exists('wali_kh' , $data) ? json_encode(array('wali'=>$data['wali_kh'])) : json_encode(array('wali' =>[]))
                );*/
                $data_kebutuhan_khusus = array(
                    'row_status' => 'active',
                    'created_by' => 1,
                    'updated_by' => 1,
                    'kebutuhan_mahasiswa' => '0',
                    'kebutuhan_ayah' =>0,
                    'kebutuhan_ibu' =>0,
                    'kebutuhan_wali' => 0
                );
                MahasiswaKebutuhanModel::where('mahasiswa_id' , $id)->update($data_kebutuhan_khusus);
                DB::commit();
                return json_encode(array('status' => 'success' , 'msg' => 'Data berhasil disimpan.'));
            } catch(\Exception $e){
                
                DB::rollBack(); 
                    throw $e;
                return json_encode(array('status' => 'error' , 'msg' => 'Terjadi kesalahan saat menyimpan, silahkan coba lagi.'));
            }

        }
        
    }

    public function delete(Request $request){
        $data = $request->all();
        $id = $data['id'];
        if($id != '' ){
            DB::beginTransaction();
            try{
                $mahasiswa = MahasiswaModel::where('id' , $id)->update(["row_status"=>"deleted"]);

                DB::commit();
                return json_encode(array('status' => 'success' , 'msg' => 'Data berhasil disimpan.'));
            } catch(\Exception $e){

                DB::rollBack();
                throw $e;
                return json_encode(array('status' => 'error' , 'msg' => 'Terjadi kesalahan saat menyimpan, silahkan coba lagi.'));
            }

        }

    }

    public function resetPassword(Request $request){
       
        $id = $request->all()['id'];
        $alphabet = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890';
        $pass = array(); //remember to declare $pass as an array
        $alphaLength = strlen($alphabet) - 1; //put the length -1 in cache
        for ($i = 0; $i < 8; $i++) {
            $n = rand(0, $alphaLength);
            $pass[] = $alphabet[$n];
        }
        $new_password = implode($pass);
        $password['password'] = Hash::make($new_password);
        if($id !='' || $id != null){
            if(MahasiswaModel::where('id' ,$id)->update($password)){
                return json_encode(["status"=> true, "message"=> $new_password]);
            }else{
                return json_encode(["status"=> false, "message"=> "Terjadi kesalahan saat mengubah data."]);
            }
        }else{
            return json_encode(["status"=> false, "message"=> "Terjadi kesalahan saat mengubah data."]);
        }
    }

    public function profile()
    {
        $data = MahasiswaModel::where('nim' , '=',Auth::user()->id)
            ->join('master_kelas', 'master_kelas.id', '=', 'mahasiswa.kelas_id')
            ->join('master_angkatan', 'master_angkatan.id', '=', 'mahasiswa.angkatan')
            ->join('master_jurusan', 'master_jurusan.id', '=', 'mahasiswa.jurusan_id')
            ->select('mahasiswa.*', 'master_kelas.title as kelas', 'master_angkatan.title as angkatan', 'master_jurusan.title as jurusan')
            ->first();

        $master = array(
            'agama' => AgamaModel::where('row_status' , 'active')->get()
        );

        $title = ucfirst(request()->segment(1))." ".ucfirst(request()->segment(2));

        $exclude = static::$exclude;
        $Tableshow = static::$Tableshow;
        return view("data/profile_mahasiswa" , compact("data" , "title"  ,"exclude" ,"Tableshow", "master"));

    }

    public function alamat()
    {
        $data = MahasiswaModel::where('nim' , '=',Auth::user()->id)
            ->join('master_kelas', 'master_kelas.id', '=', 'mahasiswa.kelas_id')
            ->join('master_angkatan', 'master_angkatan.id', '=', 'mahasiswa.angkatan')
            ->join('master_jurusan', 'master_jurusan.id', '=', 'mahasiswa.jurusan_id')
            ->select('mahasiswa.*', 'master_kelas.title as kelas', 'master_angkatan.title as angkatan', 'master_jurusan.title as jurusan')
            ->first();

        $master = array(
            'jenis_tinggal' => TinggalModel::where('row_status' , 'active')->get(),
            'alat_transportasi' => AlatTransportasiModel::where('row_status' , 'active')->get(),
        );

        $title = ucfirst(request()->segment(1))." ".ucfirst(request()->segment(2));

        $exclude = static::$exclude;
        $Tableshow = static::$Tableshow;
        return view("data/mahasiswa_alamat" , compact("data" , "title"  ,"exclude" ,"Tableshow", "master"));

    }

    public function orangtua()
    {
        $data = MahasiswaModel::where('nim' , '=',Auth::user()->id)
            ->join('master_kelas', 'master_kelas.id', '=', 'mahasiswa.kelas_id')
            ->join('master_angkatan', 'master_angkatan.id', '=', 'mahasiswa.angkatan')
            ->join('master_jurusan', 'master_jurusan.id', '=', 'mahasiswa.jurusan_id')
            ->select('mahasiswa.*', 'master_kelas.title as kelas', 'master_angkatan.title as angkatan', 'master_jurusan.title as jurusan')
            ->first();

        $orangtuawali = MahasiswaOrangtuawaliModel::where('mahasiswa_id' , $data['id'])->get();
        $master = array(
            'pekerjaan' => PekerjaanModel::where('row_status' , 'active')->get(),
            'penghasilan' => PenghasilanModel::where('row_status' , 'active')->get(),
            'pendidikan' => PendidikanModel::where('row_status' , 'active')->get(),
        );

        $title = ucfirst(request()->segment(1))." ".ucfirst(request()->segment(2));

        $exclude = static::$exclude;
        $Tableshow = static::$Tableshow;
        return view("data/mahasiswa_orangtua" , compact("data","orangtuawali" , "title"  ,"exclude" ,"Tableshow", "master"));

    }

    public function wali()
    {
        $data = MahasiswaModel::where('nim' , '=',Auth::user()->id)
            ->join('master_kelas', 'master_kelas.id', '=', 'mahasiswa.kelas_id')
            ->join('master_angkatan', 'master_angkatan.id', '=', 'mahasiswa.angkatan')
            ->join('master_jurusan', 'master_jurusan.id', '=', 'mahasiswa.jurusan_id')
            ->select('mahasiswa.*', 'master_kelas.title as kelas', 'master_angkatan.title as angkatan', 'master_jurusan.title as jurusan')
            ->first();

        $orangtuawali = MahasiswaOrangtuawaliModel::where('mahasiswa_id' , $data['id'])->get();
        $master = array(
            'pekerjaan' => PekerjaanModel::where('row_status' , 'active')->get(),
            'penghasilan' => PenghasilanModel::where('row_status' , 'active')->get(),
            'pendidikan' => PendidikanModel::where('row_status' , 'active')->get(),
        );

        $title = ucfirst(request()->segment(1))." ".ucfirst(request()->segment(2));

        $exclude = static::$exclude;
        $Tableshow = static::$Tableshow;
        return view("data/mahasiswa_wali" , compact("data","orangtuawali", "title"  ,"exclude" ,"Tableshow", "master"));

    }

    public function kebutuhankhusus()
    {
        $data = MahasiswaModel::where('nim' , '=',Auth::user()->id)
            ->join('master_kelas', 'master_kelas.id', '=', 'mahasiswa.kelas_id')
            ->join('master_angkatan', 'master_angkatan.id', '=', 'mahasiswa.angkatan')
            ->join('master_jurusan', 'master_jurusan.id', '=', 'mahasiswa.jurusan_id')
            ->select('mahasiswa.*', 'master_kelas.title as kelas', 'master_angkatan.title as angkatan', 'master_jurusan.title as jurusan')
            ->first();

        $master = array(
            'jenis_tinggal' => TinggalModel::where('row_status' , 'active')->get(),
            'alat_transportasi' => AlatTransportasiModel::where('row_status' , 'active')->get(),
            'kebutuhan' => KebutuhanKhususModel::where('row_status' , 'active')->get(),
        );
        $kebutuhan_selected = MahasiswaKebutuhanModel::where('mahasiswa_id' , $data['id'])->first();
        $title = ucfirst(request()->segment(1))." ".ucfirst(request()->segment(2));

        $exclude = static::$exclude;
        $Tableshow = static::$Tableshow;
        return view("data/mahasiswa_prestasi" , compact("data" , "title"  ,"exclude" ,"Tableshow", "master", "kebutuhan_selected"));

    }

    /*public function prestasi()
    {
        $data = MahasiswaModel::where('nim' , '=',Auth::user()->id)
            ->join('master_kelas', 'master_kelas.id', '=', 'mahasiswa.kelas_id')
            ->join('master_angkatan', 'master_angkatan.id', '=', 'mahasiswa.angkatan')
            ->join('master_jurusan', 'master_jurusan.id', '=', 'mahasiswa.jurusan_id')
            ->select('mahasiswa.*', 'master_kelas.title as kelas', 'master_angkatan.title as angkatan', 'master_jurusan.title as jurusan')
            ->first();

        $master = array(
            'jenis_tinggal' => TinggalModel::where('row_status' , 'active')->get(),
            'alat_transportasi' => AlatTransportasiModel::where('row_status' , 'active')->get(),
        );

        $title = ucfirst(request()->segment(1))." ".ucfirst(request()->segment(2));

        $exclude = static::$exclude;
        $Tableshow = static::$Tableshow;
        return view("data/mahasiswa_prestasi" , compact("data" , "title"  ,"exclude" ,"Tableshow", "master"));

    }*/

    public function gantipassword()
    {
        $data = MahasiswaModel::where('nim' , '=',Auth::user()->id)
            ->join('master_kelas', 'master_kelas.id', '=', 'mahasiswa.kelas_id')
            ->join('master_angkatan', 'master_angkatan.id', '=', 'mahasiswa.angkatan')
            ->join('master_jurusan', 'master_jurusan.id', '=', 'mahasiswa.jurusan_id')
            ->select('mahasiswa.*', 'master_kelas.title as kelas', 'master_angkatan.title as angkatan', 'master_jurusan.title as jurusan')
            ->first();

        $title = ucfirst(request()->segment(1))." ".ucfirst(request()->segment(2));

        $exclude = static::$exclude;
        $Tableshow = static::$Tableshow;
        return view("data/mahasiswa_ganti_password" , compact("data" , "title"  ,"exclude" ,"Tableshow"));

    }

    public function submit_gantipassword(Request $request){
        $input = $request->all();
        $data = MahasiswaModel::where('id' , '=',$input['id'])->first();

        if($data){
            $password_old = $data->password;
            if(!$input['password_lama'] || $input['password_lama'] == ''){
                return json_encode(["status"=> false, "message"=> "Password lama wajib diisi"]);
            }elseif (!$input['konfirmasi'] || $input['konfirmasi'] ==''){
                return json_encode(["status"=> false, "message"=> "Konfirmasi Password baru wajib diisi"]);
            }else if(!$input['password_baru'] || $input['password_baru'] == ''){
                return json_encode(["status"=> false, "message"=> "Password baru wajib diisi"]);
            }

            if($input['password_baru'] != $input['konfirmasi']){
                return json_encode(["status"=> false, "message"=> "Password baru dan konfirmasi tidak sama"]);
            }

            return json_encode(["status"=> true, "message"=> "Password sudah diubuah"]);
        }else{
            return json_encode(["status"=> false, "message"=> "Data tidak ditemukan"]);
        }
    }

    public function prestasi($id){
        
        $master = array(
            'jurusan' => JurusanModel::where('row_status' , 'active')->get(),
            'jenis_pendaftaran' => JenisPendaftaranModel::where('row_status' , 'active')->get(),
            'jalur_pendaftaran' => JalurPendaftaranModel::where('row_status' , 'active')->get(),
            'asal_studi' => AsalProgramStudiModel::where('row_status' , 'active')->get(),
            'jenis_tinggal' => TinggalModel::where('row_status' , 'active')->get(),
            'alat_transportasi' => AlatTransportasiModel::where('row_status' , 'active')->get(),
            'kelas' => KelasModel::where('row_status' , 'active')->get(),
            'pendidikan' => PendidikanModel::where('row_status' , 'active')->get(),
            'jenis_pembiayaan' => JenisPembiayaanModel::where('row_status' , 'active')->get(),
            'pekerjaan' => PekerjaanModel::where('row_status' , 'active')->get(),
            'penghasilan' => PenghasilanModel::where('row_status' , 'active')->get(),
            'kebutuhan' => KebutuhanKhususModel::where('row_status' , 'active')->get(),
            'agama' => AgamaModel::where('row_status' , 'active')->get(),
            'angkatan' => AngkatanModel::where('row_status' , 'active')->get(),
            'status_mahasiswa' => StatusMahasiswaModel::where('row_status' , 'active')->get()
        );
        $global['id'] = $id;
        $data = MahasiswaModel::join('master_jurusan', 'master_jurusan.id', '=', 'mahasiswa.jurusan_id')
        ->join('master_semester' ,'master_semester.id' ,'=' ,'mahasiswa.id_periode_masuk')
        ->join('master_kelas' ,'master_kelas.id' ,'=' ,'mahasiswa.kelas_id')
        ->join('master_status_mahasiswa' ,'master_status_mahasiswa.id' ,'=' ,'mahasiswa.status')
        ->select('mahasiswa.*' , 'master_jurusan.title' ,'master_jurusan.id as id_jurusan' ,'master_kelas.title as kelas_title' , 'master_semester.id_tahun_ajaran as angkatan_title' ,'master_status_mahasiswa.title as status_mhs')
        ->where('mahasiswa.id' , $id)->first();
        $orangtuawali = MahasiswaOrangtuawaliModel::where('mahasiswa_id' , $id)->get();
        $kebutuhan_selected = MahasiswaKebutuhanModel::where('mahasiswa_id' , $id)->first();
        $title = ucfirst(request()->segment(1))." ".ucfirst(request()->segment(2));
        $tableid = "Mahasiswa";
        return view("data/mhs_prestasi" , compact("data","master" ,"orangtuawali" ,"kebutuhan_selected" ,"global"));


    }

    public function save_prestasi(Request $request){
        $data = $request->all();
        //print_r( $data); exit;

        $id = $data['id'];
        unset($data['id']);

        if($id != '' ){
            $validation = Validator::make($data, [
                'jenis_prestasi' => 'required',
                'tingkat_prestasi' => 'required',
                'nama_prestasi' => 'required',
                'tahun' => 'required|numeric',
                'penyelenggara' => 'required',
                'peringkat' => 'max:20',
            ]);
                $data['mahasiswa_id'] = $id;
                $data['updated_at'] = date('Y-m-d H:i:s');
                $data['created_at'] = date('Y-m-d H:i:s');
            if ($validation->fails()) {
                return json_encode(['status'=> 'error', 'message'=> $validation->messages()]);
            }
            
            DB::beginTransaction();
            try{
                DB::table('mahasiswa_prestasi')->insert($data);
                DB::commit();
                return json_encode(array('status' => 'success' , 'message' => 'Data berhasil disimpan.'));
            } catch(\Exception $e){
                
                DB::rollBack(); 
                    throw $e;
                return json_encode(array('status' => 'error' , 'message' => 'Terjadi kesalahan saat menyimpan, silahkan coba lagi.'));
            }

        }
        
    }

    public function paging_prestasi(Request $request){
        //print_r($request->all()); exit;
        $post = $request->all();
        return Datatables::of(DB::table('mahasiswa_prestasi')->where('mahasiswa_id' , $post['id'])->get())->addIndexColumn()->make(true);
    }

    public function sinc_krs(){
        $token = $this->check_auth_siakad();
        //echo $token; exit;
        $data = array('act'=>"GetKRSMahasiswa" , "token"=>$token, "filter"=> "","limit"=>"10" , "offset" =>0);
        $result_string = $this->runWS($data, 'json');
        $result = json_decode($result_string , true);
        print_r($result); exit;
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
                ->insert(array('title' => 'GetKRSMahasiswa' ,'created_by'=> Auth::user()->id ,'created_at'=>date('Y-m-d H:i:s')));
                return json_encode(array('status' => 'success' , 'msg' => 'Data Berhasil Disinkronisai.'));
            } catch(\Exception $e){
                    DB::rollBack(); 
                    throw $e;
                    return json_encode(array('status' => 'error' , 'msg' => 'Terjadi kesalahan mensinkronkan data, silahkan coba lagi.'));
                }
            }
        
    }

    public function krs($ids)
    {
        $semester_active = SemesterModel::where('status_semester' ,'enable')->first();
        $mahasiswa = MahasiswaModel::where('id' , $ids)->first();
        $profile = DB::table('view_profile_mahasiswa')->where('id' , $mahasiswa->id)->first();

        //print_r($profile); exit;
        $data = JadwalPerkuliahanModel::where('kelas_id' , $mahasiswa->kelas_id)
        ->where('semester_id' , $semester_active->id)
        ->get();


        $ip_smstr_prev = JadwalPerkuliahanModel::leftJoin('kurikulum_mata_kuliah' ,'kurikulum_mata_kuliah.mata_kuliah_id' ,'=' ,'view_jadwal_kelas_perkuliahan.mata_kuliah_id')
        ->select('kurikulum_mata_kuliah.semester' ,'view_jadwal_kelas_perkuliahan.semester_id',DB::raw('SUM(view_jadwal_kelas_perkuliahan.sks_mata_kuliah) as sks'))
        ->where('kelas_id' , $mahasiswa->kelas_id)
        ->where('semester_id' , $semester_active->id)
        ->groupby('semester_id','kurikulum_mata_kuliah.semester')
        ->first();
        if($ip_smstr_prev){
            $ipk = $this->get_ipk(($ip_smstr_prev->semester_id - 1) , $ids);
            $total_sks_header = $ip_smstr_prev->sks;
        }else{
            $ipk = 0;
            $total_sks_header = 0;
        }
        if($total_sks_header > 0){
            if($ipk != 0){
                $where['mahasiswa_id'] = $ids;
                $where['semester'] = ($ip_smstr_prev->semester - 1);
                $where['semester_id'] = ($ip_smstr_prev->semester_id - 1);
                $data_ips['ips'] = $ipk;
                $data_ips['mahasiswa_id']=$ids;
                $data_ips['semester']= ($ip_smstr_prev->semester - 1);
                $data_ips['semester_id']= ($ip_smstr_prev->semester_id - 1);
                DB::table('ipk_ips_mahasiswa')->updateOrInsert($where, $data_ips);   
            } 
        }
        
        $select2 = JadwalPerkuliahanModel::select('semester_id' ,'semseter_title')
        ->where('kelas_id' , $mahasiswa->kelas_id)
        ->groupBy('semester_id')
        ->orderBy('semester_id' ,'ASC')
        ->get();
        $title = ucfirst(request()->segment(1))." ".ucfirst(request()->segment(2));
        $global['id'] = $ids;
        
        return view("data/mhs_krs" , compact("data" , "title" ,"mahasiswa" ,'select2' ,"global","profile" ,"semester_active"));



    }

    public function khs($ids)
    {
        $semester_aktif = SemesterModel::where('status_semester' , 'enable')->first();
        $master = SemesterModel::where('row_status' ,'active')->get();
        $kurikulum = MahasiswaModel::join('master_kelas' ,'master_kelas.id' ,'mahasiswa.kelas_id')
        ->select('master_kelas.*','mahasiswa.nama','mahasiswa.id')
        ->where('mahasiswa.id' , $ids)->first();
        $id = $kurikulum->id;
        $mahasiswa = DB::table('view_profile_mahasiswa')->where('id' , $ids)->first();
        $data = KurikulumModel::rightJoin('kurikulum_mata_kuliah' ,'kurikulum_mata_kuliah.kurikulum_id','=' ,'kurikulum.id')
        ->join('mata_kuliah' ,'mata_kuliah.id' , '=' ,'kurikulum_mata_kuliah.mata_kuliah_id')
        ->leftJoin('nilai_mahasiswa', function ($join) use($ids) {
            $join->on('nilai_mahasiswa.mata_kuliah_id' ,'=','kurikulum_mata_kuliah.mata_kuliah_id')
            ->Where('nilai_mahasiswa.mahasiswa_id' , '=' , $ids);
        })
        ->select('kurikulum_mata_kuliah.*' , 'kurikulum.nama_kurikulum' , 'mata_kuliah.nama_mata_kuliah', 'mata_kuliah.kode_mata_kuliah','mata_kuliah.tipe_mata_kuliah', 'mata_kuliah.sks_mata_kuliah' , 'nilai_mahasiswa.nilai_uts', 'nilai_mahasiswa.nilai_tugas', 'nilai_mahasiswa.nilai_uas')
        ->where('kurikulum.id' , $kurikulum->kurikulum_id)->where('nilai_mahasiswa.semester_id' , $semester_aktif->id)->get();
        
        $ip_smstr_prev = JadwalPerkuliahanModel::leftJoin('kurikulum_mata_kuliah' ,'kurikulum_mata_kuliah.mata_kuliah_id' ,'=' ,'view_jadwal_kelas_perkuliahan.mata_kuliah_id')
        ->select('kurikulum_mata_kuliah.semester' ,'view_jadwal_kelas_perkuliahan.semester_id',DB::raw('SUM(view_jadwal_kelas_perkuliahan.sks_mata_kuliah) as sks'))
        ->where('kelas_id' , $mahasiswa->kelas_id)
        ->where('semester_id' , $semester_aktif->id)
        ->groupby('semester_id','kurikulum_mata_kuliah.semester')
        ->first();
        if($ip_smstr_prev){
            $ipk = $this->get_ipk(($ip_smstr_prev->semester_id - 1) , $ids);
            $total_sks_header = $ip_smstr_prev->sks;
        }else{
            $ipk = 0;
            $total_sks_header = 0;
        }
        if($total_sks_header > 0){
            if($ipk > 0){
                $where['mahasiswa_id'] = $mahasiswa->id;
                $where['semester'] = ($ip_smstr_prev->semester - 1);
                $where['semester_id'] = ($ip_smstr_prev->semester_id - 1);
                $data_ips['ips'] = $ipk;
                $data_ips['mahasiswa_id']=$mahasiswa->id;
                $data_ips['semester']= ($ip_smstr_prev->semester - 1);
                $data_ips['semester_id']= ($ip_smstr_prev->semester_id - 1);
                DB::table('ipk_ips_mahasiswa')->updateOrInsert($where, $data_ips);   
            } 
        }


        $title = ucfirst(request()->segment(1))." ".ucfirst(request()->segment(2));
        $global['id'] = $ids;
        //return view("mahasiswa/khs" , compact("data" , "title" ,"mahasiswa" , "master" ,"semester_aktif"));
        return view("data/mhs_khs" , compact("data" , "title" ,"mahasiswa"  ,"global", "master" ,"semester_aktif"));
        
    }

    public function khs_load(Request $request)
    {
        //print_r($request->all());
        //exit;
        $post = $request->all();
        $kurikulum = MahasiswaModel::join('master_kelas' ,'master_kelas.id' ,'mahasiswa.kelas_id')
        ->leftJoin('master_angkatan' , 'master_angkatan.id' ,'=' ,'mahasiswa.angkatan')
        ->select('master_kelas.*','mahasiswa.nama','mahasiswa.id','master_angkatan.title as angkatan')
        ->where('mahasiswa.id' , $post['uid'])->first();

        //print_r($kurikulum); exit;
        $id = $post['uid'];
        $data = KurikulumModel::rightJoin('kurikulum_mata_kuliah' ,'kurikulum_mata_kuliah.kurikulum_id','=' ,'kurikulum.id')
        ->join('mata_kuliah' ,'mata_kuliah.id' , '=' ,'kurikulum_mata_kuliah.mata_kuliah_id')
        ->leftJoin('nilai_mahasiswa', function ($join) use($id) {
            $join->on('nilai_mahasiswa.mata_kuliah_id' ,'=','kurikulum_mata_kuliah.mata_kuliah_id')
            ->Where('nilai_mahasiswa.mahasiswa_id' , '=' , $id);
        })
        ->select('kurikulum_mata_kuliah.*' , 'kurikulum.nama_kurikulum' , 'mata_kuliah.nama_mata_kuliah', 'mata_kuliah.kode_mata_kuliah', 'mata_kuliah.sks_mata_kuliah' , 'nilai_mahasiswa.nilai_akhir', 'nilai_mahasiswa.nilai_laporan', 'nilai_mahasiswa.nilai_laporan_pkl', 'nilai_mahasiswa.nilai_ujian', 'nilai_mahasiswa.nilai_uts', 'nilai_mahasiswa.nilai_tugas', 'nilai_mahasiswa.nilai_uas','mata_kuliah.tipe_mata_kuliah')
        ->where('kurikulum.id' , $kurikulum->kurikulum_id)->where('nilai_mahasiswa.semester_id' , $request->all()['id'])->get();
        $html = '';


        $ip_smstr_prev = JadwalPerkuliahanModel::leftJoin('kurikulum_mata_kuliah' ,'kurikulum_mata_kuliah.mata_kuliah_id' ,'=' ,'view_jadwal_kelas_perkuliahan.mata_kuliah_id')
        ->select('kurikulum_mata_kuliah.semester' ,'view_jadwal_kelas_perkuliahan.semester_id',DB::raw('SUM(view_jadwal_kelas_perkuliahan.sks_mata_kuliah) as sks'))
        //->where('kelas_id' , $kurikulum->kelas_id)
        ->where('semester_id' , $request->all()['id'])
        ->groupby('semester_id','kurikulum_mata_kuliah.semester')
        ->first();
        if($ip_smstr_prev){
            $ipk = $this->get_ipk( $request->all()['id'], $id);
            $total_sks_header = $ip_smstr_prev->sks;
        }else{
            $ipk = 0;
            $total_sks_header = 0;
        }
       
        if($total_sks_header > 0){
            if($ipk > 0){
                $where['mahasiswa_id'] = $request->all()['uid'];
                $where['semester'] = $ip_smstr_prev->semester;
                $where['semester_id'] = $ip_smstr_prev->semester_id;
                $data_ips['ips'] = $ipk;
                $data_ips['mahasiswa_id']=$request->all()['uid'];
                $data_ips['semester']= ($ip_smstr_prev->semester);
                $data_ips['semester_id']= $ip_smstr_prev->semester_id;
                DB::table('ipk_ips_mahasiswa')->updateOrInsert($where, $data_ips);    
            }
        }


        if(count($data) > 0){
            $i = 0;
            $sks = 0;
            $nipk = 0;
            $t_sks_teori = 0;
            $t_sks_praktek = 0;
            foreach($data as $item){
                $i++;
                $sks += $item->sks_mata_kuliah;

                $nangka = 0;
                $index = 0;
                $indexvsks = 0;
                $nhuruf = 'E';
                $nuts = $item->nilai_uts > 0 ? $item->nilai_uts : 0;
                $nuas = $item->nilai_uas > 0 ? $item->nilai_uas : 0;
                $ntgs = $item->nilai_tugas > 0 ? $item->nilai_tugas : 0;
                $nlapopkl = $item->nilai_laporan_pkl > 0 ? $item->nilai_laporan_pkl : 0;
                $nlapo = $item->nilai_laporan > 0 ? $item->nilai_laporan : 0;
                $nujian = $item->nilai_ujian > 0 ? $item->nilai_ujian : 0;

                if($item->tipe_mata_kuliah == 'praktik'){
                    $nangka = ( (($ntgs * 20) / 100) + (($nuts * 40) / 100) + (($nuas * 40)/100));
                }elseif ($item->tipe_mata_kuliah == 'teori') {
                    $nangka = ( (($ntgs * 30) / 100) + (($nuts * 30) / 100) + (($nuas * 40)/100));
                }elseif ($item->tipe_mata_kuliah == 'seminar') {
                    $nangka = ( (($ntgs * 40) / 100) + (($nuts * 30) / 100) + (($nuas * 30)/100));
                }elseif ($item->tipe_mata_kuliah == 'pkl') {
                    $nangka = ( (($ntgs * 20) / 100) + (($nuts * 20) / 100) + (($nuas * 40)/100) + (($nlapopkl * 20) / 100));
                }elseif ($item->tipe_mata_kuliah == 'skripsi') {
                    $nangka = ( (($ntgs * 30) / 100) + (($nuts * 20) / 100) + (($nuas * 10)/100) + (($nlapopkl * 10) / 100) + (($nujian * 20) / 100) + (($nlapo * 10) / 100));
                }

                if($nangka < 45){
                    $nhuruf = 'E';
                    $nipk += 0 * $item->sks_mata_kuliah;
                    $indexvsks = 0 * $item->sks_mata_kuliah;
                    $index = 0;
                }elseif($nangka > 44 && $nangka<= 59){
                    $nhuruf = 'D';
                    $nipk += 1 * $item->sks_mata_kuliah;
                    $indexvsks = 1 * $item->sks_mata_kuliah;
                    $index = 1;
                }elseif($nangka > 59 && $nangka<= 69){
                    if((int)($kurikulum->angkatan) < 2018 && $nangka > 65 && $nangka <= 69){
                        $nhuruf = 'C+';
                    }else{
                        $nhuruf = 'C';
                    }
                    $nipk += 2 * $item->sks_mata_kuliah;
                    $indexvsks = 2 * $item->sks_mata_kuliah;
                    $index = 2;
                }elseif($nangka > 69 && $nangka<= 79){
                    if((int)($kurikulum->angkatan) < 2018 && $nangka > 75 && $nangka<= 79){
                        $nhuruf = 'B+';
                    }else{
                        $nhuruf = 'B';
                    }
                    $nipk += 3 * $item->sks_mata_kuliah;
                    $indexvsks = 3 * $item->sks_mata_kuliah;
                    $index = 3;
                }elseif($nangka > 79 && $nangka<= 100){
                    $nhuruf = 'A';
                    $nipk += 4 * $item->sks_mata_kuliah;
                    $indexvsks = 4 * $item->sks_mata_kuliah;
                    $index = 4;
                }else{
                    $nhuruf = 'E';
                    $nipk += 0 * $item->sks_mata_kuliah;
                    $index = 5;
                }

                if($item->tipe_mata_kuliah == 'praktek' || $item->tipe_mata_kuliah == 'skripsi' ||$item->tipe_mata_kuliah == 'seminar' ||$item->tipe_mata_kuliah == 'pkl'){
                    $sksteori = 0; 
                    $skspraktek = $item->sks_mata_kuliah;
                    $jumlahpr = $item->sks_mata_kuliah;
                    
                    $nilaiteoriangka = 0;
                    $nilaiteorimutu = '-';  
                    $nilaipraktekangka = $nangka;
                    $nilaipraktekmutu = $nhuruf;
                    $t_sks_praktek += $item->sks_mata_kuliah;
                    
                }else{
                    $sksteori = $item->sks_mata_kuliah; 
                    $skspraktek = '-';
                    $jumlahpr = $item->sks_mata_kuliah;

                    $nilaiteoriangka = $nangka;
                    $nilaiteorimutu = $nhuruf;  
                    $nilaipraktekangka = "-";
                    $nilaipraktekmutu = '-';
                    $t_sks_teori += $item->sks_mata_kuliah;
                }
                
                $html .= '
                        <tr>
                            <td align="center">'.$i.'</td>
                            <td>'.$item->nama_mata_kuliah.'</td>
                            <td align="center">'.$sksteori.'</td>
                            <td align="center">'.$skspraktek.'</td>
                            <td align="center">'.$nilaiteorimutu.'</td>
                            <td align="center">'.$nilaipraktekmutu.'</td>
                            <td align="center">'.$nilaiteoriangka.'</td>
                            <td align="center">'.$nilaipraktekangka.'</td>
                            <td align="center">'.$nhuruf.'</td>
                        </tr>
                
                ';
            }
            $html .= '<tr>
                        <td align="center"></td>
                        <td>Jumlah </td>
                        <td align="center">'.$t_sks_teori.'</td>
                        <td align="center">'.$t_sks_praktek.'</td>
                        <td align="center" colspan="4" ></td>
                        <td align="center" rowspan="2"></td>
                    </tr>

                    <tr>
                        <td align="center"></td>
                        <td>Jumlah  K (T + P)</td>
                        <td align="center" colspan="2" >'.$sks.'</td>
                        <td align="center" colspan="4"></td>
                    </tr>
                    <tr>
                        <td align="center"></td>
                        <td colspan="7">Indeks Prestasi (IP)</td>
                        
                        <td align="center">'. round($nipk / $sks ,2).'</td>
                    </tr>';
        }else{
            $html = '<tr>            
                        <td style="text-align: center;center; border-bottom:1px black solid; border-right:1px black solid;" colspan="9">Tidak ada matakuliah</td>
                    </tr>';
        }

        //echo $html; exit;
        return json_encode(array('html' => $html));
    }

    public function transkrip($ids)
    {
        $kurikulum = MahasiswaModel::join('master_kelas' ,'master_kelas.id' ,'mahasiswa.kelas_id')
        ->select('master_kelas.*','mahasiswa.nama','mahasiswa.id')
        ->where('mahasiswa.id' , $ids)->first();
        $id = $kurikulum->id;
        $mahasiswa = DB::table('view_profile_mahasiswa')->where('id' , $ids)->first();
        $data = KurikulumModel::rightJoin('kurikulum_mata_kuliah' ,'kurikulum_mata_kuliah.kurikulum_id','=' ,'kurikulum.id')
        ->join('mata_kuliah' ,'mata_kuliah.id' , '=' ,'kurikulum_mata_kuliah.mata_kuliah_id')
        ->leftJoin('nilai_mahasiswa', function ($join) use($ids) {
            $join->on('nilai_mahasiswa.mata_kuliah_id' ,'=','kurikulum_mata_kuliah.mata_kuliah_id')
            ->Where('nilai_mahasiswa.mahasiswa_id' , '=' , $ids);
        })
        ->leftJoin('master_semester' , 'master_semester.id' ,'=' , 'nilai_mahasiswa.semester_id')
        ->select('kurikulum_mata_kuliah.*' , 'kurikulum.nama_kurikulum' , 'mata_kuliah.nama_mata_kuliah', 'mata_kuliah.kode_mata_kuliah', 'mata_kuliah.sks_mata_kuliah' , 'nilai_mahasiswa.nilai_akhir', 'nilai_mahasiswa.nilai_uts', 'nilai_mahasiswa.nilai_tugas', 'nilai_mahasiswa.nilai_uas','mata_kuliah.tipe_mata_kuliah', 'nilai_mahasiswa.semester_id', 'master_semester.title as semester_title', 'nilai_mahasiswa.nilai_laporan', 'nilai_mahasiswa.nilai_laporan_pkl', 'nilai_mahasiswa.nilai_ujian')
        ->where('kurikulum.id' , $kurikulum->kurikulum_id)->orderby('kurikulum_mata_kuliah.semester' , 'ASC')->get();
        $title = ucfirst(request()->segment(1))." ".ucfirst(request()->segment(2));
        $global['id'] = $id;
        return view("data/mhs_transkrip" , compact("data" , "title" ,"mahasiswa","global"));
        
    }

    public function grafik_mahasiswa(){
        $data = MahasiswaModel::where('row_status','active')
            ->select('jk as label', DB::raw('count(id) as value'))
            ->groupBy('jk')->get();
        $count = MahasiswaModel::where('row_status','active')->count();

        return json_encode(["count" => $count, "data"=>$data]);
    }

    public function grafik_jurusan(){
        $data = MahasiswaModel::where('mahasiswa.row_status','active')
            ->join('master_jurusan','master_jurusan.id', '=', 'mahasiswa.jurusan_id')
            ->select('master_jurusan.title as label', DB::raw('count(mahasiswa.id) as value'))
            ->groupBy('master_jurusan.title')->get();
        $count = MahasiswaModel::where('row_status','active')->count();

        return json_encode(["count" => $count, "data"=>$data]);
    }

    public function grafik_status(){
        $data = MahasiswaModel::where('mahasiswa.row_status','active')
            ->join('master_status_mahasiswa', 'master_status_mahasiswa.id', '=', 'mahasiswa.status')
            ->select('master_status_mahasiswa.title as label', DB::raw('count(mahasiswa.id) as value'))
            ->groupBy('master_status_mahasiswa.title')->get();
        $count = MahasiswaModel::where('row_status','active')->count();

        return json_encode(["count" => $count, "data"=>$data]);
    }

    function print_khs($id_semester , $ids){
        $report = ReportSettingModel::where('row_status' ,'active')->first();
        //print_r($report); exit;
        $semester_aktif = SemesterModel::where('id' , $id_semester)->first();
        $master = SemesterModel::where('row_status' ,'active')->get();
        $kurikulum = MahasiswaModel::join('master_kelas' ,'master_kelas.id' ,'mahasiswa.kelas_id')
        ->select('master_kelas.*','mahasiswa.nama','mahasiswa.id')
        ->where('mahasiswa.id' , $ids)->first();
        $id = $kurikulum->id;
        $mahasiswa = DB::table('view_profile_mahasiswa')->where('id' , $id)->first();
        $data = KurikulumModel::rightJoin('kurikulum_mata_kuliah' ,'kurikulum_mata_kuliah.kurikulum_id','=' ,'kurikulum.id')
        ->join('mata_kuliah' ,'mata_kuliah.id' , '=' ,'kurikulum_mata_kuliah.mata_kuliah_id')
        ->leftJoin('nilai_mahasiswa', function ($join) use($id) {
            $join->on('nilai_mahasiswa.mata_kuliah_id' ,'=','kurikulum_mata_kuliah.mata_kuliah_id')
            ->Where('nilai_mahasiswa.mahasiswa_id' , '=' , $id);
        })
        ->select('kurikulum_mata_kuliah.*' , 'kurikulum.nama_kurikulum' , 'mata_kuliah.nama_mata_kuliah', 'mata_kuliah.kode_mata_kuliah','mata_kuliah.tipe_mata_kuliah', 'mata_kuliah.sks_mata_kuliah' , 'nilai_mahasiswa.nilai_uts', 'nilai_mahasiswa.nilai_tugas', 'nilai_mahasiswa.nilai_uas')
        ->where('kurikulum.id' , $kurikulum->kurikulum_id)->where('nilai_mahasiswa.semester_id' , $id_semester)->get();
        $title = ucfirst(request()->segment(1))." ".ucfirst(request()->segment(2));
        //return view("mahasiswa/print_khs" , compact("data" , "title" ,"mahasiswa" , "master" , "semester_aktif" ,"report"));
        $pdf = PDF::setPaper('legal','potrait')->loadView('mahasiswa/print_khs', compact("data" , "title" ,"mahasiswa" , "master", "semester_aktif" ,"report"));
        return $pdf->download('KHS_'.$id_semester.'_'.$ids.'_'.date('Y-m-d_H-i-s').'.pdf');
        

    }

    function print_transkrip($ids){
        $report = ReportSettingModel::where('row_status' ,'active')->first();
        $kurikulum = MahasiswaModel::join('master_kelas' ,'master_kelas.id' ,'mahasiswa.kelas_id')
        ->select('master_kelas.*','mahasiswa.nama','mahasiswa.id')
        ->where('mahasiswa.id' , $ids)->first();
        $id = $kurikulum->id;
        $mahasiswa = DB::table('view_profile_mahasiswa')->where('id' , $id)->first();
        $data = KurikulumModel::rightJoin('kurikulum_mata_kuliah' ,'kurikulum_mata_kuliah.kurikulum_id','=' ,'kurikulum.id')
        ->join('mata_kuliah' ,'mata_kuliah.id' , '=' ,'kurikulum_mata_kuliah.mata_kuliah_id')
        ->leftJoin('nilai_mahasiswa', function ($join) use($id) {
            $join->on('nilai_mahasiswa.mata_kuliah_id' ,'=','kurikulum_mata_kuliah.mata_kuliah_id')
            ->Where('nilai_mahasiswa.mahasiswa_id' , '=' , $id);
        })
        ->leftJoin('master_semester' , 'master_semester.id' ,'=' , 'nilai_mahasiswa.semester_id')
        ->select('kurikulum_mata_kuliah.*' , 'kurikulum.nama_kurikulum' , 'mata_kuliah.nama_mata_kuliah', 'mata_kuliah.kode_mata_kuliah', 'mata_kuliah.sks_mata_kuliah' , 'nilai_mahasiswa.nilai_akhir', 'nilai_mahasiswa.nilai_uts', 'nilai_mahasiswa.nilai_tugas', 'nilai_mahasiswa.nilai_uas','mata_kuliah.tipe_mata_kuliah', 'nilai_mahasiswa.semester_id', 'master_semester.title as semester_title')
        ->where('kurikulum.id' , $kurikulum->kurikulum_id)->orderby('kurikulum_mata_kuliah.semester' , 'ASC')->get();
        $title = ucfirst(request()->segment(1))." ".ucfirst(request()->segment(2));
        //return view("mahasiswa/print_transkrip" , compact("data" , "title" ,"mahasiswa" , "master","report"));
        $pdf = PDF::setPaper('legal','potrait')->loadView('mahasiswa/print_transkrip', compact("data" , "title" ,"mahasiswa" ,"report"));
        return $pdf->download('TanskriNilai_'.'_'.$ids.'_'.date('Y-m-d_H-i-s').'.pdf');
        

    }

    public function print_krs($ids){
        $report = ReportSettingModel::where('row_status' ,'active')->first();
        $semester_active = SemesterModel::where('status_semester' ,'enable')->first();
        $mahasiswa = MahasiswaModel::where('id' , $ids)->first();
        $profile = DB::table('view_profile_mahasiswa')->where('id' , $mahasiswa->id)->first();
        $data = JadwalPerkuliahanModel::where('kelas_id' , $mahasiswa->kelas_id)
        ->where('semester_id' , $semester_active->id)
        ->get();

        $ip_smstr_prev = JadwalPerkuliahanModel::leftJoin('kurikulum_mata_kuliah' ,'kurikulum_mata_kuliah.mata_kuliah_id' ,'=' ,'view_jadwal_kelas_perkuliahan.mata_kuliah_id')
        ->select('kurikulum_mata_kuliah.semester' ,'view_jadwal_kelas_perkuliahan.semester_id',DB::raw('SUM(view_jadwal_kelas_perkuliahan.sks_mata_kuliah) as sks'))
        ->where('kelas_id' , $mahasiswa->kelas_id)
        ->where('semester_id' , $semester_active->id)
        ->groupby('semester_id','kurikulum_mata_kuliah.semester')
        ->first();
        if($ip_smstr_prev){
            $ipk = $this->get_ipk(($ip_smstr_prev->semester_id - 1) , $ids);
            $total_sks_header = $ip_smstr_prev->sks;
            $where = ['mahasiswa_id' => $ids];
            $where = ['semester' => $ip_smstr_prev->semester];
            $where = ['semester_id' => $ip_smstr_prev->semester_id];
            $data_ips = ['ips' => $ipk];
            DB::table('ipk_ips_mahasiswa')->updateOrInsert($where, $data_ips);
        }else{
            $ipk = '-';
            $total_sks_header = 0;
        }

        $select2 = JadwalPerkuliahanModel::select('semester_id' ,'semseter_title')
        ->where('kelas_id' , $mahasiswa->kelas_id)
        ->groupBy('semester_id')
        ->orderBy('semester_id' ,'ASC')
        ->get();
        $title = ucfirst(request()->segment(1))." ".ucfirst(request()->segment(2));
        //return view("mahasiswa/print_krs" , compact("data" , "title" ,"mahasiswa" ,'select2',"semester_active" ,"profile","ipk" ,"total_sks_header","report"));
        $pdf = PDF::setPaper('legal','potrait')->loadView("mahasiswa/print_krs" , compact("data" , "title" ,"mahasiswa" ,'select2',"semester_active" ,"profile","ipk" ,"total_sks_header","report"));
        return $pdf->download('KRS'.'_'.$ids.'_'.date('Y-m-d_H-i-s').'.pdf');
    }

    function get_ipk($id_semester , $ids){
        $semester_aktif = SemesterModel::where('id' , $id_semester)->first();
        $master = SemesterModel::where('row_status' ,'active')->get();
        $kurikulum = MahasiswaModel::join('master_kelas' ,'master_kelas.id' ,'mahasiswa.kelas_id')
        ->leftJoin('master_angkatan' , 'master_angkatan.id' ,'=' ,'mahasiswa.angkatan')
        ->select('master_kelas.*','mahasiswa.nama','mahasiswa.id','master_angkatan.title as angkatan')
        ->where('mahasiswa.id' , $ids)->first();
        $id = $kurikulum->id;
        $mahasiswa = DB::table('view_profile_mahasiswa')->where('id' , $ids)->first();
        $data = KurikulumModel::rightJoin('kurikulum_mata_kuliah' ,'kurikulum_mata_kuliah.kurikulum_id','=' ,'kurikulum.id')
        ->join('mata_kuliah' ,'mata_kuliah.id' , '=' ,'kurikulum_mata_kuliah.mata_kuliah_id')
        ->leftJoin('nilai_mahasiswa', function ($join) use($ids) {
            $join->on('nilai_mahasiswa.mata_kuliah_id' ,'=','kurikulum_mata_kuliah.mata_kuliah_id')
            ->Where('nilai_mahasiswa.mahasiswa_id' , '=' , $ids);
        })
        ->select('kurikulum_mata_kuliah.*' , 'kurikulum.nama_kurikulum' , 'mata_kuliah.nama_mata_kuliah', 'mata_kuliah.kode_mata_kuliah','mata_kuliah.tipe_mata_kuliah', 'mata_kuliah.sks_mata_kuliah' , 'nilai_mahasiswa.nilai_uts', 'nilai_mahasiswa.nilai_tugas', 'nilai_mahasiswa.nilai_uas')
        ->where('kurikulum.id' , $kurikulum->kurikulum_id)->where('nilai_mahasiswa.semester_id' , $id_semester)->get();
        if(count($data) > 0){
            $i = 0;
            $sks = 0;
            $nipk = 0;
            $t_sks_teori = 0;
            $t_sks_praktek = 0;
            foreach($data as $item){
                $i++;
                $sks += $item->sks_mata_kuliah;

                $nangka = 0;
                $index = 0;
                $indexvsks = 0;
                $nhuruf = 'E';
                $nuts = $item->nilai_uts > 0 ? $item->nilai_uts : 0;
                $nuas = $item->nilai_uas > 0 ? $item->nilai_uas : 0;
                $ntgs = $item->nilai_tugas > 0 ? $item->nilai_tugas : 0;
                $nlapopkl = $item->nilai_laporan_pkl > 0 ? $item->nilai_laporan_pkl : 0;
                $nlapo = $item->nilai_laporan > 0 ? $item->nilai_laporan : 0;
                $nujian = $item->nilai_ujian > 0 ? $item->nilai_ujian : 0;

                if($item->tipe_mata_kuliah == 'praktik'){
                    $nangka = ( (($ntgs * 20) / 100) + (($nuts * 40) / 100) + (($nuas * 40)/100));
                }elseif ($item->tipe_mata_kuliah == 'teori') {
                    $nangka = ( (($ntgs * 30) / 100) + (($nuts * 30) / 100) + (($nuas * 40)/100));
                }elseif ($item->tipe_mata_kuliah == 'seminar') {
                    $nangka = ( (($ntgs * 40) / 100) + (($nuts * 30) / 100) + (($nuas * 30)/100));
                }elseif ($item->tipe_mata_kuliah == 'pkl') {
                    $nangka = ( (($ntgs * 20) / 100) + (($nuts * 20) / 100) + (($nuas * 40)/100) + (($nlapopkl * 20) / 100));
                }elseif ($item->tipe_mata_kuliah == 'skripsi') {
                    $nangka = ( (($ntgs * 30) / 100) + (($nuts * 20) / 100) + (($nuas * 10)/100) + (($nlapopkl * 10) / 100) + (($nujian * 20) / 100) + (($nlapo * 10) / 100));
                }

                if($nangka < 45){
                    $nhuruf = 'E';
                    $nipk += 0 * $item->sks_mata_kuliah;
                    $indexvsks = 0 * $item->sks_mata_kuliah;
                    $index = 0;
                }elseif($nangka > 44 && $nangka<= 59){
                    $nhuruf = 'D';
                    $nipk += 1 * $item->sks_mata_kuliah;
                    $indexvsks = 1 * $item->sks_mata_kuliah;
                    $index = 1;
                }elseif($nangka > 59 && $nangka<= 69){
                    if((int)($kurikulum->angkatan) < 2018 && $nangka > 65 && $nangka <= 69){
                        $nhuruf = 'C+';
                    }else{
                        $nhuruf = 'C';
                    }
                    $nipk += 2 * $item->sks_mata_kuliah;
                    $indexvsks = 2 * $item->sks_mata_kuliah;
                    $index = 2;
                }elseif($nangka > 69 && $nangka<= 79){
                    if((int)($kurikulum->angkatan) < 2018 && $nangka > 75 && $nangka <= 79){
                        $nhuruf = 'B+';
                    }else{
                        $nhuruf = 'B';
                    }
                    $nipk += 3 * $item->sks_mata_kuliah;
                    $indexvsks = 3 * $item->sks_mata_kuliah;
                    $index = 3;
                }elseif($nangka > 79 && $nangka<= 100){
                    $nhuruf = 'A';
                    $nipk += 4 * $item->sks_mata_kuliah;
                    $indexvsks = 4 * $item->sks_mata_kuliah;
                    $index = 4;
                }else{
                    $nhuruf = 'E';
                    $nipk += 0 * $item->sks_mata_kuliah;
                    $index = 5;
                }

                if($item->tipe_mata_kuliah == 'praktek' || $item->tipe_mata_kuliah == 'skripsi' ||$item->tipe_mata_kuliah == 'seminar' ||$item->tipe_mata_kuliah == 'pkl'){
                    $sksteori = 0; 
                    $skspraktek = $item->sks_mata_kuliah;
                    $jumlahpr = $item->sks_mata_kuliah;
                    
                    $nilaiteoriangka = 0;
                    $nilaiteorimutu = '-';  
                    $nilaipraktekangka = $nangka;
                    $nilaipraktekmutu = $nhuruf;
                    $t_sks_praktek += $item->sks_mata_kuliah;
                    
                }else{
                    $sksteori = $item->sks_mata_kuliah; 
                    $skspraktek = '-';
                    $jumlahpr = $item->sks_mata_kuliah;

                    $nilaiteoriangka = $nangka;
                    $nilaiteorimutu = $nhuruf;  
                    $nilaipraktekangka = "-";
                    $nilaipraktekmutu = '-';
                    $t_sks_teori += $item->sks_mata_kuliah;
                }
                
            }
            $ipk = round($nipk / $sks ,2);
        }else{
            $ipk = 0;
        }

        return $ipk;
    }

}
