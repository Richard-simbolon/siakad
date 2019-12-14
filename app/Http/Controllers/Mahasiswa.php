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

class Mahasiswa extends Controller
{
    static $Tableshow = ["id" => ["table" => ["tablename" =>"null" , "field"=> "id"] , "record"=>"Id"],
        ];
    static $html = ["id"=>["type"=>"null" , "value"=>"null" , "validation" => ""] ,
];
    static $exclude = ["id","created_at","updated_at","created_by","update_by"];
    static $tablename = "Mahasiswa";

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
            'angkatan' => AngkatanModel::where('row_status' , 'active')->get(),
            'dosen'=> DosenModel::where('dosen.row_status', 'active')->where('master_status_pegawai.title','Aktif')
                ->join('master_status_pegawai','master_status_pegawai.id','=', 'dosen.status_pegawai')
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

        // print_r($data['mahasiswa']); exit;
        
        $validation = Validator::make($data['mahasiswa'], [
            'angkatan' => 'required',
            'nama' => 'required',
            'email'=> 'required | email',
            'nim' => 'required',
            'tempat_lahir' => 'required',
            'tanggal_lahir' => 'required',
            'nik' => 'max:20',
            'nisn' => 'max:20',
            'email' => 'required|email|unique:mahasiswa',
            'nik' => 'required',
            'nisn' => 'required',
            'kewarganegaraan' => 'required',
            'alamat' => 'required',
            'jurusan_id'=>'required',
            'kelas_id' => 'required'
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
            throw $e;
            return json_encode(array('status' => 'error' , 'message' => 'Terjadi kesalahan saat menyimpan, silahkan coba lagi.'));
        }
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
            'status_mahasiswa' => StatusMahasiswaModel::where('row_status' , 'active')->get(),
            'dosen'=> DosenModel::where('dosen.row_status', 'active')->where('master_status_pegawai.title','Aktif')
                ->join('master_status_pegawai','master_status_pegawai.id','=', 'dosen.status_pegawai')
                ->select('dosen.id', 'dosen.nidn_nup_nidk', 'dosen.nama')
                ->get()
        );


        $data = MahasiswaModel::join('master_jurusan', 'master_jurusan.id', '=', 'mahasiswa.jurusan_id')
            ->join('master_angkatan' ,'master_angkatan.id' ,'=' ,'mahasiswa.angkatan')
            ->join('master_kelas' ,'master_kelas.id' ,'=' ,'mahasiswa.kelas_id')
            ->leftJoin('master_status_mahasiswa' ,'master_status_mahasiswa.id' ,'=' ,'mahasiswa.status')
            ->leftJoin('dosen', 'dosen.id' ,'=', 'mahasiswa.pembimbing_akademik')
            ->select('mahasiswa.*' ,'dosen.nama as nama_dosen', 'master_jurusan.title' ,'master_jurusan.id as id_jurusan' ,'master_kelas.title as kelas_title' , 'master_angkatan.title as angkatan_title' ,'master_status_mahasiswa.title as status_mhs')
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
            ->leftJoin('master_status_mahasiswa','master_status_mahasiswa.id', '=', 'mahasiswa.status' )
            ->leftJoin('master_angkatan','master_angkatan.id', '=', 'mahasiswa.angkatan')
            ->select("mahasiswa.id" ,"master_agama.title as t_agama","nim" ,"jurusan_id" , "master_jurusan.title", "agama" , "master_status_mahasiswa.title as status","nama","nik","nisn","tanggal_lahir","jk", "master_angkatan.title as angkatan")->get())->addIndexColumn()->make(true);
    }

    public function validatewizard(Request $request){
        $data = $request->all();

        if(isset($data['step'])){
            if($data['step'] == '1'){
                $validation = Validator::make($data['mahasiswa'], [
                    'angkatan' => 'required',
                    'nama' => 'required',
                    'email'=> 'required | email',
                    'nim' => 'required',
                    'jurusan_id'=>'required',
                    'kelas_id' => 'required'
                ]);
            }elseif($data['step'] == '2'){
                $validation = Validator::make($data['mahasiswa'], [
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
        $id = $data['mahasiswa']['id'];
        unset($data['mahasiswa']['id']);
        if($id != '' ){
            $validation = Validator::make($data['mahasiswa'], [
                'angkatan' => 'required',
                'nama' => 'required',
                'email'=> 'required | email',
                'nim' => 'required',
                'tempat_lahir' => 'required',
                'tanggal_lahir' => 'required',
                'nik' => 'max:20',
                'nisn' => 'max:20',
                'email' => 'required|email',
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
                    if($data['mahasiswa']['tanggal_lahir'] != '' && $data['mahasiswa']['tanggal_lahir'] != null){
                        $data['mahasiswa']['tanggal_lahir'] = date($data['mahasiswa']['tanggal_lahir']);
                    }
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
        ->join('master_angkatan' ,'master_angkatan.id' ,'=' ,'mahasiswa.angkatan')
        ->join('master_kelas' ,'master_kelas.id' ,'=' ,'mahasiswa.kelas_id')
        ->join('master_status_mahasiswa' ,'master_status_mahasiswa.id' ,'=' ,'mahasiswa.status')
        ->select('mahasiswa.*' , 'master_jurusan.title' ,'master_jurusan.id as id_jurusan' ,'master_kelas.title as kelas_title' , 'master_angkatan.title as angkatan_title' ,'master_status_mahasiswa.title as status_mhs')
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
        ->select('kurikulum_mata_kuliah.semester' ,'view_jadwal_kelas_perkuliahan.semester_id',DB::raw('SUM(view_jadwal_kelas_perkuliahan.bobot_mata_kuliah) as sks'))
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
        ->select('kurikulum_mata_kuliah.*' , 'kurikulum.nama_kurikulum' , 'mata_kuliah.nama_mata_kuliah', 'mata_kuliah.kode_mata_kuliah','mata_kuliah.tipe_mata_kuliah', 'mata_kuliah.bobot_mata_kuliah' , 'nilai_mahasiswa.nilai_uts', 'nilai_mahasiswa.nilai_tugas', 'nilai_mahasiswa.nilai_uas')
        ->where('kurikulum.id' , $kurikulum->kurikulum_id)->where('nilai_mahasiswa.semester_id' , $semester_aktif->id)->get();
        
        $ip_smstr_prev = JadwalPerkuliahanModel::leftJoin('kurikulum_mata_kuliah' ,'kurikulum_mata_kuliah.mata_kuliah_id' ,'=' ,'view_jadwal_kelas_perkuliahan.mata_kuliah_id')
        ->select('kurikulum_mata_kuliah.semester' ,'view_jadwal_kelas_perkuliahan.semester_id',DB::raw('SUM(view_jadwal_kelas_perkuliahan.bobot_mata_kuliah) as sks'))
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
        ->select('kurikulum_mata_kuliah.*' , 'kurikulum.nama_kurikulum' , 'mata_kuliah.nama_mata_kuliah', 'mata_kuliah.kode_mata_kuliah', 'mata_kuliah.bobot_mata_kuliah' , 'nilai_mahasiswa.nilai_akhir', 'nilai_mahasiswa.nilai_laporan', 'nilai_mahasiswa.nilai_laporan_pkl', 'nilai_mahasiswa.nilai_ujian', 'nilai_mahasiswa.nilai_uts', 'nilai_mahasiswa.nilai_tugas', 'nilai_mahasiswa.nilai_uas','mata_kuliah.tipe_mata_kuliah')
        ->where('kurikulum.id' , $kurikulum->kurikulum_id)->where('nilai_mahasiswa.semester_id' , $request->all()['id'])->get();
        $html = '';


        $ip_smstr_prev = JadwalPerkuliahanModel::leftJoin('kurikulum_mata_kuliah' ,'kurikulum_mata_kuliah.mata_kuliah_id' ,'=' ,'view_jadwal_kelas_perkuliahan.mata_kuliah_id')
        ->select('kurikulum_mata_kuliah.semester' ,'view_jadwal_kelas_perkuliahan.semester_id',DB::raw('SUM(view_jadwal_kelas_perkuliahan.bobot_mata_kuliah) as sks'))
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
                $sks += $item->bobot_mata_kuliah;

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
                    $nipk += 0 * $item->bobot_mata_kuliah;
                    $indexvsks = 0 * $item->bobot_mata_kuliah;
                    $index = 0;
                }elseif($nangka > 44 && $nangka<= 59){
                    $nhuruf = 'D';
                    $nipk += 1 * $item->bobot_mata_kuliah;
                    $indexvsks = 1 * $item->bobot_mata_kuliah;
                    $index = 1;
                }elseif($nangka > 59 && $nangka<= 69){
                    if((int)($kurikulum->angkatan) < 2018 && $nangka > 65 && $nangka <= 69){
                        $nhuruf = 'C+';
                    }else{
                        $nhuruf = 'C';
                    }
                    $nipk += 2 * $item->bobot_mata_kuliah;
                    $indexvsks = 2 * $item->bobot_mata_kuliah;
                    $index = 2;
                }elseif($nangka > 69 && $nangka<= 79){
                    if((int)($kurikulum->angkatan) < 2018 && $nangka > 75 && $nangka<= 79){
                        $nhuruf = 'B+';
                    }else{
                        $nhuruf = 'B';
                    }
                    $nipk += 3 * $item->bobot_mata_kuliah;
                    $indexvsks = 3 * $item->bobot_mata_kuliah;
                    $index = 3;
                }elseif($nangka > 79 && $nangka<= 100){
                    $nhuruf = 'A';
                    $nipk += 4 * $item->bobot_mata_kuliah;
                    $indexvsks = 4 * $item->bobot_mata_kuliah;
                    $index = 4;
                }else{
                    $nhuruf = 'E';
                    $nipk += 0 * $item->bobot_mata_kuliah;
                    $index = 5;
                }

                if($item->tipe_mata_kuliah == 'praktek' || $item->tipe_mata_kuliah == 'skripsi' ||$item->tipe_mata_kuliah == 'seminar' ||$item->tipe_mata_kuliah == 'pkl'){
                    $sksteori = 0; 
                    $skspraktek = $item->bobot_mata_kuliah;
                    $jumlahpr = $item->bobot_mata_kuliah;
                    
                    $nilaiteoriangka = 0;
                    $nilaiteorimutu = '-';  
                    $nilaipraktekangka = $nangka;
                    $nilaipraktekmutu = $nhuruf;
                    $t_sks_praktek += $item->bobot_mata_kuliah;
                    
                }else{
                    $sksteori = $item->bobot_mata_kuliah; 
                    $skspraktek = '-';
                    $jumlahpr = $item->bobot_mata_kuliah;

                    $nilaiteoriangka = $nangka;
                    $nilaiteorimutu = $nhuruf;  
                    $nilaipraktekangka = "-";
                    $nilaipraktekmutu = '-';
                    $t_sks_teori += $item->bobot_mata_kuliah;
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
        ->select('kurikulum_mata_kuliah.*' , 'kurikulum.nama_kurikulum' , 'mata_kuliah.nama_mata_kuliah', 'mata_kuliah.kode_mata_kuliah', 'mata_kuliah.bobot_mata_kuliah' , 'nilai_mahasiswa.nilai_akhir', 'nilai_mahasiswa.nilai_uts', 'nilai_mahasiswa.nilai_tugas', 'nilai_mahasiswa.nilai_uas','mata_kuliah.tipe_mata_kuliah', 'nilai_mahasiswa.semester_id', 'master_semester.title as semester_title', 'nilai_mahasiswa.nilai_laporan', 'nilai_mahasiswa.nilai_laporan_pkl', 'nilai_mahasiswa.nilai_ujian')
        ->where('kurikulum.id' , $kurikulum->kurikulum_id)->orderby('kurikulum_mata_kuliah.semester' , 'ASC')->get();
        $title = ucfirst(request()->segment(1))." ".ucfirst(request()->segment(2));
        $global['id'] = $id;
        return view("data/Mhs_Transkrip" , compact("data" , "title" ,"mahasiswa","global"));
        
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
        ->select('kurikulum_mata_kuliah.*' , 'kurikulum.nama_kurikulum' , 'mata_kuliah.nama_mata_kuliah', 'mata_kuliah.kode_mata_kuliah','mata_kuliah.tipe_mata_kuliah', 'mata_kuliah.bobot_mata_kuliah' , 'nilai_mahasiswa.nilai_uts', 'nilai_mahasiswa.nilai_tugas', 'nilai_mahasiswa.nilai_uas')
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
        ->select('kurikulum_mata_kuliah.*' , 'kurikulum.nama_kurikulum' , 'mata_kuliah.nama_mata_kuliah', 'mata_kuliah.kode_mata_kuliah', 'mata_kuliah.bobot_mata_kuliah' , 'nilai_mahasiswa.nilai_akhir', 'nilai_mahasiswa.nilai_uts', 'nilai_mahasiswa.nilai_tugas', 'nilai_mahasiswa.nilai_uas','mata_kuliah.tipe_mata_kuliah', 'nilai_mahasiswa.semester_id', 'master_semester.title as semester_title')
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
        ->select('kurikulum_mata_kuliah.semester' ,'view_jadwal_kelas_perkuliahan.semester_id',DB::raw('SUM(view_jadwal_kelas_perkuliahan.bobot_mata_kuliah) as sks'))
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
        ->select('kurikulum_mata_kuliah.*' , 'kurikulum.nama_kurikulum' , 'mata_kuliah.nama_mata_kuliah', 'mata_kuliah.kode_mata_kuliah','mata_kuliah.tipe_mata_kuliah', 'mata_kuliah.bobot_mata_kuliah' , 'nilai_mahasiswa.nilai_uts', 'nilai_mahasiswa.nilai_tugas', 'nilai_mahasiswa.nilai_uas')
        ->where('kurikulum.id' , $kurikulum->kurikulum_id)->where('nilai_mahasiswa.semester_id' , $id_semester)->get();
        if(count($data) > 0){
            $i = 0;
            $sks = 0;
            $nipk = 0;
            $t_sks_teori = 0;
            $t_sks_praktek = 0;
            foreach($data as $item){
                $i++;
                $sks += $item->bobot_mata_kuliah;

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
                    $nipk += 0 * $item->bobot_mata_kuliah;
                    $indexvsks = 0 * $item->bobot_mata_kuliah;
                    $index = 0;
                }elseif($nangka > 44 && $nangka<= 59){
                    $nhuruf = 'D';
                    $nipk += 1 * $item->bobot_mata_kuliah;
                    $indexvsks = 1 * $item->bobot_mata_kuliah;
                    $index = 1;
                }elseif($nangka > 59 && $nangka<= 69){
                    if((int)($kurikulum->angkatan) < 2018 && $nangka > 65 && $nangka <= 69){
                        $nhuruf = 'C+';
                    }else{
                        $nhuruf = 'C';
                    }
                    $nipk += 2 * $item->bobot_mata_kuliah;
                    $indexvsks = 2 * $item->bobot_mata_kuliah;
                    $index = 2;
                }elseif($nangka > 69 && $nangka<= 79){
                    if((int)($kurikulum->angkatan) < 2018 && $nangka > 75 && $nangka <= 79){
                        $nhuruf = 'B+';
                    }else{
                        $nhuruf = 'B';
                    }
                    $nipk += 3 * $item->bobot_mata_kuliah;
                    $indexvsks = 3 * $item->bobot_mata_kuliah;
                    $index = 3;
                }elseif($nangka > 79 && $nangka<= 100){
                    $nhuruf = 'A';
                    $nipk += 4 * $item->bobot_mata_kuliah;
                    $indexvsks = 4 * $item->bobot_mata_kuliah;
                    $index = 4;
                }else{
                    $nhuruf = 'E';
                    $nipk += 0 * $item->bobot_mata_kuliah;
                    $index = 5;
                }

                if($item->tipe_mata_kuliah == 'praktek' || $item->tipe_mata_kuliah == 'skripsi' ||$item->tipe_mata_kuliah == 'seminar' ||$item->tipe_mata_kuliah == 'pkl'){
                    $sksteori = 0; 
                    $skspraktek = $item->bobot_mata_kuliah;
                    $jumlahpr = $item->bobot_mata_kuliah;
                    
                    $nilaiteoriangka = 0;
                    $nilaiteorimutu = '-';  
                    $nilaipraktekangka = $nangka;
                    $nilaipraktekmutu = $nhuruf;
                    $t_sks_praktek += $item->bobot_mata_kuliah;
                    
                }else{
                    $sksteori = $item->bobot_mata_kuliah; 
                    $skspraktek = '-';
                    $jumlahpr = $item->bobot_mata_kuliah;

                    $nilaiteoriangka = $nangka;
                    $nilaiteorimutu = $nhuruf;  
                    $nilaipraktekangka = "-";
                    $nilaipraktekmutu = '-';
                    $t_sks_teori += $item->bobot_mata_kuliah;
                }
                
            }
            $ipk = round($nipk / $sks ,2);
        }else{
            $ipk = 0;
        }

        return $ipk;
    }

}
