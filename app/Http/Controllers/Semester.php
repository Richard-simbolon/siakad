<?php
            namespace App\Http\Controllers;
            use Illuminate\Support\Facades\DB;
            use Illuminate\Support\Facades\Validator;
            use Illuminate\Http\Request;
            use App\ SemesterModel;
            use Yajra\DataTables\DataTables;
            class Semester extends Controller
            {
                static $Tableshow = ["id" => ["table" => ["tablename" =>"null" , "field"=> "id"] , "record"=>"Id"],
                    "row_status" => ["table" => ["tablename" =>"null" , "field"=> "row_status"] , "record"=>"Status"],
                    "title" => ["table" => ["tablename" =>"null" , "field"=> "title"] , "record"=>"Title"],
                    "status_semester" => ["table" => ["tablename" =>"null" , "field"=> "title"] , "record"=>"Set sebagai semester berjalan?"],
                    "tanggal_mulai_berlaku" => ["table" => ["tablename" =>"null" , "field"=> "title"] , "record"=>"Mulai Berlaku"],
                    "tanggal_akhir" => ["table" => ["tablename" =>"null" , "field"=> "title"] , "record"=>"Tanggal Berakhir"],
                    "tanggal_mulai_penilaian" => ["table" => ["tablename" =>"null" , "field"=> "title"] , "record"=>"Penilaian"],
                    "tanggal_akhir_penilaian" => ["table" => ["tablename" =>"null" , "field"=> "title"] , "record"=>"Penilaian Akhir"],
                    ];
                static $html = ["id"=>["type"=>"null" , "value"=>"null" , "validation" => ""] ,
                    "row_status"=>["type"=>"radio" , "value"=>"active,notactive" , "validation" => ""] ,
                    "title"=>["type"=>"text" , "value"=>"null" , "validation" => "required"] ,
                    "status_semester"=>["type"=>"radio" , "value"=>"Ya,Tidak" , "validation" => ""] ,
                    "tanggal_mulai_berlaku"=>["type"=>"date" , "value"=>"null" , "validation" => ""] ,
                    "tanggal_akhir"=>["type"=>"date" , "value"=>"null" , "validation" => ""],
                    "tanggal_mulai_penilaian"=>["type"=>"date" , "value"=>"null" , "validation" => ""] ,
                    "tanggal_akhir_penilaian"=>["type"=>"date" , "value"=>"null" , "validation" => ""]
                ];
                static $exclude = ["id","row_status","created_at","updated_at","created_by","update_by"];
                static $tablename = "Semester";
                public function index()
                {
                    $data = SemesterModel::get();
                    $title = ucfirst(request()->segment(1))." ".ucfirst(request()->segment(2));
                    $tableid = "Semester";
                    $table_display = DB::getSchemaBuilder()->getColumnListing("master_semester");
                    $exclude = static::$exclude;
                    $Tableshow = static::$Tableshow;
                    return view("master/semester" , compact("data" , "title" ,"table_display" ,"exclude" ,"Tableshow","tableid"));

                }
                public function create(){
                    $title = "Tambah ".ucfirst(request()->segment(1))." ".ucfirst(request()->segment(2));
                    $table = array_diff(DB::getSchemaBuilder()->getColumnListing("master_semester"), static::$exclude);
                    $exclude = static::$exclude;
                    $Tableshow = static::$Tableshow;
                    $html = static::$html;
                    $column = 1;

                    $year = date("Y") - 15;
                    $tahun_ajaran = [];
                    for($i=1;$i<=20;$i++){
                        $nextYear = $year+1;
                        $value = $year." / " .$nextYear . ' Ganjil';
                        $value_genap = $year." / " .$nextYear . ' Genap';
                        array_push($tahun_ajaran,
                            ["value"=>$value, "text"=>$value],
                            ["value"=>$value_genap, "text"=>$value_genap]
                        );
                        $year++;
                    }

                    return view("master/semester_create" , compact("table" ,"exclude" , "Tableshow" , "title" , "html", "column", "tahun_ajaran"));

                }

                public function save(Request $request){
                    $input = $request->all();
                    $field = [];
                    $data = [];
                    $table = DB::getSchemaBuilder()->getColumnListing("master_semester");

                    if(SemesterModel::where('title' , $input['title'])->where('row_status', 'active')->first()){
                        return json_encode(["status"=> "false", "message"=> array(["Semester ini sudah ada"])]);
                    }

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
                    $save  = SemesterModel::firstOrCreate($data);
                    if($save){
                        return $this->success("Data berhasil disimpan.");
                    }
                }

                public function edit(Request $request){

                }

                public function view($id){
                    $data = SemesterModel::where('id' , $id)->first();

                    $title = "Edit ".ucfirst(request()->segment(1))." ".ucfirst(request()->segment(2));
                    $table = array_diff(DB::getSchemaBuilder()->getColumnListing("master_semester") , static::$exclude);
                    $exclude = static::$exclude;
                    $Tableshow = static::$Tableshow;
                    $html = static::$html;
                    $column = 1;
                    $year = date("Y") - 15;
                    $tahun_ajaran = [];
                    for($i=1;$i<=20;$i++){
                        $nextYear = $year+1;
                        $value = $year." / " .$nextYear . ' Ganjil';
                        $value_genap = $year." / " .$nextYear . ' Genap';
                        array_push($tahun_ajaran,
                            ["value"=>$value, "text"=>$value],
                            ["value"=>$value_genap, "text"=>$value_genap]
                        );
                        $year++;
                    }

                    $controller = "semester";

                    return view("master/semester_edit" , compact("data" , "title" , 'html' ,"table" ,"exclude" ,"Tableshow", "column", "controller","tahun_ajaran"));
                }

                public function update(Request $request){
                    $this->validate($request,[
                        'title' => 'required'
                    ]);

                    $data =  SemesterModel::where('id' , $request->id)->first();
                    $data->title = $request->title;
                    $data->row_status = $request->row_status;
                    $data->tanggal_mulai_berlaku = $request->tanggal_mulai_berlaku;
                    $data->tanggal_akhir = $request->tanggal_akhir;
                    $data->tanggal_mulai_penilaian = $request->tanggal_mulai_penilaian;
                    $data->tanggal_akhir_penilaian = $request->tanggal_akhir_penilaian;

                    if($data->save()){
                        return $this->success("Data berhasil disimpan.");
                    }else{
                        return json_encode(["status"=> "false", "msg"=> "Mohon maaf, terjadi kesalahan sistem"]);
                    }
                }

                public function delete(Request $request){
                    $data =  SemesterModel::where('id', $request->id)->first();
                    $data->row_status = 'deleted';

                    if($data->status_semester == 'enable'){

                        return json_encode(["status"=> "false", "msg"=> "Status semester harus di non-aktifkan terlebih dulu"]);
                    }

                    if($data->save()){
                        return $this->success("Data berhasil disimpan.");
                    }else{
                        return json_encode(["status"=> "false", "msg"=> "Mohon maaf, terjadi kesalahan sistem"]);
                    }
                }

                public function activate(Request $request){
                    $data =  SemesterModel::where('id', $request->id)->first();
                    $data['status_semester'] = 'enable';

                    if(SemesterModel::where('status_semester', 'enable')->update(array('status_semester'=>'disable'))){
                        if($data->save()){
                            return $this->success("Data berhasil disimpan.");
                        }else{
                            return json_encode(["status"=> "false", "msg"=> "Mohon maaf, terjadi kesalahan sistem"]);
                        }
                    }
                }
                public function paging(Request $request){
                    return Datatables::of(SemesterModel::where('row_status', '!=', 'deleted')
                        ->orderBy('id', 'desc')
                        ->orderBy('status_semester', 'desc')
                        ->get())->addIndexColumn()->make(true);
                }

            }
        