<?php
namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\ AgamaModel;
use Yajra\DataTables\DataTables;
use File;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class Agama extends Controller
{
    static $Tableshow = ["id" => ["table" => ["tablename" =>"null" , "field"=> "id"] , "record"=>"Id"],
        "title" => ["table" => ["tablename" =>"null" , "field"=> "title"] , "record"=>"Title"],
        "row_status" => ["table" => ["tablename" =>"null" , "field"=> "row_status"] , "record"=>"Status"],
        ];
    static $html = ["id"=>["type"=>"null" , "value"=>"null" , "validation" => "required"] ,
                    "title"=>["type"=>"text" , "value"=>"null" , "validation" => ""] ,
                    "row_status"=>["type"=>"radio" , "value"=>"active,notactive,deleted" , "validation" => "required"] ,
                    ];
    static $exclude = ["id","created_at","updated_at","created_by","updated_by"];
    static $tablename = "agama";
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
        $data = AgamaModel::get();
        $tableid = 'agama';
        $title = ucfirst(request()->segment(1))." ".ucfirst(request()->segment(2));
        $table_display = DB::getSchemaBuilder()->getColumnListing('master_agama');
        $exclude = static::$exclude;
        $Tableshow = static::$Tableshow;
        return view("setting/general_view" , compact("data" , "title" ,"table_display" ,"exclude" ,"Tableshow","tableid"));

    }

    public function create(){
        $title = "Tambah ".ucfirst(request()->segment(1))." ".ucfirst(request()->segment(2));
        $table = array_diff(DB::getSchemaBuilder()->getColumnListing("master_agama") , static::$exclude);
        $exclude = static::$exclude;
        $Tableshow = static::$Tableshow;
        $html = static::$html;
        $column = 1;
        return view('setting/master_create' , compact('table' ,'exclude' , 'Tableshow' , 'title' , 'html' , "column"));
    }


    public function sinc(){
        $token = $this->check_auth_siakad();
        $data = array('act'=>"GetAgama" , "token"=>$token, "filter"=> "","limit"=>"" , "offset" =>0);
        $result_string = $this->runWS($data, 'json');
        
        $result = json_decode($result_string , true);
        //print_r($result); exit;
        if(array_key_exists('data' , $result)){
            if(count($result['data']) > 0){
                DB::beginTransaction();
                try{
                    foreach($result['data'] as $item){
                        AgamaModel::updateOrInsert(array('id'=> $item['id_agama'], 'title'=>$item['nama_agama']));
                    }
                    DB::commit();
                    DB::table('sinkronisasi_logs')
                    ->insert(array('title' => 'GetAgama' ,'created_by'=> Auth::user()->id ,'created_at'=>date('Y-m-d H:i:s')));
                    return json_encode(array('status' => 'success' , 'msg' => 'Data Berhasil Disinkronisai.'));
                } catch(\Exception $e){
                    DB::rollBack(); 
                    throw $e;
                    return json_encode(array('status' => 'error' , 'msg' => 'Terjadi kesalahan mensinkronkan data, silahkan coba lagi.'));
                }      
            }
        }
    }


    public function view($id){
        $data = AgamaModel::where('id' , $id)->first();

        $title = "Edit ".ucfirst(request()->segment(1))." ".ucfirst(request()->segment(2));
        $table = array_diff(DB::getSchemaBuilder()->getColumnListing("master_agama") , static::$exclude);
        $exclude = static::$exclude;
        $Tableshow = static::$Tableshow;
        $html = static::$html;
        $column = 1;
        $controller = "agama";
        return view("setting/master_edit" , compact("data" , "title" , 'html' ,"table" ,"exclude" ,"Tableshow", "column", "controller"));
    }

    public function save(Request $request){
        $input = $request->all();
        $field = [];
        $data = [];
        $table = DB::getSchemaBuilder()->getColumnListing("master_agama");
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
        $save  = AgamaModel::firstOrCreate($data);

        $filedata = AgamaModel::select('id' ,'title')
                    ->where('row_status', '=', 'active')
                    ->get();

        if($filedata){
            File::put(public_path().'/master/'.strtolower(static::$tablename).'.php',json_encode($filedata));
        }
                    
        if($save){
            return $this->success("Data berhasil disimpan.");
        }
    }

    public function update(Request $request){
        $this->validate($request,[
            'title' => 'required'
        ]);

        $data =  AgamaModel::where('id' , $request->id)->first();
        $data->title = $request->title;
        $data->row_status = $request->row_status;

        $data->save();
        return redirect('/master/agama');
    }

    public function delete(Request $request){
        $data =  AgamaModel::where('id', $request->id)->first();
        $data->row_status = 'deleted';

        if($data->save()){
            return $this->success("Data berhasil disimpan.");
        }else{
            return json_encode(["status"=> "false", "msg"=> "Mohon maaf, terjadi kesalahan sistem"]);
        }
    }

    public function paging(Request $request){
        return Datatables::of(AgamaModel::where('master_agama.row_status', '!=', 'deleted')->get())->addIndexColumn()->make(true);
    }
}

