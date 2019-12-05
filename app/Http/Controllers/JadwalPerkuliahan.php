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
use PDF;

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
        //print_r(Auth::user()); exit;
        if(!Auth::user()){
            redirect('login');
        }
        $this->middleware(function ($request, $next) {
            $this->user = Auth::user();
            if($this->user->login_type != 'mahasiswa'){
                return abort(404);
            }else{
                return $next($request);
            }
        });
        
    }

    public function index()
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
        ->select('kurikulum_mata_kuliah.*' , 'kurikulum.nama_kurikulum' , 'mata_kuliah.nama_mata_kuliah', 'mata_kuliah.kode_mata_kuliah','mata_kuliah.tipe_mata_kuliah', 'mata_kuliah.bobot_mata_kuliah' , 'nilai_mahasiswa.nilai_uts', 'nilai_mahasiswa.nilai_tugas', 'nilai_mahasiswa.nilai_uas')
        ->where('kurikulum.id' , $kurikulum->kurikulum_id)->where('nilai_mahasiswa.semester_id' , $semester_aktif->id)->get();
        $title = ucfirst(request()->segment(1))." ".ucfirst(request()->segment(2));
        return view("mahasiswa/khs" , compact("data" , "title" ,"mahasiswa" , "master" ,"semester_aktif"));

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
        ->leftJoin('master_semester' , 'master_semester.id' ,'=' , 'nilai_mahasiswa.semester_id')
        ->select('kurikulum_mata_kuliah.*' , 'kurikulum.nama_kurikulum' , 'mata_kuliah.nama_mata_kuliah', 'mata_kuliah.kode_mata_kuliah', 'mata_kuliah.bobot_mata_kuliah' , 'nilai_mahasiswa.nilai_akhir', 'nilai_mahasiswa.nilai_uts', 'nilai_mahasiswa.nilai_tugas', 'nilai_mahasiswa.nilai_uas','mata_kuliah.tipe_mata_kuliah', 'nilai_mahasiswa.semester_id', 'master_semester.title as semester_title')
        ->where('kurikulum.id' , $kurikulum->kurikulum_id)->orderby('nilai_mahasiswa.semester_id' , 'ASC')->get();
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
        ->select('kurikulum_mata_kuliah.*' , 'kurikulum.nama_kurikulum' , 'mata_kuliah.nama_mata_kuliah', 'mata_kuliah.kode_mata_kuliah', 'mata_kuliah.bobot_mata_kuliah' , 'nilai_mahasiswa.nilai_akhir', 'nilai_mahasiswa.nilai_uts', 'nilai_mahasiswa.nilai_tugas', 'nilai_mahasiswa.nilai_uas','mata_kuliah.tipe_mata_kuliah')
        ->where('kurikulum.id' , $kurikulum->kurikulum_id)->where('nilai_mahasiswa.semester_id' , $request->all()['id'])->get();
        $html = '';

       // print_r($data); exit;
        if(count($data) > 0){
            $i = 0;
            $sks = 0;
            $nipk = 0;
            foreach($data as $item){
                $i++;
                $sks += $item->bobot_mata_kuliah;

                $nangka = 0;
                $nhuruf = 'E';

                $nuts = $item->nilai_uts > 0 ? $item->nilai_uts : 0;
                $nuas = $item->nilai_uas > 0 ? $item->nilai_uas : 0;
                $ntgs = $item->nilai_tugas > 0 ? $item->nilai_tugas : 0;

                if($item->tipe_mata_kuliah == 'praktik'){
                    $nangka = ( (($ntgs * 40) / 100) + (($nuts * 30) / 100) + (($nuas * 20)/100));
                }elseif ($item->tipe_mata_kuliah == 'teori') {
                    $nangka = ( (($ntgs * 30) / 100) + (($nuts * 30) / 100) + (($nuas * 40)/100));
                }
                if($nangka < 45){
                    $nhuruf = 'E';
                    $nipk += 0 * $item->bobot_mata_kuliah;
                }elseif($nangka > 44 && $nangka<= 59){
                    $nhuruf = 'D';
                    $nipk += 1 * $item->bobot_mata_kuliah;
                }elseif($nangka > 59 && $nangka<= 69){
                    $nhuruf = 'C';
                    $nipk += 2 * $item->bobot_mata_kuliah;
                }elseif($nangka > 69 && $nangka<= 79){
                    $nhuruf = 'B';
                    $nipk += 3 * $item->bobot_mata_kuliah;
                }elseif($nangka > 79 && $nangka<= 100){
                    $nhuruf = 'A';
                    $nipk += 4 * $item->bobot_mata_kuliah;
                }else{
                    $nhuruf = 'E';
                    $nipk += 0 * $item->bobot_mata_kuliah;
                }
                
                $html .= '
                        <tr>
                            <td style="text-align: center">'.$i.'</td>
                            <td style="text-align: center">'.$item->kode_mata_kuliah.'</td>
                            <td style="text-align: center">'.$item->nama_mata_kuliah.'</td>
                            <td style="text-align: center">'.$item->bobot_mata_kuliah.'</td>
                            <td style="text-align: center">'.$item->nilai_uts.'</td>
                            <td style="text-align: center">'.$item->nilai_tugas.'</td>
                            <td style="text-align: center">'.$item->nilai_uas.'</td>
                            <td style="text-align: center">'.$nangka.'</td>
                            <td style="text-align: center">'.$nhuruf.'</td>
                        </tr>
                ';
            }
            $html .= '<tr>
                        <td style="text-align: left" colspan="3"><b>Total SKS</b></td>
                        <td style="text-align: center" ><b>'.$sks.'</b></td>
                        <td style="text-align: center" colspan="3" ><b></b></td>
                    </tr>
                    <tr>
                        <td style="text-align: left" colspan="7"><b>IP</b></td>
                        <td style="text-align: center" colspan="2"><b>'.round($nipk / $sks ,2).'</b></td>
                    </tr>';
        }else{
            $html = '<tr>
                        <td colspan="5" style="text-align: center">Tidak ada data.</td>
                    </tr>';
        }

        //echo $html; exit;
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
        $profile = DB::table('view_profile_mahasiswa')->where('nim' , Auth::user()->id)->first();
        $title = ucfirst(request()->segment(1))." ".ucfirst(request()->segment(2));
        return view("mahasiswa/JadwalUjian" , compact("data" , "title" ,"mahasiswa" ,'select2' ,"profile"));
    }

    public function pagingujian(Request $request){
        $semester_ids = $request->all();
        $semester_active = SemesterModel::where('status_semester' ,'enable')->first();
        $mahasiswa = MahasiswaModel::where('nim' , Auth::user()->id)->first();
        if($semester_ids['jadwal_perkuliahan'] != ''){
            $semester_id = $semester_ids['jadwal_perkuliahan'];
        }else{
            $semester_id = $semester_active->id;
        }
        return Datatables::of(DB::table('view_mahasiswa_jadwal_ujian')->where('mahasiswa_id' , $mahasiswa->id)
        ->where('semester_id' , $semester_id))->make(true);
    }

    function print_khs($id_semester){
        $semester_aktif = SemesterModel::where('id' , $id_semester)->first();
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
        ->select('kurikulum_mata_kuliah.*' , 'kurikulum.nama_kurikulum' , 'mata_kuliah.nama_mata_kuliah', 'mata_kuliah.kode_mata_kuliah','mata_kuliah.tipe_mata_kuliah', 'mata_kuliah.bobot_mata_kuliah' , 'nilai_mahasiswa.nilai_uts', 'nilai_mahasiswa.nilai_tugas', 'nilai_mahasiswa.nilai_uas')
        ->where('kurikulum.id' , $kurikulum->kurikulum_id)->where('nilai_mahasiswa.semester_id' , $id_semester)->get();
        $title = ucfirst(request()->segment(1))." ".ucfirst(request()->segment(2));
        $pdf = PDF::loadView('mahasiswa/print_khs', compact("data" , "title" ,"mahasiswa" , "master", "semester_aktif"));
        return $pdf->download('KHS_'.$id_semester.'_'.Auth::user()->id.'_'.date('Y-m-d_H-i-s').'.pdf');
        //return view("mahasiswa/print_khs" , compact("data" , "title" ,"mahasiswa" , "master" , "semester_aktif"));

    }

    function print_transkrip(){
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
        ->leftJoin('master_semester' , 'master_semester.id' ,'=' , 'nilai_mahasiswa.semester_id')
        ->select('kurikulum_mata_kuliah.*' , 'kurikulum.nama_kurikulum' , 'mata_kuliah.nama_mata_kuliah', 'mata_kuliah.kode_mata_kuliah', 'mata_kuliah.bobot_mata_kuliah' , 'nilai_mahasiswa.nilai_akhir', 'nilai_mahasiswa.nilai_uts', 'nilai_mahasiswa.nilai_tugas', 'nilai_mahasiswa.nilai_uas','mata_kuliah.tipe_mata_kuliah', 'nilai_mahasiswa.semester_id', 'master_semester.title as semester_title')
        ->where('kurikulum.id' , $kurikulum->kurikulum_id)->orderby('nilai_mahasiswa.semester_id' , 'ASC')->get();
        $title = ucfirst(request()->segment(1))." ".ucfirst(request()->segment(2));
        $pdf = PDF::loadView('mahasiswa/print_transkrip', compact("data" , "title" ,"mahasiswa" , "master", "semester_aktif"));
        return $pdf->download('TanskriNilai_'.'_'.Auth::user()->id.'_'.date('Y-m-d_H-i-s').'.pdf');
        //return view("mahasiswa/print_transkrip" , compact("data" , "title" ,"mahasiswa" , "master"));

    }

    public function print_krs(){
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
        //return view("mahasiswa/print_krs" , compact("data" , "title" ,"mahasiswa" ,'select2',"semester_active"));
        $pdf = PDF::loadView("mahasiswa/print_krs" , compact("data" , "title" ,"mahasiswa" ,'select2',"semester_active"));
        return $pdf->download('KRS'.'_'.Auth::user()->id.'_'.date('Y-m-d_H-i-s').'.pdf');
        
    }

}
        