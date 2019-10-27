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
            use App\StatusPegawaiModel;
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
                        'status_pegawai' => StatusPegawaiModel::where('row_status' , 'active')->get(),
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

                    //print_r($data); exit;
                    
                    $validation = Validator::make($data['dosen'], [
                        'nama' => '',
                        'nidn_nup_nidk' => '',
                        'tempat_lahir' => '',
                        'agama' => ''
                    ]);

                    if ($validation->fails()) {
                        return json_encode(['status'=> 'false', 'message'=> $validation->messages()]);
                    }
                    DB::beginTransaction();
                    try{

                        if(array_key_exists('dosen' , $data)){
                            // SAVE TO TABLE mahasiswa
                            $data['dosen']['tanggal_lahir'] = date($data['dosen']['tanggal_lahir']);
                            $dosenid = DosenModel::create($data['dosen']);
                        }
    
                        if($dosenid->id != ''){
                            if(array_key_exists('keluarga' , $data)){
                                // SAVE TO TABLE mahasiswa
                                $data['keluarga']['dosen_id'] = $dosenid->id;
                                DosenKeluargaModel::create($data['keluarga']);
                            }
                            
                            // SAVE TO TABLE mahasiswa_kebutuhan_khusus
                            $data_kebutuhan_khusus = array(
                                'dosen_id' => $dosenid->id,
                                'row_status' => 'active',
                                'created_by' => 1,
                                'updated_by' => 1,
                                'kebutuhan_khusus' => array_key_exists('dosen_kh' , $data) ? json_encode(array('dosen' => $data['dosen_kh'])) : json_encode(array('dosen' =>[])),
                                'braile'=> $data['braile'],
                                'isyarat' => $data['isyarat'],
                            );
                            DosenKebutuhanModel::create($data_kebutuhan_khusus);

                        }
                        

                        DB::commit();
                        return json_encode(array('status' => 'success' , 'msg' => 'Data berhasil disimpan.'));
                    } catch(\Exception $e){
                        
                        DB::rollBack(); 
                        throw $e;
                        return json_encode(array('status' => 'error' , 'msg' => 'Terjadi kesalahan saat menyimpan, silahkan coba lagi.'));
                    }

                }

                public function edit(Request $request){

                }

                public function update(Request $request){
                    $data = $request->all();
                    $id = $data['dosen']['id'];
                    unset($data['dosen']['id']);
                    $validation = Validator::make($data['dosen'], [
                        'nama' => '',
                        'nidn_nup_nidk' => '',
                        'tempat_lahir' => '',
                        'agama' => ''
                    ]);
                    if ($validation->fails()) {
                        return json_encode(['status'=> 'false', 'message'=> $validation->messages()]);
                    }

                    if($id != ''){
                        DB::beginTransaction();
                        try{
    
                            if(array_key_exists('dosen' , $data)){
                                $data['dosen']['tanggal_lahir'] = date($data['dosen']['tanggal_lahir']);
                                DosenModel::where('id' , $id)->update($data['dosen']);
                            }
        
                           
                            if(array_key_exists('keluarga' , $data)){
                                DosenKeluargaModel::where('dosen_id' , $id)->update($data['keluarga']);
                            }
                            
                            // SAVE TO TABLE mahasiswa_kebutuhan_khusus
                            $data_kebutuhan_khusus = array(
                                'row_status' => 'active',
                                'created_by' => 1,
                                'updated_by' => 1,
                                'kebutuhan_khusus' => array_key_exists('dosen_kh' , $data) ? json_encode(array('dosen' => $data['dosen_kh'])) : json_encode(array('dosen' =>[])),
                                'braile'=> $data['braile'],
                                'isyarat' => $data['isyarat'],
                            );
                            DosenKebutuhanModel::where('dosen_id' , $id)->update($data_kebutuhan_khusus);

                            
    
                            DB::commit();
                            return json_encode(array('status' => 'success' , 'msg' => 'Data berhasil disimpan.'));
                        } catch(\Exception $e){
                            
                            DB::rollBack(); 
                            throw $e;
                            return json_encode(array('status' => 'error' , 'msg' => 'Terjadi kesalahan saat menyimpan, silahkan coba lagi.'));
                        }

                    }

                    
                    

                }

                public function paging(Request $request){
                    //return Datatables::of(DosenModel::all())->make(true);

                    return Datatables::of(DosenModel::join('master_agama', 'dosen.agama', '=', 'master_agama.id')
                    ->select("dosen.id" ,"master_agama.title as t_agama","nip" ,"nidn_nup_nidk", "agama" , "dosen.status","nama","tanggal_lahir","jenis_kelamin")->get())->make(true);
                }

                public function view($id){

                    $master = array(
                        'kebutuhan' => KebutuhanKhususModel::where('row_status' , 'active')->get(),
                        'agama' => AgamaModel::where('row_status' , 'active')->get(),
                        'pekerjaan' => PekerjaanModel::where('row_status' , 'active')->get(),
                        'status_pegawai' => StatusPegawaiModel::where('row_status' , 'active')->get(),
                        'jenis_kelamin' => config('global.jenis_kelamin')
                    );
                    $data = DosenModel::join('master_agama', 'master_agama.id', '=', 'dosen.agama')
                    ->join('dosen_keluarga' , 'dosen_keluarga.dosen_id' ,'=' , 'dosen.id')
                    ->join('dosen_kebutuhan_khusus' , 'dosen_kebutuhan_khusus.dosen_id' , '=' , 'dosen.id')
                    ->select('dosen.*','dosen_keluarga.pekerjaan' ,'dosen_keluarga.tmt_pns' ,'dosen_keluarga.nip_pasangan','dosen_keluarga.nama_pasangan','dosen_keluarga.status_pernikahan', 'master_agama.title' , 'dosen_kebutuhan_khusus.kebutuhan_khusus' , 'dosen_kebutuhan_khusus.braile' , 'dosen_kebutuhan_khusus.isyarat')
                    ->where('dosen.id' , $id)->first();
                    $title = ucfirst(request()->segment(1))." ".ucfirst(request()->segment(2));
                    $tableid = "Mahasiswa";
                    return view("data/dosen_view" , compact("data","master"));
                }

            }
        