<?php
            namespace App\Http\Controllers;
            use Illuminate\Support\Facades\Auth;
            use Illuminate\Support\Facades\DB;
            use Illuminate\Support\Facades\Validator;
            use Illuminate\Http\Request;
            use App\ KalenderAkademikModel;
            use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\Redirect;

class KalenderAkademik extends Controller
            {
                static $Tableshow = ["id" => ["table" => ["tablename" =>"null" , "field"=> "id"] , "record"=>"Id"],
                    "row_status" => ["table" => ["tablename" =>"null" , "field"=> "row_status"] , "record"=>"Status"],
                    "title" => ["table" => ["tablename" =>"null" , "field"=> "row_status"] , "record"=>"title"],
                    "keterangan" => ["table" => ["tablename" =>"null" , "field"=> "row_status"] , "record"=>"keterangan"],
                    "start" => ["table" => ["tablename" =>"null" , "field"=> "row_status"] , "record"=>"start"],
                    "end" => ["table" => ["tablename" =>"null" , "field"=> "row_status"] , "record"=>"end"],
                    "warna" => ["table" => ["tablename" =>"null" , "field"=> "row_status"] , "record"=>"warna"],
                    "display" => ["table" => ["tablename" =>"null" , "field"=> "row_status"] , "record"=>"display"],
                    ];
                static $html = ["id"=>["type"=>"null" , "value"=>"null" , "validation" => ""] ,
                    "title"=>["type"=>"text" , "value"=>"null" , "validation" => "required"] ,
                    "warna"=>["type"=>"text" , "value"=>"null" , "validation" => "required"] ,
                    "start"=>["type"=>"date" , "value"=>"null" , "validation" => "required"] ,
                    "end"=>["type"=>"date" , "value"=>"null" , "validation" => "required"],
                    "keterangan"=>["type"=>"date" , "value"=>"null" , "validation" => "required"],
                    "display"=>["type"=>"text" , "value"=>"null" , "validation" => "required"],
                ];
                static $exclude = ["id","created_at","updated_at","created_by","update_by"];
                static $tablename = "KalenderAkademik";

                public function __construct()
                {
                    $this->middleware('auth');
//                    $this->user = Auth::user();
//                    if(!$this->user){
//                        Redirect::to('login')->send();
//                    }
//                    $this->middleware(function ($request, $next) {
//                        $this->user = Auth::user();
//                        if(!$this->user){
//                            Redirect::to('login')->send();
//                        }
//                        if($this->user->login_type != 'admin'){
//                            return abort(404);
//                        }else{
//                            return $next($request);
//                        }
//                    });
                    
                }
                
                public function index()
                {
                    $data = KalenderAkademikModel::get();
                    $title = "Daftar Kalender Akademik";
                    $tableid = "KalenderAkademik";
                    $table_display = DB::getSchemaBuilder()->getColumnListing("kalender_akademik");
                    $exclude = static::$exclude;
                    $Tableshow = static::$Tableshow;
                    return view("data/kalender_akademik" , compact("data" , "title" ,"table_display" ,"exclude" ,"Tableshow","tableid"));

                }
                public function create(){
                    $title = "Tambah ".ucfirst(request()->segment(1))." ".ucfirst(request()->segment(2));
                    $table = array_diff(DB::getSchemaBuilder()->getColumnListing("kalender_akademik"), static::$exclude);
                    $exclude = static::$exclude;
                    $Tableshow = static::$Tableshow;
                    $html = static::$html;
                    $column = 1;
                    return view("data/kalender_akademik_create" , compact("table" ,"exclude" , "Tableshow" , "title" , "html", "column"));

                }

                public function view($id){
                    $data = KalenderAkademikModel::where('id' , $id)->first();
                    $data['time_start'] = date('H:i', strtotime($data['start']));
                    $data['time_end'] = date('H:i', strtotime($data['end']));
                    $title = "Edit Kalender";
                    $table = array_diff(DB::getSchemaBuilder()->getColumnListing("master_jurusan") , static::$exclude);
                    $exclude = static::$exclude;
                    $Tableshow = static::$Tableshow;
                    $html = static::$html;
                    $column = 1;
                    $controller = "jurusan";
                    return view("data/kalender_akademik_view" , compact("data" , "title" , 'html' ,"table" ,"exclude" ,"Tableshow", "column", "controller"));
                }

                public function edit($id){
                    $data = KalenderAkademikModel::where('id' , $id)->first();
                    $data['time_start'] = date('H:i', strtotime($data['start']));
                    $data['time_end'] = date('H:i', strtotime($data['end']));
                    $title = "Edit Kalender";
                    $table = array_diff(DB::getSchemaBuilder()->getColumnListing("master_jurusan") , static::$exclude);
                    $exclude = static::$exclude;
                    $Tableshow = static::$Tableshow;
                    $html = static::$html;
                    $column = 1;
                    $controller = "jurusan";
                    return view("data/kalender_akademik_edit" , compact("data" , "title" , 'html' ,"table" ,"exclude" ,"Tableshow", "column", "controller"));
                }

                public function save(Request $request){
                    $input = $request->all();
                    $field = [];
                    $data = [];
                    $table = DB::getSchemaBuilder()->getColumnListing("kalender_akademik");
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

                    $save  = KalenderAkademikModel::firstOrCreate($data);
                    if($save){
                        return $this->success("Data berhasil disimpan.");
                    }
                }

                public function update(Request $request){
                    $input = $request->all();
                    $field = [];
                    $data = KalenderAkademikModel::where('id' , $input['id'])->first();
                    $table = DB::getSchemaBuilder()->getColumnListing("kalender_akademik");
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

                    $data->start = $data->start . ' '  .$input['time_start'];
                    $data->end = $data->end . ' '  .$input['time_end'];

                    if($data->save()){
                        return $this->success("Data berhasil disimpan.");
                    }else{
                        return json_encode(["status"=> "false", "msg"=> "Mohon maaf, terjadi kesalahan sistem"]);
                    }
                }

                public function delete(Request $request){
                    $data =  KalenderAkademikModel::where('id', $request->id)->first();
                    $data->row_status = 'deleted';

                    if($data->save()){
                        return $this->success("Data berhasil disimpan.");
                    }else{
                        return json_encode(["status"=> "false", "msg"=> "Mohon maaf, terjadi kesalahan sistem"]);
                    }
                }

                public function get($id){
                    $data = KalenderAkademikModel::where('id' , $id)
                        ->select("id","title", "start","end", "warna as className", "keterangan", "created_at")
                        ->get();
                    $response = [];
                    foreach ($data as $item){
                        //$item['created_at'] = date('Y-m-d H:i', strtotime($item['created_at']));
                        array_push($response, $item);
                    }

                    if($data){
                        return json_encode(["status"=> true, "data"=> $response]);
                    }else{
                        return json_encode(["status"=> false, "message"=> "not found"]);
                    }
                }

                public function getall(){
                    $arrClass= ['','fc-event-light fc-event-solid-primary','fc-event-warning fc-event-solid-warning','fc-event-solid-danger fc-event-light', 'fc-event-light fc-event-solid-success' ];
                    $data = KalenderAkademikModel::where('row_status' , 'active')
                        ->select("id","title", "start","end", "warna as className")
                        ->get();
                    $response=[];
                    foreach ($data as $item){
                        //$item['start'] = date('Y-m-d\TH:i:P', strtotime($item['start']));
                        $item['end'] = date('Y-m-d H:i', strtotime($item['end']));
                        $item['start'] = date('Y-m-d H:i', strtotime($item['start']));
                        $item['className'] = $arrClass[$item['className']];
                        array_push($response, $item);
                    }
                    if($data){
                        return json_encode($response);
                    }else{
                        return json_encode(["status"=> false, "message"=> "not found"]);
                    }
                }

                public function paging(Request $request){
                    $type = Auth::user()->login_type;
                    if($type=='dosen'){
                        return Datatables::of(KalenderAkademikModel::where('row_status', '!=', 'deleted')->whereIn('display' , ['dosen','semua'])->get())->addIndexColumn()->make(true);
                    }else if($type == 'mahasiswa'){
                        return Datatables::of(KalenderAkademikModel::where('row_status', '!=', 'deleted')->whereIn('display' , ['mahasiswa','semua'])->get())->addIndexColumn()->make(true);
                    }else{
                        return Datatables::of(KalenderAkademikModel::where('row_status', '!=', 'deleted')->get())->addIndexColumn()->make(true);
                    }

                }

            }
        