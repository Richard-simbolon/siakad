<?php
            namespace App\Http\Controllers;
            use App\SinkronisasiModel;
            use Illuminate\Support\Facades\DB;
            use Illuminate\Support\Facades\Validator;
            use Illuminate\Http\Request;
            use App\ KebutuhanKhususModel;
            use Yajra\DataTables\DataTables;
            Use File;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class KebutuhanKhusus extends Controller
            {
                static $Tableshow = ["id" => ["table" => ["tablename" =>"null" , "field"=> "id"] , "record"=>"Id"],
                    "title" => ["table" => ["tablename" =>"null" , "field"=> "title"] , "record"=>"Title"],
                    "row_status" => ["table" => ["tablename" =>"null" , "field"=> "row_status"] , "record"=>"Status"],
                    ];
                static $html = ["id"=>["type"=>"null" , "value"=>"null" , "validation" => "required"] ,
                                "title"=>["type"=>"text" , "value"=>"null" , "validation" => "required"] ,
                                "row_status"=>["type"=>"radio" , "value"=>"notactive,active,deleted" , "validation" => "required"] ,
                                ];
                static $exclude = ["id","row_status","created_at","updated_at","created_by","update_by"];
                static $tablename = "KebutuhanKhusus";
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
                    $data = KebutuhanKhususModel::get();
                    $title = ucfirst(request()->segment(1))." ".ucfirst(request()->segment(2));
                    $tableid = "KebutuhanKhusus";
                    $table_display = DB::getSchemaBuilder()->getColumnListing("master_kebutuhan_khusus");
                    $exclude = static::$exclude;
                    $Tableshow = static::$Tableshow;
                    return view("setting/general_view" , compact("data" , "title" ,"table_display" ,"exclude" ,"Tableshow","tableid"));

                }

                public function sinc(){
                    $token = $this->check_auth_siakad();
                    $data = array('act'=>"GetKebutuhanKhusus" , "token"=>$token, "filter"=> "","limit"=>"" , "offset" =>0);
                    $result_string = $this->runWS($data, 'json');
                    $result = json_decode($result_string , true);

                    if(!$result){
                        $this->sinkron_log('sync_kebutuhan_khusus','gagal', 0);

                        return json_encode(array('status' => 'error' , 'msg' => 'Terjadi kesalahan mensinkronkan data, silahkan coba lagi.'));
                    }

                    if(array_key_exists('data' , $result)){
                        if($result['data']) {
                            if (count($result['data']) > 0) {
                                DB::beginTransaction();
                                try {
                                    foreach ($result['data'] as $item) {
                                        KebutuhanKhususModel::updateOrInsert(array('id' => $item['id_kebutuhan_khusus'], 'title' => $item['nama_kebutuhan_khusus']));
                                    }
                                    DB::commit();
                                    $this->sinkron_log('sync_kebutuhan_khusus','sukses', count($result['data']));
                                    DB::table('sinkronisasi_logs')
                                        ->insert(array('title' => 'GetKebutuhanKhusus', 'created_by' => Auth::user()->id, 'created_at' => date('Y-m-d H:i:s')));
                                    return json_encode(array('status' => 'success', 'msg' => 'Data Berhasil Disinkronisai.'));
                                } catch (\Exception $e) {
                                    DB::rollBack();
                                    throw $e;
                                    return json_encode(array('status' => 'error', 'msg' => 'Terjadi kesalahan mensinkronkan data, silahkan coba lagi.'));
                                }
                            }
                        }else{
                            return json_encode(array('status' => 'error' , 'msg' => 'Data tidak tersedia'));
                        }
                    }
                }

                public function create(){
                    $title = "Tambah ".ucfirst(request()->segment(1))." ".ucfirst(request()->segment(2));
                    $table = array_diff(DB::getSchemaBuilder()->getColumnListing("master_kebutuhan_khusus"), static::$exclude);
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
                    $table = DB::getSchemaBuilder()->getColumnListing("master_kebutuhan_khusus");
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
                    $save  = KebutuhanKhususModel::firstOrCreate($data);

                    $filedata = KebutuhanKhususModel::select('id' ,'title')
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

                public function view($id){
                    $data = KebutuhanKhususModel::where('id' , $id)->first();

                    $title = "Edit ".ucfirst(request()->segment(1))." ".ucfirst(request()->segment(2));
                    $table = array_diff(DB::getSchemaBuilder()->getColumnListing("master_kebutuhan_khusus") , static::$exclude);
                    $exclude = static::$exclude;
                    $Tableshow = static::$Tableshow;
                    $html = static::$html;
                    $column = 1;
                    $controller = "kebutuhankhusus";
                    return view("setting/master_edit" , compact("data" , "title" , 'html' ,"table" ,"exclude" ,"Tableshow", "column", "controller"));
                }

                public function update(Request $request){
                    $this->validate($request,[
                        'title' => 'required'
                    ]);

                    $data =  KebutuhanKhususModel::where('id' , $request->id)->first();
                    $data->title = $request->title;
                    $data->row_status = $request->row_status;

                    $data->save();
                    return redirect('/master/kebutuhankhusus');
                }

                public function delete(Request $request){
                    $data =  KebutuhanKhususModel::where('id', $request->id)->first();
                    $data->row_status = 'deleted';

                    if($data->save()){
                        return $this->success("Data berhasil disimpan.");
                    }else{
                        return json_encode(["status"=> "false", "msg"=> "Mohon maaf, terjadi kesalahan sistem"]);
                    }
                }

                public function paging(Request $request){
                    return Datatables::of(KebutuhanKhususModel::where('row_status', '!=', 'deleted')->get())->addIndexColumn()->make(true);
                }

            }
