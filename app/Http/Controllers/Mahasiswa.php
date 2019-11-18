<?php
namespace App\Http\Controllers;
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

class Mahasiswa extends Controller
            {
                static $Tableshow = ["id" => ["table" => ["tablename" =>"null" , "field"=> "id"] , "record"=>"Id"],
                    ];
                static $html = ["id"=>["type"=>"null" , "value"=>"null" , "validation" => ""] ,
            ];
                static $exclude = ["id","created_at","updated_at","created_by","update_by"];
                static $tablename = "Mahasiswa";
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
                        'angkatan' => AngkatanModel::where('row_status' , 'active')->get()
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

                   // print_r($data['mahasiswa']); exit;
                    
                    $validation = Validator::make($data['mahasiswa'], [
                        'nama' => 'required',
                        'jurusan_id' => 'required',
                        'nama_ibu' => 'required',
                        'nim' => 'required',
                        'tempat_lahir' => 'required',
                        'tanggal_lahir' => 'required',
                        'nik' => 'max:20',
                        'nisn' => 'max:20',
                        'email' => 'email',
                        'nik' => 'required',
                        'nisn' => 'required',
                        'kewarganegaraan' => 'required',
                        'alamat' => 'required',
                    ]);

                    if ($validation->fails()) {
                        return json_encode(['status'=> 'false', 'message'=> $validation->messages()]);
                    }
                    DB::beginTransaction();
                    try{

                        if(array_key_exists('mahasiswa' , $data)){
                            // SAVE TO TABLE mahasiswa
                            $data['mahasiswa']['tanggal_lahir'] = date($data['mahasiswa']['tanggal_lahir']);
                            if($data['mahasiswa']['is_penerima_kps'] == 'on'){
                                $data['mahasiswa']['is_penerima_kps'] = '1';
                            }else{
                                $data['mahasiswa']['is_penerima_kps'] = '0';
                            }
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
                        $data_kebutuhan_khusus = array(
                            'mahasiswa_id' => $mahasiswa->id,
                            'row_status' => 'active',
                            'created_by' => 1,
                            'updated_by' => 1,
                            'kebutuhan_mahasiswa' => array_key_exists('mahasiswa_kh' , $data) ? json_encode(array('mahasiswa' => $data['mahasiswa_kh'])) : json_encode(array('mahasiswa' =>[])),
                            'kebutuhan_ayah' =>array_key_exists('ayah_kh' , $data) ? json_encode(array('ayah' =>$data['ayah_kh'])) : json_encode(array('ayah' =>[])),
                            'kebutuhan_ibu' =>array_key_exists('ibu_kh' , $data) ? json_encode(array('ibu'=>$data['ibu_kh'])) : json_encode(array('ibu' =>[])),
                            'kebutuhan_wali' => array_key_exists('wali_kh' , $data) ? json_encode(array('wali'=>$data['wali_kh'])) : json_encode(array('wali' =>[]))
                        );
                        MahasiswaKebutuhanModel::create($data_kebutuhan_khusus);
                        DB::commit();
                        return json_encode(array('status' => 'success' , 'message' => 'Data berhasil disimpan.'));
                    } catch(\Exception $e){
                        
                        DB::rollBack(); 
                        //throw $e;
                        return json_encode(array('status' => 'error' , 'message' => 'Terjadi kesalahan saat menyimpan, silahkan coba lagi.'));
                    }

                   // print_r($data['mahasiswa']);
                   // print_r($data['mahasiswa_orang_tua_wali']);
                   // print_r($data['mahasiswa_kh']);
                   // print_r($data['ayah_kh']);
                   // print_r($data['ibu_kh']);
                    
                }

                public function edit(Request $request){

                }

                public function view($id){

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


                    $data = MahasiswaModel::join('master_jurusan', 'master_jurusan.id', '=', 'mahasiswa.jurusan_id')
                    ->join('master_angkatan' ,'master_angkatan.id' ,'=' ,'mahasiswa.angkatan')
                    ->join('master_kelas' ,'master_kelas.id' ,'=' ,'mahasiswa.kelas_id')
                    ->join('master_status_mahasiswa' ,'master_status_mahasiswa.id' ,'=' ,'mahasiswa.status')
                    ->select('mahasiswa.*' , 'master_jurusan.title' ,'master_jurusan.id as id_jurusan' ,'master_kelas.title as kelas_title' , 'master_angkatan.title as angkatan_title' ,'master_status_mahasiswa.title as status_mhs')
                    ->where('mahasiswa.id' , $id)->first();
                    $orangtuawali = MahasiswaOrangtuawaliModel::where('mahasiswa_id' , $id)->get();
                    $kebutuhan_selected = MahasiswaKebutuhanModel::where('mahasiswa_id' , $id)->first();
                    $title = ucfirst(request()->segment(1))." ".ucfirst(request()->segment(2));
                    $tableid = "Mahasiswa";
                    return view("data/mhs_view" , compact("data","master" ,"orangtuawali" ,"kebutuhan_selected"));
                }

                public function paging(Request $request){
                    return Datatables::of(MahasiswaModel::join('master_jurusan', 'master_jurusan.id', '=', 'mahasiswa.jurusan_id')
                    ->join('master_agama', 'mahasiswa.agama', '=', 'master_agama.id')
                    ->select("mahasiswa.id" ,"master_agama.title as t_agama","nim" ,"jurusan_id" , "master_jurusan.title", "agama" , "mahasiswa.row_status","nama","nik","nisn","tanggal_lahir","jk")->get())->addIndexColumn()->make(true);
                }

                public function validatewizard(Request $request){
                    //print_r($request->all()); exit;
                    $data = $request->all();
                    $stepvalidation = array(
                        'mahasiswa1' => array(
                            'nama' => 'required',
                            'nama_ibu' => 'required',
                            'tempat_lahir' => 'required',
                            'tanggal_lahir' => 'required',
                            'jk' => 'required',
                            'agama' => 'required'
                        ),
                        'mahasiswa2' => array(
                            'nik' => 'required',
                            'nisn' => '',
                            'kewarganegaraan' => 'required',
                            'alamat' => 'required',
                            'dusun' => '',
                            'rt' => '',
                            'rw' => '',
                            'kelurahan' => '',
                            'kode_pos' => '',
                            'kecamatan' => '',
                            'jenis_tingal' => '',
                            'telepon' => '',
                            'no_hp' => '',
                            'kps' => '',
                            'no_kps' => '',
                        ),
                        'mahasiswa_orang_tua_wali' => array(
                            'nik_ayah' =>'',
                            'nama_ayah' =>'',
                            'tanggal_lahir_ayah' =>'',
                            'pendidikan_ayah' =>'',
                            'pekerjaan_ayah' =>'',
                            'penghasilan_ayah' =>'',
                            'nik_ibu' =>'',
                            'tanggal_lahir_ibu' =>'',
                            'pendidikan_ibu' =>'',
                            'pekerjaan_ibu' =>'',
                            'penghasilan_ayah' =>'',
                        ),
                        'wali'=> array(
                            'nama_wali' =>'',
                            'tanggal_lahir_wali' =>'',
                            'pendidikan_wali' =>'',
                            'pekerjaan_wali' =>'',
                            'penghasilan_wali' =>'',
                        ),
                        'kebutuhan_khusus' => array()

                   );


                   if(isset($data['step'])){
                        if($data['step'] == '1'){
                            $validation = Validator::make($data['mahasiswa'], [
                                'nama' => '',
                                'nama_ibu' => '',
                                'tempat_lahir' => '',
                                'tanggal_lahir' => '',
                                'jk' => '',
                                'agama' => ''
                            ]);
                        }elseif($data['step'] == '2'){
                            $validation = Validator::make($data['mahasiswa'], [
                                'nik' => '',
                                'kewarganegaraan' => '',
                                'alamat' => ''
                               /* 'nisn' => '',
                                'dusun' => '',
                                'rt' => '',
                                'rw' => '',
                                'kelurahan' => '',
                                'kode_pos' => '',
                                'kecamatan' => '',
                                'jenis_tingal' => '',
                                'telepon' => '',
                                'no_hp' => '',
                                'kps' => '',
                                'no_kps' => '',*/
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
                    //print_r( $data); exit;
                    $id = $data['mahasiswa']['id'];
                    unset($data['mahasiswa']['id']);
                    if($id != '' ){
                        $validation = Validator::make($data['mahasiswa'], [
                            'nama' => 'required',
                            'jurusan_id' => 'required',
                            'nim' => 'required',
                            'tempat_lahir' => 'required',
                            'tanggal_lahir' => 'required',
                            'nik' => 'max:20',
                            'nisn' => 'max:20',
                            'email' => 'email',
                            'nik' => 'required',
                            'nisn' => 'required',
                            'kewarganegaraan' => 'required',
                            'alamat' => 'required',
                        ]);
    
                        if ($validation->fails()) {
                            return json_encode(['status'=> 'false', 'message'=> $validation->messages()]);
                        }
                        
                        DB::beginTransaction();
                        try{
    
                            if(array_key_exists('mahasiswa' , $data)){
                                // SAVE TO TABLE mahasiswa
                                $data['mahasiswa']['tanggal_lahir'] = date($data['mahasiswa']['tanggal_lahir']);
                                if($data['mahasiswa']['is_penerima_kps'] == 'on'){
                                    $data['mahasiswa']['is_penerima_kps'] = '1';
                                }else{
                                    $data['mahasiswa']['is_penerima_kps'] = '0';
                                }
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
                            $data_kebutuhan_khusus = array(
                                'row_status' => 'active',
                                'created_by' => 1,
                                'updated_by' => 1,
                                'kebutuhan_mahasiswa' => array_key_exists('mahasiswa_kh' , $data) ? json_encode(array('mahasiswa' => $data['mahasiswa_kh'])) : json_encode(array('mahasiswa' =>[])),
                                'kebutuhan_ayah' =>array_key_exists('ayah_kh' , $data) ? json_encode(array('ayah' =>$data['ayah_kh'])) : json_encode(array('ayah' =>[])),
                                'kebutuhan_ibu' =>array_key_exists('ibu_kh' , $data) ? json_encode(array('ibu'=>$data['ibu_kh'])) : json_encode(array('ibu' =>[])),
                                'kebutuhan_wali' => array_key_exists('wali_kh' , $data) ? json_encode(array('wali'=>$data['wali_kh'])) : json_encode(array('wali' =>[]))
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

                //login mahasiswa
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

                public function prestasi()
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

                }

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
                //end of login mahasiswa

            }
