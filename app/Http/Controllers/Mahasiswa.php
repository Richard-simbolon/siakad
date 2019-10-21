<?php
            namespace App\Http\Controllers;
            use Illuminate\Support\Facades\DB;
            use Illuminate\Support\Facades\Validator;
            use Illuminate\Http\Request;
            use App\ MahasiswaModel;
            use Yajra\DataTables\DataTables;
            class Mahasiswa extends Controller
            {
                static $Tableshow = ["id" => ["table" => ["tablename" =>"null" , "field"=> "id"] , "record"=>"Id"],
                    ];
                static $html = ["id"=>["type"=>"null" , "value"=>"null" , "validation" => ""] ,
            ];
                static $exclude = ["id","created_at","updated_at","created_by","update_by"];
                static $tablename = "Mahasiswa";
                public function index()
                {
                    $data = MahasiswaModel::get();
                    $title = ucfirst(request()->segment(1))." ".ucfirst(request()->segment(2));
                    $tableid = "Mahasiswa";
                    $table_display = DB::getSchemaBuilder()->getColumnListing("mahasiswa");
                    $exclude = static::$exclude;
                    $Tableshow = static::$Tableshow;
                    return view("data/mahasiswa" , compact("data" , "title" ,"table_display" ,"exclude" ,"Tableshow","tableid"));

                }
                public function create(){
                    $title = "Tambah ".ucfirst(request()->segment(1))." ".ucfirst(request()->segment(2));
                    $table = array_diff(DB::getSchemaBuilder()->getColumnListing("mahasiswa"), static::$exclude);
                    $exclude = static::$exclude;
                    $Tableshow = static::$Tableshow;
                    $html = static::$html;
                    $column = 1;
                    return view("data/mhs_create" , compact("table" ,"exclude" , "Tableshow" , "title" , "html", "column"));

                }

                public function save(Request $request){
                    $input = $request->all();
                    $field = [];
                    $data = [];
                    $table = DB::getSchemaBuilder()->getColumnListing("mahasiswa");
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
                    $save  = MahasiswaModel::firstOrCreate($data);
                    if($save){
                        return $this->success("Data berhasil disimpan.");
                    }
                }

                public function edit(Request $request){

                }

                public function paging(Request $request){
                    return Datatables::of(MahasiswaModel::all())->make(true);
                }

                public function validatewizard(Request $request){
                    //print_r($request->all());
                    $data = $request->all();
                   $stepvalidation = array(
                        'mahasiswa1' => array(
                            'nama' => 'required',
                            'nama_ibu' => 'required',
                            'tempat_lahir' => 'required',
                            'tanggal_lahir' => 'required',
                            'jk' => 'required',
                            'agama' => 'required'
                        ),
                        'mahasiswa2' => array(
                            'nik' => 'required',
                            'nisn' => '',
                            'kewarganegaraan' => 'required',
                            'alamat' => 'required',
                            'dusun' => '',
                            'rt' => '',
                            'rw' => '',
                            'kelurahan' => '',
                            'kode_pos' => '',
                            'kecamatan' => '',
                            'jenis_tingal' => '',
                            'telepon' => '',
                            'no_hp' => '',
                            'kps' => '',
                            'no_kps' => '',
                        ),
                        'mahasiswa_orang_tua_wali' => array(
                            'nik_ayah' =>'',
                            'nama_ayah' =>'',
                            'tanggal_lahir_ayah' =>'',
                            'pendidikan_ayah' =>'',
                            'pekerjaan_ayah' =>'',
                            'penghasilan_ayah' =>'',
                            'nik_ibu' =>'',
                            'tanggal_lahir_ibu' =>'',
                            'pendidikan_ibu' =>'',
                            'pekerjaan_ibu' =>'',
                            'penghasilan_ayah' =>'',
                        ),
                        'wali'=> array(
                            'nama_wali' =>'',
                            'tanggal_lahir_wali' =>'',
                            'pendidikan_wali' =>'',
                            'pekerjaan_wali' =>'',
                            'penghasilan_wali' =>'',
                        ),
                        'kebutuhan_khusus' => array()

                   );


                   if(isset($data['step'])){
                        if($data['step'] == '1'){
                            $validation = Validator::make($data['mahasiswa'], [
                                'nama' => 'required',
                                'nama_ibu' => 'required',
                                'tempat_lahir' => 'required',
                                'tanggal_lahir' => 'required',
                                'jk' => 'required',
                                'agama' => 'required'
                            ]);
                        }elseif($data['step'] == '2'){
                            $validation = Validator::make($data['mahasiswa'], [
                                'nik' => 'required',
                                'kewarganegaraan' => 'required',
                                'alamat' => 'required'
                               /* 'nisn' => '',
                                'dusun' => '',
                                'rt' => '',
                                'rw' => '',
                                'kelurahan' => '',
                                'kode_pos' => '',
                                'kecamatan' => '',
                                'jenis_tingal' => '',
                                'telepon' => '',
                                'no_hp' => '',
                                'kps' => '',
                                'no_kps' => '',*/
                            ]);
                        }else{
                            $validation = Validator::make($data['mahasiswa'], [

                            ]);
                        }
                        if ($validation->fails()) {
                            return json_encode(['status'=> 'false', 'message'=> $validation->messages()]);
                        }
                   }else{
                       return json_encode(['result' =>'false']);
                   }

                   return json_encode(['status'=> 'true', 'message'=> []]);
                }


            }
