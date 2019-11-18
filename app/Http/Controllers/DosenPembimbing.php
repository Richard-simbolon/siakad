<?php
namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\Auth;
use App\DosenModel;

class DosenPembimbing extends Controller
{
  
    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            $this->middleware('auth');
            $this->user= Auth::user();
            //print_r($this->user->login_type);
            if($this->user->login_type != 'dosen'){
                return abort(404);
            }else{
                return $next($request);
            }
        });
        
    }

    public function index()
    {
        $data = [];
        $title = ucfirst(request()->segment(1))." ".ucfirst(request()->segment(2));
        return view("dosen/Pembimbing_Mahasiswa" , compact("data" ,"table_display"));

    }

    public function paging(Request $request){
        $post= $request->all();
        $id = DosenModel::where('nik' , Auth::user()->id)->first();
        $where = ['dosen_id' => $id->id  , 'row_status' =>'active'];
        
            //print_r(Datatables::of(DB::table('view_input_nilai_mahasiswa')->where($where)->get())->make(true));
            return Datatables::of(DB::table('view_tugas_akhir')->where($where)->get())->make(true);
        //return Datatables::of(DB::table('view_input_nilai_mahasiswa')->get())->make(true);
    }

}
        