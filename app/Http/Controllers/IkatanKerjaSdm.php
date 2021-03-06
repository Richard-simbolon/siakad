<?php
namespace App\Http\Controllers;
use App\IkatanKerjaSdmModel;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class IkatanKerjaSdm extends Controller
{
    static $Tableshow = ["id" => ["table" => ["tablename" =>"null" , "field"=> "id"] , "record"=>"Id"],
        "row_status" => ["table" => ["tablename" =>"null" , "field"=> "row_status"] , "record"=>"Status"],
        "nama_ikatan_kerja" => ["table" => ["tablename" =>"null" , "field"=> "title"] , "record"=>"Nama Ikatan"],
    ];
    static $html = ["id"=>["type"=>"null" , "value"=>"null" , "validation" => ""] ,
        "row_status"=>["type"=>"radio" , "value"=>"active,notactive,deleted" , "validation" => ""] ,
        "nama_ikatan_kerja"=>["type"=>"text" , "value"=>"null" , "validation" => ""] ,
    ];
    static $exclude = ["id","row_status","created_at","updated_at","created_by","update_by"];
    static $tablename = "IkatanKerjaSdm";
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
        $data = IkatanKerjaSdmModel::get();
        $title = "Daftar Ikatan Kerja Sdm";
        $tableid = "IkatanKerjaSdm";
        $table_display = DB::getSchemaBuilder()->getColumnListing("master_ikatan_kerja_sdm");
        $exclude = static::$exclude;
        $Tableshow = static::$Tableshow;
        return view("setting/general_view" , compact("data" , "title" ,"table_display" ,"exclude" ,"Tableshow","tableid"));

    }
    public function create(){
        $title = "Tambah Ikatan Kerja Sdm";
        $tableid = "IkatanKerjaSdm";
        $table = array_diff(DB::getSchemaBuilder()->getColumnListing("master_ikatan_kerja_sdm"), static::$exclude);
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
        $table = DB::getSchemaBuilder()->getColumnListing("master_ikatan_kerja_sdm");
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
        $save  = IkatanKerjaSdmModel::firstOrCreate($data);
        if($save){
            return $this->success("Data berhasil disimpan.");
        }
    }

    public function edit(Request $request){

    }

    public function view($id){
        $data = JenisPegawaiModel::where('id' , $id)->first();

        $title = "Edit ".ucfirst(request()->segment(1))." ".ucfirst(request()->segment(2));
        $table = array_diff(DB::getSchemaBuilder()->getColumnListing("master_ikatan_kerja_sdm") , static::$exclude);
        $exclude = static::$exclude;
        $Tableshow = static::$Tableshow;
        $html = static::$html;
        $column = 1;
        $controller = "ikatankerjasdm";
        return view("setting/master_edit" , compact("data" , "title" , 'html' ,"table" ,"exclude" ,"Tableshow", "column", "controller"));
    }

    public function update(Request $request){
        $this->validate($request,[
            'title' => 'required'
        ]);

        $data =  IkatanKerjaSdmModel::where('id' , $request->id)->first();
        $data->title = $request->title;
        $data->row_status = $request->row_status;

        $data->save();
        return redirect('/master/ikatankerjasdm');
    }

    public function delete(Request $request){
        $data =  IkatanKerjaSdmModel::where('id', $request->id)->first();
        $data->row_status = 'deleted';

        if($data->save()){
            return $this->success("Data berhasil disimpan.");
        }else{
            return json_encode(["status"=> "false", "msg"=> "Mohon maaf, terjadi kesalahan sistem"]);
        }
    }

    public function paging(Request $request){
        return Datatables::of(IkatanKerjaSdmModel::where('row_status', '!=', 'deleted')->get())->addIndexColumn()->make(true);
    }

    public function sinc(){
        $token = $this->check_auth_siakad();
        $data = array('act'=>"GetIkatanKerjaSdm" , "token"=>$token, "filter"=> "","limit"=>"" , "offset" =>0);
        $result_string = $this->runWS($data, 'json');

        $result = json_decode($result_string , true);
        if(!$result){
            $this->sinkron_log('sync_ikatan_kerja_sdm','gagal', 0);

            return json_encode(array('status' => 'error' , 'msg' => 'Terjadi kesalahan mensinkronkan data, silahkan coba lagi.'));
        }
        if(array_key_exists('data' , $result)){
            if(count($result['data']) > 0){
                DB::beginTransaction();
                try{
                    foreach($result['data'] as $item){
                        IkatanKerjaSdmModel::updateOrInsert(array('id'=> $item['id_ikatan_kerja'], 'nama_ikatan_kerja'=>$item['nama_ikatan_kerja']));
                    }
                    DB::commit();
                    $this->sinkron_log('sync_ikatan_kerja_sdm','sukses', count($result['data']));
                    DB::table('sinkronisasi_logs')
                        ->insert(array('title' => 'GetIkatanKerjaSdm' ,'created_by'=> Auth::user()->nama ,'created_at'=>date('Y-m-d H:i:s')));
                    return json_encode(array('status' => 'success' , 'msg' => 'Data Berhasil Disinkronisai.'));
                } catch(\Exception $e){
                    DB::rollBack();
                    throw $e;
                    return json_encode(array('status' => 'error' , 'msg' => 'Terjadi kesalahan mensinkronkan data, silahkan coba lagi.'));
                }
            }
        }
    }
}
