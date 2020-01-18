<?php
namespace App\Http\Controllers;
use App\AngkatanModel;
use App\DosenModel;
use App\JurusanModel;
use App\KelasModel;
use App\KelasPerkuliahanModel;
use App\MahasiswaModel;
use App\SoalUjianModel;
use App\StatusMahasiswaModel;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\ SemesterModel;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\Redirect;

class DosenUploadUjian extends Controller
{
    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            $this->user = Auth::user();
            if(!$this->user){
                Redirect::to('login')->send();
            }
            if(Cache::get('underconstuctormode') == '1'){
                return abort(404);
            }
            if($this->user->login_type != 'dosen'){
                return abort(404);
            }else{
                return $next($request);
            }
        });
        
    }
    
    public function index()
    {
        $nik = Auth::user()->id;
        $data = DosenModel::where('dosen.nidn_nup_nidk' , $nik)->first();
        $master = array(
            'status' => StatusMahasiswaModel::where('row_status' , 'active')->get(),
            'jurusan' => JurusanModel::where('row_status' , 'active')->get(),
            'angkatan' => MahasiswaModel::where('mahasiswa.row_status' , 'active')
                ->join('master_semester','master_semester.id', '=', 'mahasiswa.id_periode_masuk')
                ->select('master_semester.id_tahun_ajaran')
                ->distinct()
                ->orderBy('id_tahun_ajaran','desc')
                ->get(),
            'kelas' => KelasModel::where('row_status' , 'active')->get(),
            'dosen' => DosenModel::where('row_status', 'active'),
            'semester'=> SemesterModel::where('row_status', 'active')
                ->orderBy('id', 'desc')
                ->get(),
        );

        return view("dosen/upload_soal", compact('master', 'data'));
    }

    public function create(){
        $nik = Auth::user()->id;
        $data = DosenModel::where('dosen.nidn_nup_nidk' , $nik)->first();
        $title = "Tambah Soal Ujian";
        $master = array(
            'status' => StatusMahasiswaModel::where('row_status' , 'active')->get(),
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
            'matakuliah' => KelasPerkuliahanModel::where('kelas_perkuliahan.row_status', 'active')
                ->where('kelas_perkuliahan_mata_kuliah.dosen_id', '=', $data['id'])
                ->join('kelas_perkuliahan_mata_kuliah', 'kelas_perkuliahan_mata_kuliah.kelas_perkuliahan_id','kelas_perkuliahan.id')
                ->join('mata_kuliah', 'mata_kuliah.id','kelas_perkuliahan_mata_kuliah.mata_kuliah_id')
                ->select('mata_kuliah.id', 'mata_kuliah.kode_mata_kuliah as kode','mata_kuliah.nama_mata_kuliah as nama')->get()
        );

        return view("dosen/upload_soal_create" , compact( "title", "master", 'data'));
    }

    public function save(Request $request){
        $input = $request->all();
        if($request->file_upload){
            $input['nama_file'] = $request->file_upload->getClientOriginalName();
        }

        $validation = Validator::make($input, [
            'jenis_ujian'=>'required',
            'mata_kuliah_id' => 'required',
            'jurusan_id' => 'required',
            'angkatan_id' => 'required',
            'kelas_id' => 'required',
            'semester_id' => 'required',
            'dosen_id' => 'required',
            'nama_file' => 'required|max:2048',
            'nama_file.*' => 'mimes:.pdf,xls,xlsx,doc'
        ]);

        if ($validation->fails()) {
            return json_encode(["status"=> "false", "message"=> $validation->messages()]);
        }

        $exist = SoalUjianModel::where("jenis_ujian", $request->jenis_ujian)
            ->where('mata_kuliah_id',$input['mata_kuliah_id'])
            ->where('jurusan_id',$input['jurusan_id'])
            ->where('angkatan_id',$input['angkatan_id'])
            ->where('kelas_id',$input['kelas_id'])
            ->where('semester_id',$input['semester_id'])
            ->where('dosen_id',$input['dosen_id'])
            ->where('row_status','active')
            ->first();

        if ($exist) {
            return json_encode(["status"=> "false", "message"=> array(["Soal sudah pernah di upload"])]);
        }

        $input['created_at'] = date('Y-m-d H:m:s');
        $input['created_by'] = Auth::user()->nama;

        try{
            $save = SoalUjianModel::create($input);
            if($save){
                $image = $request->file('file_upload');
                $image->move(public_path('assets/images/soalujian/'.$save->id), $save->nama_file);
                return json_encode(['status'=> 'success', 'msg'=> 'Data berhasil ditambahkan']);
            }else{
                return json_encode(['status'=> 'false', 'msg'=> 'Terjadi kesalahan saat menyimpan data.']);
            }
        }catch(\Exception $e){

            DB::rollBack();
            //throw $e;
            return json_encode(array('status' => 'false' , 'msg' => 'Terjadi kesalahan saat menyimpan, silahkan coba lagi.'));
        }
    }

    public function edit($id){
        $nik = Auth::user()->id;
        $data = SoalUjianModel::where('id' , $id)->first();
        $title = "Tambah Soal Ujian";
        $master = array(
            'status' => StatusMahasiswaModel::where('row_status' , 'active')->get(),
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
            'matakuliah' => KelasPerkuliahanModel::where('kelas_perkuliahan.row_status', 'active')
                ->where('kelas_perkuliahan_mata_kuliah.dosen_id', '=', $data['dosen_id'])
                ->join('kelas_perkuliahan_mata_kuliah', 'kelas_perkuliahan_mata_kuliah.kelas_perkuliahan_id','kelas_perkuliahan.id')
                ->join('mata_kuliah', 'mata_kuliah.id','kelas_perkuliahan_mata_kuliah.mata_kuliah_id')
                ->select('mata_kuliah.id', 'mata_kuliah.kode_mata_kuliah as kode','mata_kuliah.nama_mata_kuliah as nama')->get()
        );

        return view("dosen/upload_soal_edit" , compact( "title", "master", 'data'));
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
        $input = $request->all();
        if($request->file_upload){
            $input['nama_file'] = $request->file_upload->getClientOriginalName();
        }

        $validation = Validator::make($input, [
            'nama_file' => 'required|max:2048',
            'nama_file.*' => 'mimes:.pdf,xls,xlsx,doc'
        ]);

        if ($validation->fails()) {
            return json_encode(["status"=> "false", "message"=> $validation->messages()]);
        }

        $data =  SoalUjianModel::where('id' , $request->id)->first();
        $data->updated_at = date('Y-m-d H:m:s');
        $data->updated_by = Auth::user()->nama;
        $data->nama_file = $input['nama_file'];

        if($data->save()){
            $image = $request->file('file_upload');
            $image->move(public_path('assets/images/soalujian/'.$data->id), $data->nama_file);
            return $this->success("Data berhasil disimpan.");
        }else{
            return json_encode(["status"=> "false", "msg"=> "Mohon maaf, terjadi kesalahan sistem"]);
        }
    }

    public function delete(Request $request){
        $data =  SoalUjianModel::where('id', $request->id)->first();
        $data->row_status = 'deleted';

        if($data->save()){
            return $this->success("Data berhasil disimpan.");
        }else{
            return json_encode(["status"=> "false", "msg"=> "Mohon maaf, terjadi kesalahan sistem"]);
        }
    }
    
    public function paging(Request $request){
        return Datatables::of(SoalUjianModel::where('soal_ujian.row_status', '!=', 'deleted')
            ->join('mata_kuliah', 'mata_kuliah.id', 'soal_ujian.mata_kuliah_id')
            ->join('master_jurusan', 'master_jurusan.id', 'soal_ujian.jurusan_id')
            ->join('master_semester', 'master_semester.id', 'soal_ujian.semester_id')
            ->join('master_kelas', 'master_kelas.id', 'soal_ujian.kelas_id')
            ->select('soal_ujian.id','soal_ujian.jenis_ujian', 'soal_ujian.nama_file', 'mata_kuliah.kode_mata_kuliah','master_jurusan.title as jurusan','master_semester.id_tahun_ajaran as angkatan','mata_kuliah.nama_mata_kuliah', 'master_semester.title as semester', 'master_kelas.title as kelas')
            ->orderBy('soal_ujian.id', 'desc')
            ->get())->addIndexColumn()->make(true);
    }

}
        