<?php
namespace App\Http\Controllers;
use App\SemesterModel;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\ KurikulumModel;
use Yajra\DataTables\DataTables;
use App\AngkatanModel;
use App\JurusanModel;
use App\MataKuliahModel;
use App\TahunAjaranModel;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use App\KurikulumMatkulModel;

class Kurikulum extends Controller
{
    static $Tableshow = ["id" => ["table" => ["tablename" =>"null" , "field"=> "id"] , "record"=>"Id"],
        "row_status" => ["table" => ["tablename" =>"null" , "field"=> "row_status"] , "record"=>"Row_status"],
        ];
    static $html = ["id"=>["type"=>"null" , "value"=>"null" , "validation" => ""] ,
        "row_status"=>["type"=>"null" , "value"=>"null" , "validation" => ""] ,
    ];
    static $exclude = ["id","created_at","updated_at","created_by","update_by"];
    static $tablename = "Kurikulum";


    static $webserviceget = [
        'id_kurikulum' => 'id_kurikulum',
        'nama_kurikulum' => 'nama_kurikulum',
        'program_studi_id' => 'id_prodi',
        'mulai_berlaku' => 'id_semester',
        'jumlah_sks' => 'jumlah_sks_lulus',
        'jumlah_bobot_mata_kuliah_wajib' => 'jumlah_sks_wajib',
        'jumlah_bobot_mata_kuliah_pilihan' => 'jumlah_sks_pilihan',
        'jumlah_sks_mata_kuliah_wajib' => 'jumlah_sks_mata_kuliah_wajib',
        'jumlah_sks_mata_kuliah_pilihan' => 'jumlah_sks_mata_kuliah_pilihan',
    ];

    static $webservicegetmatkul = [
        'kurikulum_id' => 'id_kurikulum',
        'mata_kuliah_id' => 'id_matkul',
        'id_prodi' => 'id_prodi',
        'semester' => 'semester',
        'is_wajib' =>'apakah_wajib'
    ];

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
        $master['semester'] = SemesterModel::where('row_status' ,'active')->get();
        $master['jurusan'] = JurusanModel::where('row_status' ,'active')->get();

//        $data = KurikulumModel::join('master_jurusan as b' , 'kurikulum.program_studi_id' , '=' , 'b.id')
//            ->join('kurikulum_mata_kuliah as c' , 'c.kurikulum_id' ,'=' ,'kurikulum.id')
//            ->join('mata_kuliah as d' ,'d.id_matkul' ,'=','c.id')
//            ->join('master_semester', 'master_semester.id', '=','kurikulum.mulai_berlaku')
//            ->where('kurikulum.row_status' ,'=' ,'active')
//            ->select('kurikulum.id' , 'kurikulum.nama_kurikulum',
//                'master_semester.title as mulai_berlaku',
//                'b.title', 'kurikulum.jumlah_bobot_mata_kuliah_wajib',
//                'kurikulum.jumlah_bobot_mata_kuliah_pilihan',
//                'kurikulum.jumlah_sks',
//                DB::raw('SUM(d.sks_mata_kuliah) as total_matakuliah'),
//                DB::raw('(select SUM(d.sks_mata_kuliah)
//                    from `kurikulum_mata_kuliah` as c
//                    inner join `mata_kuliah` as `d` on `d`.`id` = `c`.`mata_kuliah_id`
//                    where c.is_wajib = 1 AND `kurikulum`.`id_kurikulum` = c.kurikulum_id
//                    group by `kurikulum`.`id_kurikulum`
//                ) as total_wajib '))
//            ->groupBy('kurikulum.id', 'kurikulum.nama_kurikulum' , 'master_semester.title', 'kurikulum.jumlah_bobot_mata_kuliah_wajib' ,'kurikulum.jumlah_bobot_mata_kuliah_pilihan', 'kurikulum.jumlah_sks' , 'b.title')
//            ->get();

        $data = KurikulumModel::join('master_jurusan as b' , 'kurikulum.program_studi_id' , '=' , 'b.id')
            ->join('kurikulum_mata_kuliah as c' , 'c.kurikulum_id' ,'=' ,'kurikulum.id')
            ->join('mata_kuliah as d' ,'d.id' ,'=','c.mata_kuliah_id')
            ->join('master_semester', 'master_semester.id', '=','kurikulum.mulai_berlaku')
            ->where('kurikulum.row_status' ,'=' ,'active')
            ->select('kurikulum.id' ,
                'kurikulum.nama_kurikulum',
                'kurikulum.mulai_berlaku',
                'kurikulum.jumlah_bobot_mata_kuliah_wajib',
                'kurikulum.jumlah_bobot_mata_kuliah_pilihan',
                'kurikulum.jumlah_sks','b.title',
                DB::raw('SUM(d.sks_mata_kuliah) as total_matakuliah'),
                DB::raw('(select SUM(d.sks_mata_kuliah) 
        from `kurikulum_mata_kuliah` as c
        inner join `mata_kuliah` as `d` on `d`.`id` = `c`.`mata_kuliah_id` 
        where c.is_wajib = 1 AND `kurikulum`.`id` = c.kurikulum_id
        group by `kurikulum`.`id`
        ) as total_wajib '))
            ->groupBy('kurikulum.id', 'kurikulum.nama_kurikulum' , 'master_semester.title', 'kurikulum.jumlah_bobot_mata_kuliah_wajib' ,'kurikulum.jumlah_bobot_mata_kuliah_pilihan', 'kurikulum.jumlah_sks' , 'b.title')
            ->get();

        return view("data/kurikulum" , compact('data' ,"master"));

    }
    
    public function sinc(){
        $token = $this->check_auth_siakad();
        $data = array('act'=>"GetListKurikulum" , "token"=>$token, "filter"=> "","limit"=>"" , "offset" =>0);
        $result_string = $this->runWS($data, 'json');
        $result = json_decode($result_string , true);
        if(!$result){
            $this->sinkron_log('sync_mata_kurikulum_get','gagal', 0);

            return json_encode(array('status' => 'error' , 'msg' => 'Terjadi kesalahan mensinkronkan data, silahkan coba lagi.'));
        }
        if(array_key_exists('data' , $result)){
            DB::beginTransaction();
            try{
                foreach($result['data'] as $item){
                    $service_data = [GetListKurikulum];
                    foreach(static::$webserviceget as $key=>$val){         
                        if($item[$val]){
                            $service_data[$key] = $item[$val];
                        }
                    }
                    KurikulumModel::updateOrCreate(array('id_kurikulum' => $item['id_kurikulum']) , $service_data);
                }
                DB::commit();
                $this->sinkron_log('sync_kurikulum_get','sukses', count($result['data']));

                DB::table('sinkronisasi_logs')
                ->insert(array('title' => 'GetListKurikulum' ,'created_by'=> Auth::user()->id ,'created_at'=>date('Y-m-d H:i:s')));
                return json_encode(array('status' => 'success' , 'msg' => 'Data Berhasil Disinkronisai.'));
            } catch(\Exception $e){
                DB::rollBack();
                throw $e;
                return json_encode(array('status' => 'error' , 'msg' => 'Terjadi kesalahan mensinkronkan data, silahkan coba lagi.'));
            }
        }
    }

    public function sinc_kurikulum_mata_kuliah(){
        $token = $this->check_auth_siakad();
        $data = array('act'=>"GetMatkulKurikulum" , "token"=>$token, "filter"=> "","limit"=>"" , "offset" =>0);
        $result_string = $this->runWS($data, 'json');
        $result = json_decode($result_string , true);
        if(!$result){
            $this->sinkron_log('sync_kurikulum_matkul_get','gagal', 0);

            return json_encode(array('status' => 'error' , 'msg' => 'Terjadi kesalahan mensinkronkan data, silahkan coba lagi.'));
        }

        if(array_key_exists('data' , $result)){
            DB::beginTransaction();
            try{
                foreach($result['data'] as $item){
                    $service_data = [];
                    foreach(static::$webservicegetmatkul as $key=>$val){         
                        if($item[$val]){
                            if($val == 'id_kurikulum'){
                                $kurikulum_exist = KurikulumModel::where('id_kurikulum',$item[$val])->first();
                                if(!$kurikulum_exist){
                                    return json_encode(array('status' => 'error' , 'msg' => 'Kurikulum tidak ditemukan, mohon sinkonisasi kurikulum terlebih dahulu'));
                                }else{
                                    $service_data[$key] = $kurikulum_exist->id;
                                }
                            }elseif ($val == 'id_matkul'){
                                $mata_kuliah_exist = MataKuliahModel::where('id_matkul', $item[$val])->first();
                                if(!$mata_kuliah_exist){
                                    return json_encode(array('status' => 'error' , 'msg' => 'Matakuliah tidak ditemukan, mohon sinkonisasi kurikulum terlebih dahulu'));
                                }else{
                                    $service_data[$key] = $mata_kuliah_exist->id;
                                }
                            }else{
                                $service_data[$key] = $item[$val];
                            }
                        }
                    }
                    KurikulumMatkulModel::updateOrCreate(array('kurikulum_id' => $item['id_kurikulum'] , 'mata_kuliah_id'=> $item['id_matkul'] ,'id_prodi'=>$item['id_prodi']) , $service_data);
                }
                DB::commit();
                $this->sinkron_log('sync_kurikulum_matkul_get','sukses', count($result['data']));
                DB::table('sinkronisasi_logs')
                ->insert(array('title' => 'GetMatkulKurikulum' ,'created_by'=> Auth::user()->id ,'created_at'=>date('Y-m-d H:i:s')));
                return json_encode(array('status' => 'success' , 'msg' => 'Data Berhasil Disinkronisai.'));
            } catch(\Exception $e){
                DB::rollBack();
                throw $e;
                return json_encode(array('status' => 'error' , 'msg' => 'Terjadi kesalahan mensinkronkan data, silahkan coba lagi.'));
            }
        }
    }

    public function filtering_table(Request $request){
        $ajax  = $request->all();
        $studi = $ajax['id_p'];
        $tahun = $ajax['id_t'];
        $where = [];
        $where['kurikulum.row_status'] = 'active'; 
        if($ajax['id_p'] != '' && $ajax['id_p'] != '0'){
            $where['kurikulum.program_studi_id'] = $studi;
        }
        if($ajax['id_t'] != '' && $ajax['id_t'] != '0'){
            $where['kurikulum.mulai_berlaku'] = $tahun;
        }

        $data = KurikulumModel::join('master_jurusan as b' , 'kurikulum.program_studi_id' , '=' , 'b.id')
            ->join('kurikulum_mata_kuliah as c' , 'c.kurikulum_id' ,'=' ,'kurikulum.id')
            ->join('mata_kuliah as d' ,'d.id' ,'=','c.mata_kuliah_id')
            ->join('master_semester', 'master_semester.id', '=','kurikulum.mulai_berlaku')
        ->where($where)
        ->select('kurikulum.id' ,
            'kurikulum.nama_kurikulum',
            'kurikulum.mulai_berlaku',
            'kurikulum.jumlah_bobot_mata_kuliah_wajib',
            'kurikulum.jumlah_bobot_mata_kuliah_pilihan',
            'kurikulum.jumlah_sks','b.title',
            DB::raw('SUM(d.sks_mata_kuliah) as total_matakuliah'),
            DB::raw('(select SUM(d.sks_mata_kuliah) 
        from `kurikulum_mata_kuliah` as c
        inner join `mata_kuliah` as `d` on `d`.`id` = `c`.`mata_kuliah_id` 
        where c.is_wajib = 1 AND `kurikulum`.`id` = c.kurikulum_id
        group by `kurikulum`.`id`
        ) as total_wajib '))
        ->groupBy('kurikulum.id', 'kurikulum.nama_kurikulum' , 'master_semester.title', 'kurikulum.jumlah_bobot_mata_kuliah_wajib' ,'kurikulum.jumlah_bobot_mata_kuliah_pilihan', 'kurikulum.jumlah_sks' , 'b.title')
        ->get();
        $html = '';
        $i = 0;

        foreach($data as $item){
            $i++;
            $html .= '<tr>
                        <td align="center">'.$i.'</td>
                        <td>'.$item['nama_kurikulum'].'</td>
                        <td>'.$item['title'].'</td>
                        <td>'.$item['mulai_berlaku'].'</td>
                        <td align="center">'.($item['jumlah_sks'] == '' ? 0 : $item['jumlah_sks']).'</td>
                        <td align="center">'.($item['jumlah_bobot_mata_kuliah_wajib'] == '' ? 0 : $item['jumlah_bobot_mata_kuliah_wajib']).'</td>
                        <td align="center">'.($item['jumlah_bobot_mata_kuliah_pilihan'] == '' ? 0 : $item['jumlah_bobot_mata_kuliah_pilihan']).'</td>
                        <td align="center">'.($item['total_matakuliah'] == '' ? 0 : $item['total_matakuliah']).'</td>
                        <td align="center">'.($item['total_wajib'] == '' ? 0 : $item['total_wajib']).'</td>
                        <td align="center">
                            <a style="font-size: 18px;" href="/data/kurikulum/view/'.$item['id'].'"><i class="la la-eye"></i></a> &nbsp;
                            <a style="font-size: 18px;" href="/data/kurikulum/edit/'.$item['id'].'"><i class="la la-edit"></i></a>
                        </td>
                    </tr>';
        }

        return $html ? $html : '<tr><td align="center" colspan="9">Data tidak ditemukan.</td></tr>';
    }

    public function create(){
        $master = array(
            'jurusan' => JurusanModel::where('row_status' , 'active')->get(),
            'angkatan' => AngkatanModel::where('row_status' , 'active')->get(),
            'semester' => SemesterModel::where('row_status', 'active')->get()
        );
        return view("data/kurikulum_create" , compact('master'));

    }

    public function save(Request $request){
        $data = $request->all();
        //print_r($data);
        $validation = Validator::make($data, [
            'nama_kurikulum' => 'required',
            'program_studi_id' => 'required',
            'mulai_berlaku' => 'required',
            'jumlah_bobot_mk_wajib' => 'required|numeric',
            'jumlah_bobot_mk_pilihan' => 'required|numeric'
        ]);
        
        if ($validation->fails()) {
            return json_encode(['status'=> 'error', 'msg'=> $validation->messages()]);
        }

        DB::beginTransaction();
        try{
            $master = array(
                'nama_kurikulum' => $data['nama_kurikulum'],
                'program_studi_id' =>$data['program_studi_id'],
                'mulai_berlaku' =>$data['mulai_berlaku'],
                'jumlah_sks' =>  (int)($data['jumlah_bobot_mk_wajib']) + (int)($data['jumlah_bobot_mk_pilihan']),
                'jumlah_bobot_mata_kuliah_wajib' =>$data['jumlah_bobot_mk_wajib'],
                'jumlah_bobot_mata_kuliah_pilihan' =>$data['jumlah_bobot_mk_pilihan']
            );
            $kurikulum = KurikulumModel::create($master);
            $matakuliah = array();
            //array_ke
            if(array_key_exists('matkulid' , $data)){
                foreach($data['matkulid'] as $key=>$val){
                    $wajib = 0;
                    if(array_key_exists('id' , $val)){
                        if(array_key_exists('wajib' , $val)){
                            $wajib = 1;
                        }
                        $matakuliah[] = array(
                            'kurikulum_id' =>$kurikulum->id,
                            'mata_kuliah_id' => $val['id'],
                            'semester' => $val['smstr'],
                            'is_wajib' => $wajib
                        );
                    }
                }

            }

            //print_r($matakuliah);
            $insert_mk = DB::table('kurikulum_mata_kuliah')->insert($matakuliah);
            DB::commit();
            return json_encode(array('status' => 'success' , 'msg' => 'Data berhasil disimpan.'));
        } catch(\Exception $e){
            
            DB::rollBack(); 
            throw $e;
            return json_encode(array('status' => 'error' , 'msg' => 'Terjadi kesalahan saat menyimpan, silahkan coba lagi.'));
        }
    }

    public function view($id){
        $master = array(
            'jurusan' => JurusanModel::where('row_status' , 'active')->get(),
            'angkatan' => AngkatanModel::where('row_status' , 'active')->get(),
            'semester' => SemesterModel::where('row_status', 'active')->get()
        );
        $kurikulum = KurikulumModel::where('id' , $id)->first();
        $matakuliah = DB::table('kurikulum_mata_kuliah')
        ->join('mata_kuliah' , 'mata_kuliah.id' , '=' ,'kurikulum_mata_kuliah.mata_kuliah_id')
        ->select('kurikulum_mata_kuliah.*' ,'mata_kuliah.nama_mata_kuliah', 'mata_kuliah.kode_mata_kuliah',
        'mata_kuliah.id_jenis_mata_kuliah' , 'mata_kuliah.sks_tatap_muka', 'mata_kuliah.sks_mata_kuliah' , 'mata_kuliah.sks_praktek',
        'mata_kuliah.sks_praktek_lapangan','mata_kuliah.sks_simulasi','mata_kuliah.sks_simulasi')
        ->where('kurikulum_id' , $id)
        ->get();
        return view("data/kurikulum_view" , compact('master' ,'kurikulum' ,'matakuliah'));
    }


    public function paging(Request $request){
        return Datatables::of(KurikulumModel::all())->addIndexColumn()->make(true);
    }

    public function edit($id){
        $master = array(
            'jurusan' => JurusanModel::where('row_status' , 'active')->get(),
            'angkatan' => AngkatanModel::where('row_status' , 'active')->get(),
            'semester' => SemesterModel::where('row_status', 'active')->get()
        );
        $kurikulum = KurikulumModel::where('id' , $id)->first();
        $matakuliah = DB::table('kurikulum_mata_kuliah')
        ->join('mata_kuliah' , 'mata_kuliah.id' , '=' ,'kurikulum_mata_kuliah.mata_kuliah_id')
        ->select('kurikulum_mata_kuliah.*' ,'mata_kuliah.nama_mata_kuliah', 'mata_kuliah.kode_mata_kuliah',
        'mata_kuliah.id_jenis_mata_kuliah' , 'mata_kuliah.sks_tatap_muka', 'mata_kuliah.sks_mata_kuliah' , 'mata_kuliah.sks_praktek',
        'mata_kuliah.sks_praktek_lapangan','mata_kuliah.sks_simulasi','mata_kuliah.sks_simulasi')
        ->where('kurikulum_id' , $id)
        ->get();
        
        return view("data/kurikulum_edit" , compact('master' ,'kurikulum' ,'matakuliah'));
    }

    public function carimatakuliah(Request $request){
        $post = $request->all();
        //print_r($post); exit;
        $matakuliah = MataKuliahModel::where('program_studi_id' , $post['id'])
        ->where('row_status' , 'active')->get();

        //print_r($matakuliah); exit;
        $html = '';
        if($matakuliah){
            foreach($matakuliah as $item){
                $html .= '<tr>
                <td><input type="checkbox" attr="'.$item['bobot_mata_kuliah'].'" class="matakuliah-chck" name="matkulid['.$item['id'].'][id]" value="'.$item['id'].'"/></td>
                <td>'.$item['kode_mata_kuliah'].'</td>
                <td>'.$item['nama_mata_kuliah'].'</td>
                <td align="center">'.$item['jenis_mata_kuliah'].'</td>
                <td align="center">'.$item['bobot_tatap_muka'].'</td>
                <td align="center">'.$item['bobot_praktikum'].'</td>
                <td align="center">'.$item['bobot_praktek_lapangan'].'</td>
                <td align="center">'.$item['bobot_simulasi'].'</td>
                <td align="center">
                    <select class="form-control form-control-sm" name="matkulid['.$item['id'].'][smstr]">
                        <option>1</option>
                        <option>2</option>
                        <option>3</option>
                        <option>4</option>
                        <option>5</option>
                        <option>6</option>
                        <option>7</option>
                        <option>8</option>
                    </select>
                </td>
                <td align="center"><input class="wajib-chck" attr="'.$item['bobot_mata_kuliah'].'" type="checkbox" class="form-control-sm" name="matkulid['.$item['id'].'][wajib]" value="wajib"></td></td>
                <!--dipakai untuk view-->
                <!--<td align="center"><span class="flaticon2-cancel-music"></span> </td>-->
            </tr>';
            }
        }
        return $html ? $html : '<td colspan="10" style="text-align: center">Matakuliah Tidak Tersedia.</td>';
    }

    public function update(Request $request){
        $data = $request->all();

        $validation = Validator::make($data, [
            'kurikulum_id' => 'required',
            'nama_kurikulum' => 'required',
            'program_studi_id' => 'required',
            'mulai_berlaku' => 'required',
            'jumlah_bobot_mk_wajib' => 'required|numeric',
            'jumlah_bobot_mk_pilihan' => 'required|numeric'
        ]);

        $kurikulum_id = $data['kurikulum_id'];
        
        if ($validation->fails()) {
            return json_encode(['status'=> 'error', 'msg'=> $validation->messages()]);
        }

        DB::beginTransaction();
        try{
           DB::table('kurikulum_mata_kuliah')->where('kurikulum_id' , $kurikulum_id)->delete();
            $master = array(
                'nama_kurikulum' => $data['nama_kurikulum'],
                'program_studi_id' =>$data['program_studi_id'],
                'mulai_berlaku' =>$data['mulai_berlaku'],
                'jumlah_sks' =>  (int)($data['jumlah_bobot_mk_wajib']) + (int)($data['jumlah_bobot_mk_pilihan']),
                'jumlah_bobot_mata_kuliah_wajib' =>$data['jumlah_bobot_mk_wajib'],
                'jumlah_bobot_mata_kuliah_pilihan' =>$data['jumlah_bobot_mk_pilihan']
            );
            KurikulumModel::where('id' , $kurikulum_id)->update($master);
            $matakuliah = array();
            //array_ke
            if(array_key_exists('matkulid' , $data)){
                foreach($data['matkulid'] as $key=>$val){
                    $wajib = 0;
                    if(array_key_exists('id' , $val)){
                        if(array_key_exists('wajib' , $val)){
                            $wajib = 1;
                        }
                        $matakuliah[] = array(
                            'kurikulum_id' =>$kurikulum_id,
                            'mata_kuliah_id' => $val['id'],
                            'semester' => $val['smstr'],
                            'is_wajib' => $wajib
                        );
                    }
                }

            }

            //print_r($matakuliah);
            DB::table('kurikulum_mata_kuliah')->insert($matakuliah);

            DB::commit();
            return json_encode(array('status' => 'success' , 'msg' => 'Data berhasil disimpan.'));
        } catch(\Exception $e){
            
            DB::rollBack(); 
            throw $e;
            return json_encode(array('status' => 'error' , 'msg' => 'Terjadi kesalahan saat menyimpan, silahkan coba lagi.'));
        }
    }

}
