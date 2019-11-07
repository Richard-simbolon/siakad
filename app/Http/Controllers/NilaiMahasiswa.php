<?php
namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\ NilaiMahasiswaModel;
use Yajra\DataTables\DataTables;
use App\JurusanModel;
use App\AngkatanModel;
use App\KelasModel;
use App\SemesterModel;
use App\MahasiswaModel;

class NilaiMahasiswa extends Controller
{
    static $Tableshow = ["id" => ["table" => ["tablename" =>"null" , "field"=> "id"] , "record"=>"Id"],
        "row_status" => ["table" => ["tablename" =>"null" , "field"=> "row_status"] , "record"=>"Row_status"],
        ];
    static $html = ["id"=>["type"=>"null" , "value"=>"null" , "validation" => ""] ,
"row_status"=>["type"=>"null" , "value"=>"null" , "validation" => ""] ,
];
    static $exclude = ["id","created_at","updated_at","created_by","update_by"];
    static $tablename = "NilaiMahasiswa";

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
        $tableid = "KelasPerkuliahan";
        $table_display = DB::getSchemaBuilder()->getColumnListing(static::$tablename);
        $exclude = static::$exclude;
        $Tableshow = static::$Tableshow;
        return view("data/nilai_mahasiswa" , compact("title" ,"table_display" ,"exclude" ,"Tableshow","tableid", "master"));
    }

    public function create(){
        $title = "Tambah ".ucfirst(request()->segment(1))." ".ucfirst(request()->segment(2));
        $table = array_diff(DB::getSchemaBuilder()->getColumnListing("nilai_mahasiswa"), static::$exclude);
        $exclude = static::$exclude;
        $Tableshow = static::$Tableshow;
        $html = static::$html;
        $column = 1;
        return view("setting/master_create" , compact("table" ,"exclude" , "Tableshow" , "title" , "html", "column"));

    }

    public function save(Request $request){
        $post = $request->all();
        $where = [];
        foreach($post['mahasiswa'] as $key => $item){
            $where['mata_kuliah_id'] = $post['mata_kuliah_id'];
            $where['kelas_perkuliahan_id'] = $post['kelas_perkuliahan_id'];
            $where['kelas_perkuliahan_detail_id'] = $post['kelas_perkuliahan_detail_id'];
            $where['mahasiswa_id'] = $key;
            
            $item['nilai_uts'] = $item['nilai_uts'] ? $item['nilai_uts'] : 0;
            $item['nilai_uas'] = $item['nilai_uas'] ? $item['nilai_uas'] : 0;
            $item['nilai_akhir'] = $item['nilai_akhir'] ? $item['nilai_akhir'] : 0;
            $item['kelas_perkuliahan_detail_id'] = $post['kelas_perkuliahan_detail_id'];
            $item['mata_kuliah_id'] = $post['mata_kuliah_id'];
            $item['jurusan_id'] = $post['jurusan_id'];
            $item['semester_id'] = $post['semester_id'];
            $item['mahasiswa_id'] = $key;
            $item['angkatan_id'] = $post['angkatan_id'];
            $item['kelas_perkuliahan_id'] = $post['kelas_perkuliahan_id'];
            DB::table('nilai_mahasiswa')->updateOrInsert($where , $item);
        }

    }

    public function edit($id){
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
        
        return view("data/nilai_mahasiswa_update" , compact("data" ,"mahasiswa"));
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

}
