<?php
            namespace App\Http\Controllers;
            use Illuminate\Support\Facades\DB;
            use Illuminate\Support\Facades\Validator;
            use Illuminate\Http\Request;
            use App\ AsalProgramStudiModel;
            use Yajra\DataTables\DataTables;
            use File;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class AsalProgramStudi extends Controller
            {
                static $Tableshow = ["id" => ["table" => ["tablename" =>"null" , "field"=> "id"] , "record"=>"Id"],
                    "title" => ["table" => ["tablename" =>"null" , "field"=> "title"] , "record"=>"Title"],
                    "row_status" => ["table" => ["tablename" =>"null" , "field"=> "row_status"] , "record"=>"Status"],
                    ];
                static $html = ["id"=>["type"=>"null" , "value"=>"null" , "validation" => ""] ,
                                "title"=>["type"=>"text" , "value"=>"null" , "validation" => ""] ,
                                "row_status"=>["type"=>"radio" , "value"=>"active,notactive,deleted" , "validation" => ""] ,
                                ];
                static $exclude = ["id","created_at","updated_at","created_by","update_by"];
                static $tablename = "AsalProgramStudi";
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
                    $data = AsalProgramStudiModel::get();
                    $title = ucfirst(request()->segment(1))." ".ucfirst(request()->segment(2));
                    $tableid = "AsalProgramStudi";
                    $table_display = DB::getSchemaBuilder()->getColumnListing("master_asal_program_studi");
                    $exclude = static::$exclude;
                    $Tableshow = static::$Tableshow;
                    return view("setting/general_view" , compact("data" , "title" ,"table_display" ,"exclude" ,"Tableshow","tableid"));

                }
                
                public function create(){
                    $title = "Tambah ".ucfirst(request()->segment(1))." ".ucfirst(request()->segment(2));
                    $table = array_diff(DB::getSchemaBuilder()->getColumnListing("master_asal_program_studi"), static::$exclude);
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
                    $table = DB::getSchemaBuilder()->getColumnListing("master_asal_program_studi");
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
                    $save  = AsalProgramStudiModel::firstOrCreate($data);

                    $filedata = AsalProgramStudiModel::select('id' ,'title')
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
                    return Datatables::of(AsalProgramStudiModel::all())->addIndexColumn()->make(true);
                }

            }
        