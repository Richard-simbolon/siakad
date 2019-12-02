<?php
namespace App\Http\Controllers;
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
use Yajra\DataTables\DataTables;
use File;
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
            'sumber_gaji'=> SumberGajiModel::where('row_status', 'active')->get()
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
                if($data['dosen']['tanggal_lahir'] != '' && $data['dosen']['tanggal_lahir'] != null){
                    $data['dosen']['tanggal_lahir'] = date($data['dosen']['tanggal_lahir']);
                }
                
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
            return json_encode(array('status' => 'success' , 'msg' => 'Data berhasil disimpan.'));
        } catch(\Exception $e){
            
            DB::rollBack(); 
            //throw $e;
            return json_encode(array('status' => 'error' , 'msg' => 'Terjadi kesalahan saat menyimpan, silahkan coba lagi.'));
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

    public function resetPassword(){
        $alphabet = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890';
        $pass = array(); //remember to declare $pass as an array
        $alphaLength = strlen($alphabet) - 1; //put the length -1 in cache
        for ($i = 0; $i < 8; $i++) {
            $n = rand(0, $alphaLength);
            $pass[] = $alphabet[$n];
        }
        $new_password = implode($pass);
        $password['password'] = Hash::make($new_password);
        if(MahasiswaModel::where('id' ,$this->get_id_mahasiswa())->update($password)){
            return json_encode(["status"=> true, "message"=> $new_password]);
        }else{
            return json_encode(["status"=> false, "message"=> "Terjadi kesalahan saat mengubah data."]);
        }
    }

    public function paging(Request $request){
        return Datatables::of(DosenModel::where("dosen.row_status", "active")
            ->leftJoin('master_agama', 'dosen.agama', '=', 'master_agama.id')
            ->leftJoin('master_status_pegawai','master_status_pegawai.id', 'dosen.status_pegawai')
        ->select("dosen.id" ,"master_agama.title as t_agama","nip" ,"nidn_nup_nidk", "agama" , "dosen.status","master_status_pegawai.title as status_pegawai","nama","tanggal_lahir","jenis_kelamin")->get())->addIndexColumn()->make(true);
    }

    public function view($id){

        $master = array(
            'kebutuhan' => KebutuhanKhususModel::where('row_status' , 'active')->get(),
            'agama' => AgamaModel::where('row_status' , 'active')->get(),
            'pekerjaan' => PekerjaanModel::where('row_status' , 'active')->get(),
            'status_pegawai' => StatusPegawaiModel::where('row_status' , 'active')->get(),
            'jenis_kelamin' => config('global.jenis_kelamin')
        );
        $data = DosenModel::leftJoin('master_agama', 'master_agama.id', '=', 'dosen.agama')
        ->leftJoin('dosen_keluarga' , 'dosen_keluarga.dosen_id' ,'=' , 'dosen.id')
        ->leftJoin('dosen_kebutuhan_khusus' , 'dosen_kebutuhan_khusus.dosen_id' , '=' , 'dosen.id')
        ->select('dosen.*','dosen_keluarga.pekerjaan' ,'dosen_keluarga.tmt_pns' ,'dosen_keluarga.nip_pasangan','dosen_keluarga.nama_pasangan','dosen_keluarga.status_pernikahan', 'master_agama.title' , 'dosen_kebutuhan_khusus.kebutuhan_khusus' , 'dosen_kebutuhan_khusus.braile' , 'dosen_kebutuhan_khusus.isyarat')
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
            'tahun_ajaran' => TahunAjaranModel::where('row_status' , 'active')->get()
        );
        $penugasan = PenugasanModel::join('master_jurusan' , 'master_jurusan.id','=', 'dosen_penugasan.program_studi_id')
        ->join('master_tahun_ajaran' , 'master_tahun_ajaran.id' , '=' , 'dosen_penugasan.tahun_ajaran')
        ->select('dosen_penugasan.*' , 'master_jurusan.title as program_studi_title' ,'master_tahun_ajaran.title as tahun_ajaran_title')
        ->where('dosen_penugasan.dosen_id' , $id)->where('dosen_penugasan.row_status' , 'active')->get();
        //print_r($penugasan); exit;
        $data = DosenModel::join('master_agama', 'master_agama.id', '=', 'dosen.agama')
        ->join('dosen_keluarga' , 'dosen_keluarga.dosen_id' ,'=' , 'dosen.id')
        ->join('dosen_kebutuhan_khusus' , 'dosen_kebutuhan_khusus.dosen_id' , '=' , 'dosen.id')
        ->select('dosen.*','dosen_keluarga.pekerjaan' ,'dosen_keluarga.tmt_pns' ,'dosen_keluarga.nip_pasangan','dosen_keluarga.nama_pasangan','dosen_keluarga.status_pernikahan', 'master_agama.title' , 'dosen_kebutuhan_khusus.kebutuhan_khusus' , 'dosen_kebutuhan_khusus.braile' , 'dosen_kebutuhan_khusus.isyarat')
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
       // print_r($pengangkatan); exit;
        $data = DosenModel::join('master_agama', 'master_agama.id', '=', 'dosen.agama')
        ->join('dosen_keluarga' , 'dosen_keluarga.dosen_id' ,'=' , 'dosen.id')
        ->join('dosen_kebutuhan_khusus' , 'dosen_kebutuhan_khusus.dosen_id' , '=' , 'dosen.id')
        ->select('dosen.*','dosen_keluarga.pekerjaan' ,'dosen_keluarga.tmt_pns' ,'dosen_keluarga.nip_pasangan','dosen_keluarga.nama_pasangan','dosen_keluarga.status_pernikahan', 'master_agama.title' , 'dosen_kebutuhan_khusus.kebutuhan_khusus' , 'dosen_kebutuhan_khusus.braile' , 'dosen_kebutuhan_khusus.isyarat')
        ->where('dosen.id' , $id)->first();
        return view('/data/dosen_kepangkatan' , compact('data' , 'master' , 'pengangkatan'));
    }

    public function tambahkepangkatan(Request $request){

        $data = $request->all();
        //print_r($data); exit;
        $validation = Validator::make($data, [
            'dosen_id' => 'required',
            'pangkat' => 'required',
            'sk_pangkat' => 'required',
            'tanggal_sk_pangkat' => 'required',
            'tmt_sk_pangkat' => 'required',
            'masa_kerja' => 'required'
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
       // print_r($pengangkatan); exit;
        $data = DosenModel::join('master_agama', 'master_agama.id', '=', 'dosen.agama')
        ->join('dosen_keluarga' , 'dosen_keluarga.dosen_id' ,'=' , 'dosen.id')
        ->join('dosen_kebutuhan_khusus' , 'dosen_kebutuhan_khusus.dosen_id' , '=' , 'dosen.id')
        ->select('dosen.*','dosen_keluarga.pekerjaan' ,'dosen_keluarga.tmt_pns' ,'dosen_keluarga.nip_pasangan','dosen_keluarga.nama_pasangan','dosen_keluarga.status_pernikahan', 'master_agama.title' , 'dosen_kebutuhan_khusus.kebutuhan_khusus' , 'dosen_kebutuhan_khusus.braile' , 'dosen_kebutuhan_khusus.isyarat')
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
       // print_r($pengangkatan); exit;
        $data = DosenModel::join('master_agama', 'master_agama.id', '=', 'dosen.agama')
        ->join('dosen_keluarga' , 'dosen_keluarga.dosen_id' ,'=' , 'dosen.id')
        ->join('dosen_kebutuhan_khusus' , 'dosen_kebutuhan_khusus.dosen_id' , '=' , 'dosen.id')
        ->select('dosen.*','dosen_keluarga.pekerjaan' ,'dosen_keluarga.tmt_pns' ,'dosen_keluarga.nip_pasangan','dosen_keluarga.nama_pasangan','dosen_keluarga.status_pernikahan', 'master_agama.title' , 'dosen_kebutuhan_khusus.kebutuhan_khusus' , 'dosen_kebutuhan_khusus.braile' , 'dosen_kebutuhan_khusus.isyarat')
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
        //print_r($penelitian); exit;
        $data = DosenModel::join('master_agama', 'master_agama.id', '=', 'dosen.agama')
        ->join('dosen_keluarga' , 'dosen_keluarga.dosen_id' ,'=' , 'dosen.id')
        ->join('dosen_kebutuhan_khusus' , 'dosen_kebutuhan_khusus.dosen_id' , '=' , 'dosen.id')
        ->select('dosen.*','dosen_keluarga.pekerjaan' ,'dosen_keluarga.tmt_pns' ,'dosen_keluarga.nip_pasangan','dosen_keluarga.nama_pasangan','dosen_keluarga.status_pernikahan', 'master_agama.title' , 'dosen_kebutuhan_khusus.kebutuhan_khusus' , 'dosen_kebutuhan_khusus.braile' , 'dosen_kebutuhan_khusus.isyarat')
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
        //print_r($penelitian); exit;
        $data = DosenModel::join('master_agama', 'master_agama.id', '=', 'dosen.agama')
        ->join('dosen_keluarga' , 'dosen_keluarga.dosen_id' ,'=' , 'dosen.id')
        ->join('dosen_kebutuhan_khusus' , 'dosen_kebutuhan_khusus.dosen_id' , '=' , 'dosen.id')
        ->select('dosen.*','dosen_keluarga.pekerjaan' ,'dosen_keluarga.tmt_pns' ,'dosen_keluarga.nip_pasangan','dosen_keluarga.nama_pasangan','dosen_keluarga.status_pernikahan', 'master_agama.title' , 'dosen_kebutuhan_khusus.kebutuhan_khusus' , 'dosen_kebutuhan_khusus.braile' , 'dosen_kebutuhan_khusus.isyarat')
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
            ->join('master_status_pegawai', 'master_status_pegawai.id', '=', 'dosen.status_pegawai')
            ->select('master_status_pegawai.title as label', DB::raw('count(dosen.id) as value'))
            ->groupBy('master_status_pegawai.title')->get();

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
            ->join('dosen_keluarga' , 'dosen_keluarga.dosen_id' ,'=' , 'dosen.id')
            ->join('dosen_kebutuhan_khusus' , 'dosen_kebutuhan_khusus.dosen_id' , '=' , 'dosen.id')
            ->select('dosen.*','dosen_keluarga.pekerjaan' ,'dosen_keluarga.tmt_pns' ,'dosen_keluarga.nip_pasangan','dosen_keluarga.nama_pasangan','dosen_keluarga.status_pernikahan', 'master_agama.title' , 'dosen_kebutuhan_khusus.kebutuhan_khusus' , 'dosen_kebutuhan_khusus.braile' , 'dosen_kebutuhan_khusus.isyarat')
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
            ->join('dosen_keluarga' , 'dosen_keluarga.dosen_id' ,'=' , 'dosen.id')
            ->join('dosen_kebutuhan_khusus' , 'dosen_kebutuhan_khusus.dosen_id' , '=' , 'dosen.id')
            ->select('dosen.*','dosen_keluarga.pekerjaan' ,'dosen_keluarga.tmt_pns' ,'dosen_keluarga.nip_pasangan','dosen_keluarga.nama_pasangan','dosen_keluarga.status_pernikahan', 'master_agama.title' , 'dosen_kebutuhan_khusus.kebutuhan_khusus' , 'dosen_kebutuhan_khusus.braile' , 'dosen_kebutuhan_khusus.isyarat')
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
            ->join('dosen_keluarga' , 'dosen_keluarga.dosen_id' ,'=' , 'dosen.id')
            ->join('dosen_kebutuhan_khusus' , 'dosen_kebutuhan_khusus.dosen_id' , '=' , 'dosen.id')
            ->select('dosen.*','dosen_keluarga.pekerjaan' ,'dosen_keluarga.tmt_pns' ,'dosen_keluarga.nip_pasangan','dosen_keluarga.nama_pasangan','dosen_keluarga.status_pernikahan', 'master_agama.title' , 'dosen_kebutuhan_khusus.kebutuhan_khusus' , 'dosen_kebutuhan_khusus.braile' , 'dosen_kebutuhan_khusus.isyarat')
            ->where('dosen.id' , $id)->first();
        return view('/data/dosen_activity' , compact('data','master','idTable' ));
    }

    public function activity_paging(Request $request){
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
}
        