<?php
namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\ JadwalUjianModel;
use Yajra\DataTables\DataTables;
use App\JurusanModel;
use App\AngkatanModel;
use App\KelasModel;
use App\SemesterModel;
use App\MahasiswaModel;
use Illuminate\Support\Facades\Cache;

class JadwalUjian extends Controller
{
    static $Tableshow = ["id" => ["table" => ["tablename" =>"null" , "field"=> "id"] , "record"=>"Id"],
        ];
    static $html = ["id"=>["type"=>"null" , "value"=>"null" , "validation" => ""] ,
];
    static $exclude = ["id","created_at","updated_at","created_by","update_by"];
    static $tablename = "JadwalUjian";
    public function index()
    {
        $master = array(
            'jurusan' => JurusanModel::where('row_status' , 'active')->get(),
            'angkatan' => AngkatanModel::where('row_status' , 'active')->get(),
            'kelas' => KelasModel::where('row_status' , 'active')->get(),
            'semester'=> SemesterModel::where('row_status', 'active')->get(),
        );
        //print_r($master); exit;
        //$data = DB::table('view_input_nilai_mahasiswa')->get();
        $title = ucfirst(request()->segment(1))." ".ucfirst(request()->segment(2));
        $tableid = "JadwalUjian";
        $table_display = DB::getSchemaBuilder()->getColumnListing(static::$tablename);
        $exclude = static::$exclude;
        $Tableshow = static::$Tableshow;
        return view("data/jadwal_ujian" , compact("title" ,"table_display" ,"exclude" ,"Tableshow","tableid", "master"));

    }
    public function create(){
        $title = "Tambah ".ucfirst(request()->segment(1))." ".ucfirst(request()->segment(2));
        $table = array_diff(DB::getSchemaBuilder()->getColumnListing("jadwal_ujian"), static::$exclude);
        $exclude = static::$exclude;
        $Tableshow = static::$Tableshow;
        $html = static::$html;
        $column = 1;
        return view("setting/master_create" , compact("table" ,"exclude" , "Tableshow" , "title" , "html", "column"));
    }

    public function save(Request $request){
        $post = $request->all();
        //print_r($post); exit;
        $absensi = $post['mahasiswa'];
        unset($post['mahasiswa']);
        $post['created_at'] = date('Y-m-d H:i:s');
        $post['updated_at'] = date('Y-m-d H:i:s');
        $validation = Validator::make($post, [
            'tanggal_ujian' => 'required',
            'jam' => 'required',
            'kelas_perkuliahan_detail_id' => 'required',
        ]);
        
        if ($validation->fails()) {
            return json_encode(['status'=> 'error', 'message'=> $validation->messages()]);
        }
        DB::beginTransaction();
        try{
            $idjadwalujian = JadwalUjianModel::updateOrInsert(array('kelas_perkuliahan_detail_id' => $post['kelas_perkuliahan_detail_id']) , $post);
            foreach($absensi as $key=> $item){
                //$item['jadwal_ujian_id'] = $idjadwalujian->id;
                $item['mahasiswa_id'] = $key;
                $item['kelas_perkuliahan_detail_id'] = $post['kelas_perkuliahan_detail_id'];
                $item['updated_at'] = date('Y-m-d H:i:s');
                $item['created_at'] = date('Y-m-d H:i:s');
                
                DB::table('jadwal_ujian_mahasiswa_detail')->updateOrInsert(array('kelas_perkuliahan_detail_id' => $post['kelas_perkuliahan_detail_id'] , 'mahasiswa_id' => $key) , $item);
            }
            DB::commit();

            $id = $post['kelas_perkuliahan_detail_id'];
            // GET DATA HEADER AND STORE TO CACHE
            $mahsiswa_cahce = DB::table('view_input_nilai_mahasiswa')
            ->join('jadwal_ujian_mahasiswa' , 'jadwal_ujian_mahasiswa.kelas_perkuliahan_detail_id' , '=' , 'view_input_nilai_mahasiswa.id')
            ->select('view_input_nilai_mahasiswa.*' , 'jadwal_ujian_mahasiswa.id as jadwal_id' , 'jadwal_ujian_mahasiswa.tanggal_ujian' , 'jadwal_ujian_mahasiswa.jam', 'jadwal_ujian_mahasiswa.catatan')
            ->where('jadwal_ujian_mahasiswa.kelas_perkuliahan_detail_id' , $post['kelas_perkuliahan_detail_id'])
            ->first();
            // GET DATA ABSENSE DETAIL AND STORE TO CACHE
            $mahsiswa_detail_cahce = DB::table('view_jadwal_ujian_mahasiswa')
            ->where('kelas_perkuliahan_detail_id' , $post['kelas_perkuliahan_detail_id'])
            ->get();
            Cache::forever('jadwal_ujian_'.$id , $mahsiswa_cahce);
            Cache::forever('jadwal_ujian_'.$id.'_detail' , $mahsiswa_detail_cahce);

            //print_r(Cache::get('jadwal_ujian_'.$id));
            return json_encode(array('status' => 'success' , 'message' => 'Data berhasil disimpan.'));
        } catch(\Exception $e){
            
            DB::rollBack(); 
            throw $e;
            return json_encode(array('status' => 'error' , 'message' => 'Terjadi kesalahan saat menyimpan, silahkan coba lagi.'));
        }
    }

    public function edit(Request $request){

    }

    public function paging(Request $request){
        //print_r($request->all()); exit;
        $post= $request->all();
        $where = [];
        foreach($post['filter'] as $key=>$val){
            if($val){
                $where[$key] = $val;
            }
        }
        if(count($where) > 0){
            return Datatables::of(DB::table('view_input_nilai_mahasiswa')->where($where)->get())->make(true);
        }
        return Datatables::of(DB::table('view_input_nilai_mahasiswa')->get())->make(true);

    }

    public function header_cache($id){

        if (Cache::has('jadwal_ujian_'.$id)){
           return   Cache::get('jadwal_ujian_'.$id);
        }else{
            //DB::table('view_input_nilai_mahasiswa')->where('id' , $id)->first();
            $mahsiswa_cahce = DB::table('view_input_nilai_mahasiswa')
            ->leftjoin('jadwal_ujian_mahasiswa' , 'jadwal_ujian_mahasiswa.kelas_perkuliahan_detail_id' , '=' , 'view_input_nilai_mahasiswa.id')
            ->select('view_input_nilai_mahasiswa.*' , 'jadwal_ujian_mahasiswa.id as jadwal_id' , 'jadwal_ujian_mahasiswa.tanggal_ujian' , 'jadwal_ujian_mahasiswa.jam', 'jadwal_ujian_mahasiswa.catatan')
            ->where('view_input_nilai_mahasiswa.id' , $id)
            ->first();
            Cache::forever('jadwal_ujian_'.$id , $mahsiswa_cahce);
            return  Cache::get('jadwal_ujian_'.$id);
        }
    }

    public function detail_cache($id){
        if (Cache::has('jadwal_ujian_'.$id.'_detail')){
            return  Cache::get('jadwal_ujian_'.$id.'_detail');
        }else{
            $mahsiswa_detail_cahce = DB::table('view_jadwal_ujian_mahasiswa')
            ->where('kelas_perkuliahan_detail_id' , $id)
            ->get();
            Cache::forever('jadwal_ujian_'.$id.'_detail' , $mahsiswa_detail_cahce);
            return  Cache::get('jadwal_ujian_'.$id.'_detail');
        } 
    }


    public function form($id){
        //Cache::flush();
        $title = "Tambah ".ucfirst(request()->segment(1))." ".ucfirst(request()->segment(2));
        $data = $this->header_cache($id);//DB::table('view_input_nilai_mahasiswa')->where('id' , $id)->first();
        //print_r($data);
        if(!$data){
            echo 'Data Tidak Ditemukan.';
            die;
        }
        $mahasiswa = $this->detail_cache($id);
       // echo count($mahasiswa);
        if (count($mahasiswa) < 1){
            if(DB::table('jadwal_ujian_mahasiswa_detail')
            ->where('kelas_perkuliahan_detail_id' , $id)->exists())
            {
                $mahasiswa = DB::table('jadwal_ujian_mahasiswa')
                ->leftjoin('mahasiswa' , 'mahasiswa.id' , '=' ,'jadwal_ujian_mahasiswa.mahasiswa_id')
                ->where('jadwal_ujian_mahasiswa.kelas_perkuliahan_detail_id' , $id)->get();
                
            }else{
                $mahasiswa = MahasiswaModel::where('kelas_id' , $data->kelas_id)->where('status' , '1')->get();
            }
        }

        //print_r($mahasiswa); exit;

        return view("data/ujian_create" , compact("title" , "mahasiswa", "data"));

    }

}
        