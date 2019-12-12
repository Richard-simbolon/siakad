<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\MahasiswaModel;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class AktivitasPerkuliahan extends Controller
{
    static $Tableshow = ["id" => ["table" => ["tablename" =>"null" , "field"=> "id"] , "record"=>"Id"],
        "title" => ["table" => ["tablename" =>"null" , "field"=> "title"] , "record"=>"Title"],
        "row_status" => ["table" => ["tablename" =>"null" , "field"=> "row_status"] , "record"=>"Status"],
    ];
    static $exclude = ["id","created_at","updated_at","created_by","updated_by"];

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
        $tableid = 'AktivitasPerkuliahan';
        $title = ucfirst(request()->segment(1))." ".ucfirst(request()->segment(2));
        $table_display = DB::getSchemaBuilder()->getColumnListing('Mahasiswa');
        $exclude = static::$exclude;
        $Tableshow = static::$Tableshow;
        return view("data/aktivitas_perkuliahan" , compact( "title" ,"table_display" ,"exclude" ,"Tableshow","tableid"));
    }

    public function paging(Request $request){
        return Datatables::of($profile = DB::table('view_profile_mahasiswa')
        ->leftJoin('master_status_mahasiswa' ,'master_status_mahasiswa.id', '=' ,'view_profile_mahasiswa.status')
        ->leftJoin('view_aktivitas_perkuliahan_ipk_ips' ,'view_aktivitas_perkuliahan_ipk_ips.mahasiswa_id', '=' ,'view_profile_mahasiswa.id')
        ->leftJoin('view_total_sks_by_kurikulum' ,'view_total_sks_by_kurikulum.kelas_id', '=' ,'view_profile_mahasiswa.kelas_id')
        ->leftJoin('view_total_sks_selesai' ,'view_total_sks_selesai.mahasiswa_id', '=' ,'view_profile_mahasiswa.id')
        ->select('view_profile_mahasiswa.id', 'view_profile_mahasiswa.nim',
         'view_profile_mahasiswa.nama', 'view_profile_mahasiswa.jurusan_title as jurusan', 'view_profile_mahasiswa.angkatan_title as angkatan', 'view_aktivitas_perkuliahan_ipk_ips.semester_terakhir as semester'
        , 'master_status_mahasiswa.title  as status', 'view_aktivitas_perkuliahan_ipk_ips.ips_terakhir as ips', 'view_aktivitas_perkuliahan_ipk_ips.ipk as ipk', 'view_total_sks_selesai.total_sks_selesai as skssemester', 'view_total_sks_by_kurikulum.total_sks as total')
        ->where('view_profile_mahasiswa.status' , '!=' ,"''")->get()
        )->addIndexColumn()->make(true);
    }
}
