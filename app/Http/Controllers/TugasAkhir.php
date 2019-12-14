<?php

namespace App\Http\Controllers;

use App\MahasiswaModel;
use App\TugasAkhirModel;
use App\TugasAkhirDetailModel;
use App\DosenModel;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class TugasAkhir extends Controller
{
    static $html = ["id"=>["type"=>"null" , "value"=>"null" , "validation" => ""],
        "row_status"=>["type"=>"radio" , "value"=>"active,deleted,notactive" , "validation" => "required"],
        "mahasiswa_id"=>["type"=>"text" , "value"=>"null" , "validation" => "required"],
        "judul"=>["type"=>"text" , "value"=>"null" , "validation" => "required"]
    ];
    static $html_detail = ["id"=>["type"=>"null" , "value"=>"null" , "validation" => ""],
        "row_status"=>["type"=>"radio" , "value"=>"active,deleted,notactive" , "validation" => "required"],
        "tugas_akhir_id"=>["type"=>"text" , "value"=>"null" , "validation" => "required"],
        "dosen_id"=>["type"=>"text" , "value"=>"null" , "validation" => "required"],
        "status_dosen"=>["type"=>"text" , "value"=>"null" , "validation" => "required"],
        "status_dosen_ke"=>["type"=>"text" , "value"=>"null" , "validation" => "required"],
    ];
    static $exclude = ["id","created_at","updated_at","created_by","modified_by"];

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

    public function view($id){
        $data = TugasAkhirModel::where('mahasiswa_tugas_akhir.id' , $id)
            ->join('mahasiswa', 'mahasiswa.id', '=', 'mahasiswa_tugas_akhir.mahasiswa_id')
            ->join('master_jurusan', 'master_jurusan.id', '=', 'mahasiswa.jurusan_id')
            ->select("mahasiswa_tugas_akhir.id as id","mahasiswa_tugas_akhir.row_status as row_status","mahasiswa_tugas_akhir.mahasiswa_id", "mahasiswa.nim", "mahasiswa.nama","judul", "master_jurusan.title as jurusan")->first();

        $master = array(
            'dosen' => DosenModel::where('row_status' , 'active')->get(),
            'detail' =>TugasAkhirDetailModel::where('tugas_akhir_id', $id)->where('row_status' , 'active')->get()
        );

        $title = "Edit Tugas Akhir";

        return view("data/tugas_akhir_edit" , compact("data", "title"  ,'master'));

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

    public function save(Request $request)
    {
        $input = $request->all();
        $field = [];
        $data = [];
        $table = DB::getSchemaBuilder()->getColumnListing("mahasiswa_tugas_akhir");
        $table_detail = DB::getSchemaBuilder()->getColumnListing("mahasiswa_tugas_akhir_detail");
        $fieldvalidation = static::$html;
        $fieldvalidation_detail = static::$html_detail;
        foreach($table as $val){
            if(array_key_exists($val , $fieldvalidation) && !in_array($val , static::$exclude)){
                $field[$val] = $fieldvalidation[$val]["validation"];
                $data[$val] = $input[$val];
            }
        }
        $validation = Validator::make($request->all(), $field);
        if ($validation->fails()) {
            return json_encode(["status"=> "false", "message"=> $validation->messages()]);
        }


        DB::beginTransaction();
        try{
            $header = TugasAkhirModel::firstOrCreate($data);

            $itemDetail = [];
            $arrDetail = [];
            $field_detail =[];
            foreach ($input['detail'] as $detail){
                $itemDetail = array("tugas_akhir_id"=>$header->id,"row_status"=>"active","dosen_id"=>$detail['dosen'], "status_dosen"=>$detail['status_dosen'], "status_dosen_ke"=>$detail['status_dosen_ke']);

                foreach($table_detail as $val){
                    if(array_key_exists($val , $fieldvalidation_detail) && !in_array($val , static::$exclude)){
                        $field_detail[$val] = $fieldvalidation_detail[$val]["validation"];
                    }
                }

                $validation = Validator::make($itemDetail, $field_detail);
                if ($validation->fails()) {
                    return json_encode(["status"=> "false", "message"=> $validation->messages()]);
                }

                array_push($arrDetail, $itemDetail);
            }

            TugasAkhirDetailModel::insert($arrDetail);

            DB::commit();
            return json_encode(array('status' => 'success' , 'msg' => 'Data berhasil disimpan.'));
        }catch(\Exception $e){
            echo $e;
            DB::rollBack();
            return json_encode(array('status' => 'error' , 'msg' => 'Terjadi kesalahan saat menyimpan, silahkan coba lagi.'));
        }

    }

    public function update(Request $request)
    {
        $input = $request->all();
        $field = [];
        $data = [];
        $table = DB::getSchemaBuilder()->getColumnListing("mahasiswa_tugas_akhir");
        $table_detail = DB::getSchemaBuilder()->getColumnListing("mahasiswa_tugas_akhir_detail");
        $fieldvalidation = static::$html;
        $fieldvalidation_detail = static::$html_detail;
        foreach($table as $val){
            if(array_key_exists($val , $fieldvalidation) || array_key_exists($val , $fieldvalidation) && !in_array($val , static::$exclude)){
                $field[$val] = $fieldvalidation[$val]["validation"];
                $data[$val] = $input[$val];
            }
        }
        $data['id'] = $input['id'];
        $where['id'] = $input['id'];

        $validation = Validator::make($request->all(), $field);
        if ($validation->fails()) {
            return json_encode(["status"=> "false", "message"=> $validation->messages()]);
        }

        $itemDetail = [];
        $arrDetail = [];
        $field_detail =[];
        foreach ($input['detail'] as $detail){
            $itemDetail = array("tugas_akhir_id"=>$data['id'],"row_status"=>"active","dosen_id"=>$detail['dosen'], "status_dosen"=>$detail['status_dosen'] , "status_dosen_ke"=>$detail['status_dosen_ke']);

            foreach($table_detail as $val){
                if(array_key_exists($val , $fieldvalidation_detail) && !in_array($val , static::$exclude)){
                    $field_detail[$val] = $fieldvalidation_detail[$val]["validation"];
                }
            }

            $validation = Validator::make($itemDetail, $field_detail);
            if ($validation->fails()) {
                return json_encode(["status"=> "false", "message"=> $validation->messages()]);
            }
            $itemDetail['id'] = $detail['detail_id'];
            $itemDetail['row_status'] = $detail['row_status_detail'];
            array_push($arrDetail, $itemDetail);
        }

        DB::beginTransaction();
        try{
            TugasAkhirModel::updateOrInsert($where , $data);

            foreach ($arrDetail as $item){
                $where_detail['id'] = $item['id'];
                TugasAkhirDetailModel::updateOrInsert($where_detail, $item);
            }
            DB::commit();
            return json_encode(array('status' => 'success' , 'msg' => 'Data berhasil disimpan.'));
        }catch(\Exception $e){
            echo $e;
            DB::rollBack();
            return json_encode(array('status' => 'error' , 'msg' => 'Terjadi kesalahan saat menyimpan, silahkan coba lagi.'));
        }

    }

    public function delete(Request $request)
    {
        $data =  TugasAkhirModel::where('id', $request->id)->first();
        $data->row_status = 'deleted';

        if($data->save()){
            return $this->success("Data berhasil disimpan.");
        }else{
            return json_encode(["status"=> "false", "msg"=> "Mohon maaf, terjadi kesalahan sistem"]);
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
