<?php
            namespace App\Http\Controllers;
            use Illuminate\Support\Facades\DB;
            use Illuminate\Support\Facades\Validator;
            use Illuminate\Http\Request;
            use App\ KelasModel;
            use App\JurusanModel;
            use App\AngkatanModel;
            use Yajra\DataTables\DataTables;
use App\KurikulumModel;
use App\DosenModel;

class Kelas extends Controller
            {
                static $Tableshow = ["id" => ["table" => ["tablename" =>"null" , "field"=> "id"] , "record"=>"Id"],
                    "title" => ["table" => ["tablename" =>"null" , "field"=> "title"] , "record"=>"Title"],
                    "jurusan_id" => ["table" => ["tablename" =>"null" , "field"=> "jurusan_id"] , "record"=>"Jurusan"],
                    "row_status" => ["table" => ["tablename" =>"null" , "field"=> "row_status"] , "record"=>"status"],
                    ];
                static $html = ["id"=>["type"=>"null" , "value"=>"null" , "validation" => ""] ,
                    "title"=>["type"=>"text" , "value"=>"null" , "validation" => ""] ,
                    "jurusan_id"=>["type"=>"text" , "value"=>"null" , "validation" => ""] ,
                    "row_status"=>["type"=>"radio" , "value"=>"active,notactive,deleted" , "validation" => ""] ,
                    ];

                static $exclude = ["id","created_at","updated_at","created_by","update_by"];
                static $tablename = "Kelas";
                public function index()
                {
                    $data = KelasModel::where('row_status', 'active')->get();

                    $title = ucfirst(request()->segment(1))." ".ucfirst(request()->segment(2));
                    $tableid = "Kelas";
                    $table_display = DB::getSchemaBuilder()->getColumnListing("master_kelas");
                    $exclude = static::$exclude;
                    $Tableshow = static::$Tableshow;
                    return view("master/kelas" , compact("data" , "title" ,"table_display" ,"exclude" ,"Tableshow","tableid"));

                }
                public function view($id)
                {
                    $data = KelasModel::where('id' , $id)->first();
                    $master = array(
                        'jurusan' => JurusanModel::where('row_status' , 'active')->get(),
                        'angkatan' => AngkatanModel::where('row_status' , 'active')->get()
                    );

                    $title = ucfirst(request()->segment(1))." ".ucfirst(request()->segment(2));
                    $tableid = "Kelas";
                    $table_display = DB::getSchemaBuilder()->getColumnListing("master_kelas");
                    $exclude = static::$exclude;
                    $Tableshow = static::$Tableshow;
                    return view("master/kelas_edit" , compact("data" , "title" ,"table_display" ,"exclude" ,"Tableshow","tableid", "master"));

                }
                public function create(){
                    $master = array(
                        'jurusan' => JurusanModel::where('row_status' , 'active')->get(),
                        'angkatan' => AngkatanModel::where('row_status' , 'active')->get()
                    );
                    $title = "Tambah ".ucfirst(request()->segment(1))." ".ucfirst(request()->segment(2));
                    $table = array_diff(DB::getSchemaBuilder()->getColumnListing("master_kelas"), static::$exclude);
                    $exclude = static::$exclude;
                    $Tableshow = static::$Tableshow;
                    $html = static::$html;
                    $column = 1;
                    return view("master/kelas_create" , compact("table" ,"exclude" , "Tableshow" , "title" , "html", "column" ,'master'));

                }

                public function save(Request $request){
                    $input = $request->all();
                    //print_r($input); exit;
                    $field = [];
                    $data = [];
                    $table = DB::getSchemaBuilder()->getColumnListing("master_kelas");
                    $fieldvalidatin = static::$html;
                    foreach($table as $val){
                        if(array_key_exists($val , $fieldvalidatin) && !in_array($val , static::$exclude)){
                            $field[$val] = $fieldvalidatin[$val]["validation"];
                            $data[$val] = $input[$val];
                        }

                    }
                    //$validation = Validator::make($request->all(), $field);

                    $validation = Validator::make($input, [
                        'title' => 'required',
                        'angkatan_id' => 'required',
                        'jurusan_id' => 'required',
                        'kurikulum_id' => 'required'
                    ]);

                    if ($validation->fails()) {
                        return json_encode(["status"=> "false", "message"=> $validation->messages()]);
                    }
                    $save  = KelasModel::firstOrCreate($input);
                    if($save){
                        return $this->success("Data berhasil disimpan.");
                    }
                }

                public function edit(Request $request){
                    $this->validate($request,[
                        'title' => 'required',
                        'jurusan_id' => 'required'
                    ]);

                    $data =  KelasModel::where('id' , $request->id)->first();
                    $data->title = $request->title;
                    $data->jurusan_id = $request->jurusan_id;
                    $data->row_status = $request->row_status;

                    $data->save();
                    return redirect('/master/kelas');
                }

                public function delete(Request $request){
                    $data =  KelasModel::where('id', $request->id)->first();
                    $data->row_status = 'deleted';

                    if($data->save()){
                        return $this->success("Data berhasil disimpan.");
                    }else{
                        return json_encode(["status"=> "false", "msg"=> "Mohon maaf, terjadi kesalahan sistem"]);
                    }
                }


                public function paging(Request $request){
                    return Datatables::of(KelasModel::where('master_kelas.row_status', 'active')->join('master_jurusan', 'master_jurusan.id', '=', 'master_kelas.jurusan_id')
                        ->select("master_kelas.id" ,"master_kelas.title as nama", "master_jurusan.title as jurusan", "master_kelas.row_status")->get())->addIndexColumn()->make(true);
                }


                public function listkurikulum(Request $request){
                    $id = $request->all();
                    $kurikulum = KurikulumModel::where('row_status' , 'active')
                    ->where('program_studi_id',$id['id'])->get();
                   $html = '<option value="">-- Pilih Kurikulum --</option>';
                    if($kurikulum){
                        foreach($kurikulum as $item){
                            $html .= '<option value="'.$item['id'].'" >'.$item['nama_kurikulum'].'</option>';
                        }
                   }
                   return $html;
                }

                public function listkelas(Request $request){
                    $post = $request->all();
                    //print_r($post); exit;
                    $kelas = KelasModel::where('row_status' , 'active')
                    ->where('jurusan_id',$post['jurusan'])
                    ->where('angkatan_id',$post['angkatan'])
                    ->get();
                   $html = '<option value="0">-- Pilih Kelas --</option>';
                    if($kelas){
                        foreach($kelas as $item){
                            $html .= '<option value="'.$item['id'].'" attr="'.$item['kurikulum_id'].'" >'.$item['title'].'</option>';
                        }
                   }
                   return $html;
                }


                


            }
        