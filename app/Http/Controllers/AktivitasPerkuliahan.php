<?php

namespace App\Http\Controllers;

use App\AktivitasPerkuliahanModel;
use App\SemesterModel;
use App\StatusMahasiswaModel;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
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
    static $html = ["id"=>["type"=>"null" , "value"=>"null" , "validation" => "required"] ,
        "mahasiswa_id"=>["type"=>"text" , "value"=>"null" , "validation" => "required"] ,
        "semester_id"=>["type"=>"text" , "value"=>"null" , "validation" => "required"] ,
        "status"=>["type"=>"text" , "value"=>"null" , "validation" => "required"] ,
        "ips"=>["type"=>"text" , "value"=>"null" , "validation" => "required"] ,
        "ipk"=>["type"=>"text" , "value"=>"null" , "validation" => "required"] ,
        "sks_semester"=>["type"=>"text" , "value"=>"null" , "validation" => "required"] ,
        "sks_total"=>["type"=>"text" , "value"=>"null" , "validation" => "required"]
    ];

    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            $this->user = Auth::user();
            if(!$this->user){
                Redirect::to('login')->send();
            }
            if($this->user->login_type != 'admin' && $this->user->login_type != 'jurusan'){
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

    public function create(){
        $master = array(
            'status' => StatusMahasiswaModel::where('row_status' , 'active')->get()
        );
        $semester = SemesterModel::where('status_semester','=', 'enable')->first();

        return view('data/aktivitas_perkuliahan_create' , compact('master','semester'));
    }

    public function edit($id){
        $data = AktivitasPerkuliahanModel::where('mahasiswa_aktivitas_perkuliahan.id' , $id)
            ->join('mahasiswa','mahasiswa.id', 'mahasiswa_aktivitas_perkuliahan.mahasiswa_id')
            ->join('master_semester','master_semester.id', 'mahasiswa_aktivitas_perkuliahan.semester_id')
            ->join('master_jurusan','master_jurusan.id', 'mahasiswa.jurusan_id')
            ->select('mahasiswa_aktivitas_perkuliahan.*', 'master_semester.title as semester', 'mahasiswa.nim', 'mahasiswa.nama', 'master_jurusan.title as jurusan')
            ->first();

        $master = array(
            'status' => StatusMahasiswaModel::where('row_status' , 'active')->get()
        );
        $semester = SemesterModel::where('status_semester','=', 'enable')->first();

        return view('data/aktivitas_perkuliahan_edit' , compact('data','master','semester'));
    }

    public function save(Request $request){
        $input = $request->all();
        $field = [];
        $data = [];
        $table = DB::getSchemaBuilder()->getColumnListing("mahasiswa_aktivitas_perkuliahan");
        $fieldvalidatin = static::$html;
        foreach($table as $val){
            if(array_key_exists($val , $fieldvalidatin) && !in_array($val , static::$exclude)){
                $field[$val] = $fieldvalidatin[$val]["validation"];
                $data[$val] = $input[$val];
            }
        }
        $data[ 'row_status'] = 'active';
        $data[ 'created_at'] = date('Y-m-d H:m:s');
        $data[ 'created_by'] = Auth::user()->nama;

        $validation = Validator::make($request->all(), $field);
        if ($validation->fails()) {
            return json_encode(["status"=> "error", "message"=> $validation->messages()]);
        }

        if(AktivitasPerkuliahanModel::where('mahasiswa_id',$data['mahasiswa_id'])->where('semester_id',$data['semester_id']))
        {
            return json_encode(["status"=> "error", 'msg' => 'Data sudah ada']);
        }

        $save  = AktivitasPerkuliahanModel::firstOrCreate($data);

        if($save){
            return $this->success("Data berhasil disimpan.");
        }
    }

    public function update(Request $request){

        $data =  AktivitasPerkuliahanModel::where('id' , $request->id)->first();
        $data->status = $request->status;
        $data->ips = $request->ips;
        $data->ipk = $request->ipk;
        $data->sks_semester = $request->sks_semester;
        $data->sks_total = $request->sks_total;
        $data->updated_at = date('Y-m-d H:m:s');
        $data->updated_by = Auth::user()->nama;
        $data->is_sinc = 0;

        if($data->save()){
            return $this->success("Data berhasil disimpan.");
        }else{
            return json_encode(["status"=> "false", "msg"=> "Mohon maaf, terjadi kesalahan sistem"]);
        }
    }

    public function delete(Request $request){
        $data =  AktivitasPerkuliahanModel::where('id', $request->id)->first();
        $data->row_status = 'deleted';

        if($data->save()){
            return $this->success("Data berhasil disimpan.");
        }else{
            return json_encode(["status"=> "false", "msg"=> "Mohon maaf, terjadi kesalahan sistem"]);
        }
    }

    public function paging(Request $request){
        return Datatables::of(AktivitasPerkuliahanModel::where('mahasiswa_aktivitas_perkuliahan.row_status', '!=', 'deleted')
            ->join('mahasiswa','mahasiswa.id','mahasiswa_aktivitas_perkuliahan.mahasiswa_id')
            ->join('master_jurusan','master_jurusan.id', 'mahasiswa.jurusan_id')
            ->join('master_semester','master_semester.id','mahasiswa_aktivitas_perkuliahan.semester_id')
            ->select('mahasiswa_aktivitas_perkuliahan.*','mahasiswa.nim','mahasiswa.nama', 'master_jurusan.title as jurusan','master_semester.title as semester','master_semester.id_tahun_ajaran as angkatan'   )
            ->get())->addIndexColumn()->make(true);
    }
}
