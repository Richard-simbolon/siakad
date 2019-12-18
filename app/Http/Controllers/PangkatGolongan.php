<?php
            namespace App\Http\Controllers;
            use Illuminate\Support\Facades\DB;
            use Illuminate\Support\Facades\Validator;
            use Illuminate\Http\Request;
            use App\ PangkatGolonganModel;
            use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\Auth;

class PangkatGolongan extends Controller
            {
                static $Tableshow = ["id" => ["table" => ["tablename" =>"null" , "field"=> "id"] , "record"=>"Id"],
                    "title" => ["table" => ["tablename" =>"null" , "field"=> "title"] , "record"=>"Title"],
                    "row_status" => ["table" => ["tablename" =>"null" , "field"=> "row_status"] , "record"=>"Row_status"],
                    ];
                static $html = ["id"=>["type"=>"null" , "value"=>"null" , "validation" => ""] ,
            "title"=>["type"=>"null" , "value"=>"null" , "validation" => ""] ,
            "row_status"=>["type"=>"null" , "value"=>"null" , "validation" => ""] ,
            ];
                static $exclude = ["id","created_at","updated_at","created_by","update_by"];
                static $tablename = "PangkatGolongan";
                public function index()
                {
                    $data = PangkatGolonganModel::get();
                    $title = ucfirst(request()->segment(1))." ".ucfirst(request()->segment(2));
                    $tableid = "PangkatGolongan";
                    $table_display = DB::getSchemaBuilder()->getColumnListing("master_pangkat_golongan");
                    $exclude = static::$exclude;
                    $Tableshow = static::$Tableshow;
                    return view("setting/general_view" , compact("data" , "title" ,"table_display" ,"exclude" ,"Tableshow","tableid"));

                }
                public function sinc(){
                    $token = $this->check_auth_siakad();
                    $data = array('act'=>"GetPangkatGolongan" , "token"=>$token, "filter"=> "","limit"=>"" , "offset" =>0);
                    $result_string = $this->runWS($data, 'json');
                    
                    $result = json_decode($result_string , true);

                   // print_r($result); exit;
                    if(array_key_exists('data' , $result)){
                        if(count($result['data']) > 0){
                            DB::beginTransaction();
                            try{
                                foreach($result['data'] as $item){
                                    PangkatGolonganModel::updateOrInsert(array('id'=> $item['id_pangkat_golongan'] , 'title'=>$item['nama_pangkat'],'kode_golongan'=>$item['kode_golongan']));
                                }
                                DB::commit();
                                DB::table('sinkronisasi_logs')
                                ->insert(array('title' => 'GetPangkatGolongan' ,'created_by'=> Auth::user()->id ,'created_at'=>date('Y-m-d H:i:s')));
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
                    $table = array_diff(DB::getSchemaBuilder()->getColumnListing("master_pangkat_golongan"), static::$exclude);
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
                    $table = DB::getSchemaBuilder()->getColumnListing("master_pangkat_golongan");
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
                    $save  = PangkatGolonganModel::firstOrCreate($data);
                    if($save){
                        return $this->success("Data berhasil disimpan.");
                    }
                }

                public function edit(Request $request){

                }

                public function paging(Request $request){
                    return Datatables::of(PangkatGolonganModel::all())->make(true);
                }

            }
        