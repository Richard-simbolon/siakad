<?php
            namespace App\Http\Controllers;
            use Illuminate\Support\Facades\DB;
            use Illuminate\Support\Facades\Validator;
            use Illuminate\Http\Request;
            use App\ KelasModel;
            use App\JurusanModel;
            use Yajra\DataTables\DataTables;
            class Kelas extends Controller
            {
                static $Tableshow = ["id" => ["table" => ["tablename" =>"null" , "field"=> "id"] , "record"=>"Id"],
                    "title" => ["table" => ["tablename" =>"null" , "field"=> "title"] , "record"=>"Title"],
                    "jurusan_id" => ["table" => ["tablename" =>"null" , "field"=> "jurusan_id"] , "record"=>"Jurusan"],
                    "row_status" => ["table" => ["tablename" =>"null" , "field"=> "row_status"] , "record"=>"status"],
                    ];
                static $html = ["id"=>["type"=>"null" , "value"=>"null" , "validation" => ""] ,
                    "title"=>["type"=>"text" , "value"=>"null" , "validation" => ""] ,
                    "jurusan_id"=>["type"=>"text" , "value"=>"null" , "validation" => ""] ,
                    "row_status"=>["type"=>"radio" , "value"=>"active,notactive,deleted" , "validation" => ""] ,
                    ];

                static $exclude = ["id","created_at","updated_at","created_by","update_by"];
                static $tablename = "Kelas";
                public function index()
                {
                    $data = KelasModel::get();
                    $title = ucfirst(request()->segment(1))." ".ucfirst(request()->segment(2));
                    $tableid = "Kelas";
                    $table_display = DB::getSchemaBuilder()->getColumnListing("master_kelas");
                    $exclude = static::$exclude;
                    $Tableshow = static::$Tableshow;
                    return view("master/kelas" , compact("data" , "title" ,"table_display" ,"exclude" ,"Tableshow","tableid"));

                }
                public function create(){
                    $master = array(
                        'jurusan' => JurusanModel::where('row_status' , 'active')->get()
                    );
                    $title = "Tambah ".ucfirst(request()->segment(1))." ".ucfirst(request()->segment(2));
                    $table = array_diff(DB::getSchemaBuilder()->getColumnListing("master_kelas"), static::$exclude);
                    $exclude = static::$exclude;
                    $Tableshow = static::$Tableshow;
                    $html = static::$html;
                    $column = 1;
                    return view("master/kelas_create" , compact("table" ,"exclude" , "Tableshow" , "title" , "html", "column" ,'master'));

                }

                public function save(Request $request){
                    $input = $request->all();
                    $field = [];
                    $data = [];
                    $table = DB::getSchemaBuilder()->getColumnListing("master_kelas");
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
                    $save  = KelasModel::firstOrCreate($data);
                    if($save){
                        return $this->success("Data berhasil disimpan.");
                    }
                }

                public function edit(Request $request){

                }

                public function paging(Request $request){
                    return Datatables::of(KelasModel::join('master_jurusan', 'master_jurusan.id', '=', 'master_kelas.jurusan_id')
                        ->select("master_kelas.id" ,"master_kelas.title as nama", "master_jurusan.title as jurusan", "master_kelas.row_status")->get())->make(true);
                }


            }
        