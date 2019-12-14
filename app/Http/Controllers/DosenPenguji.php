<?php
namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\Auth;
use App\DosenModel;
use Illuminate\Support\Facades\Redirect;

class DosenPenguji extends Controller
{
  
    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            $this->user = Auth::user();
            if(!$this->user){
                Redirect::to('login')->send();
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
        $data = [];
        $title = ucfirst(request()->segment(1))." ".ucfirst(request()->segment(2));

        return view("dosen/penguji_mahasiswa" , compact("data" ));

    }

    public function paging(Request $request){
        $post= $request->all();
        $id = DosenModel::where('nidn_nup_nidk' , Auth::user()->id)->first();
        $where = ['dosen_id' => $id->id  , 'row_status' =>'active', "status_dosen"=>"Penguji"];
        
        return Datatables::of(DB::table('view_tugas_akhir')->where($where)->get())->addIndexColumn()->make(true);
    }

}
        