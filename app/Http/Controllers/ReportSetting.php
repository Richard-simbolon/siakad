<?php
            namespace App\Http\Controllers;
            use Illuminate\Support\Facades\DB;
            use Illuminate\Support\Facades\Validator;
            use Illuminate\Http\Request;
            use App\ ReportSettingModel;
            use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class ReportSetting extends Controller
            {
                static $Tableshow = ["id" => ["table" => ["tablename" =>"null" , "field"=> "id"] , "record"=>"Id"],
                    "row_status" => ["table" => ["tablename" =>"null" , "field"=> "row_status"] , "record"=>"Status"],
                    "kepala_bagian_ad_akademik" => ["table" => ["tablename" =>"null" , "field"=> "title"] , "record"=>"Kepala Bagian Administrasi Akademik,
Kemahasiswaan dan Alumni"],
                    "kepala_bagian_ad_akademik_nip" => ["table" => ["tablename" =>"null" , "field"=> "title"] , "record"=>"NIP Kepala Bagian Administrasi Akademik,
Kemahasiswaan dan Alumni"],
                    "ketua_jurusan" => ["table" => ["tablename" =>"null" , "field"=> "title"] , "record"=>"Ketua Jurusan"],
                    "ketua_jurusan_nip" => ["table" => ["tablename" =>"null" , "field"=> "title"] , "record"=>"NIP Ketua Jurusan"],
                    "direktur" => ["table" => ["tablename" =>"null" , "field"=> "title"] , "record"=>"Direktur"],
                    "direktur_nip" => ["table" => ["tablename" =>"null" , "field"=> "title"] , "record"=>"NIP Direktur"],
                    "wakil_direktur_i_bidang_akademik" => ["table" => ["tablename" =>"null" , "field"=> "title"] , "record"=>"Wakil Direktur I Bidang_Akademik"],
                    "wakil_direktur_i_bidang_akademik_nip" => ["table" => ["tablename" =>"null" , "field"=> "title"] , "record"=>"NIP Wakil Direktur I Bidang_Akademik"],
                    ];
                static $html = ["id"=>["type"=>"null" , "value"=>"null" , "validation" => ""] ,
                    "kepala_bagian_ad_akademik"=>["type"=>"text" , "value"=>"null" , "validation" => "required"] ,
                    "kepala_bagian_ad_akademik_nip"=>["type"=>"text" , "value"=>"null" , "validation" => "required"] ,
                    "ketua_jurusan"=>["type"=>"text" , "value"=>"null" , "validation" => "required"] ,
                    "ketua_jurusan_nip"=>["type"=>"text" , "value"=>"null" , "validation" => "required"] ,
                    "direktur"=>["type"=>"text" , "value"=>"null" , "validation" => "required"] ,
                    "direktur_nip"=>["type"=>"text" , "value"=>"null" , "validation" => "required"] ,
                    "wakil_direktur_i_bidang_akademik"=>["type"=>"text" , "value"=>"null" , "validation" => "required"] ,
                    "wakil_direktur_i_bidang_akademik_nip"=>["type"=>"text" , "value"=>"null" , "validation" => "required"] ,
                    "row_status"=>["type"=>"radio" , "value"=>"active" , "validation" => "required"],
            ];
                static $exclude = ["id","created_at","updated_at","created_by","update_by"];
                static $tablename = "ReportSetting";
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
                    $data = ReportSettingModel::get();
                    $title = ucfirst(request()->segment(1))." ".ucfirst(request()->segment(2));
                    $tableid = "ReportSetting";
                    $table_display = DB::getSchemaBuilder()->getColumnListing("report_setting");
                    $exclude = static::$exclude;
                    $Tableshow = static::$Tableshow;
                    return view("master/report_setting" , compact("data" , "title" ,"table_display" ,"exclude" ,"Tableshow","tableid"));

                }
                public function create(){
                    $title = "Tambah ".ucfirst(request()->segment(1))." ".ucfirst(request()->segment(2));
                    $table = array_diff(DB::getSchemaBuilder()->getColumnListing("report_setting"), static::$exclude);
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
                    $table = DB::getSchemaBuilder()->getColumnListing("report_setting");
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
                    $save  = ReportSettingModel::firstOrCreate($data);
                    if($save){
                        return $this->success("Data berhasil disimpan.");
                    }
                }

                public function edit(Request $request){

                }

                public function view($id){
                    $data = ReportSettingModel::where('id' , $id)->first();

                    $title = "Edit Pengaturan Laporan";
                    $table = array_diff(DB::getSchemaBuilder()->getColumnListing("report_setting") , static::$exclude);
                    $exclude = static::$exclude;
                    $Tableshow = static::$Tableshow;
                    $html = static::$html;
                    $column = 1;
                    $controller = "reportsetting";
                    return view("master/report_setting_edit" , compact("data" , "title" , 'html' ,"table" ,"exclude" ,"Tableshow", "column", "controller"));
                }

                public function update(Request $request){
                    $this->validate($request,[

                    ]);

                    $data =  ReportSettingModel::where('id' , $request->id)->first();

                    $data->kepala_bagian_ad_akademik = $request->kepala_bagian_ad_akademik;
                    $data->kepala_bagian_ad_akademik_nip = $request->kepala_bagian_ad_akademik_nip;
                    $data->ketua_jurusan = $request->ketua_jurusan;
                    $data->ketua_jurusan_nip = $request->ketua_jurusan_nip;
                    $data->direktur = $request->direktur;
                    $data->direktur_nip = $request->direktur_nip;
                    $data->wakil_direktur_i_bidang_akademik = $request->wakil_direktur_i_bidang_akademik;
                    $data->wakil_direktur_i_bidang_akademik_nip = $request->wakil_direktur_i_bidang_akademik_nip;

                    $data->save();
                    return redirect('/master/reportsetting');
                }

                public function paging(Request $request){
                    return Datatables::of(ReportSettingModel::all())->addIndexColumn()->make(true);
                }

            }
        