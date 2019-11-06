<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class NilaiPerkuliahan extends Controller
{
    public function index()
    {
        $data = PekerjaanModel::get();
        $title = ucfirst(request()->segment(1))." ".ucfirst(request()->segment(2));
        $tableid = "Pekerjaan";
        $table_display = DB::getSchemaBuilder()->getColumnListing("master_pekerjaan");
        $exclude = static::$exclude;
        $Tableshow = static::$Tableshow;
        return view("setting/general_view" , compact("data" , "title" ,"table_display" ,"exclude" ,"Tableshow","tableid"));

    }
}
