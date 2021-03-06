<?php
            namespace App\Http\Controllers;
            use Illuminate\Support\Facades\DB;
            use Illuminate\Support\Facades\Validator;
            use Illuminate\Http\Request;
            use App\ RuanganModel;
            use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class Ruangan extends Controller
            {
                static $Tableshow = ["id" => ["table" => ["tablename" =>"null" , "field"=> "id"] , "record"=>"Id"],
                    "kode_ruangan" => ["table" => ["tablename" =>"null" , "field"=> "kode_ruangan"] , "record"=>"Kode Ruangan"],
                    "nama_ruangan" => ["table" => ["tablename" =>"null" , "field"=> "nama_ruangan"] , "record"=>"Nama Ruangan"],
                    "keterangan" => ["table" => ["tablename" =>"null" , "field"=> "keterangan"] , "record"=>"Keterangan"],
                    "row_status" => ["table" => ["tablename" =>"null" , "field"=> "row_status"] , "record"=>"Status"],
                    ];
                static $html = ["id"=>["type"=>"null" , "value"=>"null" , "validation" => ""] ,
                    "kode_ruangan"=>["type"=>"text" , "value"=>"null" , "validation" => ""] ,
                    "nama_ruangan"=>["type"=>"text" , "value"=>"null" , "validation" => ""] ,
                    "keterangan"=>["type"=>"text" , "value"=>"null" , "validation" => ""] ,
                    "row_status"=>["type"=>"radio" , "value"=>"active,notactive" , "validation" => ""] ,
                    ];
                static $exclude = ["id","row_status","created_at","updated_at","created_by","update_by"];
                static $tablename = "Ruangan";
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
                    $data = RuanganModel::get();
                    $title = ucfirst(request()->segment(1))." ".ucfirst(request()->segment(2));
                    $tableid = "Ruangan";
                    $table_display = DB::getSchemaBuilder()->getColumnListing("master_ruangan");
                    $exclude = static::$exclude;
                    $Tableshow = static::$Tableshow;
                    return view("setting/general_view" , compact("data" , "title" ,"table_display" ,"exclude" ,"Tableshow","tableid"));

                }
                public function create(){
                    $title = "Tambah ".ucfirst(request()->segment(1))." ".ucfirst(request()->segment(2));
                    $table = array_diff(DB::getSchemaBuilder()->getColumnListing("master_ruangan"), static::$exclude);
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
                    $table = DB::getSchemaBuilder()->getColumnListing("master_ruangan");
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
                    $save  = RuanganModel::firstOrCreate($data);
                    if($save){
                        return $this->success("Data berhasil disimpan.");
                    }
                }

                public function edit(Request $request){

                }

                public function view($id){
                    $data = RuanganModel::where('id' , $id)->first();

                    $title = "Edit ".ucfirst(request()->segment(1))." ".ucfirst(request()->segment(2));
                    $table = array_diff(DB::getSchemaBuilder()->getColumnListing("master_ruangan") , static::$exclude);
                    $exclude = static::$exclude;
                    $Tableshow = static::$Tableshow;
                    $html = static::$html;
                    $column = 1;
                    $controller = "ruangan";
                    return view("setting/master_edit" , compact("data" , "title" , 'html' ,"table" ,"exclude" ,"Tableshow", "column", "controller"));
                }

                public function update(Request $request){
                    $this->validate($request,[
                        'kode_ruangan' => 'required',
                        'nama_ruangan' => 'required'
                    ]);

                    $data =  RuanganModel::where('id' , $request->id)->first();
                    $data->kode_ruangan = $request->kode_ruangan;
                    $data->nama_ruangan = $request->nama_ruangan;
                    $data->keterangan = $request->keterangan;
                    $data->row_status = $request->row_status;
                    $data->update_by = Auth::user()->nama;
                    $data->updated_at = date('Y-m-d H:m:s');

                    $data->save();
                    return redirect('/master/ruangan');
                }

                public function delete(Request $request){
                    $data =  RuanganModel::where('id', $request->id)->first();
                    $data->row_status = 'deleted';

                    if($data->save()){
                        return $this->success("Data berhasil disimpan.");
                    }else{
                        return json_encode(["status"=> "false", "msg"=> "Mohon maaf, terjadi kesalahan sistem"]);
                    }
                }

                public function paging(Request $request){
                    return Datatables::of(RuanganModel::where('row_status', '!=', 'deleted')->get())->addIndexColumn()->make(true);
                }

            }
        