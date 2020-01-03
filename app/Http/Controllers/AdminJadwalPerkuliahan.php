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
use App\JurusanModel;
use App\AngkatanModel;
use App\KelasModel;
use Illuminate\Support\Facades\Redirect;

class AdminJadwalPerkuliahan extends Controller
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

        $semester_active = SemesterModel::where('status_semester' ,'enable')->first();
        
        $mahasiswa = MahasiswaModel::where('nim' , Auth::user()->id)->first();
        
        $title = ucfirst(request()->segment(1))." ".ucfirst(request()->segment(2));
        return view("data/admin_jadwal_perkuliahan" , compact("title" ,"mahasiswa" ,'semester_active' ,'master'));

    }

    public function paging(Request $request){
        $post = $request->all();
        $where = [];
        foreach($post['filter'] as $key=>$item){
            if($item != ''){
                $where[$key] = $item;
            }
        }
        
        return Datatables::of(JadwalPerkuliahanModel::where($where)
        )->make(true);
    }

}
        