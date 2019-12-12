<?php
            namespace App\Http\Controllers;
            use Illuminate\Support\Facades\DB;
            use Illuminate\Support\Facades\Validator;
            use Illuminate\Http\Request;
            use App\ JenisKelaminModel;
            Use File;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class JenisKelamin extends Controller
            {
                static $Tableshow = [
                                    "id" => ["table" => ["tablename" =>"null" , "field"=> "id"] , "record"=>"id"],
                                    "title" => ["table" => ["tablename" =>"null" , "field"=> "title"] , "record"=>"Jenis Kelamin"],
                                    ];
                static $html = ["id"=>["type"=>"null" , "value"=>"null" , "validation" => ""] ,
                                "title"=>["type"=>"text" , "value"=>"null" , "validation" => "required"] ,
                                ];
                static $exclude = ["id","created_at","updated_at","created_by","updated_by"];
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
                    $data = JenisKelaminModel::get();
                    $title = ucfirst(request()->segment(1))." ".ucfirst(request()->segment(2));
                    $table_display = DB::getSchemaBuilder()->getColumnListing('master_jenis_kelamin');
                    $exclude = static::$exclude;
                    $Tableshow = static::$Tableshow;
                    return view("setting/general_view" , compact("data" , "title" ,"table_display" , "exclude" ,'Tableshow'));

                }
                public function create(){
                    $title = "Create ".ucfirst(request()->segment(1))." ".ucfirst(request()->segment(2));
                    $table = DB::getSchemaBuilder()->getColumnListing("master_jenis_kelamin");
                    $exclude = static::$exclude;
                    $Tableshow = static::$Tableshow;
                    $html = static::$html;
                    return view('setting/master_create' , compact('table' ,'exclude' , 'tableshow' , 'title' , 'html'));
                }

                public function save(Request $request){
                    $input = $request->all();
                    $field = [];
                    $data = [];
                    $table = DB::getSchemaBuilder()->getColumnListing("master_jenis_kelamin");
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
                    $save  = JenisKelaminModel::firstOrCreate($data);
                    $filedata = JenisKelaminModel::select('id' ,'title')
                        ->where('row_status', '=', 'active')
                        ->get();

                    if($filedata){
                        File::put(public_path().'/master/'.strtolower(static::$tablename).'.php',json_encode($filedata));
                    }
                    if($save){
                        return $this->success("Data berhasil disimpan.");
                    }
                }


            }

