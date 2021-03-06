<?php
namespace App\Http\Controllers;
use App\AngkatanModel;
use App\IkatanKerjaSdmModel;
use App\JenisPegawaiModel;
use App\KelasModel;
use App\MahasiswaModel;
use App\PangkatGolonganModel;
use App\SemesterModel;
use App\SoalUjianModel;
use App\StatusKeaktifanPegawaiModel;
use App\StatusMahasiswaModel;
use App\SumberGajiModel;
use App\TahunAjaranModel;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\ DosenModel;
use App\PekerjaanModel;
use App\AgamaModel;
use App\KebutuhanKhususModel;
use App\DosenKebutuhanModel;
use App\DosenKeluargaModel;
use App\StatusPegawaiModel;
use App\JurusanModel;
use App\PenugasanModel;
use App\RiwayatPendidikanModel;
use App\RiwayatSertifikasiModel;
use App\RiwayatPenelitianModel;
use App\RiwayatFungsionalModel;
use App\PengangkatanModel;
use phpDocumentor\Reflection\Types\Array_;
use Yajra\DataTables\DataTables;
use File;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
                    

class Dosen extends Controller
{
    static $Tableshow = ["id" => ["table" => ["tablename" =>"null" , "field"=> "id"] , "record"=>"Id"],
        "row_status" => ["table" => ["tablename" =>"null" , "field"=> "row_status"] , "record"=>"Row_status"],
        ];
    static $html = ["id"=>["type"=>"null" , "value"=>"null" , "validation" => ""] ,
"row_status"=>["type"=>"null" , "value"=>"null" , "validation" => ""] ,
];
    static $exclude = ["id","created_at","updated_at","created_by","update_by"];
    static $tablename = "Dosen";

    static $bio_websevice = [
        'bio' => [
            'id_dosen' => 'id_dosen',
            'nama'=> 'nama_dosen',
            'tempat_lahir' =>'tempat_lahir',
            'tanggal_lahir' =>'tanggal_lahir',
            'jenis_kelamin'=>'jenis_kelamin',
            'agama' =>'id_agama',
            'status_pegawai'=>'id_status_aktif',
            'nidn_nup_nidk'=>'nidn',
            'nama_ibu'=>'nama_ibu',
            'nik'=>'nik',
            'nip'=>'nip',
            'npwp'=>'npwp',
            'jenis_pegawai'=>'id_jenis_sdm',
            'no_sk_cpns'=>'no_sk_cpns',
            'tanggal_sk_cpns'=>'tanggal_sk_cpns',
            'no_sk_pengangkatan'=>'no_sk_pengangkatan',
            'tgl_sk_pengangkatan'=>'mulai_sk_pengangkatan',
            'lembaga_pengangkatan'=>'id_lembaga_pengangkatan',
            'pangkat_golongan'=>'id_pangkat_golongan',
            'sumber_gaji'=>'id_sumber_gaji',
            'alamat'=>'jalan',
            'dusun'=>'dusun',
            'rt'=>'rt',
            'rw'=>'rw',
            'kelurahan'=>'ds_kel',
            'kode_pos'=>'kode_pos',
            'id_wilayah'=>'id_wilayah',
            'telepon'=>'telepon',
            'no_hp'=>'handphone',
            'email'=>'email'
        ],
        'pernikahan'=> [
            'status_pernikahan'=>'status_pernikahan',
            'nama_pasangan'=>'nama_suami_istri',
            'nip_pasangan'=>'nip_suami_istri',
            'tmt_pns'=>'tanggal_mulai_pns',
            'pekerjaan'=>'id_pekerjaan_suami_istri'
        ]
];

static $service_penugasan = [
                    'id_registrasi_dosen' =>'id_registrasi_dosen',
                    'id_dosen' => 'id_dosen',
                    'tahun_ajran' => 'id_tahun_ajaran',
                    'id_perguruan_tinggi'=>'id_perguruan_tinggi',
                    'program_studi_id'=>'id_prodi',
                    'no_surat_tugas'=>'nomor_surat_tugas',
                    'tanggal_surat_tugas'=>'tanggal_surat_tugas',
                    'tmt_surat_tugas' => 'mulai_surat_tugas'
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

    public function sinc(){
        
        $token = $this->check_auth_siakad();

        $data = array('act'=>"DetailBiodataDosen" , "token"=>$token, "filter"=> "","limit"=>"" , "offset" =>0);
        $result_string = $this->runWS($data, 'json');
        $result = json_decode($result_string , true);
        if(!$result){
            $this->sinkron_log('sync_dosen','gagal', 0);

            return json_encode(array('status' => 'error' , 'msg' => 'Terjadi kesalahan mensinkronkan data, silahkan coba lagi.'));
        }
        if(array_key_exists('data' , $result)){
            DB::beginTransaction();
            try{
                foreach($result['data'] as $item){
                    $service_data = [];
                    foreach(static::$bio_websevice as $key=>$val){
                        foreach(static::$bio_websevice[$key] as $key2=>$val2){
                            $service_data[$key][$key2] = $item[$val2];
                        }
                    }
                    $dosen_id = DosenModel::updateOrCreate(array('id_dosen' => $service_data['bio']['id_dosen']), $service_data['bio']);
                    DosenKeluargaModel::updateOrCreate(array('dosen_id' => $dosen_id->id) , $service_data['pernikahan']);
                }
                DB::commit();
                $this->sinkron_log('sync_dosen','sukses', count($result['data']));
                DB::table('sinkronisasi_logs')
                ->insert(array('title' => 'DetailBiodataDosen' ,'created_by'=> Auth::user()->id ,'created_at'=>date('Y-m-d H:i:s')));
                return json_encode(array('status' => 'success' , 'msg' => 'Data Berhasil Disinkronisai.'));
            } catch(\Exception $e){
                DB::rollBack();
                throw $e;
                return json_encode(array('status' => 'error' , 'msg' => 'Terjadi kesalahan mensinkronkan data, silahkan coba lagi.'));
            }
        

        }
        
    }

    public function sinc_penugasan(){
        
        $token = $this->check_auth_siakad();
        //echo $token; exit;
        $data = array('act'=>"GetListPenugasanDosen" , "token"=>$token, "filter"=> "","limit"=>"2" , "offset" =>0);
        $result_string = $this->runWS($data, 'json');
        $result = json_decode($result_string , true);
        //print_r($result ); exit;
        if(array_key_exists('data' , $result)){
            //DB::beginTransaction();
            //    try{
            foreach($result['data'] as $item){
                
                    $service_data = [];
                    foreach(static::$service_penugasan as $key=>$val){
                        foreach(static::$service_penugasan[$key] as $key2=>$val2){
                            $service_data[$key][$key2] = $item[$val2];
                        }
                    }
                    $dosen_id = DosenModel::updateOrCreate(array('id_dosen' => $service_data['bio']['id_dosen']), $service_data['bio']);
                    DosenKeluargaModel::updateOrCreate(array('dosen_id' => $dosen_id->id) , $service_data['pernikahan']);
                    
                    
                }
                DB::table('sinkronisasi_logs')
                ->insert(array('title' => 'DetailBiodataDosen' ,'created_by'=> Auth::user()->id ,'created_at'=>date('Y-m-d H:i:s')));
                return json_encode(array('status' => 'success' , 'msg' => 'Data Berhasil Disinkronisai.'));
                //DB::commit();
            //} catch(\Exception $e){
            //    DB::rollBack(); 
            //    throw $e;
            //    return json_encode(array('status' => 'error' , 'msg' => 'Terjadi kesalahan mensinkronkan data, silahkan coba lagi.'));
            //}  
        
        }
        
    }

    public function index()
    {
        
        $data = DosenModel::get();
        $title = ucfirst(request()->segment(1))." ".ucfirst(request()->segment(2));
        $tableid = "Dosen";
        $table_display = DB::getSchemaBuilder()->getColumnListing("dosen");
        $exclude = static::$exclude;
        $Tableshow = static::$Tableshow;

        $master = array(
            'agama' => AgamaModel::where('row_status' , 'active')->get(),
            'status' => StatusPegawaiModel::where('row_status' , 'active')->get(),
        );

        return view("data/dosen" , compact("data" , "title" ,"table_display" ,"exclude" ,"Tableshow","tableid", "master"));


    }
    public function create(){
        $master = array(
            'pekerjaan' => PekerjaanModel::where('row_status' , 'active')->get(),
            'kebutuhan' => KebutuhanKhususModel::where('row_status' , 'active')->get(),
            'status_pegawai' => StatusPegawaiModel::where('row_status' , 'active')->get(),
            'agama' => AgamaModel::where('row_status' , 'active')->get(),
            'sumber_gaji'=> SumberGajiModel::where('row_status', 'active')->get(),
            'ikatan_kerja_sdm' => IkatanKerjaSdmModel::where('row_status', 'active')->get(),
            'status_keaktifan'=>StatusKeaktifanPegawaiModel::where('row_status', 'active')->get(),
            'jenis_pegawai'=>JenisPegawaiModel::where('row_status', 'active')->get()
        );
        $title = "Tambah ".ucfirst(request()->segment(1))." ".ucfirst(request()->segment(2));
        $table = array_diff(DB::getSchemaBuilder()->getColumnListing("dosen"), static::$exclude);
        $exclude = static::$exclude;
        $Tableshow = static::$Tableshow;
        $html = static::$html;
        $column = 1;
        return view("data/dosen_create" , compact("table" ,"exclude" , "Tableshow" , "title" , "html", "column" , "master"));

    }

    public function validatewizard(Request $request){
        //print_r($request->all()); exit;
        $data = $request->all();

        if(isset($data['step'])){
            if($data['step'] == '1'){
                $validation = Validator::make($data['dosen'], [
                    'nama' => 'required',
                    'email' => 'required | email | unique:dosen',
                    'nidn_nup_nidk' => 'required'
                ]);
            }elseif($data['step'] == '2'){
//                $validation = Validator::make($data['dosen'], [
//                    'nik' => 'required',
//                    'kewarganegaraan' => 'required',
//                    'alamat' => 'required'
//                ]);
            }else{
                $validation = Validator::make($data['dosen'], [

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


    public function save(Request $request){
        $data = $request->all();

         //print_r($data); exit;
        
        $validation = Validator::make($data['dosen'], [
            'nama' => '',
            'nidn_nup_nidk' => '',
            'tempat_lahir' => '',
            'agama' => ''
        ]);

        if ($validation->fails()) {
            return json_encode(['status'=> 'false', 'message'=> $validation->messages()]);
        }
        DB::beginTransaction();
        try{

            if(array_key_exists('dosen' , $data)){
                // SAVE TO TABLE mahasiswa
                $password = $this->generate_password();
                $data['dosen']['password'] = $password['hash'];
                if($data['dosen']['tanggal_lahir'] != '' && $data['dosen']['tanggal_lahir'] != null){
                    $data['dosen']['tanggal_lahir'] = date($data['dosen']['tanggal_lahir']);
                }
                $this->send_password_mail($data['dosen']['email'],$data['dosen']['nama'], $password['pass']);
                $dosenid = DosenModel::create($data['dosen']);
            }

            if($dosenid->id != ''){
                if(array_key_exists('keluarga' , $data)){
                    // SAVE TO TABLE mahasiswa
                    $data['keluarga']['dosen_id'] = $dosenid->id;
                    DosenKeluargaModel::create($data['keluarga']);
                }
                
                // SAVE TO TABLE mahasiswa_kebutuhan_khusus
                $data_kebutuhan_khusus = array(
                    'dosen_id' => $dosenid->id,
                    'row_status' => 'active',
                    'created_by' => 1,
                    'updated_by' => 1,
                    'kebutuhan_khusus' => array_key_exists('dosen_kh' , $data) ? json_encode(array('dosen' => $data['dosen_kh'])) : json_encode(array('dosen' =>[])),
                    'braile'=> $data['braile'],
                    'isyarat' => $data['isyarat'],
                );
                DosenKebutuhanModel::create($data_kebutuhan_khusus);
                
            }
            

            DB::commit();
            return json_encode(array('status' => 'success' , 'message' => 'Data berhasil disimpan.'));
        } catch(\Exception $e){
            
            DB::rollBack(); 
            //throw $e;
            return json_encode(array('status' => 'error' , 'message' => 'Terjadi kesalahan saat menyimpan, silahkan coba lagi.'));
        }

    }

    public function edit(Request $request){

    }

    public function update(Request $request){
        $data = $request->all();
        $id = $data['dosen']['id'];
        unset($data['dosen']['id']);
        $validation = Validator::make($data['dosen'], [
            'nama' => '',
            'nidn_nup_nidk' => '',
            'tempat_lahir' => '',
            'agama' => ''
        ]);
        if ($validation->fails()) {
            return json_encode(['status'=> 'false', 'message'=> $validation->messages()]);
        }

        if($id != ''){
            DB::beginTransaction();
            try{

                if(array_key_exists('dosen' , $data)){
                    $data['dosen']['tanggal_lahir'] = date($data['dosen']['tanggal_lahir']);
                    DosenModel::where('id' , $id)->update($data['dosen']);
                }

                
                if(array_key_exists('keluarga' , $data)){
                    DosenKeluargaModel::where('dosen_id' , $id)->update($data['keluarga']);
                }
                
                // SAVE TO TABLE mahasiswa_kebutuhan_khusus
                $data_kebutuhan_khusus = array(
                    'row_status' => 'active',
                    'created_by' => 1,
                    'updated_by' => 1,
                    'kebutuhan_khusus' => array_key_exists('dosen_kh' , $data) ? json_encode(array('dosen' => $data['dosen_kh'])) : json_encode(array('dosen' =>[])),
                    'braile'=> $data['braile'],
                    'isyarat' => $data['isyarat'],
                );
                DosenKebutuhanModel::where('dosen_id' , $id)->update($data_kebutuhan_khusus);

                DB::commit();
                return json_encode(array('status' => 'success' , 'msg' => 'Data berhasil disimpan.'));
            } catch(\Exception $e){
                
                DB::rollBack(); 
                //throw $e;
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
                $mahasiswa = DosenModel::where('id' , $id)->update(["row_status"=>"deleted"]);

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
        //$data = DosenModel::select('email' ,'nama')->where('id' ,$id)->first();
        //$this->send_password_mail($data->email,$data->nama, $password['password']);
        if($id != '' || $id != null){
            if(DosenModel::where('id' ,$id)->update($password)){
                return json_encode(["status"=> true, "message"=> $new_password]);
            }else{
                return json_encode(["status"=> false, "message"=> "Terjadi kesalahan saat mengubah data."]);
            }
        }else{
            return json_encode(["status"=> false, "message"=> "Terjadi kesalahan saat mengubah data."]);
        }
        
    }

    public function paging(Request $request){
        return Datatables::of(DosenModel::where("dosen.row_status", "active")
            ->leftJoin('master_agama', 'dosen.agama', '=', 'master_agama.id')
            ->leftJoin('master_status_keaktifan_pegawai','master_status_keaktifan_pegawai.id', 'dosen.status_pegawai')
        ->select("dosen.id" ,"master_agama.title as t_agama","nip" ,"nidn_nup_nidk", "agama" , "dosen.status","master_status_keaktifan_pegawai.title as status_pegawai","nama","tanggal_lahir","jenis_kelamin")->get())->addIndexColumn()->make(true);
    }

    public function view($id){

        $master = array(
            'kebutuhan' => KebutuhanKhususModel::where('row_status' , 'active')->get(),
            'agama' => AgamaModel::where('row_status' , 'active')->get(),
            'pekerjaan' => PekerjaanModel::where('row_status' , 'active')->get(),
            'status_pegawai' => StatusPegawaiModel::where('row_status' , 'active')->get(),
            'jenis_kelamin' => config('global.jenis_kelamin'),
            'status_keaktifan'=>StatusKeaktifanPegawaiModel::where('row_status', 'active')->get(),
            'jenis_pegawai'=>JenisPegawaiModel::where('row_status', 'active')->get()
        );

        $data = DosenModel::leftJoin('master_agama', 'master_agama.id', '=', 'dosen.agama')
            ->leftJoin('dosen_keluarga' , 'dosen_keluarga.dosen_id' ,'=' , 'dosen.id')
            ->leftJoin('dosen_kebutuhan_khusus' , 'dosen_kebutuhan_khusus.dosen_id' , '=' , 'dosen.id')
            ->leftJoin('master_status_keaktifan_pegawai','master_status_keaktifan_pegawai.id','dosen.status_pegawai')
            ->select('dosen.*','dosen_keluarga.pekerjaan' ,'master_status_keaktifan_pegawai.title as status_keaktifan','dosen_keluarga.tmt_pns' ,'dosen_keluarga.nip_pasangan','dosen_keluarga.nama_pasangan','dosen_keluarga.status_pernikahan', 'master_agama.title' , 'dosen_kebutuhan_khusus.kebutuhan_khusus' , 'dosen_kebutuhan_khusus.braile' , 'dosen_kebutuhan_khusus.isyarat')
            ->where('dosen.id' , $id)->first();

        $title = ucfirst(request()->segment(1))." ".ucfirst(request()->segment(2));
        $tableid = "Mahasiswa";
        return view("data/dosen_view" , compact("data","master"));
    }



    public function penugasan($id){
        $master = array(
            'jurusan' => JurusanModel::where('row_status' , 'active')->get(),
            'kebutuhan' => KebutuhanKhususModel::where('row_status' , 'active')->get(),
            'agama' => AgamaModel::where('row_status' , 'active')->get(),
            'pekerjaan' => PekerjaanModel::where('row_status' , 'active')->get(),
            'status_pegawai' => StatusPegawaiModel::where('row_status' , 'active')->get(),
            'jenis_kelamin' => config('global.jenis_kelamin'),
            'tahun_ajaran' => TahunAjaranModel::where('row_status' , 'active')
                ->orderBy('id','desc')
                ->get()
        );
        $penugasan = PenugasanModel::leftJoin('master_jurusan' , 'master_jurusan.id','=', 'dosen_penugasan.program_studi_id')
        ->join('master_tahun_ajaran' , 'master_tahun_ajaran.id' , '=' , 'dosen_penugasan.tahun_ajaran')
        ->select('dosen_penugasan.*' , 'master_jurusan.title as program_studi_title' ,'master_tahun_ajaran.title as tahun_ajaran_title')
        ->where('dosen_penugasan.dosen_id' , $id)->where('dosen_penugasan.row_status' , 'active')->get();

        $data = DosenModel::join('master_agama', 'master_agama.id', '=', 'dosen.agama')
            ->leftJoin('master_status_keaktifan_pegawai','master_status_keaktifan_pegawai.id','dosen.status_pegawai')
            ->select('dosen.*','master_status_keaktifan_pegawai.title as status_keaktifan','master_agama.title')
            ->where('dosen.id' , $id)->first();

        return view('/data/dosen_penugasan' , compact('data' , 'master' , 'penugasan'));
    }

    public function tambahpenugasan(Request $request){
        
        $data = $request->all();
        $validation = Validator::make($data, [
            'dosen_id' => 'required',
            'tahun_ajaran' => 'required',
            'program_studi_id' => 'required',
            'no_surat_tugas' => 'required',
            'tanggal_surat_tugas' => 'required',
            'tmt_surat_tugas' => 'required'
        ]);
        
        if ($validation->fails()) {
            return json_encode(['status'=> 'error', 'msg'=> $validation->messages()]);
        }
        unset($data['id_penugasan']);
        if(PenugasanModel::create($data)){
            return json_encode(['status'=> 'success', 'msg'=> 'Data berhasil ditambahkan']);
        }else{
            return json_encode(['status'=> 'error', 'msg'=> 'Terjadi kesalahan saat menyimpan data.']);
        }
        
    }

    public function pengangkatan($id){
        $master = array(
            'jurusan' => JurusanModel::where('row_status' , 'active')->get(),
            'kebutuhan' => KebutuhanKhususModel::where('row_status' , 'active')->get(),
            'agama' => AgamaModel::where('row_status' , 'active')->get(),
            'pekerjaan' => PekerjaanModel::where('row_status' , 'active')->get(),
            'status_pegawai' => StatusPegawaiModel::where('row_status' , 'active')->get(),
            'jenis_kelamin' => config('global.jenis_kelamin')
        );
        $pengangkatan = PengangkatanModel::where('dosen_riwayat_kepangkatan.dosen_id' , $id)->where('dosen_riwayat_kepangkatan.row_status' , 'active')->get();

        $data = DosenModel::join('master_agama', 'master_agama.id', '=', 'dosen.agama')
            ->leftJoin('master_status_keaktifan_pegawai','master_status_keaktifan_pegawai.id','dosen.status_pegawai')
            ->select('dosen.*','master_status_keaktifan_pegawai.title as status_keaktifan','master_agama.title')
            ->where('dosen.id' , $id)->first();

        return view('/data/dosen_kepangkatan' , compact('data' , 'master' , 'pengangkatan'));
    }

    public function tambahkepangkatan(Request $request){

        $data = $request->all();

        $validation = Validator::make($data, [
            'dosen_id' => 'required',
            'pangkat' => 'required',
            'sk_pangkat' => 'required',
            'tanggal_sk_pangkat' => 'required',
            'tmt_sk_pangkat' => 'required',
            'masa_kerja_bulan' => 'required',
            'masa_kerja_tahun' => 'required'
        ]);
        $penugasan_id = $data['id_kepangkatan'];
        unset($data['id_kepangkatan']);

        if ($validation->fails()) {
            return json_encode(['status'=> 'error', 'msg'=> $validation->messages()]);
        }

        if($penugasan_id == '' || $penugasan_id == null){
            if(PengangkatanModel::create($data)){
                return json_encode(['status'=> 'success', 'msg'=> 'Data berhasil ditambahkan']);
            }else{
                return json_encode(['status'=> 'error', 'msg'=> 'Terjadi kesalahan saat menyimpan data.']);
            }
        }else{
            if(PengangkatanModel::where('id' , $penugasan_id)->update($data)){
                return json_encode(['status'=> 'success', 'msg'=> 'Data berhasil disimpan']);
            }else{
                return json_encode(['status'=> 'error', 'msg'=> 'Terjadi kesalahan saat menyimpan data.']);
            }

        }
        
    }

    public function r_pendidikan($id){
        $master = array(
            'jurusan' => JurusanModel::where('row_status' , 'active')->get(),
            'kebutuhan' => KebutuhanKhususModel::where('row_status' , 'active')->get(),
            'agama' => AgamaModel::where('row_status' , 'active')->get(),
            'pekerjaan' => PekerjaanModel::where('row_status' , 'active')->get(),
            'status_pegawai' => StatusPegawaiModel::where('row_status' , 'active')->get(),
            'jenis_kelamin' => config('global.jenis_kelamin')
        );
        $pendidikan = RiwayatPendidikanModel::where('dosen_riwayat_pendidikan.dosen_id' , $id)->where('dosen_riwayat_pendidikan.row_status' , 'active')->get();

        $data = DosenModel::join('master_agama', 'master_agama.id', '=', 'dosen.agama')
            ->leftJoin('master_status_keaktifan_pegawai','master_status_keaktifan_pegawai.id','dosen.status_pegawai')
            ->select('dosen.*','master_status_keaktifan_pegawai.title as status_keaktifan','master_agama.title')
            ->where('dosen.id' , $id)->first();

        return view('/data/dosen_pendidikan' , compact('data' , 'master' , 'pendidikan'));
    }

    public function tambah_r_pendidikan(Request $request){
        $data = $request->all();
        $validation = Validator::make($data, [
            'bidang_studi' => 'required',
            'jenjang' => 'required',
            'gelar' => 'required',
            'perguruan_tinggi' => 'required',
            'fakultas' => 'required',
            'tahun_lulus' => 'required',
            'sks' => 'required',
            'ipk' => 'required'
        ]);

        $pendidikan_id = $data['id_pendidikan'];
        unset($data['id_pendidikan']);

        if ($validation->fails()) {
            return json_encode(['status'=> 'error', 'msg'=> $validation->messages()]);
        }

        if($pendidikan_id == '' || $pendidikan_id == null){
            if(RiwayatPendidikanModel::create($data)){
                return json_encode(['status'=> 'success', 'msg'=> 'Data berhasil ditambahkan']);
            }else{
                return json_encode(['status'=> 'error', 'msg'=> 'Terjadi kesalahan saat menyimpan data.']);
            }
        }else{
            if(RiwayatPendidikanModel::where('id' , $pendidikan_id)->update($data)){
                return json_encode(['status'=> 'success', 'msg'=> 'Data berhasil disimpan']);
            }else{
                return json_encode(['status'=> 'error', 'msg'=> 'Terjadi kesalahan saat menyimpan data.']);
            }
        }
    }

    public function r_sertifikasi($id){
        $master = array(
            'jurusan' => JurusanModel::where('row_status' , 'active')->get(),
            'kebutuhan' => KebutuhanKhususModel::where('row_status' , 'active')->get(),
            'agama' => AgamaModel::where('row_status' , 'active')->get(),
            'pekerjaan' => PekerjaanModel::where('row_status' , 'active')->get(),
            'status_pegawai' => StatusPegawaiModel::where('row_status' , 'active')->get(),
            'jenis_kelamin' => config('global.jenis_kelamin')
        );
        $sertifikasi = RiwayatSertifikasiModel::where('dosen_riwayat_sertifikasi.dosen_id' , $id)->where('dosen_riwayat_sertifikasi.row_status' , 'active')->get();

        $data = DosenModel::join('master_agama', 'master_agama.id', '=', 'dosen.agama')
            ->leftJoin('master_status_keaktifan_pegawai','master_status_keaktifan_pegawai.id','dosen.status_pegawai')
            ->select('dosen.*','master_status_keaktifan_pegawai.title as status_keaktifan','master_agama.title')
            ->where('dosen.id' , $id)->first();

        return view('/data/dosen_sertifikasi' , compact('data' , 'master' , 'sertifikasi'));
    }

    public function tambah_r_sertifikasi(Request $request){
        $data = $request->all();
        $validation = Validator::make($data, [
            'nomor' => 'required',
            'bidang_studi' => 'required',
            'jenis_sertifikasi' => 'required',
            'tahun_sertifikasi' => 'required',
            'no_sk_sertifikasi' => 'required'
        ]);

        $sertifikasi_id = $data['id_sertifikasi'];
        unset($data['id_sertifikasi']);

        if ($validation->fails()) {
            return json_encode(['status'=> 'error', 'msg'=> $validation->messages()]);
        }

        if($sertifikasi_id == '' || $sertifikasi_id == null){
            if(RiwayatSertifikasiModel::create($data)){
                return json_encode(['status'=> 'success', 'msg'=> 'Data berhasil ditambahkan']);
            }else{
                return json_encode(['status'=> 'error', 'msg'=> 'Terjadi kesalahan saat menyimpan data.']);
            }
        }else{
            if(RiwayatSertifikasiModel::where('id' , $sertifikasi_id)->update($data)){
                return json_encode(['status'=> 'success', 'msg'=> 'Data berhasil disimpan']);
            }else{
                return json_encode(['status'=> 'error', 'msg'=> 'Terjadi kesalahan saat menyimpan data.']);
            }
        }
    }

    public function r_penelitian($id){
        $master = array(
            'jurusan' => JurusanModel::where('row_status' , 'active')->get(),
            'kebutuhan' => KebutuhanKhususModel::where('row_status' , 'active')->get(),
            'agama' => AgamaModel::where('row_status' , 'active')->get(),
            'pekerjaan' => PekerjaanModel::where('row_status' , 'active')->get(),
            'status_pegawai' => StatusPegawaiModel::where('row_status' , 'active')->get(),
            'jenis_kelamin' => config('global.jenis_kelamin')
        );
        $penelitian = RiwayatPenelitianModel::where('dosen_riwayat_penelitian.dosen_id' , $id)->where('dosen_riwayat_penelitian.row_status' , 'active')->get();

        $data = DosenModel::join('master_agama', 'master_agama.id', '=', 'dosen.agama')
            ->leftJoin('master_status_keaktifan_pegawai','master_status_keaktifan_pegawai.id','dosen.status_pegawai')
            ->select('dosen.*','master_status_keaktifan_pegawai.title as status_keaktifan','master_agama.title')
            ->where('dosen.id' , $id)->first();
        return view('/data/dosen_penelitian' , compact('data' , 'master' , 'penelitian'));
    }

    public function tambah_r_penelitian(Request $request){
        $data = $request->all();
        $validation = Validator::make($data, [
            'judul_penelitian' => 'required',
            'bidang_ilmu' => 'required',
            'lembaga' => 'required',
            'tahun' => 'required',
        ]);

        $penelitian_id = $data['id_penelitian'];
        unset($data['id_penelitian']);

        if ($validation->fails()) {
            return json_encode(['status'=> 'error', 'msg'=> $validation->messages()]);
        }

        if($penelitian_id == '' || $penelitian_id == null) {
            if (RiwayatPenelitianModel::create($data)) {
                return json_encode(['status' => 'success', 'msg' => 'Data berhasil ditambahkan']);
            } else {
                return json_encode(['status' => 'error', 'msg' => 'Terjadi kesalahan saat menyimpan data.']);
            }
        }else{
            if(RiwayatPenelitianModel::where('id' , $penelitian_id)->update($data)){
                return json_encode(['status'=> 'success', 'msg'=> 'Data berhasil disimpan']);
            }else{
                return json_encode(['status'=> 'error', 'msg'=> 'Terjadi kesalahan saat menyimpan data.']);
            }
        }
    }

    public function r_fungsional($id){
        $master = array(
            'jurusan' => JurusanModel::where('row_status' , 'active')->get(),
            'kebutuhan' => KebutuhanKhususModel::where('row_status' , 'active')->get(),
            'agama' => AgamaModel::where('row_status' , 'active')->get(),
            'pekerjaan' => PekerjaanModel::where('row_status' , 'active')->get(),
            'status_pegawai' => StatusPegawaiModel::where('row_status' , 'active')->get(),
            'jenis_kelamin' => config('global.jenis_kelamin')
        );
        $fungsional = RiwayatFungsionalModel::where('dosen_riwayat_fungsional.dosen_id' , $id)->where('dosen_riwayat_fungsional.row_status' , 'active')->get();

        $data = DosenModel::join('master_agama', 'master_agama.id', '=', 'dosen.agama')
            ->leftJoin('master_status_keaktifan_pegawai','master_status_keaktifan_pegawai.id','dosen.status_pegawai')
            ->select('dosen.*','master_status_keaktifan_pegawai.title as status_keaktifan','master_agama.title')
            ->where('dosen.id' , $id)->first();
        return view('/data/dosen_fungsional' , compact('data' , 'master' , 'fungsional'));
    }

    public function tambah_r_fungsional(Request $request){
        
        $data = $request->all();
        $validation = Validator::make($data, [
            'jabatan' => 'required',
            'sk_jabatan' => 'required',
            'tmt_jabatan' => 'required'
        ]);

        $fungsional_id = $data['id_fungsional'];
        unset($data['id_fungsional']);

        if ($validation->fails()) {
            return json_encode(['status'=> 'error', 'msg'=> $validation->messages()]);
        }

        if($fungsional_id == '' || $fungsional_id == null){
            if(RiwayatFungsionalModel::create($data)){
                return json_encode(['status'=> 'success', 'msg'=> 'Data berhasil ditambahkan']);
            }else{
                return json_encode(['status'=> 'error', 'msg'=> 'Terjadi kesalahan saat menyimpan data.']);
            }
        }else{
            if(RiwayatFungsionalModel::where('id' , $fungsional_id)->update($data)){
                return json_encode(['status'=> 'success', 'msg'=> 'Data berhasil disimpan']);
            }else{
                return json_encode(['status'=> 'error', 'msg'=> 'Terjadi kesalahan saat menyimpan data.']);
            }

        }
        
    }

    public  function modaleditadmin(request $request){
        $post = $request->all();
        if($post['type'] == 'penugasan'){
            if($post['status'] == 'delete'){
                $data['row_status'] = 'deleted';
                if(PenugasanModel::where('id' , $post['id'])->update($data)){
                    return json_encode(['status'=> 'success', 'message'=> 'Data berhasil dihapus']);
                }else{
                    return json_encode(['status'=> 'error', 'message'=> 'Terjadi kesalahan saat menghapus data.']);
                }
            }
            $data = PenugasanModel::where('id' , $post['id'])->first();
            return collect($data);
        }else if($post['type'] == 'fungsional'){
            if($post['status'] == 'delete'){
                $data['row_status'] = 'deleted';
                if(RiwayatFungsionalModel::where('id' , $post['id'])->update($data)){
                    return json_encode(['status'=> 'success', 'message'=> 'Data berhasil dihapus']);
                }
                return json_encode(['status'=> 'error', 'message'=> 'Terjadi kesalahan saat menghapus data.']);
            }
            $data = RiwayatFungsionalModel::where('id' , $post['id'])->first();
            return collect($data);
        }else if($post['type'] == 'kepangkatan'){
            if($post['status'] == 'delete'){
                $data['row_status'] = 'deleted';
                if(PengangkatanModel::where('id' , $post['id'])->update($data)){
                    return json_encode(['status'=> 'success', 'message'=> 'Data berhasil dihapus']);
                }
                return json_encode(['status'=> 'error', 'message'=> 'Terjadi kesalahan saat menghapus data.']);
            }
            $data = PengangkatanModel::where('id' , $post['id'])->first();
            return collect($data);
        }else if($post['type'] == 'pendidikan'){
            if($post['status'] == 'delete'){
                $data['row_status'] = 'deleted';
                if(RiwayatPendidikanModel::where('id' , $post['id'])->update($data)){
                    return json_encode(['status'=> 'success', 'message'=> 'Data berhasil dihapus']);
                }
                return json_encode(['status'=> 'error', 'message'=> 'Terjadi kesalahan saat menghapus data.']);
            }
            $data = RiwayatPendidikanModel::where('id' , $post['id'])->first();
            return collect($data);
        }else if($post['type'] == 'sertifikasi'){
            if($post['status'] == 'delete'){
                $data['row_status'] = 'deleted';
                if(RiwayatSertifikasiModel::where('id' , $post['id'])->update($data)){
                    return json_encode(['status'=> 'success', 'message'=> 'Data berhasil dihapus']);
                }
                return json_encode(['status'=> 'error', 'message'=> 'Terjadi kesalahan saat menghapus data.']);
            }
            $data = RiwayatSertifikasiModel::where('id' , $post['id'])->first();
            return collect($data);
        }else if($post['type'] == 'penelitian'){
            if($post['status'] == 'delete'){
                $data['row_status'] = 'deleted';
                if(RiwayatPenelitianModel::where('id' , $post['id'])->update($data)){
                    return json_encode(['status'=> 'success', 'message'=> 'Data berhasil dihapus']);
                }
                return json_encode(['status'=> 'error', 'message'=> 'Terjadi kesalahan saat menghapus data.']);
            }
            $data = RiwayatPenelitianModel::where('id' , $post['id'])->first();
            return collect($data);
        }

    }

    public function getdosen_select2(){
        $data = DosenModel::where('row_status' , 'active')
            ->select("id as value", DB::raw("CONCAT(nik,' - ',nama) as text"))
            ->get();

        return json_encode($data);
    }

    public function grafik_dosen(){
        $data = DosenModel::where('row_status','active')
            ->select('jenis_kelamin as label', DB::raw('count(id) as value'))
            ->groupBy('jenis_kelamin')->get();

        $count = DosenModel::where('row_status','active')->count();

        return json_encode(["count" => $count, "data"=>$data]);
    }

    public function grafik_jenis(){
        $data = DosenModel::where('dosen.row_status','active')
            ->join('master_jenis_pegawai','master_jenis_pegawai.id', '=', 'dosen.jenis_pegawai')
            ->select('master_jenis_pegawai.title as label', DB::raw('count(dosen.id) as value'))
            ->groupBy('master_jenis_pegawai.title')->get();

        $count = DosenModel::where('row_status','active')->count();

        return json_encode(["count" => $count, "data"=>$data]);
    }

    public function grafik_status(){
        $data = DosenModel::where('dosen.row_status','active')
            ->join('master_status_keaktifan_pegawai', 'master_status_keaktifan_pegawai.id', '=', 'dosen.status_pegawai')
            ->select('master_status_keaktifan_pegawai.title as label', DB::raw('count(dosen.id) as value'))
            ->groupBy('master_status_keaktifan_pegawai.title')->get();

        $count = DosenModel::where('row_status','active')->count();

        return json_encode(["count" => $count, "data"=>$data]);
    }

    public function pembimbing($id){
        
        $master = array(
            'jurusan' => JurusanModel::where('row_status' , 'active')->get(),
            'kebutuhan' => KebutuhanKhususModel::where('row_status' , 'active')->get(),
            'agama' => AgamaModel::where('row_status' , 'active')->get(),
            'pekerjaan' => PekerjaanModel::where('row_status' , 'active')->get(),
            'status_pegawai' => StatusPegawaiModel::where('row_status' , 'active')->get(),
            'jenis_kelamin' => config('global.jenis_kelamin')
        );

        $idTable ="tbl_mhs_tugas_akhir_pembimbing";
        $title = "Daftar Pembimbing Dosen";
        $page = "Pembimbing";

        $data = DosenModel::join('master_agama', 'master_agama.id', '=', 'dosen.agama')
            ->leftJoin('master_status_keaktifan_pegawai','master_status_keaktifan_pegawai.id','dosen.status_pegawai')
            ->select('dosen.*','master_status_keaktifan_pegawai.title as status_keaktifan','master_agama.title')
            ->where('dosen.id' , $id)->first();
        return view('/data/dosen_tugas_akhir' , compact('data','master','idTable','title','page'));
    }

    public function penguji($id){
        $master = array(
            'jurusan' => JurusanModel::where('row_status' , 'active')->get(),
            'kebutuhan' => KebutuhanKhususModel::where('row_status' , 'active')->get(),
            'agama' => AgamaModel::where('row_status' , 'active')->get(),
            'pekerjaan' => PekerjaanModel::where('row_status' , 'active')->get(),
            'status_pegawai' => StatusPegawaiModel::where('row_status' , 'active')->get(),
            'jenis_kelamin' => config('global.jenis_kelamin')
        );

        $idTable ="tbl_mhs_tugas_akhir_penguji";
        $title = "Daftar Penguji Dosen";
        $page = "Penguji";

        $data = DosenModel::join('master_agama', 'master_agama.id', '=', 'dosen.agama')
            ->leftJoin('master_status_keaktifan_pegawai','master_status_keaktifan_pegawai.id','dosen.status_pegawai')
            ->select('dosen.*','master_status_keaktifan_pegawai.title as status_keaktifan','master_agama.title')
            ->where('dosen.id' , $id)->first();
        return view('/data/dosen_tugas_akhir' , compact('data','master','idTable', 'title','page'));
    }

    public function activity($id){
        $master = array(
            'jurusan' => JurusanModel::where('row_status' , 'active')->get(),
            'kebutuhan' => KebutuhanKhususModel::where('row_status' , 'active')->get(),
            'agama' => AgamaModel::where('row_status' , 'active')->get(),
            'pekerjaan' => PekerjaanModel::where('row_status' , 'active')->get(),
            'status_pegawai' => StatusPegawaiModel::where('row_status' , 'active')->get(),
            'jenis_kelamin' => config('global.jenis_kelamin')
        );

        $idTable ="tbl_dosen_aktivitas_mengajar";

        $data = DosenModel::join('master_agama', 'master_agama.id', '=', 'dosen.agama')
            ->leftJoin('master_status_keaktifan_pegawai','master_status_keaktifan_pegawai.id','dosen.status_pegawai')
            ->select('dosen.*','master_status_keaktifan_pegawai.title as status_keaktifan','master_agama.title')
            ->where('dosen.id' , $id)->first();
        return view('/data/dosen_activity' , compact('data','master','idTable' ));
    }

    public function activity_paging_data(Request $request){
        $post= $request->all();
        $where = ['dosen_id' => $post['dosen_id']];

        return Datatables::of(DB::table('view_aktivitas_mengajar')->where($where)->get())->addIndexColumn()->make(true);
    }

    public function pembimbing_paging(Request $request){
        $post= $request->all();
        $where = ['dosen_id' => $post['dosen_id'], 'row_status' =>'active', "status_dosen"=>"Penguji"];

        return Datatables::of(DB::table('view_tugas_akhir')->where($where)->get())->make(true);
    }

    public function penguji_paging(Request $request){
        $post= $request->all();
        $where = ['dosen_id' => $post['dosen_id'], 'row_status' =>'active', "status_dosen"=>"Penguji"];

        return Datatables::of(DB::table('view_tugas_akhir')->where($where)->get())->make(true);
    }

    public function daftarsoal(){
        $master = array(
            'status' => StatusMahasiswaModel::where('row_status' , 'active')->get(),
            'jurusan' => JurusanModel::where('row_status' , 'active')->get(),
            'angkatan' => MahasiswaModel::where('mahasiswa.row_status' , 'active')
                ->join('master_semester','master_semester.id', '=', 'mahasiswa.id_periode_masuk')
                ->select('master_semester.id_tahun_ajaran')
                ->distinct()
                ->orderBy('id_tahun_ajaran','desc')
                ->get(),
            'kelas' => KelasModel::where('row_status' , 'active')->get(),
            'dosen' => DosenModel::where('row_status', 'active'),
            'semester'=> SemesterModel::where('row_status', 'active')
                ->orderBy('id', 'desc')
                ->get(),
        );

        return view("data/daftar_soal", compact('master'));
    }

    public function paging_soal(Request $request){
        return Datatables::of(SoalUjianModel::where('soal_ujian.row_status', '!=', 'deleted')
            ->join('mata_kuliah', 'mata_kuliah.id', 'soal_ujian.mata_kuliah_id')
            ->join('master_jurusan', 'master_jurusan.id', 'soal_ujian.jurusan_id')
            ->join('master_semester', 'master_semester.id', 'soal_ujian.semester_id')
            ->join('master_kelas', 'master_kelas.id', 'soal_ujian.kelas_id')
            ->join('master_angkatan', 'master_angkatan.id', 'soal_ujian.angkatan_id')
            ->join('dosen', 'dosen.id', 'soal_ujian.dosen_id')
            ->select('soal_ujian.id','soal_ujian.jenis_ujian', 'dosen.nama', 'soal_ujian.nama_file', 'mata_kuliah.kode_mata_kuliah','master_jurusan.title as jurusan','master_angkatan.title as angkatan','mata_kuliah.nama_mata_kuliah', 'master_semester.title as semester', 'master_kelas.title as kelas')
            ->orderBy('soal_ujian.id', 'desc')
            ->get())->addIndexColumn()->make(true);
    }

    public function sinc_penugasan_dosen(){
        $token = $this->check_auth_siakad();
        $data = array('act'=>"GetListPenugasanDosen" , "token"=>$token, "filter"=> "","limit"=>"" , "offset" =>0);
        $result_string = $this->runWS($data, 'json');

        $result = json_decode($result_string , true);
        if(!$result){
            $this->sinkron_log('sync_penugasan','gagal', 0);

            return json_encode(array('status' => 'error' , 'msg' => 'Terjadi kesalahan mensinkronkan data, silahkan coba lagi.'));
        }
        if(array_key_exists('data' , $result)){
            if($result['data']) {
                if (count($result['data']) > 0) {
                    $row_count = 0;
                    DB::beginTransaction();
                    try {
                        foreach ($result['data'] as $item) {
                            $dosen = DosenModel::where('id_dosen', $item['id_dosen'])->first();
                            if ($dosen) {
                                $arr_data = array('dosen_id' => $dosen->id,
                                    'id_registrasi' => $item['id_registrasi_dosen'],
                                    'tahun_ajaran' => $item['id_tahun_ajaran'],
                                    'program_studi_id' => $item['id_prodi'],
                                    'no_surat_tugas' => $item['nomor_surat_tugas'],
                                    'tmt_surat_tugas' => $item['mulai_surat_tugas'],
                                    'tanggal_surat_tugas' => $item['tanggal_surat_tugas'],
                                    'is_sinc' => 1);

                                PenugasanModel::updateOrInsert(array('id_registrasi' => $item['id_registrasi_dosen']), $arr_data);
                                $row_count++;
                            }
                        }
                        DB::commit();
                        $this->sinkron_log('sync_penugasan', 'sukses', $row_count);
                        DB::table('sinkronisasi_logs')
                            ->insert(array('title' => 'GetListPenugasanDosen', 'created_by' => Auth::user()->nama, 'created_at' => date('Y-m-d H:i:s')));
                        return json_encode(array('status' => 'success', 'msg' => 'Data Berhasil Disinkronisai.'));
                    } catch (\Exception $e) {
                        DB::rollBack();
                        throw $e;
                        return json_encode(array('status' => 'error', 'msg' => 'Terjadi kesalahan mensinkronkan data, silahkan coba lagi.'));
                    }
                }
            }else{
                return json_encode(array('status' => 'error' , 'msg' => 'Data tidak tersedia'));
            }
        }
    }

    public function sinc_fungsional_dosen(){
        $token = $this->check_auth_siakad();
        $data = array('act'=>"GetRiwayatFungsionalDosen" , "token"=>$token, "filter"=> "","limit"=>"" , "offset" =>0);
        $result_string = $this->runWS($data, 'json');

        $result = json_decode($result_string , true);
        if(!$result){
            $this->sinkron_log('sinc_fungsional_dosen','gagal', 0);

            return json_encode(array('status' => 'error' , 'msg' => 'Terjadi kesalahan mensinkronkan data, silahkan coba lagi.'));
        }
        if(array_key_exists('data' , $result)){
            if($result['data']) {
                if (count($result['data']) > 0) {
                    $row_count = 0;
                    DB::beginTransaction();
                    try {
                        foreach ($result['data'] as $item) {
                            $dosen = DosenModel::where('id_dosen', $item['id_dosen'])->first();
                            if ($dosen) {
                                $arr_data = array('dosen_id' => $dosen->id,
                                    'id_jabatan_fungsional' => $item['id_jabatan_fungsional'],
                                    'jabatan' => $item['nama_jabatan_fungsional'],
                                    'sk_jabatan' => $item['sk_jabatan_fungsional'],
                                    'tmt_jabatan' => $item['mulai_sk_jabatan'],
                                    'is_sinc' => 1);

                                RiwayatFungsionalModel::updateOrInsert(array('id_jabatan_fungsional' => $item['id_jabatan_fungsional']), $arr_data);
                                $row_count++;
                            }
                        }
                        DB::commit();
                        $this->sinkron_log('sinc_fungsional_dosen', 'sukses', $row_count);
                        DB::table('sinkronisasi_logs')
                            ->insert(array('title' => 'GetRiwayatFungsionalDosen', 'created_by' => Auth::user()->nama, 'created_at' => date('Y-m-d H:i:s')));
                        return json_encode(array('status' => 'success', 'msg' => 'Data Berhasil Disinkronisai.'));
                    } catch (\Exception $e) {
                        DB::rollBack();
                        throw $e;
                        return json_encode(array('status' => 'error', 'msg' => 'Terjadi kesalahan mensinkronkan data, silahkan coba lagi.'));
                    }
                }
            }else{
                return json_encode(array('status' => 'error' , 'msg' => 'Data tidak tersedia'));
            }
        }
    }

    public function sinc_kepangkatan(){
        $token = $this->check_auth_siakad();
        $data = array('act'=>"GetRiwayatPangkatDosen" , "token"=>$token, "filter"=> "","limit"=>"" , "offset" =>0);
        $result_string = $this->runWS($data, 'json');

        $result = json_decode($result_string , true);
        if(!$result){
            $this->sinkron_log('sinc_kepangkatan','gagal', 0);

            return json_encode(array('status' => 'error' , 'msg' => 'Terjadi kesalahan mensinkronkan data, silahkan coba lagi.'));
        }
        if(array_key_exists('data' , $result)){
            if($result['data']) {
                if (count($result['data']) > 0) {
                    $row_count = 0;
                    DB::beginTransaction();
                    try {
                        foreach ($result['data'] as $item) {
                            $dosen = DosenModel::where('id_dosen', $item['id_dosen'])->first();
                            if ($dosen) {
                                $arr_data = array('dosen_id' => $dosen->id,
                                    'id_pangkat_golongan' => $item['id_pangkat_golongan'],
                                    'pangkat' => $item['nama_pangkat_golongan'],
                                    'sk_pangkat' => $item['sk_pangkat'],
                                    'tanggal_sk_pangkat' => $item['tanggal_sk_pangkat'],
                                    'tmt_sk_pangkat' => $item['mulai_sk_pangkat'],
                                    'masa_kerja_bulan' => $item['masa_kerja_dalam_bulan'],
                                    'masa_kerja_tahun' => $item['masa_kerja_dalam_tahun'],
                                    'is_sinc' => 1);

                                PengangkatanModel::updateOrInsert(array('id_pangkat_golongan' => $item['id_pangkat_golongan']), $arr_data);
                                $row_count++;
                            }
                        }
                        DB::commit();
                        $this->sinkron_log('sinc_kepangkatan', 'sukses', $row_count);
                        DB::table('sinkronisasi_logs')
                            ->insert(array('title' => 'GetRiwayatPangkatDosen', 'created_by' => Auth::user()->nama, 'created_at' => date('Y-m-d H:i:s')));
                        return json_encode(array('status' => 'success', 'msg' => 'Data Berhasil Disinkronisai.'));
                    } catch (\Exception $e) {
                        DB::rollBack();
                        throw $e;
                        return json_encode(array('status' => 'error', 'msg' => 'Terjadi kesalahan mensinkronkan data, silahkan coba lagi.'));
                    }
                }
            }else{
                return json_encode(array('status' => 'error' , 'msg' => 'Data tidak tersedia'));
            }
        }
    }

    public function sinc_pendidikan(){
        $token = $this->check_auth_siakad();
        $data = array('act'=>"GetRiwayatPendidikanDosen" , "token"=>$token, "filter"=> "","limit"=>"" , "offset" =>0);
        $result_string = $this->runWS($data, 'json');

        $result = json_decode($result_string , true);
        if(!$result){
            $this->sinkron_log('sinc_pendidikan','gagal', 0);

            return json_encode(array('status' => 'error' , 'msg' => 'Terjadi kesalahan mensinkronkan data, silahkan coba lagi.'));
        }
        if(array_key_exists('data' , $result)){
            if($result['data']){
                if(count($result['data']) > 0){
                    $row_count = 0;
                    DB::beginTransaction();
                    try{
                        foreach($result['data'] as $item){
                            $dosen = DosenModel::where('id_dosen', $item['id_dosen'])->first();
                            if($dosen){
                                $arr_data = array('dosen_id'=> $dosen->id,
                                    'id_perguruan_tinggi'=> $item['id_perguruan_tinggi'],
                                    'id_bidang_studi'=> $item['id_bidang_studi'],
                                    'id_jenjang_pendidikan'=> $item['id_jenjang_pendidikan'],
                                    'bidang_studi'=>$item['nama_bidang_studi'],
                                    'jenjang'=>$item['nama_jenjang_pendidikan'],
                                    'gelar'=>$item['nama_gelar_akademik'],
                                    'perguruan_tinggi'=>$item['nama_perguruan_tinggi'],
                                    'fakultas'=>$item['fakultas'],
                                    'tahun_lulus'=>$item['tahun_lulus'],
                                    'sks'=>$item['sks_lulus'],
                                    'ipk'=>$item['masa_kerja_dalam_tahun']
                                );
                                RiwayatPendidikanModel::updateOrInsert(
                                    array(
                                        'id_perguruan_tinggi'=> $item['id_perguruan_tinggi'],
                                        'id_bidang_studi'=> $item['id_bidang_studi'],
                                        'id_jenjang_pendidikan'=> $item['id_jenjang_pendidikan']
                                    )
                                    , $arr_data);
                                $row_count++;
                            }
                        }
                        DB::commit();
                        $this->sinkron_log('sinc_pendidikan','sukses', $row_count);
                        DB::table('sinkronisasi_logs')
                            ->insert(array('title' => 'GetRiwayatPendidikanDosen' ,'created_by'=> Auth::user()->nama ,'created_at'=>date('Y-m-d H:i:s')));
                        return json_encode(array('status' => 'success' , 'msg' => 'Data Berhasil Disinkronisai.'));
                    } catch(\Exception $e){
                        DB::rollBack();
                        throw $e;
                        return json_encode(array('status' => 'error' , 'msg' => 'Terjadi kesalahan mensinkronkan data, silahkan coba lagi.'));
                    }
                }
            }else{
                return json_encode(array('status' => 'error' , 'msg' => 'Data tidak tersedia'));
            }
        }
    }

    public function sinc_sertifikasi(){
        $token = $this->check_auth_siakad();
        $data = array('act'=>"GetRiwayatSertifikasiDosen" , "token"=>$token, "filter"=> "","limit"=>"" , "offset" =>0);
        $result_string = $this->runWS($data, 'json');

        $result = json_decode($result_string , true);
        if(!$result){
            $this->sinkron_log('sinc_sertifikasi','gagal', 0);

            return json_encode(array('status' => 'error' , 'msg' => 'Terjadi kesalahan mensinkronkan data, silahkan coba lagi.'));
        }
        if(array_key_exists('data' , $result)){
            if($result['data']) {
                if (count($result['data']) > 0) {
                    $row_count = 0;
                    DB::beginTransaction();
                    try {
                        foreach ($result['data'] as $item) {
                            $dosen = DosenModel::where('id_dosen', $item['id_dosen'])->first();
                            if ($dosen) {
                                $arr_data = array('dosen_id' => $dosen->id,
                                    'nomor' => $item['nomor_peserta'],
                                    'bidang_studi' => $item['nama_bidang_studi'],
                                    'jenis_sertifikasi' => $item['nama_jenis_sertifikasi'],
                                    'tahun_sertifikasi' => $item['tahun_sertifikasi'],
                                    'no_sk_sertifikasi' => $item['sk_sertifikasi']
                                );
                                RiwayatSertifikasiModel::updateOrInsert(array('nomor' => $item['nomor_peserta']), $arr_data);
                                $row_count++;
                            }
                        }
                        DB::commit();
                        $this->sinkron_log('sinc_sertifikasi', 'sukses', $row_count);
                        DB::table('sinkronisasi_logs')
                            ->insert(array('title' => 'GetRiwayatSertifikasiDosen', 'created_by' => Auth::user()->nama, 'created_at' => date('Y-m-d H:i:s')));
                        return json_encode(array('status' => 'success', 'msg' => 'Data Berhasil Disinkronisai.'));
                    } catch (\Exception $e) {
                        DB::rollBack();
                        throw $e;
                        return json_encode(array('status' => 'error', 'msg' => 'Terjadi kesalahan mensinkronkan data, silahkan coba lagi.'));
                    }
                }
            }else{
                return json_encode(array('status' => 'error' , 'msg' => 'Data tidak tersedia'));
            }
        }
    }

    public function sinc_penelitian(){
        $token = $this->check_auth_siakad();
        $data = array('act'=>"GetRiwayatPenelitianDosen" , "token"=>$token, "filter"=> "","limit"=>"" , "offset" =>0);
        $result_string = $this->runWS($data, 'json');

        $result = json_decode($result_string , true);
        if(!$result){
            $this->sinkron_log('sinc_penelitian','gagal', 0);

            return json_encode(array('status' => 'error' , 'msg' => 'Terjadi kesalahan mensinkronkan data, silahkan coba lagi.'));
        }
        if(array_key_exists('data' , $result)){
            if($result['data']) {
                if (count($result['data']) > 0) {
                    $row_count = 0;
                    DB::beginTransaction();
                    try {
                        foreach ($result['data'] as $item) {
                            $dosen = DosenModel::where('id_dosen', $item['id_dosen'])->first();
                            if ($dosen) {
                                $arr_data = array('dosen_id' => $dosen->id,
                                    'id_penelitian' => $item['id_penelitian'],
                                    'id_lembaga_iptek' => $item['id_pangkat_golongan'],
                                    'judul_penelitian' => $item['judul_penelitian'],
                                    'bidang_ilmu' => $item['nama_kelompok_bidang'],
                                    'lembaga' => $item['nama_lembaga_iptek'],
                                    'tahun' => $item['tahun_kegiatan']
                                );
                                RiwayatPenelitianModel::updateOrInsert(array('id_penelitian' => $item['id_penelitian']), $arr_data);
                                $row_count++;
                            }
                        }
                        DB::commit();
                        $this->sinkron_log('sinc_penelitian', 'sukses', $row_count);
                        DB::table('sinkronisasi_logs')
                            ->insert(array('title' => 'GetRiwayatPenelitianDosen', 'created_by' => Auth::user()->nama, 'created_at' => date('Y-m-d H:i:s')));
                        return json_encode(array('status' => 'success', 'msg' => 'Data Berhasil Disinkronisai.'));
                    } catch (\Exception $e) {
                        DB::rollBack();
                        throw $e;
                        return json_encode(array('status' => 'error', 'msg' => 'Terjadi kesalahan mensinkronkan data, silahkan coba lagi.'));
                    }
                }
            }else{
                return json_encode(array('status' => 'error' , 'msg' => 'Data tidak tersedia'));
            }
        }
    }

}
        