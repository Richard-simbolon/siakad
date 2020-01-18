<?php

namespace App\Http\Controllers;

use App\Setting;
use File;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\SettingModel;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Artisan;
use League\Flysystem\Config;
use Illuminate\Support\Facades\Cache;

class SettingMenu extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index()
    {
        //
        $tablename = 'dosen';
       print_r(DB::getSchemaBuilder()->getColumnListing($tablename)) ;

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $module = SettingModel::get();
        return view('setting/create' , compact('module'));
    }

    public function save(Request $request){
        //print_r($request->all()); exit;
        $input = $request->all();
        $now = date('Y-m-d H:i:s');
        $validation = Validator::make($request->all(), [
            'title' => 'required|unique:module',
            'description' => 'required'
        ]);
        if ($validation->fails()) {
            return json_encode(['status'=> 'false', 'message'=> $validation->messages()]);
        }
        $menuname = explode('_', $input['title']);
        //print_r($menuname);
        if(count($menuname) > 1){

            //$module = SettingModel::get();
            $filename = end($menuname);
            $data = array('title'  => $input['title'], 'mval' => ucfirst($filename), 'description' => $input['description'] , 'link'=>implode('/' , $menuname));
            $wishlist = SettingModel::firstOrCreate($data);
            array_pop($menuname);
            //print_r($menuname);
            $path = implode('/', $menuname);

            // GENERATE THE VIEW
            if(!file_exists( public_path(resource_path().'/views/'.strtolower($path).'/'.$filename.'.blade.php'))
            && !file_exists( app_path().'/Http/Controllers/'.ucfirst($filename).'.php')
            && !file_exists( app_path().'/'.ucfirst($filename).'Model.php')
            ){
                File::makeDirectory(resource_path().'/views/'.strtolower($path), $mode = 0777, true, true);
                File::put(resource_path().'/views/'.strtolower($path).'/'.$filename.'.blade.php','Your View Controller will put here');
                //Storage::disk('local')->put(resource_path().'/file.txt', 'Contents');
    
                // GENERATE THE CONTROLLER
                File::put(app_path().'/Http/Controllers/'.ucfirst($filename).'.php',static::autocontroller($filename , $request->all()));
                // GENERATE THE MODEL
                File::put(app_path().'/'.ucfirst($filename).'Model.php', static::automodel($filename , $request->all()));
    
                // GENERATE MIGRATION FILE
    
            }
           
        }
    }

    static function autocontroller($filename , $data){
        $table = '';
        $h = '';
        foreach($data['fieldname'] as $key=> $val){
            if($data['show'][$key] == '1'){
                if($data['migrationtable'][$key] != 'none'){
                    $table .= '"'.$val.'" => ["table" => ["tablename" =>"'.$data['migrationtable'][$key].'" , "field"=> "'.$data['fieldname'][$key].'"] , "record"=>"'.ucfirst($val).'"],
                    ';
                }
                //$table[] = [$val => ['table' => [$]]]
            }
            $h .= '"'.$val.'"=>["type"=>"null" , "value"=>"null" , "validation" => ""] ,
            ';
        }
        $text = '<?php
            namespace App\Http\Controllers;
            use Illuminate\Support\Facades\DB;
            use Illuminate\Support\Facades\Validator;
            use Illuminate\Http\Request;
            use App\ '.ucfirst($filename).'Model;
            use Yajra\DataTables\DataTables;
            class '.ucfirst($filename).' extends Controller
            {
                static $Tableshow = ['.$table.'];
                static $html = ['.$h.'];
                static $exclude = ["id","created_at","updated_at","created_by","update_by"];
                static $tablename = "'.$filename.'";
                public function index()
                {
                    $data = '.ucfirst($filename).'Model::get();
                    $title = ucfirst(request()->segment(1))." ".ucfirst(request()->segment(2));
                    $tableid = "'.$filename.'";
                    $table_display = DB::getSchemaBuilder()->getColumnListing("'.$data['tablename'].'");
                    $exclude = static::$exclude;
                    $Tableshow = static::$Tableshow;
                    return view("setting/general_view" , compact("data" , "title" ,"table_display" ,"exclude" ,"Tableshow","tableid"));

                }
                public function create(){
                    $title = "Tambah ".ucfirst(request()->segment(1))." ".ucfirst(request()->segment(2));
                    $table = array_diff(DB::getSchemaBuilder()->getColumnListing("'.$data['tablename'].'"), static::$exclude);
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
                    $table = DB::getSchemaBuilder()->getColumnListing("'.$data['tablename'].'");
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
                    $save  = '.ucfirst($filename).'Model::firstOrCreate($data);
                    if($save){
                        return $this->success("Data berhasil disimpan.");
                    }
                }

                public function edit(Request $request){

                }

                public function paging(Request $request){
                    return Datatables::of('.ucfirst($filename).'Model::all())->make(true);
                }

            }
        ';
        return $text;
    }

    static function automodel($filename, $data){
        $table = $data['tablename'];
        $field = implode('","' , $data['fieldname']);

        $migration = static::createmigration($data);
        $text = '<?php

        namespace App;

        use Illuminate\Database\Eloquent\Model;

        class '.ucfirst($filename).'Model extends Model
        {

            protected $table = "'.$table.'";

            protected $fillable = [
                "'.$field.'","updated_at" ,"created_at","created_by", "update_by"
            ];



            public function scopeget_row(){
                return [
                    "'.$field.'","updated_at" ,"created_at","created_by", "update_by"
                 ];
             }




            /**************************************/
            /*COPY THIS FUNCTION TO YOUR MIGRATION*/
            /**************************************/
            public function up(){
                Schema::create("'.$table.'", function (Blueprint $table) {
                    '.$migration.'
                    $table->enum("row_status", ["active", "deleted", "notactive"]);
                    $table->timestamp("updated_at")->nullable();
                    $table->timestamp("created_at")->nullable();
                    $table->timestamp("update_by")->nullable();
                    $table->timestamp("created_by")->nullable();
                });
            }
            public function down()
            {
                Schema::dropIfExists("'.$table.'");
            }


        }';
        return $text;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }


    static function createmigration($data=[]){
        $text = '';
        if(count($data['fieldname']) > 0){
            foreach($data['fieldname'] as $key=>$val){
                if($data['type'][$key] == 'bigIncrements'){
                    $text .= '$table->bigIncrements("'.$val.'")->unsigned();'."\r\n";
                }else{
                    $text .= '$table->'.$data['type'][$key].'("'.$val.'" , '.$data['length'][$key].');'."\r\n";
                }
            }
        }
        return $text;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Setting  $setting
     * @return \Illuminate\Http\Response
     */
    public function list()
    {
        //
        $data = SettingModel::get();
        return view('setting/list' , compact('data'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Setting  $setting
     * @return \Illuminate\Http\Response
     */
    public function edit(Setting $setting)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Setting  $setting
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Setting $setting)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Setting  $setting
     * @return \Illuminate\Http\Response
     */
    public function destroy(Setting $setting)
    {
        //
    }

    public function mtable(Request $request){
        $input = $request->all();
        if(isset($input['table'])){
            $table = explode('_' , $input['table']);
            $tablename = strtolower(end($table));
            $field =  DB::getSchemaBuilder()->getColumnListing($tablename);
            echo json_encode($field);
        }
    }

    public function underconstructor(){
        //echo Cache::get('underconstuctormode');
        if(Cache::get('underconstuctormode') == '1'){
            Cache::forever('underconstuctormode' , '0');
            return json_encode(["status"=> "success", "msg"=> 'Berhasil mengganti ke mode perbaikan.']);
        }else{
            Cache::forever('underconstuctormode' , '1');
            return json_encode(["status"=> "success", "msg"=> 'Berhasil mengganti ke mode publikasi.']);
        }
        //if(){}
        
    }
}
