<?php
namespace App\Http\Controllers;
use App\JadwalUjianDetailModel;
use App\KelasPerkuliahanModel;
use Illuminate\Support\Facades\Auth;
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
use App\DosenModel;
use App\RuanganModel;
use Illuminate\Support\Facades\Redirect;

class JadwalUjian extends Controller
{
    static $Tableshow = ["id" => ["table" => ["tablename" =>"null" , "field"=> "id"] , "record"=>"Id"],
        ];
    static $html = ["id"=>["type"=>"null" , "value"=>"null" , "validation" => ""] ,
];
    static $exclude = ["id","created_at","updated_at","created_by","update_by"];
    static $tablename = "JadwalUjian";

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
        $master = array(
            'jurusan' => JurusanModel::where('row_status' , 'active')->get(),
            'angkatan' => MahasiswaModel::where('mahasiswa.row_status' , 'active')
                ->join('master_semester','master_semester.id', '=', 'mahasiswa.id_periode_masuk')
                ->select('master_semester.id_tahun_ajaran')
                ->distinct()
                ->orderBy('id_tahun_ajaran','desc')
                ->get(),
            'kelas' => KelasModel::where('row_status' , 'active')->get(),
            'semester'=> SemesterModel::where('row_status', 'active')
                ->orderBy('id', 'desc')
                ->get(),
        );

        $title = ucfirst(request()->segment(1))." ".ucfirst(request()->segment(2));
        $tableid = "JadwalUjian";
        $table_display = DB::getSchemaBuilder()->getColumnListing(static::$tablename);
        $exclude = static::$exclude;
        $Tableshow = static::$Tableshow;
        return view("data/daftar_jadwal_ujian" , compact("title" ,"table_display" ,"exclude" ,"Tableshow","tableid", "master"));

    }

    public function daftar()
    {
        $master = array(
            'jurusan' => JurusanModel::where('row_status' , 'active')->get(),
            'angkatan' => MahasiswaModel::where('mahasiswa.row_status' , 'active')
                ->join('master_semester','master_semester.id', '=', 'mahasiswa.id_periode_masuk')
                ->select('master_semester.id_tahun_ajaran')
                ->distinct()
                ->orderBy('id_tahun_ajaran','desc')
                ->get(),
            'kelas' => KelasModel::where('row_status' , 'active')->get(),
            'semester'=> SemesterModel::where('row_status', 'active')
                ->orderBy('id', 'desc')
                ->get(),
        );

        $title = ucfirst(request()->segment(1))." ".ucfirst(request()->segment(2));
        $tableid = "JadwalUjian";
        $table_display = DB::getSchemaBuilder()->getColumnListing(static::$tablename);
        $exclude = static::$exclude;
        $Tableshow = static::$Tableshow;
        return view("data/daftar_jadwal_ujian" , compact("title" ,"table_display" ,"exclude" ,"Tableshow","tableid", "master"));

    }

    public function create(){
        $master = array(
            'jurusan' => JurusanModel::where('row_status' , 'active')->get(),
            'angkatan' => MahasiswaModel::where('mahasiswa.row_status' , 'active')
                ->join('master_semester','master_semester.id', '=', 'mahasiswa.id_periode_masuk')
                ->select('master_semester.id_tahun_ajaran')
                ->distinct()
                ->orderBy('id_tahun_ajaran','desc')
                ->get(),
            'kelas' => KelasModel::where('row_status' , 'active')->get(),
            'semester'=> SemesterModel::where('row_status', 'active')
                ->orderBy('id', 'desc')
                ->get(),
        );

        $title = ucfirst(request()->segment(1))." ".ucfirst(request()->segment(2));
        $tableid = "JadwalUjian";
        $table_display = DB::getSchemaBuilder()->getColumnListing(static::$tablename);
        $exclude = static::$exclude;
        $Tableshow = static::$Tableshow;
        return view("data/jadwal_ujian" , compact("title" ,"table_display" ,"exclude" ,"Tableshow","tableid", "master"));
    }

    public function kelas($jenis){
        $master = array(
            'jurusan' => JurusanModel::where('row_status' , 'active')->get(),
            'angkatan' => MahasiswaModel::where('mahasiswa.row_status' , 'active')
                ->join('master_semester','master_semester.id', '=', 'mahasiswa.id_periode_masuk')
                ->select('master_semester.id_tahun_ajaran')
                ->distinct()
                ->orderBy('id_tahun_ajaran','desc')
                ->get(),
            'kelas' => KelasModel::where('row_status' , 'active')->get(),
            'semester'=> SemesterModel::where('row_status', 'active')
                ->orderBy('id', 'desc')
                ->get(),
        );

        $jenis = strtolower($jenis);
        $title = ucfirst(request()->segment(1))." ".ucfirst(request()->segment(2));
        $tableid = "JadwalUjian";
        $table_display = DB::getSchemaBuilder()->getColumnListing(static::$tablename);
        $exclude = static::$exclude;
        $Tableshow = static::$Tableshow;
        return view("data/jadwal_ujian" , compact("title" ,"table_display" ,"exclude" ,"Tableshow","tableid", "master","jenis"));
    }

    public function save(Request $request){
        $post = $request->all();

        $absensi = $post['mahasiswa'];
        unset($post['mahasiswa']);
        $post['created_at'] = date('Y-m-d H:i:s');
        $post['updated_at'] = date('Y-m-d H:i:s');
        $validation = Validator::make($post, [
            'tanggal_ujian' => 'required',
            'jam' => 'required',
            'selesai' => 'required',
            'jenis_ujian' => 'required',
            'kelas_perkuliahan_detail_id' => 'required',
        ]);
        
        if ($validation->fails()) {
            return json_encode(['status'=> 'error', 'message'=> $validation->messages()]);
        }
        DB::beginTransaction();
        try{
            $idjadwalujian = JadwalUjianModel::firstOrCreate($post);
            foreach($absensi as $key=> $item){
                $item['jadwal_ujian_id'] = $idjadwalujian->id;
                $item['mahasiswa_id'] = $key;
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

    public function update(Request $request){
        $post = $request->all();

        $absensi = $post['mahasiswa'];
        unset($post['mahasiswa']);
        $post['created_at'] = date('Y-m-d H:i:s');
        $post['updated_at'] = date('Y-m-d H:i:s');
        $validation = Validator::make($post, [
            'tanggal_ujian' => 'required',
            'jam' => 'required',
            'selesai' => 'required',
            'jenis_ujian' => 'required'
        ]);

        if ($validation->fails()) {
            return json_encode(['status'=> 'error', 'message'=> $validation->messages()]);
        }

        DB::beginTransaction();
        try{
            $jadwalPerkuliahan = JadwalUjianModel::where("id", $post['id'])->first();
            $jadwalPerkuliahan->tanggal_ujian = $post['tanggal_ujian'];
            $jadwalPerkuliahan->jam = $post['jam'];
            $jadwalPerkuliahan->selesai = $post['selesai'];
            $jadwalPerkuliahan->catatan = $post['catatan'];
            $jadwalPerkuliahan->updated_at = date('Y-m-d H:i:s');
            $jadwalPerkuliahan->modified_by = Auth::user()->nama;

            if($jadwalPerkuliahan->save()){
                foreach($absensi as $key=> $item){
                    $jadwalPerkuliahanDetail = JadwalUjianDetailModel::where("id", $item['id'])->first();
                    $jadwalPerkuliahanDetail->ruangan = $item['ruangan'];
                    $jadwalPerkuliahanDetail->pengawas_id = $item['pengawas_id'];
                    $jadwalPerkuliahanDetail->updated_at =  date('Y-m-d H:i:s');
                    $jadwalPerkuliahanDetail->update_by = Auth::user()->nama;

                    $jadwalPerkuliahanDetail->save();
                }
            }else{
                return json_encode(array('status' => 'false' , 'message' => 'Data gagal disimpan.'));
            }

            DB::commit();

            return json_encode(array('status' => 'success' , 'message' => 'Data berhasil disimpan.'));
        } catch(\Exception $e){

            DB::rollBack();
            throw $e;
            return json_encode(array('status' => 'error' , 'message' => 'Terjadi kesalahan saat menyimpan, silahkan coba lagi.'));
        }
    }

    public function delete(Request $request){
        $post = $request->all();

        DB::beginTransaction();
        try{
            $jadwalPerkuliahan = JadwalUjianModel::where("id", $post['id'])->first();

            if($jadwalPerkuliahan->delete()){
                JadwalUjianDetailModel::where('jadwal_ujian_id', '=',  $post['id'])->delete();
            }else{
                return json_encode(array('status' => 'false' , 'message' => 'Data gagal disimpan.'));
            }

            DB::commit();

            return json_encode(array('status' => 'success' , 'message' => 'Data berhasil disimpan.'));
        } catch(\Exception $e){

            DB::rollBack();
            throw $e;
            return json_encode(array('status' => 'false' , 'message' => 'Terjadi kesalahan saat menyimpan, silahkan coba lagi.'));
        }
    }

    public function paging(Request $request){
        $post= $request->all();

        return DataTables::of(KelasPerkuliahanModel::where('kelas_perkuliahan.row_status','=','active')
            ->join('kelas_perkuliahan_mata_kuliah','kelas_perkuliahan_mata_kuliah.kelas_perkuliahan_id','=','kelas_perkuliahan.id')
            ->join('mata_kuliah','mata_kuliah.id','=','kelas_perkuliahan_mata_kuliah.mata_kuliah_id')
            ->join('master_jurusan','master_jurusan.id','=','kelas_perkuliahan.program_studi_id')
            ->join('master_kelas','master_kelas.id','=','kelas_perkuliahan.kelas_id')
           // ->join('master_angkatan','master_angkatan.id','=','kelas_perkuliahan.angkatan_id')
            ->join('dosen','dosen.id','=','kelas_perkuliahan_mata_kuliah.dosen_id')
            ->leftJoin('jadwal_ujian_mahasiswa','jadwal_ujian_mahasiswa.kelas_perkuliahan_detail_id', '=', 'kelas_perkuliahan_mata_kuliah.id')
            ->select('kelas_perkuliahan_mata_kuliah.id', 'mata_kuliah.kode_mata_kuliah','mata_kuliah.nama_mata_kuliah','dosen.nama as nama_dosen','master_jurusan.title as nama_jurusan','kelas_perkuliahan.angkatan_id as nama_angkatan','master_kelas.title as nama_kelas', 'jadwal_ujian_mahasiswa.jenis_ujian')
            ->whereNull('jadwal_ujian_mahasiswa.jenis_ujian')
            ->orWhere('jadwal_ujian_mahasiswa.jenis_ujian','!=', strtolower($post['jenis_ujian_jadwal']))
            ->get())->addIndexColumn()->make(true);
    }

    public function paging_daftar(Request $request){
        return Datatables::of(JadwalUjianModel::where('jadwal_ujian_mahasiswa.row_status', '=', 'active')
            ->join('kelas_perkuliahan_mata_kuliah', 'kelas_perkuliahan_mata_kuliah.id','=', 'jadwal_ujian_mahasiswa.kelas_perkuliahan_detail_id')
            ->join('kelas_perkuliahan', 'kelas_perkuliahan.id','=', 'kelas_perkuliahan_mata_kuliah.kelas_perkuliahan_id')
            ->join('master_jurusan', 'master_jurusan.id','=', 'kelas_perkuliahan.program_studi_id')
            ->join('mata_kuliah', 'mata_kuliah.id', '=', 'kelas_perkuliahan_mata_kuliah.mata_kuliah_id')
            ->join('dosen', 'dosen.id', 'kelas_perkuliahan_mata_kuliah.dosen_id')
            //->join('master_angkatan', 'master_angkatan.id','=', 'kelas_perkuliahan.angkatan_id')
            ->join('master_semester', 'master_semester.id', '=','kelas_perkuliahan.semester_id')
            ->join('master_kelas', 'master_kelas.id', '=', 'kelas_perkuliahan.kelas_id')
            ->select('jadwal_ujian_mahasiswa.id','mata_kuliah.kode_mata_kuliah', 'mata_kuliah.nama_mata_kuliah', 'dosen.nama as nama_dosen', 'master_jurusan.title as program_studi','kelas_perkuliahan.angkatan_id as nama_angkatan','master_semester.title as nama_semester', 'master_kelas.title as nama_kelas', 'jadwal_ujian_mahasiswa.jenis_ujian')
            ->orderBy('jadwal_ujian_mahasiswa.id', 'desc')
            ->get())->addIndexColumn()->make(true);

    }

    public function header_cache($id){

        if (Cache::has('jadwal_ujian_'.$id)){
           return   Cache::get('jadwal_ujian_'.$id);
        }else{
            //DB::table('view_input_nilai_mahasiswa')->where('id' , $id)->first();
            $mahsiswa_cahce = DB::table('view_input_nilai_mahasiswa')
            ->leftjoin('jadwal_ujian_mahasiswa' , 'jadwal_ujian_mahasiswa.kelas_perkuliahan_detail_id' , '=' , 'view_input_nilai_mahasiswa.id')
            ->leftJoin('dosen' ,'dosen.id' ,'=' ,'jadwal_ujian_mahasiswa.pengawas_id')
            ->select('view_input_nilai_mahasiswa.*' , 'jadwal_ujian_mahasiswa.id as jadwal_id' , 'jadwal_ujian_mahasiswa.tanggal_ujian' , 'jadwal_ujian_mahasiswa.jam' , 'jadwal_ujian_mahasiswa.selesai', 'jadwal_ujian_mahasiswa.catatan', 'jadwal_ujian_mahasiswa.pengawas_id', 'dosen.id as dosen_id','dosen.nama as nama_pengawas')
            ->where('kelas_perkuliahan_detail_id.id' , $id)
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

    public function form($id, $jenis){
        Cache::flush();
        $title = "Tambah ".ucfirst(request()->segment(1))." ".ucfirst(request()->segment(2));
        $jenis_ujian = $jenis;
        $eligible = true;

        $data = KelasPerkuliahanModel::where('kelas_perkuliahan.row_status','=','active')
            ->where('kelas_perkuliahan_mata_kuliah.id','=', $id)
            ->join('kelas_perkuliahan_mata_kuliah','kelas_perkuliahan_mata_kuliah.kelas_perkuliahan_id','=','kelas_perkuliahan.id')
            ->join('mata_kuliah','mata_kuliah.id','=','kelas_perkuliahan_mata_kuliah.mata_kuliah_id')
            ->join('master_jurusan','master_jurusan.id','=','kelas_perkuliahan.program_studi_id')
            ->join('master_kelas','master_kelas.id','=','kelas_perkuliahan.kelas_id')
            ->join('master_semester', 'master_semester.id', '=', 'kelas_perkuliahan.semester_id')
            ->join('dosen','dosen.id','=','kelas_perkuliahan_mata_kuliah.dosen_id')
            ->join('master_ruangan','master_ruangan.id','=','kelas_perkuliahan_mata_kuliah.ruangan')
            ->select('kelas_perkuliahan_mata_kuliah.id',
                'mata_kuliah.kode_mata_kuliah',
                'mata_kuliah.nama_mata_kuliah',
                'mata_kuliah.sks_mata_kuliah as sks',
                'dosen.nama as nama_dosen',
                'master_jurusan.title as nama_jurusan',
                'kelas_perkuliahan.angkatan_id as nama_angkatan',
                'master_kelas.title as nama_kelas',
                'master_ruangan.nama_ruangan as ruangan',
                'kelas_perkuliahan.kelas_id',
                'master_semester.title as nama_semester')
            ->first();

        $datajadwal = JadwalUjianModel::where('kelas_perkuliahan_detail_id',$id)
            ->where('jenis_ujian', '=', strtolower($jenis))
            ->get();

        if(count($datajadwal) > 1){
            $eligible = false;
        }

        if(!$data){
            echo 'Data Tidak Ditemukan.';
            die;
        }

        $master = [];
        $master['dosen'] = DosenModel::select('id' , 'nidn_nup_nidk', 'nama')->where('row_status' , 'active')->get();
        $master['ruangan'] = RuanganModel::select('id' , 'kode_ruangan' , 'nama_ruangan')->where('row_status' , 'active')->get();
        $mahasiswa = MahasiswaModel::where('kelas_id' , $data->kelas_id)->where('nama_status_mahasiswa' , 'AKTIF')->get();

        return view("data/ujian_create" , compact("title" , "mahasiswa", "data" ,"master","jenis_ujian", 'eligible'));
    }

    public function view($id){
        $title = "Ubah ".ucfirst(request()->segment(1))." ".ucfirst(request()->segment(2));

        $dataheader = JadwalUjianModel::where('id',$id)
            ->select('id',
                'jadwal_ujian_mahasiswa.jenis_ujian',
                'jadwal_ujian_mahasiswa.tanggal_ujian',
                'jadwal_ujian_mahasiswa.jam',
                'jadwal_ujian_mahasiswa.kelas_perkuliahan_detail_id',
                'jadwal_ujian_mahasiswa.selesai',
                'jadwal_ujian_mahasiswa.catatan')->first();

        $data = KelasPerkuliahanModel::where('kelas_perkuliahan.row_status','=','active')
            ->where('kelas_perkuliahan_mata_kuliah.id','=', $dataheader->kelas_perkuliahan_detail_id)
            ->join('kelas_perkuliahan_mata_kuliah','kelas_perkuliahan_mata_kuliah.kelas_perkuliahan_id','=','kelas_perkuliahan.id')
            ->join('mata_kuliah','mata_kuliah.id','=','kelas_perkuliahan_mata_kuliah.mata_kuliah_id')
            ->join('master_jurusan','master_jurusan.id','=','kelas_perkuliahan.program_studi_id')
            ->join('master_kelas','master_kelas.id','=','kelas_perkuliahan.kelas_id')
            ->join('master_semester', 'master_semester.id', '=', 'kelas_perkuliahan.semester_id')
            ->join('dosen','dosen.id','=','kelas_perkuliahan_mata_kuliah.dosen_id')
            ->leftJoin('master_ruangan', 'master_ruangan.id', '=', 'kelas_perkuliahan_mata_kuliah.ruangan')
            ->select('kelas_perkuliahan_mata_kuliah.id',
                'mata_kuliah.kode_mata_kuliah',
                'mata_kuliah.nama_mata_kuliah',
                'mata_kuliah.sks_mata_kuliah as sks',
                'dosen.nama as nama_dosen',
                'master_jurusan.title as nama_jurusan',
                'kelas_perkuliahan.angkatan_id as nama_angkatan',
                'master_kelas.title as nama_kelas',
                'master_ruangan.nama_ruangan as ruangan',
                'kelas_perkuliahan.kelas_id',
                'master_semester.title as nama_semester')
            ->first();

        $detail = JadwalUjianModel::where('jadwal_ujian_mahasiswa.id',$id)
            ->join('jadwal_ujian_mahasiswa_detail','jadwal_ujian_mahasiswa_detail.jadwal_ujian_id', 'jadwal_ujian_mahasiswa.id')
            ->join('mahasiswa','mahasiswa.id', 'jadwal_ujian_mahasiswa_detail.mahasiswa_id' )
            ->select('jadwal_ujian_mahasiswa_detail.id',
                'mahasiswa.nim',
                'mahasiswa.nama',
                'mahasiswa.jk',
                'jadwal_ujian_mahasiswa_detail.pengawas_id',
                'jadwal_ujian_mahasiswa_detail.ruangan',
                'jadwal_ujian_mahasiswa_detail.catatan')
            ->get();

        $master = [];
        $master['dosen'] = DosenModel::select('id' , 'nama')->where('row_status' , 'active')->get();
        $master['ruangan'] = RuanganModel::select('id' , 'kode_ruangan' , 'nama_ruangan')->where('row_status' , 'active')->get();
        //$mahasiswa = MahasiswaModel::where('kelas_id' , $data->kelas_id)->where('status' , '1')->get();

        return view("data/ujian_edit" , compact("title" , "data" ,"master", "dataheader", "detail"));
    }

}
        