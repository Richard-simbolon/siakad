<?php
namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\ JadwalUjianModel;
use Yajra\DataTables\DataTables;
use App\JurusanModel;
use App\AngkatanModel;
use App\KelasModel;
use App\SemesterModel;
use App\MahasiswaModel;

class JadwalUjian extends Controller
{
    static $Tableshow = ["id" => ["table" => ["tablename" =>"null" , "field"=> "id"] , "record"=>"Id"],
        ];
    static $html = ["id"=>["type"=>"null" , "value"=>"null" , "validation" => ""] ,
];
    static $exclude = ["id","created_at","updated_at","created_by","update_by"];
    static $tablename = "JadwalUjian";
    public function index()
    {
        $master = array(
            'jurusan' => JurusanModel::where('row_status' , 'active')->get(),
            'angkatan' => AngkatanModel::where('row_status' , 'active')->get(),
            'kelas' => KelasModel::where('row_status' , 'active')->get(),
            'semester'=> SemesterModel::where('row_status', 'active')->get(),
        );
        //print_r($master); exit;
        //$data = DB::table('view_input_nilai_mahasiswa')->get();
        $title = ucfirst(request()->segment(1))." ".ucfirst(request()->segment(2));
        $tableid = "JadwalUjian";
        $table_display = DB::getSchemaBuilder()->getColumnListing(static::$tablename);
        $exclude = static::$exclude;
        $Tableshow = static::$Tableshow;
        return view("data/jadwal_ujian" , compact("title" ,"table_display" ,"exclude" ,"Tableshow","tableid", "master"));

    }
    public function create(){
        $title = "Tambah ".ucfirst(request()->segment(1))." ".ucfirst(request()->segment(2));
        $table = array_diff(DB::getSchemaBuilder()->getColumnListing("jadwal_ujian"), static::$exclude);
        $exclude = static::$exclude;
        $Tableshow = static::$Tableshow;
        $html = static::$html;
        $column = 1;
        return view("setting/master_create" , compact("table" ,"exclude" , "Tableshow" , "title" , "html", "column"));

    }

    public function save(Request $request){
        $input = $request->all();
        $field = [];
        $data = [];
        $table = DB::getSchemaBuilder()->getColumnListing("jadwal_ujian");
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
        $save  = JadwalUjianModel::firstOrCreate($data);
        if($save){
            return $this->success("Data berhasil disimpan.");
        }
    }

    public function edit(Request $request){

    }

    public function paging(Request $request){
        //print_r($request->all()); exit;
        $post= $request->all();
        $where = [];
        foreach($post['filter'] as $key=>$val){
            if($val){
                $where[$key] = $val;
            }
        }
        if(count($where) > 0){
            return Datatables::of(DB::table('view_input_nilai_mahasiswa')->where($where)->get())->make(true);
        }
        return Datatables::of(DB::table('view_input_nilai_mahasiswa')->get())->make(true);

    }

    public function form($id){

        //echo $id; exit;
        $title = "Tambah ".ucfirst(request()->segment(1))." ".ucfirst(request()->segment(2));
        
        $data = DB::table('view_input_nilai_mahasiswa')->where('id' , $id)->first();
        if(!$data->kelas_id){
            echo 'Data Tidak Ditemukan.';
        }
        if(DB::table('nilai_mahasiswa')
        ->where('kelas_perkuliahan_detail_id' , $id)->exists())
        {
            $mahasiswa = DB::table('nilai_mahasiswa')
            ->leftjoin('mahasiswa' , 'mahasiswa.id' , '=' ,'nilai_mahasiswa.mahasiswa_id')
            ->where('nilai_mahasiswa.kelas_perkuliahan_detail_id' , $id)->get();
            
        }else{
            $mahasiswa = MahasiswaModel::where('kelas_id' , $data->kelas_id)->where('status' , '1')->get();
        }

        //print_r($mahasiswa); exit;

        return view("data/ujian_create" , compact("title" , "mahasiswa", "data"));

    }

}
        