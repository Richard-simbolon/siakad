<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\MahasiswaModel;
use Yajra\DataTables\DataTables;

class AktivitasPerkuliahan extends Controller
{
    static $Tableshow = ["id" => ["table" => ["tablename" =>"null" , "field"=> "id"] , "record"=>"Id"],
        "title" => ["table" => ["tablename" =>"null" , "field"=> "title"] , "record"=>"Title"],
        "row_status" => ["table" => ["tablename" =>"null" , "field"=> "row_status"] , "record"=>"Status"],
    ];
    static $exclude = ["id","created_at","updated_at","created_by","updated_by"];

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
        $sql = DB::select("SELECT mahasiswa.id, mahasiswa.nim, mahasiswa.nama, mj.title as jurusan, ma.title as angkatan, 1 as semester, ms.title  as status, 1 as ips, 1 as ipk, 1 as skssemester, 1 as total
                                FROM mahasiswa
                                INNER join master_jurusan mj on mj.id = mahasiswa.jurusan_id
                                INNER JOIN master_angkatan ma on ma.id = mahasiswa.angkatan
                                INNER JOIN master_status_mahasiswa ms on ms.id = mahasiswa.status"
        );
        return Datatables::of($sql)->addIndexColumn()->make(true);
    }
}
