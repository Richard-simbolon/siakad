<?php
namespace App\Http\Controllers;
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
        //return view("data/dosen" , compact("data" , "title" ,"table_display" ,"exclude" ,"Tableshow","tableid"));
        return view("data/dosen" , compact("data" , "title" ,"table_display" ,"exclude" ,"Tableshow","tableid"));


    }
    public function create(){
        $master = array(
            'pekerjaan' => PekerjaanModel::where('row_status' , 'active')->get(),
            'kebutuhan' => KebutuhanKhususModel::where('row_status' , 'active')->get(),
            'status_pegawai' => StatusPegawaiModel::where('row_status' , 'active')->get(),
            'agama' => AgamaModel::where('row_status' , 'active')->get(),
        );
        $title = "Tambah ".ucfirst(request()->segment(1))." ".ucfirst(request()->segment(2));
        $table = array_diff(DB::getSchemaBuilder()->getColumnListing("dosen"), static::$exclude);
        $exclude = static::$exclude;
        $Tableshow = static::$Tableshow;
        $html = static::$html;
        $column = 1;
        return view("data/dosen_create" , compact("table" ,"exclude" , "Tableshow" , "title" , "html", "column" , "master"));

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
                $data['dosen']['tanggal_lahir'] = date($data['dosen']['tanggal_lahir']);
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
                throw $e;
                return json_encode(array('status' => 'error' , 'msg' => 'Terjadi kesalahan saat menyimpan, silahkan coba lagi.'));
            }

        }

    }

    public function paging(Request $request){
        return Datatables::of(DosenModel::join('master_agama', 'dosen.agama', '=', 'master_agama.id')
        ->select("dosen.id" ,"master_agama.title as t_agama","nip" ,"nidn_nup_nidk", "agama" , "dosen.status","nama","tanggal_lahir","jenis_kelamin")->get())->addIndexColumn()->make(true);
    }

    public function view($id){

        $master = array(
            'kebutuhan' => KebutuhanKhususModel::where('row_status' , 'active')->get(),
            'agama' => AgamaModel::where('row_status' , 'active')->get(),
            'pekerjaan' => PekerjaanModel::where('row_status' , 'active')->get(),
            'status_pegawai' => StatusPegawaiModel::where('row_status' , 'active')->get(),
            'jenis_kelamin' => config('global.jenis_kelamin')
        );
        $data = DosenModel::join('master_agama', 'master_agama.id', '=', 'dosen.agama')
        ->join('dosen_keluarga' , 'dosen_keluarga.dosen_id' ,'=' , 'dosen.id')
        ->join('dosen_kebutuhan_khusus' , 'dosen_kebutuhan_khusus.dosen_id' , '=' , 'dosen.id')
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
            'jenis_kelamin' => config('global.jenis_kelamin')
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

    public function tambahpengangkatan(Request $request){
        
        $data = $request->all();
        $validation = Validator::make($data, [
            'dosen_id' => 'required',
            'pangkat' => 'required',
            'sk_pangkat' => 'required',
            'tanggal_sk_pangkat' => 'required',
            'tmt_sk_pangkat' => 'required',
            'masa_kerja' => 'required'
        ]);
        
        if ($validation->fails()) {
            return json_encode(['status'=> 'error', 'msg'=> $validation->messages()]);
        }

        if(PengangkatanModel::create($data)){
            return json_encode(['status'=> 'success', 'msg'=> 'Data berhasil ditambahkan']);
        }else{
            return json_encode(['status'=> 'error', 'msg'=> 'Terjadi kesalahan saat menyimpan data.']);
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
        
        if ($validation->fails()) {
            return json_encode(['status'=> 'error', 'msg'=> $validation->messages()]);
        }

        if(RiwayatPendidikanModel::create($data)){
            return json_encode(['status'=> 'success', 'msg'=> 'Data berhasil ditambahkan']);
        }else{
            return json_encode(['status'=> 'error', 'msg'=> 'Terjadi kesalahan saat menyimpan data.']);
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
        
        if ($validation->fails()) {
            return json_encode(['status'=> 'error', 'msg'=> $validation->messages()]);
        }

        if(RiwayatSertifikasiModel::create($data)){
            return json_encode(['status'=> 'success', 'msg'=> 'Data berhasil ditambahkan']);
        }else{
            return json_encode(['status'=> 'error', 'msg'=> 'Terjadi kesalahan saat menyimpan data.']);
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
        
        if ($validation->fails()) {
            return json_encode(['status'=> 'error', 'msg'=> $validation->messages()]);
        }

        if(RiwayatPenelitianModel::create($data)){
            return json_encode(['status'=> 'success', 'msg'=> 'Data berhasil ditambahkan']);
        }else{
            return json_encode(['status'=> 'error', 'msg'=> 'Terjadi kesalahan saat menyimpan data.']);
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
        
        if ($validation->fails()) {
            return json_encode(['status'=> 'error', 'msg'=> $validation->messages()]);
        }

        if(RiwayatFungsionalModel::create($data)){
            return json_encode(['status'=> 'success', 'msg'=> 'Data berhasil ditambahkan']);
        }else{
            return json_encode(['status'=> 'error', 'msg'=> 'Terjadi kesalahan saat menyimpan data.']);
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

        return json_encode($data);
    }

    public function grafik_jenis(){
        $data = DosenModel::where('dosen.row_status','active')
            ->join('master_jenis_pegawai','master_jenis_pegawai.id', '=', 'dosen.jenis_pegawai')
            ->select('master_jenis_pegawai.title as label', DB::raw('count(dosen.id) as value'))
            ->groupBy('master_jenis_pegawai.title')->get();

        return json_encode($data);
    }

    public function grafik_status(){
        $data = DosenModel::where('dosen.row_status','active')
            ->join('master_status_pegawai', 'master_status_pegawai.id', '=', 'dosen.status_pegawai')
            ->select('master_status_pegawai.title as label', DB::raw('count(dosen.id) as value'))
            ->groupBy('master_status_pegawai.title')->get();

        return json_encode($data);
    }
}
        