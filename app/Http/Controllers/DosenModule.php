<?php
namespace App\Http\Controllers;
use App\DosenKeluargaModel;
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
use App\StatusPegawaiModel;
use App\DosenKebutuhanModel;
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
        $data = DosenModel::where('nik' , '=',Auth::user()->id)->first();

        $master = array(
            'agama' => AgamaModel::where('row_status' , 'active')->get()
        );
        $menu['submenu'] = "profile";
        $title = ucfirst(request()->segment(1))." ".ucfirst(request()->segment(2));

        $exclude = static::$exclude;
        $Tableshow = static::$Tableshow;
        return view("data/profile_dosen" , compact("data" , "title"  ,"exclude" ,"Tableshow", "master", "menu"));

    }

    public function submitprofile(Request $request){
        $input = $request->all();

        $data = DosenModel::where('id','=',$input['id'])->first();

        if($data){
            $data->nik = $input['nik'];
            $data->nama = $input['nama'];
            $data->tempat_lahir = $input['tempat_lahir'];
            $data->tanggal_lahir = $input['tanggal_lahir'];
            $data->agama = $input['agama'];
            $data->jenis_kelamin = $input['jenis_kelamin'];
            $data->no_hp = $input['no_hp'];
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

    public function biodata()
    {
        $data = DosenModel::where('nik' , '=',Auth::user()->id)->first();

        $master = array(
            'agama' => AgamaModel::where('row_status' , 'active')->get(),
            'status_pegawai' => StatusPegawaiModel::where('row_status' , 'active')->get(),
        );
        $menu['submenu'] = "biodata";
        $title = ucfirst(request()->segment(1))." ".ucfirst(request()->segment(2));

        $exclude = static::$exclude;
        $Tableshow = static::$Tableshow;
        return view("data/dosen_biodata" , compact("data" , "title"  ,"exclude" ,"Tableshow", "master", "menu"));

    }

    public function submitbiodata(Request $request){
        $input = $request->all();
        $data = DosenModel::where('id','=',$input['id'])->first();

        if($data){
            $data->nip = $input['nip'];
            $data->npwp = $input['npwp'];
            $data->ikatan_kerja = $input['ikatan_kerja'];
            $data->status_pegawai = $input['status_pegawai'];
            $data->jenis_pegawai = $input['jenis_pegawai'];
            $data->no_sk_cpns = $input['no_sk_cpns'];
            $data->tanggal_sk_cpns = $input['tanggal_sk_cpns'];
            $data->no_sk_pengangkatan = $input['no_sk_pengangkatan'];
            $data->tgl_sk_pengangkatan = $input['tgl_sk_pengangkatan'];
            $data->lembaga_pengangkatan = $input['lembaga_pengangkatan'];
            $data->pangkat_golongan = $input['pangkat_golongan'];
            $data->sumber_gaji = $input['sumber_gaji'];
            $data->alamat = $input['alamat'];
            $data->dusun = $input['dusun'];
            $data->rt = $input['rt'];
            $data->rw = $input['rw'];
            $data->kelurahan = $input['kelurahan'];
            $data->kecamatan = $input['kecamatan'];
            $data->kode_pos = $input['kode_pos'];

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
            ->join('dosen_keluarga' , 'dosen_keluarga.dosen_id' ,'=' , 'dosen.id')
            ->select('dosen.*','dosen_keluarga.pekerjaan' ,'dosen_keluarga.tmt_pns' ,'dosen_keluarga.nip_pasangan','dosen_keluarga.nama_pasangan','dosen_keluarga.status_pernikahan')
            ->first();

        $master = array(
            'pekerjaan' => PekerjaanModel::where('row_status' , 'active')->get(),
        );

        $menu['submenu'] = "keluarga";
        $title = ucfirst(request()->segment(1))." ".ucfirst(request()->segment(2));

        $exclude = static::$exclude;
        $Tableshow = static::$Tableshow;
        return view("data/dosen_keluarga" , compact("data" , "title"  ,"exclude" ,"Tableshow", "master", "menu"));

    }

    public function submitkeluarga(Request $request){
        $input = $request->all();
        $data = DosenKeluargaModel::where('dosen_id','=',$input['id'])->first();

        if($data){
            $data->status_pernikahan = $input['status_pernikahan'];
            $data->nama_pasangan = $input['nama_pasangan'];
            $data->nip_pasangan = $input['nip_pasangan'];
            $data->tmt_pns = $input['tmt_pns'];
            $data->pekerjaan = $input['pekerjaan'];

            if($data->save()){
                return $this->success("Data berhasil disimpan.");
            }else{
                return json_encode(["status"=> false, "msg"=> "Mohon maaf, terjadi kesalahan sistem"]);
            }
        }else{
            return json_encode(["status"=> false, "message"=> "Data tidak ditemukan"]);
        }
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
                'created_by' => 1,
                'updated_by' => 1,
                'kebutuhan_khusus' => array_key_exists('dosen_kh' , $data) ? json_encode(array('dosen' => $data['dosen_kh'])) : json_encode(array('dosen' =>[])),
                'braile'=> $data['braile'],
                'isyarat' => $data['isyarat'],
            );
            DosenKebutuhanModel::where('dosen_id' , $data['id'])->update($data_kebutuhan_khusus);

            return json_encode(array('status' => true , 'message' => 'Data berhasil disimpan.'));
        } catch(\Exception $e){
            throw $e;
            return json_encode(array('status' => false , 'message' => 'Terjadi kesalahan saat menyimpan, silahkan coba lagi.'));
        }
    }

    public function gantipassword()
    {
        $data = DosenModel::where('nik' , '=',Auth::user()->id)->first();

        $title = ucfirst(request()->segment(1))." ".ucfirst(request()->segment(2));

        $menu['submenu'] = "password";
        $exclude = static::$exclude;
        $Tableshow = static::$Tableshow;

        return view("data/dosen_ganti_password" , compact("data" , "title"  ,"exclude" ,"Tableshow", "menu"));
    }

    public function submit_gantipassword(Request $request){
        $input = $request->all();
        $data = DosenModel::where('id' , '=',$input['id'])->first();

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
