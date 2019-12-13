<?php
namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\ AbsensiMahasiswaModel;
use Yajra\DataTables\DataTables;
use App\JurusanModel;
use App\AngkatanModel;
use App\KelasModel;
use App\SemesterModel;
use Illuminate\Support\Facades\Cache;
use App\MahasiswaModel;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class AbsensiMahasiswa extends Controller
{
    static $Tableshow = ["id" => ["table" => ["tablename" =>"null" , "field"=> "id"] , "record"=>"Id"],
        "row_status" => ["table" => ["tablename" =>"null" , "field"=> "row_status"] , "record"=>"Row_status"],
        "title" => ["table" => ["tablename" =>"null" , "field"=> "title"] , "record"=>"Title"],
        ];
    static $html = ["id"=>["type"=>"null" , "value"=>"null" , "validation" => ""] ,
        "row_status"=>["type"=>"null" , "value"=>"null" , "validation" => ""] ,
        "title"=>["type"=>"null" , "value"=>"null" , "validation" => ""] ,
    ];
    static $exclude = ["id","created_at","updated_at","created_by","update_by"];
    static $tablename = "AbsensiMahasiswa";

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
        //print_r(Cache::get('absensi_18'));
        //print_r(Cache::get('absensi_29_detail'));
        //Cache::get('key', 'default');
        //exit;
        ///echo implode( "','", DB::getSchemaBuilder()->getColumnListing('absensi_mahasiswa')); exit;
        $master = array(
            'jurusan' => JurusanModel::where('row_status' , 'active')->get(),
            'angkatan' => AngkatanModel::where('row_status' , 'active')->get(),
            'kelas' => KelasModel::where('row_status' , 'active')->get(),
            'semester'=> SemesterModel::where('row_status', 'active')->get(),
        );
        //print_r($master); exit;
        //$data = DB::table('view_input_nilai_mahasiswa')->get();
        $title = ucfirst(request()->segment(1))." ".ucfirst(request()->segment(2));
        $tableid = "KelasPerkuliahan";
        $table_display = DB::getSchemaBuilder()->getColumnListing(static::$tablename);
        $exclude = static::$exclude;
        $Tableshow = static::$Tableshow;
        return view("data/absensi_mahasiswa" , compact("title" ,"table_display" ,"exclude" ,"Tableshow","tableid", "master"));

    }
    public function absensi($id){

        //echo $id; exit;
        $title = "Tambah ".ucfirst(request()->segment(1))." ".ucfirst(request()->segment(2));
        
        $data = DB::table('view_input_nilai_mahasiswa')->where('id' , $id)->first();
        if(!$data->kelas_id){
            echo 'Data Tidak Ditemukan.';
        }
        if(DB::table('nilai_mahasiswa')
        ->where('kelas_perkuliahan_detail_id' , $id)->exists())
        {
            $mahasiswa = DB::table('nilai_mahasiswa')
            ->leftjoin('mahasiswa' , 'mahasiswa.id' , '=' ,'nilai_mahasiswa.mahasiswa_id')
            ->where('nilai_mahasiswa.kelas_perkuliahan_detail_id' , $id)->get();
            
        }else{

            $mahasiswa = MahasiswaModel::where('kelas_id' , $data->kelas_id)->where('status' , '1')->get();
        }

        return view("data/absensi_create" , compact("title" , "mahasiswa", "data"));

    }


    public function view($id){
        //Cache::flush();
        $title = "Tambah ".ucfirst(request()->segment(1))." ".ucfirst(request()->segment(2));
        $data = DB::table('view_input_nilai_mahasiswa')->where('id' , $id)->first();
        if(!$data->kelas_id){
            echo 'Data Tidak Ditemukan.';
        }
        $header_id = DB::table('absensi_mahasiswa')
                    ->select('id')
                    ->where('kelas_perkuliahan_detail_id' , $id)->get();
        $datas = array();
        $mahasiswa = [];
        $detail = [];
        foreach($header_id as $key=>$item){
            
            $all_mhs = $this->get_detail_absensi($item->id , 'absensi_'.$item->id.'_detail');

            foreach($all_mhs as $key2=>$val2){

                if (Cache::has('absensi_'.$item->id)){
                    $h = Cache::get('absensi_'.$item->id);
                }else{
                    $this->cache_header_absensi($item->id,'absensi_'.$item->id);
                    $h = Cache::get('absensi_'.$item->id);
                
                }
                $detail[$val2->mahasiswa_id][$val2->id] = array(
                    'status_absensi' => $val2->status_absensi,
                    'id' => $val2->absensi_id,
                    'catatan' => $val2->catatan,
                    'pembahasan' => $h->pembahasan,
                    'tanggal_perkuliahan' => $h->tanggal_perkuliahan
                );
                $mahasiswa[$val2->mahasiswa_id] = $val2;
            }
        }
        return view("data/absensi_edit" , compact("title", "data" ,"mahasiswa" ,"detail"));

    }

    public function cache_header_absensi($id, $key){
        if (Cache::has($key)){
            return Cache::get($key);
        }else{
            $new_cache = DB::table('view_input_nilai_mahasiswa')
            ->join('absensi_mahasiswa' , 'absensi_mahasiswa.kelas_perkuliahan_detail_id' , '=' , 'view_input_nilai_mahasiswa.id')
            ->select('view_input_nilai_mahasiswa.*' , 'absensi_mahasiswa.id as absensi_id' , 'absensi_mahasiswa.pembahasan' , 'absensi_mahasiswa.tanggal_perkuliahan')
            ->where('absensi_mahasiswa.id' , $id)
            ->first();
            $this->store_memcached($key , $new_cache);
            Cache::get($key); 
        
        }
        
    }

    public function get_detail_absensi($id , $key){

        //return array($key , $id);
        if (Cache::has($key)){
            $data = Cache::get($key);
        }else{
            $new_data = DB::table('view_absensi_mahasiswa')
            ->where('absensi_id' , $id)
            ->get();
            $this->store_memcached($key, $new_data);
            $data = Cache::get($key);
        }

        return $data;
    }

    public function save(Request $request){
        $post = $request->all();
       // print_r($post); exit;
        $absensi = $post['mahasiswa'];
        unset($post['mahasiswa']);
        $post['created_at'] = date('Y-m-d H:i:s');
        $post['updated_at'] = date('Y-m-d H:i:s');
        $validation = Validator::make($post, [
            'tanggal_perkulian' => 'required',
            'pembahasan' => 'required',
            'kelas_perkuliahan_detail_id' => 'required',
            'semester_id' => 'required',
            'mata_kuliah_id' => 'required',
            'jurusan_id' => 'required',
            'angkatan_id' => 'required',
            'kelas_perkuliahan_id' => 'required'
        ]);
        
        if ($validation->fails()) {
            return json_encode(['status'=> 'error', 'message'=> $validation->messages()]);
        }
        DB::beginTransaction();
        try{
            
            $absensiheader = AbsensiMahasiswaModel::create($post);
            $data_absensi = [];
            foreach($absensi as $key=> $item){
                $item['absensi_id'] = $absensiheader->id;
                $item['mahasiswa_id'] = $key;
                $item['updated_at'] = date('Y-m-d H:i:s');
                $item['created_at'] = date('Y-m-d H:i:s');
                $data_absensi[] = $item;
            }
            DB::table('absensi_mahasiswa_detail')->insert($data_absensi);
            $id = $post['kelas_perkuliahan_detail_id'];
            
            // GET DATA HEADER AND STORE TO CACHE
            $mahsiswa_cahce = DB::table('view_input_nilai_mahasiswa')
            ->join('absensi_mahasiswa' , 'absensi_mahasiswa.kelas_perkuliahan_detail_id' , '=' , 'view_input_nilai_mahasiswa.id')
            ->select('view_input_nilai_mahasiswa.*' , 'absensi_mahasiswa.id as absensi_id' , 'absensi_mahasiswa.pembahasan' , 'absensi_mahasiswa.tanggal_perkuliahan')
            ->where('absensi_mahasiswa.id' , $absensiheader->id)
            ->first();

            //print_r($mahsiswa_cahce); exit;

            // GET DATA ABSENSE DETAIL AND STORE TO CACHE
            $mahsiswa_detail_cahce = DB::table('view_absensi_mahasiswa')
            ->where('absensi_id' , $absensiheader->id)
            ->get();
            //Cache::forever('absensi_'.$id , $mahsiswa_cahce);
            //Cache::forever('absensi_'.$id.'_detail' , $mahsiswa_detail_cahce);
            DB::commit();

            Cache::forever('absensi_'.$id , $mahsiswa_cahce);
            Cache::forever('absensi_'.$id.'_detail' , $mahsiswa_detail_cahce);
            return json_encode(array('status' => 'success' , 'message' => 'Data berhasil disimpan.'));
        } catch(\Exception $e){
            
            DB::rollBack(); 
            throw $e;
            return json_encode(array('status' => 'error' , 'message' => 'Terjadi kesalahan saat menyimpan, silahkan coba lagi.'));
        }
        
    }

    public function update(Request $request){
        $post = $request->all();
        //print_r($post); exit;
        $post['created_at'] = date('Y-m-d H:i:s');
        $post['updated_at'] = date('Y-m-d H:i:s');
        $validation = Validator::make($post, [
            'tanggal_perkuliahan' => 'required',
            'pembahasan' => 'required'
        ]);
        
        if ($validation->fails()) {
            return json_encode(['status'=> 'error', 'msg'=> $validation->messages()]);
        }
        DB::beginTransaction();
        try{
            $data = array(
                'tanggal_perkuliahan' => $post['tanggal_perkuliahan'],
                'pembahasan' => $post['pembahasan'],
                'updated_at' => date('Y-m-d H:i:s'),
            );
            AbsensiMahasiswaModel::where('id' ,$post['absensi'])->update($data);
            
            foreach($post['mahasiswa'] as $item){
                $detail = array(
                    'status_absensi' => $item['status_absensi'],
                    'catatan' => $item['catatan']
                );
                DB::table('absensi_mahasiswa_detail')->where('id' ,$item['id'])->update($detail);
            }
            $id = $post['absensi'];
            // GET DATA HEADER AND STORE TO CACHE
            $mahsiswa_cahce = DB::table('view_input_nilai_mahasiswa')
            ->join('absensi_mahasiswa' , 'absensi_mahasiswa.kelas_perkuliahan_detail_id' , '=' , 'view_input_nilai_mahasiswa.id')
            ->select('view_input_nilai_mahasiswa.*' , 'absensi_mahasiswa.id as absensi_id' , 'absensi_mahasiswa.pembahasan' , 'absensi_mahasiswa.tanggal_perkuliahan')
            ->where('absensi_mahasiswa.id' , $id)
            ->first();
            // GET DATA ABSENSE DETAIL AND STORE TO CACHE
            $mahsiswa_detail_cahce = DB::table('view_absensi_mahasiswa')
            ->where('absensi_id' , $id)
            ->get();
            Cache::forever('absensi_'.$id , $mahsiswa_cahce);
            Cache::forever('absensi_'.$id.'_detail' , $mahsiswa_detail_cahce);
            DB::commit();
            return json_encode(array('status' => 'success' , 'message' => 'Data berhasil disimpan.'));
        } catch(\Exception $e){
            
            DB::rollBack(); 
            throw $e;
            return json_encode(array('status' => 'error' , 'message' => 'Terjadi kesalahan saat menyimpan, silahkan coba lagi.'));
        }
        
    }

    public function edit($id){
        $title = "Tambah ".ucfirst(request()->segment(1))." ".ucfirst(request()->segment(2));
        
        $mahasiswa = $this->get_detail_absensi($id , 'absensi_'.$id.'_detail');

        $data = $this->cache_header_absensi($id, 'absensi_'.$id);

        if(!$data->kelas_perkuliahan_id){
            return 'Data Tidak Ditemukan.';
        }
        return view("data/absensi_update" , compact("title" , "mahasiswa", "data" ,"id"));
    }

    public function paging(Request $request){
        return Datatables::of(AbsensiMahasiswaModel::all())->make(true);
    }

}
        