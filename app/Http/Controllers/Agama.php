<?php
namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\ AgamaModel;
use Yajra\DataTables\DataTables;
class Agama extends Controller
{
    static $Tableshow = [
                            "id" => ["table" => ["tablename" =>"null" , "field"=> "id"] , "record"=>"id"] ,
                            "title" => ["table" => ["tablename" =>"null" , "field"=> "title"] , "record"=>"Agama"] ,
                            "status" => ["table" => ["tablename" =>"null" , "field"=> "status"] , "record"=>"Status"] ,
                        ];
    static $exclude = ['id','created_at','updated_at','created_by','updated_by'];
    static $html = [
                    "id"=>["type" => "null" , "value"=>"null" , "validation" => "required"] ,
                    "title"=>["type" => "text" , "value"=>"text" , "validation" => "required"] ,
                    "status"=>["type" => "radio" , "value"=>"enable,disable" , "validation" => "required"],
                    ];
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
        if($save){
            return $this->success("Data berhasil disimpan.");
        }
    }

    public function edit(Request $request){

    }

    public function paging(Request $request){
        return Datatables::of(AgamaModel::all())->make(true);
    }
}

