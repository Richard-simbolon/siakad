<?php
namespace App\Http\Controllers;
use App\DosenModel;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\ MahasiswaModel;
use App\MahasiswaOrangtuaModel;
use App\MahasiswaOrangtuawaliModel;
use App\MahasiswaKebutuhanModel;
use App\AgamaModel;
use App\AlatTransportasiModel;
use App\KebutuhanKhususModel;
use App\JurusanModel;
use App\JenispendaftaranModel;
use App\JenisPembiayaanModel;
use App\AsalProgramStudiModel;
use App\JalurPendaftaranModel;
use App\TinggalModel;
use App\PenghasilanModel;
use App\PendidikanModel;
use App\StatusMahasiswaModel;
use App\PekerjaanModel;
use App\AngkatanModel;
use App\MahasiswaPendidikanModel;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\Auth;
use App\KelasModel;

class DosenModule extends Controller
{
    static $Tableshow = ["id" => ["table" => ["tablename" =>"null" , "field"=> "id"] , "record"=>"Id"],
        ];
    static $html = ["id"=>["type"=>"null" , "value"=>"null" , "validation" => ""] ,
];
    static $exclude = ["id","created_at","updated_at","created_by","update_by"];
    static $tablename = "Dosen";

    public function profile()
    {
        $data = DosenModel::where('nik' , '=',Auth::user()->id)
//            ->join('master_kelas', 'master_kelas.id', '=', 'mahasiswa.kelas_id')
//            ->join('master_angkatan', 'master_angkatan.id', '=', 'mahasiswa.angkatan')
//            ->join('master_jurusan', 'master_jurusan.id', '=', 'mahasiswa.jurusan_id')
//            ->select('mahasiswa.*', 'master_kelas.title as kelas', 'master_angkatan.title as angkatan', 'master_jurusan.title as jurusan')
            ->first();

        $master = array(
            'agama' => AgamaModel::where('row_status' , 'active')->get()
        );
        $menu['submenu'] = "profile";
        $title = ucfirst(request()->segment(1))." ".ucfirst(request()->segment(2));
        //$count=DB::table('mahasiswa_prestasi')->where('mahasiswa_id' , $data['id'])->count();

        $exclude = static::$exclude;
        $Tableshow = static::$Tableshow;
        return view("data/profile_dosen" , compact("data" , "title"  ,"exclude" ,"Tableshow", "master", "menu"));

    }

    public function biodata()
    {
        $data = DosenModel::where('nik' , '=',Auth::user()->id)
//            ->join('master_kelas', 'master_kelas.id', '=', 'mahasiswa.kelas_id')
//            ->join('master_angkatan', 'master_angkatan.id', '=', 'mahasiswa.angkatan')
//            ->join('master_jurusan', 'master_jurusan.id', '=', 'mahasiswa.jurusan_id')
//            ->select('mahasiswa.*', 'master_kelas.title as kelas', 'master_angkatan.title as angkatan', 'master_jurusan.title as jurusan')
            ->first();

        $master = array(
            'agama' => AgamaModel::where('row_status' , 'active')->get()
        );
        $menu['submenu'] = "biodata";
        $title = ucfirst(request()->segment(1))." ".ucfirst(request()->segment(2));
        //$count=DB::table('mahasiswa_prestasi')->where('mahasiswa_id' , $data['id'])->count();

        $exclude = static::$exclude;
        $Tableshow = static::$Tableshow;
        return view("data/dosen_biodata" , compact("data" , "title"  ,"exclude" ,"Tableshow", "master", "menu"));

    }


    public function submitprofile(Request $request){
        $input = $request->all();
        $data = MahasiswaModel::where('id','=',$input['id'])->first();

        if($data){
            $data->nik = $input['nik'];
            $data->nama = $input['nama'];
            $data->tempat_lahir = $input['tempat_lahir'];
            $data->tanggal_lahir = $input['tanggal_lahir'];
            $data->agama = $input['agama'];
            $data->jk = $input['jk'];
            $data->no_telepon = $input['no_telepon'];
            $data->email = $input['email'];

            if($data->save()){
                return $this->success("Data berhasil disimpan.");
            }else{
                return json_encode(["status"=> false, "msg"=> "Mohon maaf, terjadi kesalahan sistem"]);
            }
        }else{
            return json_encode(["status"=> false, "message"=> "Data tidak ditemukan"]);
        }
    }

    public function keluarga()
    {
        $data = DosenModel::where('nik' , '=',Auth::user()->id)
//            ->join('master_kelas', 'master_kelas.id', '=', 'mahasiswa.kelas_id')
//            ->join('master_angkatan', 'master_angkatan.id', '=', 'mahasiswa.angkatan')
//            ->join('master_jurusan', 'master_jurusan.id', '=', 'mahasiswa.jurusan_id')
//            ->select('mahasiswa.*', 'master_kelas.title as kelas', 'master_angkatan.title as angkatan', 'master_jurusan.title as jurusan')
            ->first();

        $master = array(
            'pekerjaan' => PekerjaanModel::where('row_status' , 'active')->get(),
        );

        $menu['submenu'] = "keluarga";
        $title = ucfirst(request()->segment(1))." ".ucfirst(request()->segment(2));
        $count=DB::table('mahasiswa_prestasi')->where('mahasiswa_id' , $data['id'])->count();

        $exclude = static::$exclude;
        $Tableshow = static::$Tableshow;
        return view("data/dosen_keluarga" , compact("data" , "title"  ,"exclude" ,"Tableshow", "master", "menu"));

    }

    public function kebutuhankhusus()
    {
        $data = DosenModel::join('master_agama', 'master_agama.id', '=', 'dosen.agama')
            ->join('dosen_keluarga' , 'dosen_keluarga.dosen_id' ,'=' , 'dosen.id')
            ->join('dosen_kebutuhan_khusus' , 'dosen_kebutuhan_khusus.dosen_id' , '=' , 'dosen.id')
            ->select('dosen.*','dosen_keluarga.pekerjaan' ,'dosen_keluarga.tmt_pns' ,'dosen_keluarga.nip_pasangan','dosen_keluarga.nama_pasangan','dosen_keluarga.status_pernikahan', 'master_agama.title' , 'dosen_kebutuhan_khusus.kebutuhan_khusus' , 'dosen_kebutuhan_khusus.braile' , 'dosen_kebutuhan_khusus.isyarat')
            ->where('dosen.nik' , Auth::user()->id)->first();

        $master = array(
            'kebutuhan' => KebutuhanKhususModel::where('row_status' , 'active')->get(),
        );
        $kebutuhan_selected = MahasiswaKebutuhanModel::where('mahasiswa_id' , $data['id'])->first();
        $title = ucfirst(request()->segment(1))." ".ucfirst(request()->segment(2));
        $menu['submenu'] = "kebutuhan_khusus";
        $exclude = static::$exclude;
        $Tableshow = static::$Tableshow;
        return view("data/dosen_kebutuhan_khusus" , compact("data" , "title"  ,"exclude" ,"Tableshow", "master", "kebutuhan_selected", "menu"));

    }

    public function submitkebutuhankhusus(Request $request){
        $data = $request->all();
        try{
            $data_kebutuhan_khusus = array(
                'row_status' => 'active',
                'updated_by' => Auth::user()->id,
                'kebutuhan_mahasiswa' => array_key_exists('mahasiswa_kh' , $data) ? json_encode(array('mahasiswa' => $data['mahasiswa_kh'])) : json_encode(array('mahasiswa' =>[])),
                'kebutuhan_ayah' =>array_key_exists('ayah_kh' , $data) ? json_encode(array('ayah' =>$data['ayah_kh'])) : json_encode(array('ayah' =>[])),
                'kebutuhan_ibu' =>array_key_exists('ibu_kh' , $data) ? json_encode(array('ibu'=>$data['ibu_kh'])) : json_encode(array('ibu' =>[])),
            );
            MahasiswaKebutuhanModel::where('mahasiswa_id' , $data['mahasiswa_id'])->update($data_kebutuhan_khusus);

            return json_encode(array('status' => true , 'message' => 'Data berhasil disimpan.'));
        } catch(\Exception $e){
            throw $e;
            return json_encode(array('status' => false , 'message' => 'Terjadi kesalahan saat menyimpan, silahkan coba lagi.'));
        }
    }

    public function gantipassword()
    {
        $data = MahasiswaModel::where('nim' , '=',Auth::user()->id)
            ->join('master_kelas', 'master_kelas.id', '=', 'mahasiswa.kelas_id')
            ->join('master_angkatan', 'master_angkatan.id', '=', 'mahasiswa.angkatan')
            ->join('master_jurusan', 'master_jurusan.id', '=', 'mahasiswa.jurusan_id')
            ->select('mahasiswa.*', 'master_kelas.title as kelas', 'master_angkatan.title as angkatan', 'master_jurusan.title as jurusan')
            ->first();

        $title = ucfirst(request()->segment(1))." ".ucfirst(request()->segment(2));

        $menu['submenu'] = "password";
        $exclude = static::$exclude;
        $Tableshow = static::$Tableshow;

        return view("data/dosen_ganti_password" , compact("data" , "title"  ,"exclude" ,"Tableshow", "menu"));
    }

    public function submit_gantipassword(Request $request){
        $input = $request->all();
        $data = MahasiswaModel::where('id' , '=',$input['id'])->first();

        if($data){
            $password_old = $data->password;
            if(!$input['password_lama'] || $input['password_lama'] == ''){
                return json_encode(["status"=> false, "message"=> "Password lama wajib diisi"]);
            }elseif (!$input['konfirmasi'] || $input['konfirmasi'] ==''){
                return json_encode(["status"=> false, "message"=> "Konfirmasi Password baru wajib diisi"]);
            }else if(!$input['password_baru'] || $input['password_baru'] == ''){
                return json_encode(["status"=> false, "message"=> "Password baru wajib diisi"]);
            }

            if($input['password_baru'] != $input['konfirmasi']){
                return json_encode(["status"=> false, "message"=> "Password baru dan konfirmasi tidak sama"]);
            }

            return json_encode(["status"=> true, "message"=> "Password sudah diubuah"]);
        }else{
            return json_encode(["status"=> false, "message"=> "Data tidak ditemukan"]);
        }
    }
}
