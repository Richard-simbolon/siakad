<?php
            namespace App\Http\Controllers;
            use Illuminate\Support\Facades\DB;
            use Illuminate\Support\Facades\Validator;
            use Illuminate\Http\Request;
            use App\MataKuliahModel;
            use App\JurusanModel;
            use App\JenisMatakuliahModel;
            use Yajra\DataTables\DataTables;
            Use File;
            class MataKuliah extends Controller
            {
                static $Tableshow = [   "id" => ["table" => ["tablename" =>"null" , "field"=> "id"] , "record"=>"Id"],
                                        "kode_mata_kuliah"=> ["table" => ["tablename" =>"null" , "field"=> "id"] , "record"=>"Kode MK"],
                                        "nama_mata_kuliah"=> ["table" => ["tablename" =>"null" , "field"=> "id"] , "record"=>"Nama MK"],
                                        "program_studi_id"=> ["table" => ["tablename" =>"null" , "field"=> "id"] , "record"=>"Program Studi"],
                                        "row_status"=> ["table" => ["tablename" =>"null" , "field"=> "id"] , "record"=>"Status"],
                                        "jenis_mata_kuliah_id"=> ["table" => ["tablename" =>"null" , "field"=> "id"] , "record"=>"Jenis MK"],
                                        "bobot_mata_kuliah"=> ["table" => ["tablename" =>"null" , "field"=> "id"] , "record"=>"Bobot MK"],
                                        "bobot_tatap_muka"=> ["table" => ["tablename" =>"null" , "field"=> "id"] , "record"=>"Bobot TM"],
                                        "bobot_praktikum"=> ["table" => ["tablename" =>"null" , "field"=> "id"] , "record"=>"B. Praktikum"],
                                        "bobot_praktek_lapangan"=> ["table" => ["tablename" =>"null" , "field"=> "id"] , "record"=>"B. PKL"],
                                        "bobot_simulasi"=> ["table" => ["tablename" =>"null" , "field"=> "id"] , "record"=>"B. Simulasi"],
                                        "metode_pembelajaran"=> ["table" => ["tablename" =>"null" , "field"=> "id"] , "record"=>"Metode Pembelajaran"],
                                        "tanggal_mulai_efektif"=> ["table" => ["tablename" =>"null" , "field"=> "id"] , "record"=>"Efektif"],
                                        "taggal_akhir_efektif"=> ["table" => ["tablename" =>"null" , "field"=> "id"] , "record"=>"Berakhir"],
                                        "created_by"=> ["table" => ["tablename" =>"null" , "field"=> "id"] , "record"=>"id"],
                                        "created_at"=> ["table" => ["tablename" =>"null" , "field"=> "id"] , "record"=>"id"],
                                        "modified_by"=> ["table" => ["tablename" =>"null" , "field"=> "id"] , "record"=>"id"],
                                        "updated_at"=> ["table" => ["tablename" =>"null" , "field"=> "id"] , "record"=>"id"],
                                    ];
                static $html = ["id"=>["type"=>"null" , "value"=>"null" , "validation" => ""],
                                "row_status"=>["type"=>"radio" , "value"=>"active,deleted,notactive" , "validation" => "required"],
                                "kode_mata_kuliah"=>["type"=>"text" , "value"=>"null" , "validation" => "required"],
                                "nama_mata_kuliah"=>["type"=>"text" , "value"=>"null" , "validation" => "required"],
                                "program_studi_id"=>["type"=>"select" , "value"=>"null" , "validation" => "required"],
                                "jenis_mata_kuliah_id"=>["type"=>"select" , "value"=>"null" , "validation" => "required"],
                                "bobot_mata_kuliah"=>["type"=>"number" , "value"=>"null" , "validation" => "required"],
                                "bobot_tatap_muka"=>["type"=>"number" , "value"=>"null" , "validation" => "required"],
                                "bobot_praktikum"=>["type"=>"number" , "value"=>"null" , "validation" => "required"],
                                "bobot_praktek_lapangan"=>["type"=>"number" , "value"=>"null" , "validation" => "required"],
                                "bobot_simulasi"=>["type"=>"number" , "value"=>"null" , "validation" => "required"],
                                "metode_pembelajaran"=>["type"=>"textarea" , "value"=>"null" , "validation" => "required"],
                                "tanggal_mulai_efektif"=>["type"=>"date" , "value"=>"null" , "validation" => "required"],
                                "taggal_akhir_efektif"=>["type"=>"date" , "value"=>"null" , "validation" => "required"],
                                "created_by"=>["type"=>"null" , "value"=>"null" , "validation" => "required"],
                                "created_at"=>["type"=>"null" , "value"=>"null" , "validation" => "required"],
                                "modified_by"=>["type"=>"null" , "value"=>"null" , "validation" => "required"],
                                "updated_at"=>["type"=>"null" , "value"=>"null" , "validation" => "required"],
                                ];
                static $exclude = ["id","created_at","updated_at","created_by","modified_by"];
                static $exclude_table = ["id","created_at","updated_at","created_by","modified_by", "bobot_tatap_muka", "bobot_praktikum", "bobot_praktek_lapangan", "bobot_simulasi", "metode_pembelajaran","tanggal_mulai_efektif","taggal_akhir_efektif"];

                public function index()
                {
                    $data = MataKuliahModel::get();// DB::getSchemaBuilder()->getColumnListing("mata_kuliah")
                    $tableid = 'matakuliah';
                    $title = ucfirst(request()->segment(1))." ".ucfirst(request()->segment(2));
                    $table_display = MataKuliahModel::tabel_column();

                    $exclude = static::$exclude_table;

                    $Tableshow = static::$Tableshow;
                    return view("setting/general_view" , compact("data" , "title" ,"table_display" ,"exclude" ,"Tableshow","tableid"));

                }
                public function create(){
//                    $i = 5;
//                    $program = array(1,2,3);
//                    $jenis = array(1,2);
//                    for($i = 6 ; $i<25;$i++){
//                        $data = [
//                            'kode_mata_kuliah' => 'P000'.$i,
//                            'nama_mata_kuliah' => 'Mata Kuliah '.$i,
//                            'row_status' => 'active',
//                            'program_studi_id' => $program[array_rand($program, 1)],
//                            'jenis_mata_kuliah_id' => $jenis[array_rand($jenis, 1)],
//                            'bobot_mata_kuliah' => '10',
//                            'bobot_tatap_muka' => '20',
//                            'bobot_praktikum' => '30',
//                            'bobot_praktek_lapangan' => '10',
//                            'bobot_simulasi' => '10',
//                            'metode_pembelajaran' => 'Tatap Muka',
//                            'tanggal_mulai_efektif' => date('Y-m-d H:i:s'),
//                            'taggal_akhir_efektif' => date('Y-m-d H:i:s'),
//                            'created_by' => '1',
//                            'modified_by' => '1'
//                        ];
//
//                        MataKuliahModel::firstOrCreate($data);
//
//                    }
                    $master = array(
                        'jurusan' => JurusanModel::where('row_status' , 'active')->get(),
                        'jenis' => JenisMatakuliahModel::where('row_status' , 'active')->get()
                    );
                    $title = "Tambah ".ucfirst(request()->segment(1))." ".ucfirst(request()->segment(2));

                    $table = array_diff(MataKuliahModel::get_row() , static::$exclude);//array_diff(DB::getSchemaBuilder()->getColumnListing("mata_kuliah") , static::$exclude);
                    $exclude = static::$exclude;
                    $Tableshow = static::$Tableshow;
                    $html = static::$html;
                    $column = 2;
                    return view("master/matakuliah" , compact("table" ,"exclude" , "Tableshow" , "title" , "html" , "column", "master"));

                }

                public function save(Request $request){
                    $input = $request->all();
                    $field = [];
                    $data = [];
                    $table = DB::getSchemaBuilder()->getColumnListing("mata_kuliah");
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
                    $save  = MataKuliahModel::firstOrCreate($data);

//                    $filedata = MataKuliahModel::select('id' ,'title')
//                    ->where('row_status', '=', 'active')
//                    ->get();

//                    if($filedata){
//                        File::put(public_path().'/master/'.strtolower(static::$tablename).'.php',json_encode($filedata));
//                    }

                    if($save){
                        return $this->success("Data berhasil disimpan.");
                    }
                }

                public function view($id){
                    $data = MataKuliahModel::where('id' , $id)->first();
                    $master = array(
                        'jurusan' => JurusanModel::where('row_status' , 'active')->get(),
                        'jenis' => JenisMatakuliahModel::where('row_status' , 'active')->get()
                    );
                    $title = "View ".ucfirst(request()->segment(1))." ".ucfirst(request()->segment(2));
                    $table = array_diff(DB::getSchemaBuilder()->getColumnListing("mata_kuliah") , static::$exclude);
                    $exclude = static::$exclude;
                    $Tableshow = static::$Tableshow;
                    $html = static::$html;
                    $column = 1;
                    $controller = "matakuliah";
                    return view("master/matakuliah_view" , compact("data" , "title" , 'html' ,"table" ,"exclude" ,"Tableshow","tableid", "column", "controller", "master"));
                }

                public function edit($id){
                    $data = MataKuliahModel::where('id' , $id)->first();
                    $master = array(
                        'jurusan' => JurusanModel::where('row_status' , 'active')->get(),
                        'jenis' => JenisMatakuliahModel::where('row_status' , 'active')->get()
                    );
                    $title = "Edit ".ucfirst(request()->segment(1))." ".ucfirst(request()->segment(2));
                    $table = array_diff(DB::getSchemaBuilder()->getColumnListing("mata_kuliah") , static::$exclude);
                    $exclude = static::$exclude;
                    $Tableshow = static::$Tableshow;
                    $html = static::$html;
                    $column = 1;
                    $controller = "matakuliah";
                    return view("master/matakuliah_edit" , compact("data" , "title" , 'html' ,"table" ,"exclude" ,"Tableshow","tableid", "column", "controller", "master"));
                }


                public function update(Request $request){
//                    $this->validate($request,[
//                        'kode_mata_kuliah' => 'kode_mata_kuliah',
//                        'row_status' => 'row_status',
//                        'nama_mata_kuliah' => 'nama_mata_kuliah',
//                        'program_studi_id' => 'program_studi_id',
//                        'jenis_mata_kuliah_id' => 'jenis_mata_kuliah_id',
//                        'bobot_mata_kuliah' => 'bobot_mata_kuliah',
//                        'bobot_tatap_muka' => 'bobot_tatap_muka',
//                        'bobot_praktikum' => 'bobot_praktikum',
//                        'bobot_praktek_lapangan' => 'bobot_praktek_lapangan',
//                        'bobot_simulasi' => 'bobot_simulasi',
//                        'metode_pembelajaran' => 'metode_pembelajaran',
//                        'tanggal_mulai_efektif' => 'tanggal_mulai_efektif',
//                        'taggal_akhir_efektif' => 'taggal_akhir_efektif',
//                    ]);
                    $input = $request->all();
                    $table = DB::getSchemaBuilder()->getColumnListing("mata_kuliah");
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

                    $data =  MataKuliahModel::where('id' , $request->id)->first();
                    $data->kode_mata_kuliah = $request->kode_mata_kuliah;
                    $data->row_status = $request->row_status;
                    $data->nama_mata_kuliah = $request->nama_mata_kuliah;
                    $data->program_studi_id = $request->program_studi_id;
                    $data->jenis_mata_kuliah_id = $request->jenis_mata_kuliah_id;
                    $data->bobot_mata_kuliah = $request->bobot_mata_kuliah;
                    $data->bobot_tatap_muka = $request->bobot_tatap_muka;
                    $data->bobot_praktikum = $request->bobot_praktikum;
                    $data->bobot_praktek_lapangan = $request->bobot_praktek_lapangan;
                    $data->bobot_simulasi = $request->bobot_simulasi;
                    $data->metode_pembelajaran = $request->metode_pembelajaran;
                    $data->tanggal_mulai_efektif = $request->tanggal_mulai_efektif;
                    $data->taggal_akhir_efektif = $request->taggal_akhir_efektif;

                    $data->save();
                    return redirect('/master/matakuliah');
                }

                public function delete(Request $request){
                    $data =  MataKuliahModel::where('id', $request->id)->first();
                    $data->row_status = 'deleted';

                    if($data->save()){
                        return $this->success("Data berhasil disimpan.");
                    }else{
                        return json_encode(["status"=> "false", "msg"=> "Mohon maaf, terjadi kesalahan sistem"]);
                    }
                }

                public function paging(Request $request){
                    return Datatables::of(MataKuliahModel::where('mata_kuliah.row_status', 'active')
                        ->join('master_jurusan', 'master_jurusan.id', '=', 'mata_kuliah.program_studi_id')
                        ->join('master_jenis_matakuliah', 'master_jenis_matakuliah.id', '=', 'mata_kuliah.jenis_mata_kuliah_id')
                        ->select("mata_kuliah.id", "kode_mata_kuliah", "nama_mata_kuliah", "bobot_mata_kuliah", "master_jurusan.title as program_studi_id", "master_jenis_matakuliah.title as jenis_mata_kuliah_id", "mata_kuliah.row_status")
                        ->get())->addIndexColumn()->make(true);
                }
            }
