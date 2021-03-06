<?php
            namespace App\Http\Controllers;
            use App\SinkronisasiModel;
            use Illuminate\Support\Facades\DB;
            use Illuminate\Support\Facades\Validator;
            use Illuminate\Http\Request;
            use App\ TahunAjaranModel;
            use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class TahunAjaran extends Controller
            {
                static $Tableshow = ["id" => ["table" => ["tablename" =>"null" , "field"=> "id"] , "record"=>"Id"],
                    "row_status" => ["table" => ["tablename" =>"null" , "field"=> "row_status"] , "record"=>"Status"],
                    "title" => ["table" => ["tablename" =>"null" , "field"=> "title"] , "record"=>"Title"],
                    "a_periode_aktif" => ["table" => ["tablename" =>"null" , "field"=> "row_status"] , "record"=>"Periode Aktif"],
                    "tanggal_mulai" => ["table" => ["tablename" =>"null" , "field"=> "row_status"] , "record"=>"Tanggal Mulai"],
                    "tanggal_selesai" => ["table" => ["tablename" =>"null" , "field"=> "row_status"] , "record"=>"Tanggal Selesai"],
                    "angkatan" => ["table" => ["tablename" =>"null" , "field"=> "angkatan"] , "record"=>"Angkatan"],
                    ];
                static $html = ["id"=>["type"=>"null" , "value"=>"null" , "validation" => ""] ,
                                "row_status"=>["type"=>"radio" , "value"=>"active,notactive,deleted" , "validation" => ""] ,
                                "title"=>["type"=>"text" , "value"=>"null" , "validation" => ""] ,
                                "angkatan"=>["type"=>"text" , "value"=>"null" , "validation" => ""] ,
                                ];
                static $exclude = ["id","row_status","angkatan","created_at","updated_at","created_by","update_by"];
                static $tablename = "TahunAjaran";
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
                    $data = TahunAjaranModel::get();
                    $title = "Daftar Tahun Ajaran";
                    $tableid = "TahunAjaran";
                    $table_display = DB::getSchemaBuilder()->getColumnListing("master_tahun_ajaran");
                    $exclude = static::$exclude;
                    $Tableshow = static::$Tableshow;
                    return view("setting/general_view" , compact("data" , "title" ,"table_display" ,"exclude" ,"Tableshow","tableid"));

                }

                public function sinc(){
                    $token = $this->check_auth_siakad();
                    $data = array('act'=>"GetTahunAjaran" , "token"=>$token, "filter"=> "","limit"=>"" , "offset" =>0);
                    $result_string = $this->runWS($data, 'json');
                    $result = json_decode($result_string , true);
                    if(!$result){
                        $this->sinkron_log('sync_tahun_ajaran','gagal', 0);
                        
                        return json_encode(array('status' => 'error' , 'msg' => 'Terjadi kesalahan mensinkronkan data, silahkan coba lagi.'));
                    }
                    if(array_key_exists('data' , $result)){
                        if(count($result['data']) > 1){
                            DB::beginTransaction();
                            try{
                                foreach($result['data'] as $item){
                                    TahunAjaranModel::updateOrInsert(array('id'=> $item['id_tahun_ajaran'] , 'title'=>$item['nama_tahun_ajaran'], 'a_periode_aktif'=>$item['a_periode_aktif'], 'tanggal_mulai'=>$item['tanggal_mulai'], 'tanggal_selesai'=>$item['tanggal_selesai']));
                                }
                                DB::commit();
                                $this->sinkron_log('sync_tahun_ajaran','sukses', count($result['data']));
                                DB::table('sinkronisasi_logs')
                                ->insert(array('title' => 'GetTahunAjaran' ,'created_by'=> Auth::user()->id ,'created_at'=>date('Y-m-d H:i:s')));
                                return json_encode(array('status' => 'success' , 'msg' => 'Data Berhasil Disinkronisai.'));
                            } catch(\Exception $e){
                                DB::rollBack(); 
                                throw $e;
                                return json_encode(array('status' => 'error' , 'msg' => 'Terjadi kesalahan mensinkronkan data, silahkan coba lagi.'));
                            }      
                        }
                    }
                }

                public function create(){
                    $title = "Tambah ".ucfirst(request()->segment(1))." ".ucfirst(request()->segment(2));
                    $table = array_diff(DB::getSchemaBuilder()->getColumnListing("master_tahun_ajaran"), static::$exclude);
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
                    $table = DB::getSchemaBuilder()->getColumnListing("master_tahun_ajaran");
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
                    $save  = TahunAjaranModel::firstOrCreate($data);
                    if($save){
                        return $this->success("Data berhasil disimpan.");
                    }
                }

                public function edit(Request $request){

                }

                public function view($id){
                    $data = TahunAjaranModel::where('id' , $id)->first();

                    $title = "Edit ".ucfirst(request()->segment(1))." ".ucfirst(request()->segment(2));
                    $table = array_diff(DB::getSchemaBuilder()->getColumnListing("master_tahun_ajaran") , static::$exclude);
                    $exclude = static::$exclude;
                    $Tableshow = static::$Tableshow;
                    $html = static::$html;
                    $column = 1;
                    $controller = "tahunajaran";
                    return view("setting/master_edit" , compact("data" , "title" , 'html' ,"table" ,"exclude" ,"Tableshow", "column", "controller"));
                }

                public function update(Request $request){
                    $this->validate($request,[
                        'title' => 'required'
                    ]);

                    $data =  TahunAjaranModel::where('id' , $request->id)->first();
                    $data->title = $request->title;
                    $data->row_status = $request->row_status;

                    $data->save();
                    return redirect('/master/tahunajaran');
                }

                public function delete(Request $request){
                    $data =  TahunAjaranModel::where('id', $request->id)->first();
                    $data->row_status = 'deleted';

                    if($data->save()){
                        return $this->success("Data berhasil disimpan.");
                    }else{
                        return json_encode(["status"=> "false", "msg"=> "Mohon maaf, terjadi kesalahan sistem"]);
                    }
                }

                public function paging(Request $request){
                    return Datatables::of(TahunAjaranModel::where('row_status', '!=', 'deleted')
                        ->orderBy('title', 'desc')
                        ->get())->addIndexColumn()->make(true);
                }

            }
        