<?php
            namespace App\Http\Controllers;
            use Illuminate\Support\Facades\DB;
            use Illuminate\Support\Facades\Validator;
            use Illuminate\Http\Request;
            use App\JurusanModel;
            use Yajra\DataTables\DataTables;
            Use File;
            class Jurusan extends Controller
            {
                static $Tableshow = ["id" => ["table" => ["tablename" =>"null" , "field"=> "id"] , "record"=>"Id"],
                    "row_status" => ["table" => ["tablename" =>"null" , "field"=> "row_status"] , "record"=>"Status"],
                    "title" => ["table" => ["tablename" =>"null" , "field"=> "title"] , "record"=>"Title"],
                    "deskripsi" => ["table" => ["tablename" =>"null" , "field"=> "deskripsi"] , "record"=>"Deskripsi"],
                    ];
                static $html = ["id"=>["type"=>"" , "value"=>"null" , "validation" => ""] ,
                                "row_status"=>["type"=>"radio" , "value"=>"active,notactive,deletd" , "validation" => "required"] ,
                                "title"=>["type"=>"text" , "value"=>"null" , "validation" => "required"] ,
                                ];
                static $exclude = ["id","created_at","updated_at","created_by","update_by"];
                static $tablename = "Jurusan";
                
                public function index()
                {

                    //echo 'asdasd'; exit;
                    $data = JurusanModel::get();
                    $title = ucfirst(request()->segment(1))." ".ucfirst(request()->segment(2));
                    $tableid = "Jurusan";
                    $table_display = DB::getSchemaBuilder()->getColumnListing("master_jurusan");
                    $exclude = static::$exclude;
                    $Tableshow = static::$Tableshow;
                    return view("setting/general_view" , compact("data" , "title" ,"table_display" ,"exclude" ,"Tableshow","tableid"));

                }
                public function create(){
                    $title = "Tambah ".ucfirst(request()->segment(1))." ".ucfirst(request()->segment(2));
                    $table = array_diff(DB::getSchemaBuilder()->getColumnListing("master_jurusan"), static::$exclude);
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
                    $table = DB::getSchemaBuilder()->getColumnListing("master_jurusan");
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
                    $save  = JurusanModel::firstOrCreate($data);

                    $filedata = JurusanModel::select('id' ,'title')
                    ->where('row_status', '=', 'active')
                    ->get();

                    if($filedata){
                        File::put(public_path().'/master/'.strtolower(static::$tablename).'.php',json_encode($filedata));
                    }
                    if($save){
                        return $this->success("Data berhasil disimpan.");
                    }
                }

                public function edit(Request $request){

                }

                public function paging(Request $request){
                    return Datatables::of(JurusanModel::all())->addIndexColumn()->make(true);
                }

            }
        