<?php
            namespace App\Http\Controllers;
            use Illuminate\Support\Facades\DB;
            use Illuminate\Support\Facades\Validator;
            use Illuminate\Http\Request;
            use App\ DosenModel;
            use App\PekerjaanModel;
            use App\AgamaModel;
            use App\KebutuhanKhususModel;
            use App\DosenKebutuhanModel;
            use App\DosenKeluargaModel;
            use Yajra\DataTables\DataTables;
            use File;
            class Dosen extends Controller
            {
                static $Tableshow = ["id" => ["table" => ["tablename" =>"null" , "field"=> "id"] , "record"=>"Id"],
                    "row_status" => ["table" => ["tablename" =>"null" , "field"=> "row_status"] , "record"=>"Row_status"],
                    ];
                static $html = ["id"=>["type"=>"null" , "value"=>"null" , "validation" => ""] ,
            "row_status"=>["type"=>"null" , "value"=>"null" , "validation" => ""] ,
            ];
                static $exclude = ["id","created_at","updated_at","created_by","update_by"];
                static $tablename = "Dosen";
                public function index()
                {
                    $data = DosenModel::get();
                    $title = ucfirst(request()->segment(1))." ".ucfirst(request()->segment(2));
                    $tableid = "Dosen";
                    $table_display = DB::getSchemaBuilder()->getColumnListing("dosen");
                    $exclude = static::$exclude;
                    $Tableshow = static::$Tableshow;
                    //return view("data/dosen" , compact("data" , "title" ,"table_display" ,"exclude" ,"Tableshow","tableid"));
                    return view("data/dosen" , compact("data" , "title" ,"table_display" ,"exclude" ,"Tableshow","tableid"));


                }
                public function create(){
                    $master = array(
                        'pekerjaan' => PekerjaanModel::where('row_status' , 'active')->get(),
                        'kebutuhan' => KebutuhanKhususModel::where('row_status' , 'active')->get(),
                        'agama' => AgamaModel::where('row_status' , 'active')->get(),
                    );
                    $title = "Tambah ".ucfirst(request()->segment(1))." ".ucfirst(request()->segment(2));
                    $table = array_diff(DB::getSchemaBuilder()->getColumnListing("dosen"), static::$exclude);
                    $exclude = static::$exclude;
                    $Tableshow = static::$Tableshow;
                    $html = static::$html;
                    $column = 1;
                    return view("data/dosen_create" , compact("table" ,"exclude" , "Tableshow" , "title" , "html", "column" , "master"));

                }

                public function save(Request $request){
                    $data = $request->all();

                    print_r($data); exit;
                    
                    $validation = Validator::make($data['mahasiswa'], [
                        'nama' => 'required',
                        'nidn_nup_nidk' => 'required',
                        'tempat_lahir' => 'required',
                        'agama' => 'required'
                    ]);

                    if ($validation->fails()) {
                        return json_encode(['status'=> 'false', 'message'=> $validation->messages()]);
                    }
                    DB::beginTransaction();
                    try{

                        if(array_key_exists('dosen' , $data)){
                            // SAVE TO TABLE mahasiswa
                            $data['dosen']['tanggal_lahir'] = date($data['mahasiswa']['tanggal_lahir']);
                            $mahasiswa = DosenModel::create($data['dosen']);
                        }

                        if(array_key_exists('keluarga' , $data)){
                            // SAVE TO TABLE mahasiswa
                            $data['keluarga']['tanggal_lahir'] = date($data['keluarga']['tanggal_lahir']);
                            $mahasiswa = DosenKeluargaModel::create($data['keluarga']);
                        }
                        
                        // SAVE TO TABLE mahasiswa_kebutuhan_khusus
                        $data_kebutuhan_khusus = array(
                            'mahasiswa_id' => $mahasiswa->id,
                            'row_status' => 'active',
                            'created_by' => 1,
                            'updated_by' => 1,
                            'kebutuhan_mahasiswa' => array_key_exists('dosen_kh' , $data) ? json_encode(array('dosen' => $data['dosen_kh'])) : json_encode(array('mahasiswa' =>[])),
                            'handle_braile'=> $data['dosen_kh']['handle_braile'],
                            'handle_bahasa_isyarat' => $data['dosen_kh']['handle_bahasa_isyarat'],
                        );
                        DosenKebutuhanModel::create($data_kebutuhan_khusus);
                        DB::commit();
                        return json_encode(array('status' => 'success' , 'msg' => 'Data berhasil disimpan.'));
                    } catch(\Exception $e){
                        
                        DB::rollBack(); 
                        return json_encode(array('status' => 'error' , 'msg' => 'Terjadi kesalahan saat menyimpan, silahkan coba lagi.'));
                    }

                }

                public function edit(Request $request){

                }

                public function paging(Request $request){
                    return Datatables::of(DosenModel::all())->make(true);
                }

            }
        