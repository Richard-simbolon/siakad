<?php

namespace App\Http\Controllers;

use App\MahasiswaModel;
use App\TugasAkhirModel;
use App\DosenModel;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class TugasAkhir extends Controller
{
    public function index()
    {
        $title = "Tugas Akhir";
        $tableid = "TugasAkhir";

        return view("data/tugas_akhir" , compact("title","tableid"));
    }

    public function create(){
        $master = array(
            'dosen' => DosenModel::where('row_status' , 'active')->get()
        );

        $title = "Tugas Akhir";

        return view("data/tugas_akhir_create" , compact("title"  ,'master'));

    }

    public function get($nim){
        $data = MahasiswaModel::where('nim' , $nim)
            ->join('master_jurusan', 'master_jurusan.id', '=', 'mahasiswa.jurusan_id')
            ->select("mahasiswa.id as id", "nim", "nama", "master_jurusan.title as jurusan")
            ->first();
        if($data){
            return json_encode(["status"=> true, "data"=> $data]);
        }else{
            return json_encode(["status"=> false, "message"=> "not found"]);
        }
    }

    public function paging(Request $request){
        return Datatables::of(TugasAkhirModel::where('mahasiswa_tugas_akhir.row_status', 'active')
            ->join('mahasiswa', 'mahasiswa.id', '=', 'mahasiswa_tugas_akhir.mahasiswa_id')
            ->join('master_jurusan', 'master_jurusan.id', '=', 'mahasiswa.jurusan_id')
            ->select("mahasiswa_tugas_akhir.id as id", "nim", "nama", "master_jurusan.title as jurusan", "judul")
            ->get())->addIndexColumn()->make(true);
    }
}
