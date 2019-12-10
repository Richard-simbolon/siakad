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
        $profile = DB::table('view_profile_mahasiswa')->where('id' , $mahasiswa->id)->first();
        $select2 = JadwalPerkuliahanModel::select('semester_id' ,'semseter_title')
        ->where('kelas_id' , $mahasiswa->kelas_id)
        ->groupBy('semester_id')
        ->orderBy('semester_id' ,'ASC')
        ->get();
        $title = ucfirst(request()->segment(1))." ".ucfirst(request()->segment(2));
        $semester = SemesterModel::where('status_semester','=', 'enable')->first();

        return view("mahasiswa/JadwalPerkuliahan" , compact("data" , "title" ,"mahasiswa" ,'select2', 'semester' ,"profile"));

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
        $ipk = $this->get_ipk(1);
        echo $ipk; exit;
        $semester_active = SemesterModel::where('status_semester' ,'enable')->first();
        $mahasiswa = MahasiswaModel::where('nim' , Auth::user()->id)->first();
        $profile = DB::table('view_profile_mahasiswa')->where('id' , $mahasiswa->id)->first();
        //print_r($profile); exit;
        $data = JadwalPerkuliahanModel::where('kelas_id' , $mahasiswa->kelas_id)
        ->where('semester_id' , $semester_active->id)
        ->get();
        $select2 = JadwalPerkuliahanModel::select('semester_id' ,'semseter_title')
        ->where('kelas_id' , $mahasiswa->kelas_id)
        ->groupBy('semester_id')
        ->orderBy('semester_id' ,'ASC')
        ->get();
        $title = ucfirst(request()->segment(1))." ".ucfirst(request()->segment(2));
        return view("mahasiswa/krs" , compact("data" , "title" ,"mahasiswa" ,'select2' ,"profile" ,"semester_active"));

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
        ->select('kurikulum_mata_kuliah.*' , 'kurikulum.nama_kurikulum' , 'mata_kuliah.nama_mata_kuliah', 'mata_kuliah.kode_mata_kuliah','mata_kuliah.tipe_mata_kuliah', 'mata_kuliah.bobot_mata_kuliah' , 'nilai_mahasiswa.nilai_uts', 'nilai_mahasiswa.nilai_tugas', 'nilai_mahasiswa.nilai_uas', 'nilai_mahasiswa.nilai_laporan', 'nilai_mahasiswa.nilai_laporan_pkl', 'nilai_mahasiswa.nilai_ujian')
        ->where('kurikulum.id' , $kurikulum->kurikulum_id)->where('nilai_mahasiswa.semester_id' , $semester_aktif->id)->get();
        //print_r($data); exit;
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
        ->select('kurikulum_mata_kuliah.*' , 'kurikulum.nama_kurikulum' , 'mata_kuliah.nama_mata_kuliah', 'mata_kuliah.kode_mata_kuliah', 'mata_kuliah.bobot_mata_kuliah' , 'nilai_mahasiswa.nilai_akhir', 'nilai_mahasiswa.nilai_uts', 'nilai_mahasiswa.nilai_tugas', 'nilai_mahasiswa.nilai_uas','mata_kuliah.tipe_mata_kuliah', 'nilai_mahasiswa.semester_id', 'master_semester.title as semester_title', 'nilai_mahasiswa.nilai_laporan', 'nilai_mahasiswa.nilai_laporan_pkl', 'nilai_mahasiswa.nilai_ujian')
        ->where('kurikulum.id' , $kurikulum->kurikulum_id)->orderby('nilai_mahasiswa.semester_id' , 'DESC')->get();
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
        ->select('kurikulum_mata_kuliah.*' , 'kurikulum.nama_kurikulum' , 'mata_kuliah.nama_mata_kuliah', 'mata_kuliah.kode_mata_kuliah', 'mata_kuliah.bobot_mata_kuliah' , 'nilai_mahasiswa.nilai_akhir', 'nilai_mahasiswa.nilai_uts', 'nilai_mahasiswa.nilai_tugas', 'nilai_mahasiswa.nilai_uas','mata_kuliah.tipe_mata_kuliah', 'nilai_mahasiswa.nilai_laporan', 'nilai_mahasiswa.nilai_laporan_pkl', 'nilai_mahasiswa.nilai_ujian')
        ->where('kurikulum.id' , $kurikulum->kurikulum_id)->where('nilai_mahasiswa.semester_id' , $request->all()['id'])->get();
        $html = '';

       // print_r($data); exit;
        if(count($data) > 0){
            $i = 0;
            $sks = 0;
            $nipk = 0;
            $t_sks_teori = 0;
            $t_sks_praktek = 0;
            foreach($data as $item){
                $i++;
                $sks += $item->bobot_mata_kuliah;

                $nangka = 0;
                $index = 0;
                $indexvsks = 0;
                $nhuruf = 'E';
                $nuts = $item->nilai_uts > 0 ? $item->nilai_uts : 0;
                $nuas = $item->nilai_uas > 0 ? $item->nilai_uas : 0;
                $ntgs = $item->nilai_tugas > 0 ? $item->nilai_tugas : 0;
                $nlapopkl = $item->nilai_laporan_pkl > 0 ? $item->nilai_laporan_pkl : 0;
                $nlapo = $item->nilai_laporan > 0 ? $item->nilai_laporan : 0;
                $nujian = $item->nilai_ujian > 0 ? $item->nilai_ujian : 0;

                if($item->tipe_mata_kuliah == 'praktik'){
                    $nangka = ( (($ntgs * 20) / 100) + (($nuts * 40) / 100) + (($nuas * 40)/100));
                }elseif ($item->tipe_mata_kuliah == 'teori') {
                    $nangka = ( (($ntgs * 30) / 100) + (($nuts * 30) / 100) + (($nuas * 40)/100));
                }elseif ($item->tipe_mata_kuliah == 'seminar') {
                    $nangka = ( (($ntgs * 40) / 100) + (($nuts * 30) / 100) + (($nuas * 30)/100));
                }elseif ($item->tipe_mata_kuliah == 'pkl') {
                    $nangka = ( (($ntgs * 20) / 100) + (($nuts * 20) / 100) + (($nuas * 40)/100) + (($nlapopkl * 20) / 100));
                }elseif ($item->tipe_mata_kuliah == 'skripsi') {
                    $nangka = ( (($ntgs * 30) / 100) + (($nuts * 20) / 100) + (($nuas * 10)/100) + (($nlapopkl * 10) / 100) + (($nujian * 20) / 100) + (($nlapo * 10) / 100));
                }

                if($nangka < 45){
                    $nhuruf = 'E';
                    $nipk += 0 * $item->bobot_mata_kuliah;
                    $indexvsks = 0 * $item->bobot_mata_kuliah;
                    $index = 0;
                }elseif($nangka > 44 && $nangka<= 59){
                    $nhuruf = 'D';
                    $nipk += 1 * $item->bobot_mata_kuliah;
                    $indexvsks = 1 * $item->bobot_mata_kuliah;
                    $index = 1;
                }elseif($nangka > 59 && $nangka<= 69){
                    $nhuruf = 'C';
                    $nipk += 2 * $item->bobot_mata_kuliah;
                    $indexvsks = 2 * $item->bobot_mata_kuliah;
                    $index = 2;
                }elseif($nangka > 69 && $nangka<= 79){
                    $nhuruf = 'B';
                    $nipk += 3 * $item->bobot_mata_kuliah;
                    $indexvsks = 3 * $item->bobot_mata_kuliah;
                    $index = 3;
                }elseif($nangka > 79 && $nangka<= 100){
                    $nhuruf = 'A';
                    $nipk += 4 * $item->bobot_mata_kuliah;
                    $indexvsks = 4 * $item->bobot_mata_kuliah;
                    $index = 4;
                }else{
                    $nhuruf = 'E';
                    $nipk += 0 * $item->bobot_mata_kuliah;
                    $index = 5;
                }

                if($item->tipe_mata_kuliah == 'praktek' || $item->tipe_mata_kuliah == 'skripsi' ||$item->tipe_mata_kuliah == 'seminar' ||$item->tipe_mata_kuliah == 'pkl'){
                    $sksteori = 0; 
                    $skspraktek = $item->bobot_mata_kuliah;
                    $jumlahpr = $item->bobot_mata_kuliah;
                    
                    $nilaiteoriangka = 0;
                    $nilaiteorimutu = '-';  
                    $nilaipraktekangka = $nangka;
                    $nilaipraktekmutu = $nhuruf;
                    $t_sks_praktek += $item->bobot_mata_kuliah;
                    
                }else{
                    $sksteori = $item->bobot_mata_kuliah; 
                    $skspraktek = '-';
                    $jumlahpr = $item->bobot_mata_kuliah;

                    $nilaiteoriangka = $nangka;
                    $nilaiteorimutu = $nhuruf;  
                    $nilaipraktekangka = "-";
                    $nilaipraktekmutu = '-';
                    $t_sks_teori += $item->bobot_mata_kuliah;
                }
                
                $html .= '
                        <tr>
                            <td align="center">'.$i.'</td>
                            <td>'.$item->nama_mata_kuliah.'</td>
                            <td align="center">'.$sksteori.'</td>
                            <td align="center">'.$skspraktek.'</td>
                            <td align="center">'.$nilaiteorimutu.'</td>
                            <td align="center">'.$nilaipraktekmutu.'</td>
                            <td align="center">'.$nilaiteoriangka.'</td>
                            <td align="center">'.$nilaipraktekangka.'</td>
                            <td align="center">'.$nhuruf.'</td>
                        </tr>
                
                ';
            }
            $html .= '<tr>
                        <td align="center"></td>
                        <td>Jumlah </td>
                        <td align="center">'.$t_sks_teori.'</td>
                        <td align="center">'.$t_sks_praktek.'</td>
                        <td align="center" colspan="4" ></td>
                        <td align="center" rowspan="2"></td>
                    </tr>

                    <tr>
                        <td align="center"></td>
                        <td>Jumlah  K (T + P)</td>
                        <td align="center" colspan="2" >'.$sks.'</td>
                        <td align="center" colspan="4"></td>
                    </tr>
                    <tr>
                        <td align="center"></td>
                        <td colspan="7">Indeks Prestasi (IP)</td>
                        
                        <td align="center">'. round($nipk / $sks ,2).'</td>
                    </tr>';
        }else{
            $html = '<tr>            
                        <td style="text-align: center;center; border-bottom:1px black solid; border-right:1px black solid;" colspan="9">Tidak ada matakuliah</td>
                    </tr>';
        }

        //echo $html; exit;
        return json_encode(array('html' => $html));
    }

    function get_ipk($id_semester){
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
        if(count($data) > 0){
            $i = 0;
            $sks = 0;
            $nipk = 0;
            $t_sks_teori = 0;
            $t_sks_praktek = 0;
            foreach($data as $item){
                $i++;
                $sks += $item->bobot_mata_kuliah;

                $nangka = 0;
                $index = 0;
                $indexvsks = 0;
                $nhuruf = 'E';
                $nuts = $item->nilai_uts > 0 ? $item->nilai_uts : 0;
                $nuas = $item->nilai_uas > 0 ? $item->nilai_uas : 0;
                $ntgs = $item->nilai_tugas > 0 ? $item->nilai_tugas : 0;
                $nlapopkl = $item->nilai_laporan_pkl > 0 ? $item->nilai_laporan_pkl : 0;
                $nlapo = $item->nilai_laporan > 0 ? $item->nilai_laporan : 0;
                $nujian = $item->nilai_ujian > 0 ? $item->nilai_ujian : 0;

                if($item->tipe_mata_kuliah == 'praktik'){
                    $nangka = ( (($ntgs * 20) / 100) + (($nuts * 40) / 100) + (($nuas * 40)/100));
                }elseif ($item->tipe_mata_kuliah == 'teori') {
                    $nangka = ( (($ntgs * 30) / 100) + (($nuts * 30) / 100) + (($nuas * 40)/100));
                }elseif ($item->tipe_mata_kuliah == 'seminar') {
                    $nangka = ( (($ntgs * 40) / 100) + (($nuts * 30) / 100) + (($nuas * 30)/100));
                }elseif ($item->tipe_mata_kuliah == 'pkl') {
                    $nangka = ( (($ntgs * 20) / 100) + (($nuts * 20) / 100) + (($nuas * 40)/100) + (($nlapopkl * 20) / 100));
                }elseif ($item->tipe_mata_kuliah == 'skripsi') {
                    $nangka = ( (($ntgs * 30) / 100) + (($nuts * 20) / 100) + (($nuas * 10)/100) + (($nlapopkl * 10) / 100) + (($nujian * 20) / 100) + (($nlapo * 10) / 100));
                }

                if($nangka < 45){
                    $nhuruf = 'E';
                    $nipk += 0 * $item->bobot_mata_kuliah;
                    $indexvsks = 0 * $item->bobot_mata_kuliah;
                    $index = 0;
                }elseif($nangka > 44 && $nangka<= 59){
                    $nhuruf = 'D';
                    $nipk += 1 * $item->bobot_mata_kuliah;
                    $indexvsks = 1 * $item->bobot_mata_kuliah;
                    $index = 1;
                }elseif($nangka > 59 && $nangka<= 69){
                    $nhuruf = 'C';
                    $nipk += 2 * $item->bobot_mata_kuliah;
                    $indexvsks = 2 * $item->bobot_mata_kuliah;
                    $index = 2;
                }elseif($nangka > 69 && $nangka<= 79){
                    $nhuruf = 'B';
                    $nipk += 3 * $item->bobot_mata_kuliah;
                    $indexvsks = 3 * $item->bobot_mata_kuliah;
                    $index = 3;
                }elseif($nangka > 79 && $nangka<= 100){
                    $nhuruf = 'A';
                    $nipk += 4 * $item->bobot_mata_kuliah;
                    $indexvsks = 4 * $item->bobot_mata_kuliah;
                    $index = 4;
                }else{
                    $nhuruf = 'E';
                    $nipk += 0 * $item->bobot_mata_kuliah;
                    $index = 5;
                }

                if($item->tipe_mata_kuliah == 'praktek' || $item->tipe_mata_kuliah == 'skripsi' ||$item->tipe_mata_kuliah == 'seminar' ||$item->tipe_mata_kuliah == 'pkl'){
                    $sksteori = 0; 
                    $skspraktek = $item->bobot_mata_kuliah;
                    $jumlahpr = $item->bobot_mata_kuliah;
                    
                    $nilaiteoriangka = 0;
                    $nilaiteorimutu = '-';  
                    $nilaipraktekangka = $nangka;
                    $nilaipraktekmutu = $nhuruf;
                    $t_sks_praktek += $item->bobot_mata_kuliah;
                    
                }else{
                    $sksteori = $item->bobot_mata_kuliah; 
                    $skspraktek = '-';
                    $jumlahpr = $item->bobot_mata_kuliah;

                    $nilaiteoriangka = $nangka;
                    $nilaiteorimutu = $nhuruf;  
                    $nilaipraktekangka = "-";
                    $nilaipraktekmutu = '-';
                    $t_sks_teori += $item->bobot_mata_kuliah;
                }

                
                
                
            }
            $ipk = round($nipk / $sks ,2);
        }else{
            $ipk = 0;
        }

        return $ipk;
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
        ->where('kurikulum.id' , $kurikulum->kurikulum_id)->orderby('nilai_mahasiswa.semester_id' , 'DESC')->get();
        $title = ucfirst(request()->segment(1))." ".ucfirst(request()->segment(2));
        $pdf = PDF::loadView('mahasiswa/print_transkrip', compact("data" , "title" ,"mahasiswa" ));
        return $pdf->download('TanskriNilai_'.'_'.Auth::user()->id.'_'.date('Y-m-d_H-i-s').'.pdf');
        //return view("mahasiswa/print_transkrip" , compact("data" , "title" ,"mahasiswa" , "master"));

    }

    public function print_krs(){
        $semester_active = SemesterModel::where('status_semester' ,'enable')->first();
        $mahasiswa = MahasiswaModel::where('nim' , Auth::user()->id)->first();
        $profile = DB::table('view_profile_mahasiswa')->where('id' , $mahasiswa->id)->first();
        $data = JadwalPerkuliahanModel::where('kelas_id' , $mahasiswa->kelas_id)
        ->where('semester_id' , $semester_active->id)
        ->get();
        $select2 = JadwalPerkuliahanModel::select('semester_id' ,'semseter_title')
        ->where('kelas_id' , $mahasiswa->kelas_id)
        ->groupBy('semester_id')
        ->orderBy('semester_id' ,'ASC')
        ->get();
        $title = ucfirst(request()->segment(1))." ".ucfirst(request()->segment(2));
        //return view("mahasiswa/print_krs" , compact("data" , "title" ,"mahasiswa" ,'select2',"semester_active" ,"profile"));
        $pdf = PDF::loadView("mahasiswa/print_krs" , compact("data" , "title" ,"mahasiswa" ,'select2',"semester_active" ,"profile"));
        return $pdf->download('KRS'.'_'.Auth::user()->id.'_'.date('Y-m-d_H-i-s').'.pdf');
        
    }

}
        