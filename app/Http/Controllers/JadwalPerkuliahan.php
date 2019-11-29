<?php
namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\ JadwalPerkuliahanModel;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\Auth;
use App\MahasiswaModel;
use App\SemesterModel;
use App\KurikulumModel;

class JadwalPerkuliahan extends Controller
{
    static $Tableshow = ["id" => ["table" => ["tablename" =>"Master_Jenis_Tinggal" , "field"=> "id"] , "record"=>"Id"],
        ];
    static $html = ["id"=>["type"=>"null" , "value"=>"null" , "validation" => ""] ,
];
    static $exclude = ["id","created_at","updated_at","created_by","update_by"];
    static $tablename = "JadwalPerkuliahan";


    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            $this->user= Auth::user();
            //print_r($this->user->login_type);
            if($this->user->login_type != 'mahasiswa'){
                return abort(404);
            }else{
                return $next($request);
            }
        });
        
    }

    public function index()
    {
        //$mahasiswa_id = Auth::user()->id;
        $semester_active = SemesterModel::where('status_semester' ,'enable')->first();
        $mahasiswa = MahasiswaModel::where('nim' , Auth::user()->id)->first();
        $data = JadwalPerkuliahanModel::where('kelas_id' , $mahasiswa->kelas_id)
        ->where('semester_id' , $semester_active->id)
        ->get();
        $select2 = JadwalPerkuliahanModel::select('semester_id' ,'semseter_title')
        ->where('kelas_id' , $mahasiswa->kelas_id)
        //->where('mahasiswa_id' , $semester_active->id)
        ->groupBy('semester_id')
        ->orderBy('semester_id' ,'ASC')
        ->get();
        $title = ucfirst(request()->segment(1))." ".ucfirst(request()->segment(2));
        $semester = SemesterModel::where('status_semester','=', 'enable')->first();

        return view("mahasiswa/JadwalPerkuliahan" , compact("data" , "title" ,"mahasiswa" ,'select2', 'semester'));

    }
    public function create(){
        $title = "Tambah ".ucfirst(request()->segment(1))." ".ucfirst(request()->segment(2));
        $table = array_diff(DB::getSchemaBuilder()->getColumnListing("mahasiswa_jadwal_perkuliahan"), static::$exclude);
        $exclude = static::$exclude;
        $Tableshow = static::$Tableshow;
        $html = static::$html;
        $column = 1;
        return view("setting/master_create" , compact("table" ,"exclude" , "Tableshow" , "title" , "html", "column"));

    }

    public function save(Request $request){
        $input = $request->all();
        $field = [];
        $data = [];
        $table = DB::getSchemaBuilder()->getColumnListing("mahasiswa_jadwal_perkuliahan");
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
        $save  = JadwalPerkuliahanModel::firstOrCreate($data);
        if($save){
            return $this->success("Data berhasil disimpan.");
        }
    }

    public function edit(Request $request){

    }

    public function paging(Request $request){
        $semester_ids = $request->all();
        
        $semester_active = SemesterModel::where('status_semester' ,'enable')->first();
        $mahasiswa = MahasiswaModel::where('nim' , Auth::user()->id)->first();
        if($semester_ids['jadwal_perkuliahan'] != ''){
            $semester_id = $semester_ids['jadwal_perkuliahan'];
        }else{
            $semester_id = $semester_active->id;
        }
        return Datatables::of(JadwalPerkuliahanModel::where('kelas_id' , $mahasiswa->kelas_id)
        ->where('semester_id' , $semester_id))->make(true);
    }

    public function krs()
    {
        //$mahasiswa_id = Auth::user()->id;
        $semester_active = SemesterModel::where('status_semester' ,'enable')->first();
        $mahasiswa = MahasiswaModel::where('nim' , Auth::user()->id)->first();
        $data = JadwalPerkuliahanModel::where('kelas_id' , $mahasiswa->kelas_id)
        ->where('semester_id' , $semester_active->id)
        ->get();
        $select2 = JadwalPerkuliahanModel::select('semester_id' ,'semseter_title')
        ->where('kelas_id' , $mahasiswa->kelas_id)
        //->where('mahasiswa_id' , $semester_active->id)
        ->groupBy('semester_id')
        ->orderBy('semester_id' ,'ASC')
        ->get();
        $title = ucfirst(request()->segment(1))." ".ucfirst(request()->segment(2));
        return view("mahasiswa/krs" , compact("data" , "title" ,"mahasiswa" ,'select2'));

    }

    public function khs()
    {
        $semester_aktif = SemesterModel::where('status_semester' , 'enable')->first();
        $master = SemesterModel::where('row_status' ,'active')->get();
        $kurikulum = MahasiswaModel::join('master_kelas' ,'master_kelas.id' ,'mahasiswa.kelas_id')
        ->select('master_kelas.*','mahasiswa.nama','mahasiswa.id')
        ->where('nim' , Auth::user()->id)->first();
        $id = $kurikulum->id;
        $mahasiswa = DB::table('view_profile_mahasiswa')->where('id' , $id)->first();
        $data = KurikulumModel::rightJoin('kurikulum_mata_kuliah' ,'kurikulum_mata_kuliah.kurikulum_id','=' ,'kurikulum.id')
        ->join('mata_kuliah' ,'mata_kuliah.id' , '=' ,'kurikulum_mata_kuliah.mata_kuliah_id')
        ->leftJoin('nilai_mahasiswa', function ($join) use($id) {
            $join->on('nilai_mahasiswa.mata_kuliah_id' ,'=','kurikulum_mata_kuliah.mata_kuliah_id')
            ->Where('nilai_mahasiswa.mahasiswa_id' , '=' , $id);
        })
        ->select('kurikulum_mata_kuliah.*' , 'kurikulum.nama_kurikulum' , 'mata_kuliah.nama_mata_kuliah', 'mata_kuliah.kode_mata_kuliah', 'mata_kuliah.bobot_mata_kuliah' , 'nilai_mahasiswa.nilai_akhir')
        ->where('kurikulum.id' , $kurikulum->kurikulum_id)->where('nilai_mahasiswa.semester_id' , $semester_aktif->id)->get();
        $title = ucfirst(request()->segment(1))." ".ucfirst(request()->segment(2));
        return view("mahasiswa/khs" , compact("data" , "title" ,"mahasiswa" , "master"));

    }

    public function transkrip()
    {
        //$semester_aktif = SemesterModel::where('status_semester' , 'enable')->first();
        //$master = SemesterModel::where('row_status' ,'active')->get();
        $kurikulum = MahasiswaModel::join('master_kelas' ,'master_kelas.id' ,'mahasiswa.kelas_id')
        ->select('master_kelas.*','mahasiswa.nama','mahasiswa.id')
        ->where('nim' , Auth::user()->id)->first();
        $id = $kurikulum->id;
        $mahasiswa = DB::table('view_profile_mahasiswa')->where('id' , $id)->first();
        $data = KurikulumModel::rightJoin('kurikulum_mata_kuliah' ,'kurikulum_mata_kuliah.kurikulum_id','=' ,'kurikulum.id')
        ->join('mata_kuliah' ,'mata_kuliah.id' , '=' ,'kurikulum_mata_kuliah.mata_kuliah_id')
        ->leftJoin('nilai_mahasiswa', function ($join) use($id) {
            $join->on('nilai_mahasiswa.mata_kuliah_id' ,'=','kurikulum_mata_kuliah.mata_kuliah_id')
            ->Where('nilai_mahasiswa.mahasiswa_id' , '=' , $id);
        })
        ->select('kurikulum_mata_kuliah.*' , 'kurikulum.nama_kurikulum' , 'mata_kuliah.nama_mata_kuliah', 'mata_kuliah.kode_mata_kuliah', 'mata_kuliah.bobot_mata_kuliah' , 'nilai_mahasiswa.nilai_akhir')
        ->where('kurikulum.id' , $kurikulum->kurikulum_id)->get();
        $title = ucfirst(request()->segment(1))." ".ucfirst(request()->segment(2));
        return view("mahasiswa/transkrip" , compact("data" , "title" ,"mahasiswa"));

    }

    public function khs_load(Request $request)
    {
        $kurikulum = MahasiswaModel::join('master_kelas' ,'master_kelas.id' ,'mahasiswa.kelas_id')
        ->select('master_kelas.*','mahasiswa.nama','mahasiswa.id')
        ->where('nim' , Auth::user()->id)->first();
        $id = $kurikulum->id;
        $data = KurikulumModel::rightJoin('kurikulum_mata_kuliah' ,'kurikulum_mata_kuliah.kurikulum_id','=' ,'kurikulum.id')
        ->join('mata_kuliah' ,'mata_kuliah.id' , '=' ,'kurikulum_mata_kuliah.mata_kuliah_id')
        ->leftJoin('nilai_mahasiswa', function ($join) use($id) {
            $join->on('nilai_mahasiswa.mata_kuliah_id' ,'=','kurikulum_mata_kuliah.mata_kuliah_id')
            ->Where('nilai_mahasiswa.mahasiswa_id' , '=' , $id);
        })
        ->select('kurikulum_mata_kuliah.*' , 'kurikulum.nama_kurikulum' , 'mata_kuliah.nama_mata_kuliah', 'mata_kuliah.kode_mata_kuliah', 'mata_kuliah.bobot_mata_kuliah' , 'nilai_mahasiswa.nilai_akhir')
        ->where('kurikulum.id' , $kurikulum->kurikulum_id)->where('nilai_mahasiswa.semester_id' , $request->all()['id'])->get();
        $html = '';
        if(count($data) > 0){
            $i = 0;
            $sks = 0;
            foreach($data as $item){
                $i++;
                $sks += $item->bobot_mata_kuliah;
                $html .= '
                    <tr>
                        <td>'.$i.'</td>
                        <td style="text-align: center">'.$item->kode_mata_kuliah.'</td>
                        <td style="text-align: center">'.$item->nama_mata_kuliah.'</td>
                        <td style="text-align: center">'.$item->bobot_mata_kuliah.'</td>
                        <td style="text-align: center">'.$item->nilai_akhir.'</td>
                    </tr>

                ';
            }
            $html .= '<tr>
                        <td style="text-align: center" colspan="3"><b>Total SKS</b></td>
                        <td style="text-align: center" ><b>'.$sks.'</b></td>
                        <td style="text-align: center" ></td>
                    </tr>';
        }else{
            $html = '<tr>
                        <td colspan="5" style="text-align: center">Tidak ada data.</td>
                    </tr>';
        }

        return json_encode(array('html' => $html));
    }


    public function jadwalujian()
    {
        
        $semester_active = SemesterModel::where('status_semester' ,'enable')->first();
        $mahasiswa = MahasiswaModel::where('nim' , Auth::user()->id)->first();
        $data = JadwalPerkuliahanModel::where('kelas_id' , $mahasiswa->kelas_id)
        ->where('semester_id' , $semester_active->id)
        ->get();
        $select2 = JadwalPerkuliahanModel::select('semester_id' ,'semseter_title')
        ->where('kelas_id' , $mahasiswa->kelas_id)
        ->groupBy('semester_id')
        ->orderBy('semester_id' ,'ASC')
        ->get();
        $title = ucfirst(request()->segment(1))." ".ucfirst(request()->segment(2));
        return view("mahasiswa/JadwalUjian" , compact("data" , "title" ,"mahasiswa" ,'select2'));
    }

}
        