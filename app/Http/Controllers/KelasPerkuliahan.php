<?php

namespace App\Http\Controllers;

use App\KelasModel;
use App\SemesterModel;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\KelasPerkuliahanModel;
use App\AngkatanModel;
use App\JurusanModel;
use Yajra\DataTables\DataTables;

class KelasPerkuliahan extends Controller
{
    static $Tableshow = ["id" => ["table" => ["tablename" =>"null" , "field"=> "id"] , "record"=>"Id"],
                        "row_status" => ["table" => ["tablename" =>"null" , "field"=> "row_status"] , "record"=>"status"],
                        "program_studi_id" => ["table" => ["tablename" =>"null" , "field"=> "program_studi_id"] , "record"=>"ProgramStudi"],
                        "semester_id" => ["table" => ["tablename" =>"null" , "field"=> "semester_id"] , "record"=>"Semester"],
                        "mata_kuliah_id" => ["table" => ["tablename" =>"null" , "field"=> "mata_kuliah_id"] , "record"=>"MataKuliah"],
                        "kelas_id" => ["table" => ["tablename" =>"null" , "field"=> "kelas_id"] , "record"=>"Kelas"],
                        "pembahasan" => ["table" => ["tablename" =>"null" , "field"=> "pembahasan"] , "record"=>"pembahasan"],
                        "tanggal_efektif" => ["table" => ["tablename" =>"null" , "field"=> "tanggal_efektif"] , "record"=>"tanggal_efektif"],
                        "tanggal_akhir_efektif" => ["table" => ["tablename" =>"null" , "field"=> "tanggal_akhir_efektif"] , "record"=>"tanggal_akhir_efektif"],

    ];

    static $exclude = ["id","created_at","updated_at","created_by","update_by"];
    static $tablename = "kelas_perkuliahan";

    public function index()
    {
        $master = array(
            'jurusan' => JurusanModel::where('row_status' , 'active')->get(),
            'angkatan' => AngkatanModel::where('row_status' , 'active')->get(),
            'semester'=> SemesterModel::where('row_status', 'active')->get(),
        );

        $data = KelasPerkuliahanModel::where('row_status', 'active')->get();

        $title = ucfirst(request()->segment(1))." ".ucfirst(request()->segment(2));
        $tableid = "KelasPerkuliahan";
        $table_display = DB::getSchemaBuilder()->getColumnListing(static::$tablename);
        $exclude = static::$exclude;
        $Tableshow = static::$Tableshow;
        return view("data/kelas_perkuliahan" , compact("data" , "title" ,"table_display" ,"exclude" ,"Tableshow","tableid", "master"));

    }

    public function create(){
        $master = array(
            'jurusan' => JurusanModel::where('row_status' , 'active')->get(),
            'kelas' => KelasModel::where('row_status' , 'active')->get(),
            'angkatan' => AngkatanModel::where('row_status' , 'active')->get(),
            'semester'=> SemesterModel::where('row_status', 'active')->get(),

        );
        $title = "Tambah ".ucfirst(request()->segment(1))." ".ucfirst(request()->segment(2));

        return view("data/kelas_perkuliahan_create" , compact("title" , "column" ,'master'));

    }
}
