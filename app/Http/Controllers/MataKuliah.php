<?php
namespace App\Http\Controllers;
use App\SemesterModel;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\MataKuliahModel;
use App\JurusanModel;
use App\JenisMatakuliahModel;
use Yajra\DataTables\DataTables;
Use File;
use Illuminate\Support\Facades\Redirect;

class MataKuliah extends Controller
{
    static $Tableshow = [   "id" => ["table" => ["tablename" =>"null" , "field"=> "id"] , "record"=>"Id"],
                            "kode_mata_kuliah"=> ["table" => ["tablename" =>"null" , "field"=> "id"] , "record"=>"Kode MK"],
                            "nama_mata_kuliah"=> ["table" => ["tablename" =>"null" , "field"=> "id"] , "record"=>"Nama MK"],
                            "tipe_mata_kuliah"=> ["table" => ["tablename" =>"null" , "field"=> "id"] , "record"=>"Tipe"],
                            "program_studi_id"=> ["table" => ["tablename" =>"null" , "field"=> "id"] , "record"=>"Program Studi"],
                            "row_status"=> ["table" => ["tablename" =>"null" , "field"=> "id"] , "record"=>"Status"],
                            "id_jenis_mata_kuliah"=> ["table" => ["tablename" =>"null" , "field"=> "id"] , "record"=>"Jenis MK"],
                            "sks_mata_kuliah"=> ["table" => ["tablename" =>"null" , "field"=> "id"] , "record"=>"Bobot MK"],
                            "sks_tatap_muka"=> ["table" => ["tablename" =>"null" , "field"=> "id"] , "record"=>"Bobot TM"],
                            "sks_praktek"=> ["table" => ["tablename" =>"null" , "field"=> "id"] , "record"=>"B. Praktikum"],
                            "sks_praktek_lapangan"=> ["table" => ["tablename" =>"null" , "field"=> "id"] , "record"=>"B. PKL"],
                            "sks_simulasi"=> ["table" => ["tablename" =>"null" , "field"=> "id"] , "record"=>"B. Simulasi"],
                            "metode_kuliah"=> ["table" => ["tablename" =>"null" , "field"=> "id"] , "record"=>"Metode Pembelajaran"],
                            "tanggal_mulai_efektif"=> ["table" => ["tablename" =>"null" , "field"=> "id"] , "record"=>"Efektif"],
                            "tanggal_selesai_efektif"=> ["table" => ["tablename" =>"null" , "field"=> "id"] , "record"=>"Berakhir"],
                            "created_by"=> ["table" => ["tablename" =>"null" , "field"=> "id"] , "record"=>"id"],
                            "created_at"=> ["table" => ["tablename" =>"null" , "field"=> "id"] , "record"=>"id"],
                            "modified_by"=> ["table" => ["tablename" =>"null" , "field"=> "id"] , "record"=>"id"],
                            "updated_at"=> ["table" => ["tablename" =>"null" , "field"=> "id"] , "record"=>"id"],
                        ];
    static $html = ["id"=>["type"=>"null" , "value"=>"null" , "validation" => ""],
                    "row_status"=>["type"=>"radio" , "value"=>"active,deleted,notactive" , "validation" => "required"],
                    "kode_mata_kuliah"=>["type"=>"text" , "value"=>"null" , "validation" => "required"],
                    "nama_mata_kuliah"=>["type"=>"text" , "value"=>"null" , "validation" => "required"],
                    "tipe_mata_kuliah"=>["type"=>"text" , "value"=>"null" , "validation" => "required"],
                    "program_studi_id"=>["type"=>"select" , "value"=>"null" , "validation" => "required"],
                    "id_jenis_mata_kuliah"=>["type"=>"select" , "value"=>"null" , "validation" => "required"],
                    "sks_mata_kuliah"=>["type"=>"number" , "value"=>"null" , "validation" => "required"],
                    "sks_tatap_muka"=>["type"=>"number" , "value"=>"null" , "validation" => "required"],
                    "sks_praktek"=>["type"=>"number" , "value"=>"null" , "validation" => "required"],
                    "sks_praktek_lapangan"=>["type"=>"number" , "value"=>"null" , "validation" => "required"],
                    "sks_simulasi"=>["type"=>"number" , "value"=>"null" , "validation" => "required"],
                    "metode_kuliah"=>["type"=>"textarea" , "value"=>"null" , "validation" => "required"],
                    "tanggal_mulai_efektif"=>["type"=>"date" , "value"=>"null" , "validation" => "required"],
                    "tanggal_selesai_efektif"=>["type"=>"date" , "value"=>"null" , "validation" => "required"],
                    "created_by"=>["type"=>"null" , "value"=>"null" , "validation" => "required"],
                    "created_at"=>["type"=>"null" , "value"=>"null" , "validation" => "required"],
                    "modified_by"=>["type"=>"null" , "value"=>"null" , "validation" => "required"],
                    "updated_at"=>["type"=>"null" , "value"=>"null" , "validation" => "required"],
                    ];
    static $exclude = ["id","id_matkul","created_at","updated_at","created_by","modified_by"];
    static $exclude_table = ["id","id_matkul","row_status","created_at","updated_at","created_by","modified_by", "bobot_tatap_muka", "bobot_praktikum", "bobot_praktek_lapangan", "bobot_simulasi", "metode_pembelajaran","tanggal_mulai_efektif","tanggal_akhir_efektif", "tipe_mata_kuliah"];

    static $webservice = [ 
            'id_matkul' =>'id_matkul',
            'kode_mata_kuliah' => 'kode_mata_kuliah',
            'nama_mata_kuliah' => 'nama_mata_kuliah',
            'id_prodi' => 'id_prodi',
            'id_jenis_mata_kuliah' => 'id_jenis_mata_kuliah',
            'id_kelompok_mata_kuliah' => 'id_kelompok_mata_kuliah',
            'sks_mata_kuliah' => 'sks_mata_kuliah',
            'sks_tatap_muka' => 'sks_tatap_muka',
            'sks_praktek' => 'sks_praktek',
            'sks_praktek_lapangan' => 'sks_praktek_lapangan',
            'sks_simulasi' => 'sks_simulasi',
            'metode_kuliah' => 'metode_kuliah',
            'ada_sap' => 'ada_sap',
            'ada_silabus' => 'ada_silabus',
            'ada_bahan_ajar' => 'ada_bahan_ajar',
            'ada_acara_praktek' => 'ada_acara_praktek',
            'ada_diktat' => 'ada_diktat',
            'tanggal_mulai_efektif' => 'tanggal_mulai_efektif',
            'tanggal_selesai_efektif' => 'tanggal_akhir_efektif'
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
        $data = MataKuliahModel::get();// DB::getSchemaBuilder()->getColumnListing("mata_kuliah")
        $tableid = 'matakuliah';
        $title = ucfirst(request()->segment(1))." ".ucfirst(request()->segment(2));
        $table_display = MataKuliahModel::tabel_column();

        $exclude = static::$exclude_table;

        $Tableshow = static::$Tableshow;
        return view("setting/general_view" , compact("data" , "title" ,"table_display" ,"exclude" ,"Tableshow","tableid"));

    }
    

    public function sinc(){
        $token = $this->check_auth_siakad();
        $data = array('act'=>"GetDetailMataKuliah" , "token"=>$token, "filter"=> "","limit"=>"" , "offset" =>0);
        $result_string = $this->runWS($data, 'json');
        $result = json_decode($result_string , true);
        if(!$result){
            $this->sinkron_log('sync_mata_kuliah_get','gagal', 0);

            return json_encode(array('status' => 'error' , 'msg' => 'Terjadi kesalahan mensinkronkan data, silahkan coba lagi.'));
        }
        if(array_key_exists('data' , $result)){
            if(count($result['data']) > 1){
                DB::beginTransaction();
                try{
                    foreach($result['data'] as $item){
                        unset($item['nama_program_studi']);
                        MataKuliahModel::updateOrInsert($item);
                    }
                    DB::commit();
                    $this->sinkron_log('sync_mata_kuliah_get','sukses', count($result['data']));
                    DB::table('sinkronisasi_logs')
                    ->insert(array('title' => 'GetListMataKuliah' ,'created_by'=> Auth::user()->id ,'created_at'=>date('Y-m-d H:i:s')));
                    return json_encode(array('status' => 'success' , 'msg' => 'Data Berhasil Disinkronisai.'));
                } catch(\Exception $e){
                    DB::rollBack(); 
                    throw $e;
                    return json_encode(array('status' => 'error' , 'msg' => 'Terjadi kesalahan mensinkronkan data, silahkan coba lagi.'));
                }      
            }
        }
    }

    public function add_mat_kul_sinc(){
        $token = $this->check_auth_siakad();
        //echo $token; exit;
        //$table_display = DB::getSchemaBuilder()->getColumnListing("mata_kuliah");
        $data_sinc = MataKuliahModel::select('id','id_matkul','row_status')->where("is_sinc" ,"0")->get();
        foreach($data_sinc as $item){
            $data = [];
            $data_master = MataKuliahModel::select('mata_kuliah.*' ,'master_jurusan.title as nama_program_studi')->join( 'master_jurusan' , 'mata_kuliah.id_prodi' , '=' ,'master_jurusan.id')->where('mata_kuliah.id' , '=' , $item->id)->first();
            if($data_master){
                foreach(static::$webservice as $key => $val){
                    $data[$val] = $data_master->$key;
                }
            }
            if($item->row_status != 'deleted'){
                if(strlen($item->id_matkul) > 8){
                    unset($data['id_matkul']);
                    $action = array('act'=>"UpdateMataKuliah" , "token"=>$token ,'key' => array('id_matkul' => $item->id_matkul), "record"=> $data);
                    $response = $this->runWS($action, 'json');
                    $res1 = json_decode($response);
                    
                    if($res1->error_code != '0'){
                        DB::table('sinkronisasi')->update(array('last_sync_status'=>'gagal'))->where('sync_code' ,'sync_mata_kuliah_get');
                        return json_encode(array('status'=>'error','message' => 'Terjadi kesalahan pada saat sinkron biodata mahasiswa dengan nama '.$data['nama_mahasiswa'].' error_desc '.$res1->error_desc));
                    }else{
                        if(!MataKuliahModel::where('id' ,$item->id)->update(array('is_sinc' =>'1'))){
                            DB::table('sinkronisasi_logs')
                            ->insert(array('title' => 'InsertMataKuliah' ,'created_by'=> Auth::user()->id ,'created_at'=>date('Y-m-d H:i:s')));
                        }
                    }

                }else{
                    unset($data['id_matkul']);
                    $action = array('act'=>"InsertMataKuliah" , "token"=>$token, "record"=> $data);
                    $response = $this->runWS($action, 'json');
                    $result = json_decode($response , true);
                    //print_r($result_mhs);
                    $id_matkul = $result['data']['id_matkul'];
                    if($id_matkul){
                        if(!MataKuliahModel::where('id' ,$item->id)->update(array('id_matkul'=>$id_matkul , 'is_sinc' =>'1'))){
                            DB::table('sinkronisasi_logs')
                            ->insert(array('title' => 'InsertMataKuliah' ,'created_by'=> Auth::user()->id ,'created_at'=>date('Y-m-d H:i:s')));
                            return json_encode(array('status' => 'Error' , 'msg' => 'Data Tidak Berhasil Disinkronisai.'));
                        }
                    }
                }
            }else{
                if(strlen($item->id_matkul) > 8){
                    $action = array('act'=>"DeleteMataKuliah" , "token"=>$token ,'key' => array('id_matkul' => $item->id_matkul));
                    $response = $this->runWS($action, 'json');
                    $res1 = json_decode($response);
                    if(!MataKuliahModel::where('id' ,$item->id)->update(array('is_sinc' =>'1'))){
                        DB::table('sinkronisasi_logs')
                        ->insert(array('title' => 'InsertMataKuliah' ,'created_by'=> Auth::user()->id ,'created_at'=>date('Y-m-d H:i:s')));
                        return json_encode(array('status' => 'Error' , 'msg' => 'Data Tidak Berhasil Disinkronisai.'));
                    }
                }else{
                    MataKuliahModel::where('id' ,$item->id)->update(array('is_sinc' =>'1'));
                }
            }
        }
        DB::table('sinkronisasi')->where('sync_code','like','%sync_mata_kuliah_get%')->update(array('last_sync_status'=>'success'));
        return json_encode(array('status' => 'Success' , 'msg' => 'Data Berhasil Disinkronisai.'));
    }

    public function create(){
        $master = array(
            'jurusan' => JurusanModel::where('row_status' , 'active')->get(),
            'jenis' => JenisMatakuliahModel::where('row_status' , 'active')->get()
        );

        $title = "Tambah ".ucfirst(request()->segment(1))." ".ucfirst(request()->segment(2));

        $table = array_diff(MataKuliahModel::get_row() , static::$exclude);//array_diff(DB::getSchemaBuilder()->getColumnListing("mata_kuliah") , static::$exclude);
        $exclude = static::$exclude;
        $Tableshow = static::$Tableshow;
        $html = static::$html;
        $column = 2;
        return view("master/matakuliah" , compact("table" ,"exclude" , "Tableshow" , "title" , "html" , "column", "master"));

    }

    public function save(Request $request){
        $input = $request->all();
        $field = [];
        $data = [];
        $table = DB::getSchemaBuilder()->getColumnListing("mata_kuliah");
        $fieldvalidatin = static::$html;
        foreach($table as $val){
            if(array_key_exists($val , $fieldvalidatin) && !in_array($val , static::$exclude)){
                $field[$val] = $fieldvalidatin[$val]["validation"];
                $data[$val] = $input[$val];
            }
        }
        $data['modified_by'] = '';
        $data['created_by'] = Auth::user()->nama;
        $validation = Validator::make($request->all(), $field);
        if ($validation->fails()) {
            return json_encode(["status"=> "false", "message"=> $validation->messages()]);
        }

        if(!MataKuliahModel::where('kode_mata_kuliah','=',$data['kode_mata_kuliah'])->first()){
            $save = MataKuliahModel::firstOrCreate($data);
        }else{
            return json_encode(["status"=> "false", "message"=> array(["Kode matakuliah ini sudah ada"])]);
        }

        if($save){
            return $this->success("Data berhasil disimpan.");
        }
    }

    public function view($id){
        $data = MataKuliahModel::where('id' , $id)->first();
        $master = array(
            'jurusan' => JurusanModel::where('row_status' , 'active')->get(),
            'jenis_mata_kuliah' => JenisMatakuliahModel::where('row_status' , 'active')->get()
        );


        $title = "View ".ucfirst(request()->segment(1))." ".ucfirst(request()->segment(2));
        $table = array_diff(DB::getSchemaBuilder()->getColumnListing("mata_kuliah") , static::$exclude);
        $exclude = static::$exclude;
        $Tableshow = static::$Tableshow;
        $html = static::$html;
        $column = 1;
        $controller = "matakuliah";
        return view("master/matakuliah_view" , compact("data" , "title" , 'html' ,"table" ,"exclude" ,"Tableshow", "column", "controller", "master"));
    }

    public function edit($id){
        $data = MataKuliahModel::where('id' , $id)->first();
        $master = array(
            'jurusan' => JurusanModel::where('row_status' , 'active')->get(),
            'jenis_mata_kuliah' => JenisMatakuliahModel::where('row_status' , 'active')->get()
        );

        $title = "Edit ".ucfirst(request()->segment(1))." ".ucfirst(request()->segment(2));
        $table = array_diff(DB::getSchemaBuilder()->getColumnListing("mata_kuliah") , static::$exclude);
        $exclude = static::$exclude;
        $Tableshow = static::$Tableshow;
        $html = static::$html;
        $column = 1;
        $controller = "matakuliah";

        return view("master/matakuliah_edit" , compact("data" , "title" , 'html' ,"table"  ,"Tableshow", "column", "controller", "master"));
    }


    public function update(Request $request){
        $input = $request->all();
        $table = DB::getSchemaBuilder()->getColumnListing("mata_kuliah");

        $fieldvalidatin = static::$html;
        foreach($table as $val){
            if(array_key_exists($val , $fieldvalidatin) && !in_array($val , static::$exclude)){
                $field[$val] = $fieldvalidatin[$val]["validation"];
                $data[$val] = $input[$val];
            }
        }
        $validation = Validator::make($request->all(), $field);
        if ($validation->fails()) {
            return json_encode(["status"=> "false", "message"=> $validation->messages()]);
        }

        $data =  MataKuliahModel::where('id' , $request->id)->first();
        $data->kode_mata_kuliah = $request->kode_mata_kuliah;
        $data->nama_mata_kuliah = $request->nama_mata_kuliah;
        $data->tipe_mata_kuliah = $request->tipe_mata_kuliah;
        $data->id_prodi = $request->id_prodi;
        $data->id_jenis_mata_kuliah = $request->id_jenis_mata_kuliah;
        $data->sks_mata_kuliah = $request->sks_mata_kuliah;
        $data->sks_tatap_muka = $request->sks_tatap_muka;
        $data->sks_praktek = $request->sks_praktek;
        $data->sks_praktek_lapangan = $request->sks_praktek_lapangan;
        $data->sks_simulasi = $request->sks_simulasi;
        $data->metode_kuliah = $request->metode_kuliah;
        $data->tanggal_mulai_efektif = $request->tanggal_mulai_efektif;
        $data->tanggal_selesai_efektif = $request->tanggal_selesai_efektif;
        $data->modified_by = Auth::user()->nama;

        if($data->save()){
            return json_encode(["status"=> "success", "message"=> $validation->messages()]);
        }else{
            return json_encode(["status"=> "false", "message"=> $validation->messages()]);
        }
    }

    public function delete(Request $request){
        $data =  MataKuliahModel::where('id', $request->id)->first();
        $data->row_status = 'deleted';

        if($data->save()){
            return $this->success("Data berhasil disimpan.");
        }else{
            return json_encode(["status"=> "false", "msg"=> "Mohon maaf, terjadi kesalahan sistem"]);
        }
    }

    public function paging(Request $request){
        return Datatables::of(MataKuliahModel::where('mata_kuliah.row_status', 'active')
            ->join('master_jurusan', 'master_jurusan.id', '=', 'mata_kuliah.id_prodi')
            ->join('master_jenis_matakuliah', 'master_jenis_matakuliah.id', '=', 'mata_kuliah.id_jenis_mata_kuliah')
            ->select("mata_kuliah.id", "kode_mata_kuliah", "nama_mata_kuliah", "sks_mata_kuliah", "master_jurusan.title as program_studi_id", "master_jenis_matakuliah.title as jenis_mata_kuliah_id", "mata_kuliah.row_status")
            ->get())->addIndexColumn()->make(true);
    }
}
