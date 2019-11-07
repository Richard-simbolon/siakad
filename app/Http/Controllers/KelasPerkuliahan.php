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
use App\MahasiswaModel;
use App\MataKuliahModel;
use App\DosenModel;
use App\KurikulumModel;

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
            'kelas' => KelasModel::where('row_status' , 'active')->get(),
            'semester'=> SemesterModel::where('row_status', 'active')->get(),
        );
        //print_r($master); exit;
        $data = DB::table('view_kelas_perkuliahan')->get();
        $title = ucfirst(request()->segment(1))." ".ucfirst(request()->segment(2));
        $tableid = "KelasPerkuliahan";
        $table_display = DB::getSchemaBuilder()->getColumnListing(static::$tablename);
        $exclude = static::$exclude;
        $Tableshow = static::$Tableshow;
        return view("data/kelas_perkuliahan" , compact("data" , "title" ,"table_display" ,"exclude" ,"Tableshow","tableid", "master"));

    }

    public function filtering_kelas_perkuliahan_index(Request $request){
        $post = $request->all();
        //print_r($post);
        $where = [];
        foreach($post['filter'] as $key=>$val){
            if($val){
                $where[$key] = $val;
            }
        }

        //print_r($where);
        if(count($where) > 0){
            $data = DB::table('view_kelas_perkuliahan')->where($where)->get();
        }else{
            $data = DB::table('view_kelas_perkuliahan')->get();
        }
        $html = '';
        $i = 0;
        foreach($data as $item){
            $i++;
            $html .= ' <tr>
                            <td align="center">'.$i.'</td>
                            <td align="center">'.$item->angkatan.'</td>
                            <td>'.$item->semester.'</td>
                            <td style="vertical-align: center;">'.$item->jurusan.'</td>
                            <td align="center">'.$item->kelas.'</td>
                            <td align="center">'.$item->sks.'</td>
                            <td align="center">'.$item->total_mhs.'</td>
                            <td>Edit/View</td>
                        </tr>';
        }

        return $html ? $html : '<tr><td colspan="8" align="center">Tidak ada record.</td></tr>';

        
    }

    public function create(){
        $master = array(
            'jurusan' => JurusanModel::where('row_status' , 'active')->get(),
            //'kelas' => KelasModel::where('row_status' , 'active')->get(),
            'angkatan' => AngkatanModel::where('row_status' , 'active')->get(),
            'semester'=> SemesterModel::where('row_status', 'active')->get(),

        );
        $title = "Tambah ".ucfirst(request()->segment(1))." ".ucfirst(request()->segment(2));

        return view("data/kelas_perkuliahan_create" , compact("title" , "column" ,'master'));

    }

    public function save_kelas_perkuliahan(Request $request){
        $post = $request->all();

        $validation = Validator::make($post, [
            'semester_id' => 'required',
            'angkatan_id' => 'required',
            'program_studi_id' => 'required',
            'kelas_id' => 'required'
        ]);

        if ($validation->fails()) {
            return json_encode(['status'=> 'error', 'message'=> $validation->messages()]);
        }

        // CHECK IF SEMERSTER IS AVAILABLE FOR THIS KELAS
        if(KelasPerkuliahanModel::where('semester_id' , $post['semester_id'])
        ->where('program_studi_id' , $post['program_studi_id'])
        ->where('kelas_id' , $post['kelas_id'])->exists()){
             return json_encode(['status'=> 'error', 'message'=> array('msg' =>['Data untuk semester sudah ada periksa kembali.'])]);
        }
        
        $detail = [];
        foreach($post['item'] as $val){
            if(array_key_exists('mata_kuliah_id' , $val) ){
                if($val['dosen_id'] == '' || $val['hari_id'] == '' || $val['ruangan'] == ''|| $val['jam'] == ''){
                    return json_encode(['status'=> 'error', 'message'=> array('msg' =>['Silahkan isi semua field kolom.'])]);
                }else{
                    $detail[] = $val;
                }
            }
        }
        //print_r($post['item']);
        if(count($detail) < 1){
            return json_encode(['status'=> 'error', 'message'=> array('msg' =>['Silahkan beri tanda ceklis pada matakuliah.'])]);
        }

        $master = [
            'semester_id' => $post['semester_id'],
            'angkatan_id' => $post['angkatan_id'],
            'program_studi_id' => $post['program_studi_id'],
            'kelas_id' => $post['kelas_id']
        ];
        DB::beginTransaction();
        try{

            // SAVE TO TABLE kelas perkulahan
            $perkuliahanid = KelasPerkuliahanModel::create($master);
            $items = [];
            // save to table kelas perkuliahan mata kuliah
            foreach($detail as $item){
                $item['kelas_perkuliahan_id'] = $perkuliahanid->id;
                $items[] = $item;
            }
            //print_r($items);
            DB::table('kelas_perkuliahan_mata_kuliah')->insert($items);

            DB::commit();
            return json_encode(array('status' => 'success' , 'message' => 'Data berhasil disimpan.'));
        } catch(\Exception $e){
            DB::rollBack(); 
            throw $e;
            return json_encode(array('status' => 'error' , 'message' => 'Terjadi kesalahan saat menyimpan, silahkan coba lagi.'));
        }
        
    }


    public function update_kelas_perkuliahan(Request $request){
        $post = $request->all();
        $detail = [];
        foreach($post['item'] as $val){
            if(array_key_exists('mata_kuliah_id' , $val) ){
                if($val['dosen_id'] == '' || $val['hari_id'] == '' || $val['ruangan'] == ''|| $val['jam'] == ''){
                    return json_encode(['status'=> 'error', 'message'=> array('msg' =>['Silahkan isi semua field kolom.'])]);
                }else{
                    $detail[] = $val;
                }
            }
        }
        DB::beginTransaction();
        try{
            DB::table('kelas_perkuliahan_mata_kuliah')->where('kelas_perkuliahan_id' , $post['update'])->delete();
            $items = [];
            foreach($detail as $item){
                $item['kelas_perkuliahan_id'] = $post['update'];
                $items[] = $item;
            }
            DB::table('kelas_perkuliahan_mata_kuliah')->insert($items);
            DB::commit();
            return json_encode(array('status' => 'success' , 'message' => 'Data berhasil disimpan.'));
        } catch(\Exception $e){
            DB::rollBack(); 
            throw $e;
            return json_encode(array('status' => 'error' , 'message' => 'Terjadi kesalahan saat menyimpan, silahkan coba lagi.'));
        }
        
    }

    public function update_kelas_perkuliahan_table(Request $request){
        $post = $request->all();
        $data = KelasPerkuliahanModel::join('master_angkatan' , 'master_angkatan.id' ,'=' ,'kelas_perkuliahan.angkatan_id')
        ->join('master_jurusan' , 'master_jurusan.id' ,'=' ,'kelas_perkuliahan.program_studi_id')
        ->join('master_kelas' , 'master_kelas.id' ,'=' ,'kelas_perkuliahan.kelas_id')
        ->join('master_semester' , 'master_semester.id' ,'=' ,'kelas_perkuliahan.semester_id')
        ->join('mahasiswa' , 'mahasiswa.kelas_id' ,'=' ,'kelas_perkuliahan.kelas_id')
        ->select('kelas_perkuliahan.id',
        DB::raw('(SELECT count(mahasiswa.id) as mahasiswa FROM mahasiswa WHERE kelas_id = 5) as mahasiswa') 
        ,'master_angkatan.title as angktan' ,'master_kelas.title as kelas' ,'master_jurusan.title as jurusan' ,'master_semester.title as semester')
        ->where('kelas_perkuliahan.row_status', 'active')->get();

    }


    public function view($id){
        $master = array(
            //'jurusan' => JurusanModel::where('row_status' , 'active')->get(),
            //'kelas' => KelasModel::where('row_status' , 'active')->get(),
            //'kurikulum' => KurikulumModel::where('row_status' , 'active')->get(),
            //'angkatan' => AngkatanModel::where('row_status' , 'active')->get(),
            //'semester'=> SemesterModel::where('row_status', 'active')->get(),
            'dosen' => DosenModel::where('row_status' , 'active')->get()
        );
        //$dosen = DosenModel::where('row_status' , 'active')->get();
        
        $kurikulum = DB::table('kelas_perkuliahan')
        ->join('master_kelas' , 'master_kelas.id' , '=' , 'kelas_perkuliahan.kelas_id')
        ->join('kurikulum' , 'kurikulum.id' , '=' , 'master_kelas.kurikulum_id')
        ->join('master_angkatan' , 'master_angkatan.id' , '=' , 'kelas_perkuliahan.angkatan_id')
        ->join('master_jurusan' , 'master_jurusan.id' , '=' , 'kelas_perkuliahan.program_studi_id')
        ->join('master_semester' , 'master_semester.id' , '=' , 'kelas_perkuliahan.semester_id')
        ->where('kelas_perkuliahan.id' ,$id)->select('kurikulum.nama_kurikulum','master_semester.title as nama_semester','master_jurusan.title as nama_jurusan','master_angkatan.title as nama_angkatan','master_kelas.title as nama_kelas','kurikulum.id as kurikulum_id', 'kelas_perkuliahan.*')->first();
        if(!$kurikulum){
            return 'data tidak di temukan';
        }
        $kur_id = $kurikulum->id;

        ///echo $kur_id ; exit;
        
        $matakuliah = DB::table('kurikulum_mata_kuliah')
        ->join('mata_kuliah' , 'mata_kuliah.id' , '=' , 'kurikulum_mata_kuliah.mata_kuliah_id')
        //->leftJoin('kelas_perkuliahan_mata_kuliah' , 'kelas_perkuliahan_mata_kuliah.mata_kuliah_id' , '=' , 'mata_kuliah.id')
        ->leftJoin('kelas_perkuliahan_mata_kuliah', function ($join ) use($id) {
            $join->on('kelas_perkuliahan_mata_kuliah.mata_kuliah_id', '=', 'mata_kuliah.id')
                 ->where('kelas_perkuliahan_mata_kuliah.kelas_perkuliahan_id', '=', $id , DB::raw('AND'));
        })
        ->where('kurikulum_mata_kuliah.row_status' , 'active')
        ->where('kurikulum_mata_kuliah.kurikulum_id',$kurikulum->kurikulum_id)
        ->select('mata_kuliah.*' ,'mata_kuliah.id as matakuliah_id','kurikulum_mata_kuliah.semester','kelas_perkuliahan_mata_kuliah.*')
        ->get();
        $title = "Edit ".ucfirst(request()->segment(1))." ".ucfirst(request()->segment(2));
        return view("data/kelas_perkuliahan_view" , compact("title" , "matakuliah" ,"kurikulum",'master'));
    }

    public function listmatakuliah(Request $request){
        $post = $request->all();
        $dosen = DosenModel::where('row_status' , 'active')->get();
        $dosen_html = '<option value="0"> -- Pilih dosen --</option>';
        foreach($dosen as $item){
            $dosen_html .= '<option value="'.$item['id'].'"> '.$item['nama'].'</option>';
        }
        $kurikulum = KurikulumModel::where('id' ,$post['kelas'])->select('nama_kurikulum')->first();
        $matakuliah = DB::table('kurikulum_mata_kuliah')->join('mata_kuliah' , 'mata_kuliah.id' , '=' , 'kurikulum_mata_kuliah.mata_kuliah_id')
        ->where('kurikulum_mata_kuliah.row_status' , 'active')
        ->where('kurikulum_mata_kuliah.kurikulum_id',$post['kelas'])
        ->select('mata_kuliah.*' ,'kurikulum_mata_kuliah.semester')
        ->get();
        $html = '';
        foreach($matakuliah as $item){
            $html .= '
                    <tr>
                        <td align="center"><input type="checkbox" name="item['.$item->id.'][mata_kuliah_id]" value="'.$item->id.'" class="form-control-sm"></td></td>
                        <td>'.$item->kode_mata_kuliah.'</td>
                        <td>'.$item->nama_mata_kuliah.'</td>
                        <td align="center">'.$item->bobot_mata_kuliah.'</td>
                        <td align="center">'.$item->semester.'</td>
                        <td>
                            <select class="form-control form-control-sm kt-select2" name="item['.$item->id.'][dosen_id]">
                                '.$dosen_html.'
                            </select>
                        </td>
                        <td align="center"><input type="text" name="item['.$item->id.'][asisten]" class="form-control form-control-sm" /> </td>
                        <td align="center">
                            <select class="form-control form-control-sm" name="item['.$item->id.'][hari_id]">
                                <option value="1">Senin</option>
                                <option value="2">Selasa</option>
                                <option value="3">Rabu</option>
                                <option value="4">Kamis</option>
                                <option value="5">Jumat</option>
                                <option value="6">Sabtu</option>
                            </select>
                        </td>
                        <td align="center">
                            <input type="text"class="form-control form-control-sm"  name="item['.$item->id.'][ruangan]"/>
                        </td>
                        <td align="center">
                            <div class="input-group timepicker">
                                <input type="text" name="item['.$item->id.'][jam]" class="form-control m-input time-picker" placeholder="Pilih Jam" type="text"/>
                            </div>
                        </td>
                    </tr>
        ';
        }

        $htmls =   '<table class="table table-striped table-bordered table-hover responsive" id="table-matakuliah">
                        <thead>
                        <tr>
                            <th>Pilih</th>
                            <th>Kode</th>
                            <th>Matakuliah</th>
                            <th>SKS</th>
                            <th>Semester</th>
                            <th>Dosen</th>
                            <th>Asisten</th>
                            <th>Hari</th>
                            <th>Ruangan</th>
                            <th>Jam</th>
                        </tr>
                        </thead>
                        <tbody>
                            '.$html.'
                        </tbody>
                    </table>';
        return array('html'=>$htmls , 'nama' => $kurikulum);
        
        
       
    }
}
