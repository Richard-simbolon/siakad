<?php
namespace App\Http\Controllers;
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

class MahasiswaModule extends Controller
{
    static $Tableshow = ["id" => ["table" => ["tablename" =>"null" , "field"=> "id"] , "record"=>"Id"],
        ];
    static $html = ["id"=>["type"=>"null" , "value"=>"null" , "validation" => ""] ,
];
    static $exclude = ["id","created_at","updated_at","created_by","update_by"];
    static $tablename = "Mahasiswa";
    public function index()
    {

        $master = array(
            'jurusan' => JurusanModel::where('row_status' , 'active')->get(),
            'jenis_pendaftaran' => JenisPendaftaranModel::where('row_status' , 'active')->get(),
            'jalur_pendaftaran' => JalurPendaftaranModel::where('row_status' , 'active')->get(),
            'asal_studi' => AsalProgramStudiModel::where('row_status' , 'active')->get(),
            'jenis_tinggal' => TinggalModel::where('row_status' , 'active')->get(),
            'alat_transportasi' => AlatTransportasiModel::where('row_status' , 'active')->get(),
            'pendidikan' => PendidikanModel::where('row_status' , 'active')->get(),
            'jenis_pembiayaan' => JenisPembiayaanModel::where('row_status' , 'active')->get(),
            'kelas' => KelasModel::where('row_status' , 'active')->get(),
            'pekerjaan' => PekerjaanModel::where('row_status' , 'active')->get(),
            'penghasilan' => PenghasilanModel::where('row_status' , 'active')->get(),
            'kebutuhan' => KebutuhanKhususModel::where('row_status' , 'active')->get(),
            'agama' => AgamaModel::where('row_status' , 'active')->get(),
            'angkatan' => AngkatanModel::where('row_status' , 'active')->get(),
            'status_mahasiswa' => StatusMahasiswaModel::where('row_status' , 'active')->get()
        );
        

        /*$master = array(
            'jurusan' => JurusanModel::where('row_status' , 'active')->get(),
            'jenis_kelamin' => array('Laki-Laki' , 'Perempuan'),
            'status_kuliah' => StatusMahasisiwa::where('row_status' , 'active')->get(),
            'angkatan' => Angkatan::where('row_status' , 'active')->get(),
            'agama' => AgamaModel::where('row_status' , 'active')->get()
        );*/
        $data = MahasiswaModel::get();
        $title = ucfirst(request()->segment(1))." ".ucfirst(request()->segment(2));
        $tableid = "Mahasiswa";
        $table_display = DB::getSchemaBuilder()->getColumnListing("mahasiswa");
        $exclude = static::$exclude;
        $Tableshow = static::$Tableshow;
        return view("data/mahasiswa" , compact("data" , "title" ,"table_display" ,"exclude" ,"master","tableid"));

    }

    public function profile()
    {
        $data = MahasiswaModel::where('nim' , '=',Auth::user()->id)
            ->join('master_kelas', 'master_kelas.id', '=', 'mahasiswa.kelas_id')
            ->join('master_angkatan', 'master_angkatan.id', '=', 'mahasiswa.angkatan')
            ->join('master_jurusan', 'master_jurusan.id', '=', 'mahasiswa.jurusan_id')
            ->select('mahasiswa.*', 'master_kelas.title as kelas', 'master_angkatan.title as angkatan', 'master_jurusan.title as jurusan')
            ->first();

        $master = array(
            'agama' => AgamaModel::where('row_status' , 'active')->get()
        );

        $title = ucfirst(request()->segment(1))." ".ucfirst(request()->segment(2));

        $exclude = static::$exclude;
        $Tableshow = static::$Tableshow;
        return view("data/profile_mahasiswa" , compact("data" , "title"  ,"exclude" ,"Tableshow", "master"));

    }

    public function alamat()
    {
        $data = MahasiswaModel::where('nim' , '=',Auth::user()->id)
            ->join('master_kelas', 'master_kelas.id', '=', 'mahasiswa.kelas_id')
            ->join('master_angkatan', 'master_angkatan.id', '=', 'mahasiswa.angkatan')
            ->join('master_jurusan', 'master_jurusan.id', '=', 'mahasiswa.jurusan_id')
            ->select('mahasiswa.*', 'master_kelas.title as kelas', 'master_angkatan.title as angkatan', 'master_jurusan.title as jurusan')
            ->first();

        $master = array(
            'jenis_tinggal' => TinggalModel::where('row_status' , 'active')->get(),
            'alat_transportasi' => AlatTransportasiModel::where('row_status' , 'active')->get(),
        );

        $title = ucfirst(request()->segment(1))." ".ucfirst(request()->segment(2));

        $exclude = static::$exclude;
        $Tableshow = static::$Tableshow;
        return view("data/mahasiswa_alamat" , compact("data" , "title"  ,"exclude" ,"Tableshow", "master"));

    }

    public function orangtua()
    {
        $data = MahasiswaModel::where('nim' , '=',Auth::user()->id)
            ->join('master_kelas', 'master_kelas.id', '=', 'mahasiswa.kelas_id')
            ->join('master_angkatan', 'master_angkatan.id', '=', 'mahasiswa.angkatan')
            ->join('master_jurusan', 'master_jurusan.id', '=', 'mahasiswa.jurusan_id')
            ->select('mahasiswa.*', 'master_kelas.title as kelas', 'master_angkatan.title as angkatan', 'master_jurusan.title as jurusan')
            ->first();

        $orangtuawali = MahasiswaOrangtuawaliModel::where('mahasiswa_id' , $data['id'])->get();
        $master = array(
            'pekerjaan' => PekerjaanModel::where('row_status' , 'active')->get(),
            'penghasilan' => PenghasilanModel::where('row_status' , 'active')->get(),
            'pendidikan' => PendidikanModel::where('row_status' , 'active')->get(),
        );

        $title = ucfirst(request()->segment(1))." ".ucfirst(request()->segment(2));

        $exclude = static::$exclude;
        $Tableshow = static::$Tableshow;
        return view("data/mahasiswa_orangtua" , compact("data","orangtuawali" , "title"  ,"exclude" ,"Tableshow", "master"));

    }

    public function wali()
    {
        $data = MahasiswaModel::where('nim' , '=',Auth::user()->id)
            ->join('master_kelas', 'master_kelas.id', '=', 'mahasiswa.kelas_id')
            ->join('master_angkatan', 'master_angkatan.id', '=', 'mahasiswa.angkatan')
            ->join('master_jurusan', 'master_jurusan.id', '=', 'mahasiswa.jurusan_id')
            ->select('mahasiswa.*', 'master_kelas.title as kelas', 'master_angkatan.title as angkatan', 'master_jurusan.title as jurusan')
            ->first();

        $orangtuawali = MahasiswaOrangtuawaliModel::where('mahasiswa_id' , $data['id'])->get();
        $master = array(
            'pekerjaan' => PekerjaanModel::where('row_status' , 'active')->get(),
            'penghasilan' => PenghasilanModel::where('row_status' , 'active')->get(),
            'pendidikan' => PendidikanModel::where('row_status' , 'active')->get(),
        );

        $title = ucfirst(request()->segment(1))." ".ucfirst(request()->segment(2));

        $exclude = static::$exclude;
        $Tableshow = static::$Tableshow;
        return view("data/mahasiswa_wali" , compact("data","orangtuawali", "title"  ,"exclude" ,"Tableshow", "master"));

    }

    public function kebutuhankhusus()
    {
        $data = MahasiswaModel::where('nim' , '=',Auth::user()->id)
            ->join('master_kelas', 'master_kelas.id', '=', 'mahasiswa.kelas_id')
            ->join('master_angkatan', 'master_angkatan.id', '=', 'mahasiswa.angkatan')
            ->join('master_jurusan', 'master_jurusan.id', '=', 'mahasiswa.jurusan_id')
            ->select('mahasiswa.*', 'master_kelas.title as kelas', 'master_angkatan.title as angkatan', 'master_jurusan.title as jurusan')
            ->first();

        $master = array(
            'jenis_tinggal' => TinggalModel::where('row_status' , 'active')->get(),
            'alat_transportasi' => AlatTransportasiModel::where('row_status' , 'active')->get(),
            'kebutuhan' => KebutuhanKhususModel::where('row_status' , 'active')->get(),
        );
        $kebutuhan_selected = MahasiswaKebutuhanModel::where('mahasiswa_id' , $data['id'])->first();
        $title = ucfirst(request()->segment(1))." ".ucfirst(request()->segment(2));

        $exclude = static::$exclude;
        $Tableshow = static::$Tableshow;
        return view("data/mahasiswa_prestasi" , compact("data" , "title"  ,"exclude" ,"Tableshow", "master", "kebutuhan_selected"));

    }

    public function prestasi()
    {
        $data = MahasiswaModel::where('nim' , '=',Auth::user()->id)
            ->join('master_kelas', 'master_kelas.id', '=', 'mahasiswa.kelas_id')
            ->join('master_angkatan', 'master_angkatan.id', '=', 'mahasiswa.angkatan')
            ->join('master_jurusan', 'master_jurusan.id', '=', 'mahasiswa.jurusan_id')
            ->select('mahasiswa.*', 'master_kelas.title as kelas', 'master_angkatan.title as angkatan', 'master_jurusan.title as jurusan')
            ->first();

        $master = array(
            'jenis_tinggal' => TinggalModel::where('row_status' , 'active')->get(),
            'alat_transportasi' => AlatTransportasiModel::where('row_status' , 'active')->get(),
        );

        $title = ucfirst(request()->segment(1))." ".ucfirst(request()->segment(2));

        $exclude = static::$exclude;
        $Tableshow = static::$Tableshow;
        return view("data/mahasiswa_prestasi" , compact("data" , "title"  ,"exclude" ,"Tableshow", "master"));

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

        $exclude = static::$exclude;
        $Tableshow = static::$Tableshow;
        return view("data/mahasiswa_ganti_password" , compact("data" , "title"  ,"exclude" ,"Tableshow"));

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
