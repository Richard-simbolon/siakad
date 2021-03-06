<?php
namespace App\Http\Controllers;
use App\AngkatanModel;
use App\DosenKeluargaModel;
use App\DosenModel;
use App\JenisPegawaiModel;
use App\KelasPerkuliahanModel;
use App\PendidikanModel;
use App\StatusKeaktifanPegawaiModel;
use App\StatusMahasiswaModel;
use App\SumberGajiModel;
use Illuminate\Support\Facades\Date;
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
use App\PengangkatanModel;
use App\RiwayatPendidikanModel;
use App\RiwayatSertifikasiModel;
use App\RiwayatPenelitianModel;
use App\RiwayatFungsionalModel;
use App\PenugasanModel;
use App\PekerjaanModel;
use App\StatusPegawaiModel;
use App\DosenKebutuhanModel;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\Auth;
use App\KelasModel;
use App\TahunAjaranModel;
use Intervention\Image\Facades\Image as InterventionImage;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;
use Dompdf\Image\Cache;

class DosenModule extends Controller
{
    static $Tableshow = ["id" => ["table" => ["tablename" =>"null" , "field"=> "id"] , "record"=>"Id"],
        ];
    static $html = ["id"=>["type"=>"null" , "value"=>"null" , "validation" => ""] ,
];
    static $exclude = ["id","created_at","updated_at","created_by","update_by"];
    static $tablename = "Dosen";


    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            $this->user = Auth::user();
            if(!$this->user){
                Redirect::to('login')->send();
            }
            if(!$this->setUserActivity()){
                Redirect::to('/')->send();
            }
            if($this->user->login_type != 'dosen'){
                return abort(404);
            }else{
                return $next($request);
            }
        });
        
    }

    public function profile()
    {
        $data = DosenModel::where('nidn_nup_nidk' , '=',Auth::user()->id)->first();

        $master = array(
            'agama' => AgamaModel::where('row_status' , 'active')->get()
        );
        $menu['submenu'] = "profile";
        $title = ucfirst(request()->segment(1))." ".ucfirst(request()->segment(2));

        $exclude = static::$exclude;
        $Tableshow = static::$Tableshow;
        return view("data/profile_dosen" , compact("data" , "title"  ,"exclude" ,"Tableshow", "master", "menu"));

    }

    public function get_id_dosen(){
        $id = DosenModel::where('nidn_nup_nidk' , Auth::user()->id)->first();
        return $id->id;
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
        $data = DosenModel::where('nidn_nup_nidk' , '=',Auth::user()->id)->first();

        $master = array(
            'agama' => AgamaModel::where('row_status' , 'active')->get(),
            'status_pegawai' => StatusPegawaiModel::where('row_status' , 'active')->get(),
            'jenis_pegawai'=> JenisPegawaiModel::where('row_status', 'active')->get(),
            'sumber_gaji'=> SumberGajiModel::where('row_status', 'active')->get()
        );
        $menu['submenu'] = "biodata";
        $title = ucfirst(request()->segment(1))." ".ucfirst(request()->segment(2));

        $exclude = static::$exclude;
        $Tableshow = static::$Tableshow;
        return view("dosen/dosen_biodata" , compact("data" , "title"  ,"exclude" ,"Tableshow", "master", "menu"));

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
        $data = DosenModel::where('nidn_nup_nidk' , '=',Auth::user()->id)
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
        return view("dosen/dosen_keluarga" , compact("data" , "title"  ,"exclude" ,"Tableshow", "master", "menu"));

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
            ->leftjoin('dosen_keluarga' , 'dosen_keluarga.dosen_id' ,'=' , 'dosen.id')
            ->leftjoin('dosen_kebutuhan_khusus' , 'dosen_kebutuhan_khusus.dosen_id' , '=' , 'dosen.id')
            ->select('dosen.*','dosen_keluarga.pekerjaan' ,'dosen_keluarga.tmt_pns' ,'dosen_keluarga.nip_pasangan','dosen_keluarga.nama_pasangan','dosen_keluarga.status_pernikahan', 'master_agama.title' , 'dosen_kebutuhan_khusus.kebutuhan_khusus' , 'dosen_kebutuhan_khusus.braile' , 'dosen_kebutuhan_khusus.isyarat')
            ->where('dosen.nidn_nup_nidk' , Auth::user()->id)->first();

        $master = array(
            'kebutuhan' => KebutuhanKhususModel::where('row_status' , 'active')->get(),
        );
        $kebutuhan_selected = DosenKebutuhanModel::where('dosen_id' , $data['id'])->first();
        $title = ucfirst(request()->segment(1))." ".ucfirst(request()->segment(2));
        $menu['submenu'] = "kebutuhan_khusus";
        $exclude = static::$exclude;
        $Tableshow = static::$Tableshow;
        return view("dosen/dosen_kebutuhan_khusus" , compact("data" , "title"  ,"exclude" ,"Tableshow", "master", "kebutuhan_selected", "menu"));

    }

    public function submitkebutuhankhusus(Request $request){
        $data = $request->all();
        try{
            $data_kebutuhan_khusus = array(
                'dosen_id' => $data['id'],
                'row_status' => 'active',
                'created_by' => Auth::user()->nama,
                'created_at' => date('Y-m-d'),
                'updated_by' => Auth::user()->nama,
                'updated_at' => date('Y-m-d'),
                'kebutuhan_khusus' => array_key_exists('dosen_kh' , $data) ? json_encode(array('dosen' => $data['dosen_kh'])) : json_encode(array('dosen' =>[])),
                'braile'=> $data['braile'],
                'isyarat' => $data['isyarat'],
            );

            if(DosenKebutuhanModel::where('dosen_id' , $data['id'])->first()){
                DosenKebutuhanModel::where('dosen_id' , $data['id'])->update($data_kebutuhan_khusus);
            }else{
                DosenKebutuhanModel::firstOrCreate($data_kebutuhan_khusus);
            }
            return json_encode(array('status' => true , 'message' => 'Data berhasil disimpan.'));
        } catch(\Exception $e){
            throw $e;
            return json_encode(array('status' => false , 'message' => 'Terjadi kesalahan saat menyimpan, silahkan coba lagi.'));
        }
    }

    public function gantipassword()
    {
        $data = DosenModel::where('nidn_nup_nidk' , '=',Auth::user()->id)->first();

        $title = ucfirst(request()->segment(1))." ".ucfirst(request()->segment(2));

        $menu['submenu'] = "password";
        $exclude = static::$exclude;
        $Tableshow = static::$Tableshow;

        return view("dosen/dosen_ganti_password" , compact("data" , "title"  ,"exclude" ,"Tableshow", "menu"));
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

            if(Hash::check($input['password_lama'], Auth::user()->password))
            {     
                $password['password'] = Hash::make($input['konfirmasi']);
                if(DosenModel::where('id' ,$this->get_id_dosen())->update($password)){
                    return json_encode(["status"=> true, "message"=> "Password sudah diubuah"]);
                }else{
                    return json_encode(["status"=> false, "message"=> "Terjadi kesalahan saat mengubah data."]);
                }
            }else{
                return json_encode(["status"=> false, "message"=> "Password yang anda masukkan salah."]);
            }
        }else{
            return json_encode(["status"=> false, "message"=> "Data tidak ditemukan"]);
        }
    }

    public function penugasan_dosen(){

        $master = array(
            'jurusan' => JurusanModel::where('row_status' , 'active')->get(),
            'tahun_ajaran' => TahunAjaranModel::where('row_status' , 'active')->get(),
            'agama' => AgamaModel::where('row_status' , 'active')->get(),
            'pekerjaan' => PekerjaanModel::where('row_status' , 'active')->get(),
            'status_pegawai' => StatusKeaktifanPegawaiModel::where('row_status' , 'active')->get(),
            'jenis_kelamin' => config('global.jenis_kelamin')
        );
        $data = DosenModel::join('master_agama', 'master_agama.id', '=', 'dosen.agama')
            ->leftJoin('dosen_keluarga' , 'dosen_keluarga.dosen_id' ,'=' , 'dosen.id')
            ->leftJoin('dosen_kebutuhan_khusus' , 'dosen_kebutuhan_khusus.dosen_id' , '=' , 'dosen.id')
            ->leftJoin('master_status_keaktifan_pegawai','master_status_keaktifan_pegawai.id', '=', 'dosen.status_pegawai')
            ->select('dosen.*','master_status_keaktifan_pegawai.title as status', 'dosen_keluarga.pekerjaan' ,'dosen_keluarga.tmt_pns' ,'dosen_keluarga.nip_pasangan','dosen_keluarga.nama_pasangan','dosen_keluarga.status_pernikahan', 'master_agama.title' , 'dosen_kebutuhan_khusus.kebutuhan_khusus' , 'dosen_kebutuhan_khusus.braile' , 'dosen_kebutuhan_khusus.isyarat')
            ->where('dosen.nidn_nup_nidk' , Auth::user()->id)->first();

        $penugasan = PenugasanModel::join('master_jurusan' , 'master_jurusan.id','=', 'dosen_penugasan.program_studi_id')
            ->join('master_tahun_ajaran' , 'master_tahun_ajaran.id' , '=' , 'dosen_penugasan.tahun_ajaran')
            ->select('dosen_penugasan.*' , 'master_jurusan.title as program_studi_title' ,'master_tahun_ajaran.title as tahun_ajaran_title')
            ->where('dosen_penugasan.dosen_id' , $this->get_id_dosen())->where('dosen_penugasan.row_status' , 'active')->get();
             //print_r($penugasan); exit;

        return view('/dosen/dosen_penugasan' , compact('data' , 'master' , 'penugasan'));
    }


    public  function modaledit(request $request){
        $post = $request->all();
        if($post['type'] == 'penugasan'){
            if($post['status'] == 'delete'){
                $data['row_status'] = 'deleted';
                if(PenugasanModel::where('id' , $post['id'])->update($data)){
                    return json_encode(['status'=> 'success', 'message'=> 'Data berhasil dihapus']);    
                }else{
                    return json_encode(['status'=> 'error', 'message'=> 'Terjadi kesalahan saat menghapus data.']);
                }
            }
            $data = PenugasanModel::where('id' , $post['id'])->first();
            return collect($data);
        }else if($post['type'] == 'fungsional'){
            if($post['status'] == 'delete'){
                $data['row_status'] = 'deleted';
                if(RiwayatFungsionalModel::where('id' , $post['id'])->update($data)){
                    return json_encode(['status'=> 'success', 'message'=> 'Data berhasil dihapus']);    
                }
                return json_encode(['status'=> 'error', 'message'=> 'Terjadi kesalahan saat menghapus data.']);
            }
            $data = RiwayatFungsionalModel::where('id' , $post['id'])->first();
            return collect($data);
        }else if($post['type'] == 'kepangkatan'){
            if($post['status'] == 'delete'){
                $data['row_status'] = 'deleted';
                if(PengangkatanModel::where('id' , $post['id'])->update($data)){
                    return json_encode(['status'=> 'success', 'message'=> 'Data berhasil dihapus']);    
                }
                return json_encode(['status'=> 'error', 'message'=> 'Terjadi kesalahan saat menghapus data.']);
            }
            $data = PengangkatanModel::where('id' , $post['id'])->first();
            return collect($data);
        }else if($post['type'] == 'pendidikan'){
            if($post['status'] == 'delete'){
                $data['row_status'] = 'deleted';
                if(RiwayatPendidikanModel::where('id' , $post['id'])->update($data)){
                    return json_encode(['status'=> 'success', 'message'=> 'Data berhasil dihapus']);
                }
                return json_encode(['status'=> 'error', 'message'=> 'Terjadi kesalahan saat menghapus data.']);
            }
            $data = RiwayatPendidikanModel::where('id' , $post['id'])->first();
            return collect($data);
        }else if($post['type'] == 'sertifikasi'){
            if($post['status'] == 'delete'){
                $data['row_status'] = 'deleted';
                if(RiwayatSertifikasiModel::where('id' , $post['id'])->update($data)){
                    return json_encode(['status'=> 'success', 'message'=> 'Data berhasil dihapus']);
                }
                return json_encode(['status'=> 'error', 'message'=> 'Terjadi kesalahan saat menghapus data.']);
            }
            $data = RiwayatSertifikasiModel::where('id' , $post['id'])->first();
            return collect($data);
        }else if($post['type'] == 'penelitian'){
            if($post['status'] == 'delete'){
                $data['row_status'] = 'deleted';
                if(RiwayatPenelitianModel::where('id' , $post['id'])->update($data)){
                    return json_encode(['status'=> 'success', 'message'=> 'Data berhasil dihapus']);
                }
                return json_encode(['status'=> 'error', 'message'=> 'Terjadi kesalahan saat menghapus data.']);
            }
            $data = RiwayatPenelitianModel::where('id' , $post['id'])->first();
            return collect($data);
        }

    }

    public function submitpenugasan_dosen(Request $request){
        
        $data = $request->all();
        //print_r($data); exit;
        $validation = Validator::make($data, [
            'dosen_id' => 'required',
            'tahun_ajaran' => 'required',
            'program_studi_id' => 'required',
            'no_surat_tugas' => 'required',
            'tanggal_surat_tugas' => 'required',
            'tmt_surat_tugas' => 'required'
        ]);
        $penugasan_id = $data['id_penugasan'];
        $data['dosen_id'] = $this->get_id_dosen();
        
        unset($data['id_penugasan']);
        
        if ($validation->fails()) {
            return json_encode(['status'=> 'error', 'msg'=> $validation->messages()]);
        }

        if($penugasan_id == '' || $penugasan_id == null){
            if(PenugasanModel::create($data)){
                return json_encode(['status'=> 'success', 'msg'=> 'Data berhasil ditambahkan']);
            }else{
                return json_encode(['status'=> 'error', 'msg'=> 'Terjadi kesalahan saat menyimpan data.']);
            }  
        }else{
            if(PenugasanModel::where('id' , $penugasan_id)->update($data)){
                return json_encode(['status'=> 'success', 'msg'=> 'Data berhasil disimpan']);
            }else{
                return json_encode(['status'=> 'error', 'msg'=> 'Terjadi kesalahan saat menyimpan data.']);
            } 
           
        }
        
    }

    public function kepangkatan_dosen(){
        $nik = Auth::user()->id;
        $master = array(
            'jurusan' => JurusanModel::where('row_status' , 'active')->get(),
            'kebutuhan' => KebutuhanKhususModel::where('row_status' , 'active')->get(),
            'agama' => AgamaModel::where('row_status' , 'active')->get(),
            'pekerjaan' => PekerjaanModel::where('row_status' , 'active')->get(),
            'status_pegawai' => StatusPegawaiModel::where('row_status' , 'active')->get(),
            'jenis_kelamin' => config('global.jenis_kelamin')
        );

        $data = DosenModel::join('master_agama', 'master_agama.id', '=', 'dosen.agama')
            ->leftJoin('dosen_keluarga' , 'dosen_keluarga.dosen_id' ,'=' , 'dosen.id')
            ->leftJoin('dosen_kebutuhan_khusus' , 'dosen_kebutuhan_khusus.dosen_id' , '=' , 'dosen.id')
            ->leftJoin('master_status_keaktifan_pegawai','master_status_keaktifan_pegawai.id', '=', 'dosen.status_pegawai')
            ->select('dosen.*','master_status_keaktifan_pegawai.title as status', 'dosen_keluarga.pekerjaan' ,'dosen_keluarga.tmt_pns' ,'dosen_keluarga.nip_pasangan','dosen_keluarga.nama_pasangan','dosen_keluarga.status_pernikahan', 'master_agama.title' , 'dosen_kebutuhan_khusus.kebutuhan_khusus' , 'dosen_kebutuhan_khusus.braile' , 'dosen_kebutuhan_khusus.isyarat')
            ->where('dosen.nidn_nup_nidk' , Auth::user()->id)->first();

        $pengangkatan = PengangkatanModel::where('dosen_riwayat_kepangkatan.dosen_id' , $data['id'])->where('dosen_riwayat_kepangkatan.row_status' , 'active')->get();

        return view('/dosen/dosen_kepangkatan' , compact('data' , 'master' , 'pengangkatan'));
    }

    public function submitpengangkatan_dosen(Request $request){
        
        $data = $request->all();
        //print_r($data); exit;
        $validation = Validator::make($data, [
            'dosen_id' => 'required',
            'pangkat' => 'required',
            'sk_pangkat' => 'required',
            'tanggal_sk_pangkat' => 'required',
            'tmt_sk_pangkat' => 'required',
            'masa_kerja' => 'required'
        ]);
        $penugasan_id = $data['id_kepangkatan'];
        $data['dosen_id'] = $this->get_id_dosen();
        
        unset($data['id_kepangkatan']);
        
        if ($validation->fails()) {
            return json_encode(['status'=> 'error', 'msg'=> $validation->messages()]);
        }

        if($penugasan_id == '' || $penugasan_id == null){
            if(PengangkatanModel::create($data)){
                return json_encode(['status'=> 'success', 'msg'=> 'Data berhasil ditambahkan']);
            }else{
                return json_encode(['status'=> 'error', 'msg'=> 'Terjadi kesalahan saat menyimpan data.']);
            }  
        }else{
            if(PengangkatanModel::where('id' , $penugasan_id)->update($data)){
                return json_encode(['status'=> 'success', 'msg'=> 'Data berhasil disimpan']);
            }else{
                return json_encode(['status'=> 'error', 'msg'=> 'Terjadi kesalahan saat menyimpan data.']);
            } 
           
        }
        
    }

    public function pendidikan_dosen(){
        $nik = Auth::user()->id;
        $master = array(
            'jurusan' => JurusanModel::where('row_status' , 'active')->get(),
            'kebutuhan' => KebutuhanKhususModel::where('row_status' , 'active')->get(),
            'agama' => AgamaModel::where('row_status' , 'active')->get(),
            'pekerjaan' => PekerjaanModel::where('row_status' , 'active')->get(),
            'status_pegawai' => StatusPegawaiModel::where('row_status' , 'active')->get(),
            'jenis_kelamin' => config('global.jenis_kelamin')
        );
        $data = DosenModel::join('master_agama', 'master_agama.id', '=', 'dosen.agama')
            ->leftJoin('dosen_keluarga' , 'dosen_keluarga.dosen_id' ,'=' , 'dosen.id')
            ->leftJoin('dosen_kebutuhan_khusus' , 'dosen_kebutuhan_khusus.dosen_id' , '=' , 'dosen.id')
            ->leftJoin('master_status_keaktifan_pegawai','master_status_keaktifan_pegawai.id', '=', 'dosen.status_pegawai')
            ->select('dosen.*','master_status_keaktifan_pegawai.title as status', 'dosen_keluarga.pekerjaan' ,'dosen_keluarga.tmt_pns' ,'dosen_keluarga.nip_pasangan','dosen_keluarga.nama_pasangan','dosen_keluarga.status_pernikahan', 'master_agama.title' , 'dosen_kebutuhan_khusus.kebutuhan_khusus' , 'dosen_kebutuhan_khusus.braile' , 'dosen_kebutuhan_khusus.isyarat')
            ->where('dosen.nidn_nup_nidk' , Auth::user()->id)->first();

        $pendidikan = RiwayatPendidikanModel::where('dosen_riwayat_pendidikan.dosen_id' , $data['id'])->where('dosen_riwayat_pendidikan.row_status' , 'active')->get();

        return view('/dosen/dosen_pendidikan' , compact('data' , 'master' , 'pendidikan'));
    }

    public function submitpendidikan_dosen(Request $request){
        $data = $request->all();
        $validation = Validator::make($data, [
            'bidang_studi' => 'required',
            'jenjang' => 'required',
            'gelar' => 'required',
            'perguruan_tinggi' => 'required',
            'fakultas' => 'required',
            'tahun_lulus' => 'required',
            'sks' => 'required',
            'ipk' => 'required'
        ]);

        $pendidikan_id = $data['id_pendidikan'];
        $data['dosen_id'] = $this->get_id_dosen();

        unset($data['id_pendidikan']);

        if ($validation->fails()) {
            return json_encode(['status'=> 'error', 'msg'=> $validation->messages()]);
        }

        if($pendidikan_id == '' || $pendidikan_id == null){
            if(RiwayatPendidikanModel::create($data)){
                return json_encode(['status'=> 'success', 'msg'=> 'Data berhasil ditambahkan']);
            }else{
                return json_encode(['status'=> 'error', 'msg'=> 'Terjadi kesalahan saat menyimpan data.']);
            }
        }else{
            if(RiwayatPendidikanModel::where('id' , $pendidikan_id)->update($data)){
                return json_encode(['status'=> 'success', 'msg'=> 'Data berhasil disimpan']);
            }else{
                return json_encode(['status'=> 'error', 'msg'=> 'Terjadi kesalahan saat menyimpan data.']);
            }
        }
    }

    public function sertifikasi_dosen(){
        $nik = Auth::user()->id;
        $master = array(
            'jurusan' => JurusanModel::where('row_status' , 'active')->get(),
            'kebutuhan' => KebutuhanKhususModel::where('row_status' , 'active')->get(),
            'agama' => AgamaModel::where('row_status' , 'active')->get(),
            'pekerjaan' => PekerjaanModel::where('row_status' , 'active')->get(),
            'status_pegawai' => StatusPegawaiModel::where('row_status' , 'active')->get(),
            'jenis_kelamin' => config('global.jenis_kelamin')
        );
        $data = DosenModel::join('master_agama', 'master_agama.id', '=', 'dosen.agama')
            ->leftJoin('dosen_keluarga' , 'dosen_keluarga.dosen_id' ,'=' , 'dosen.id')
            ->leftJoin('dosen_kebutuhan_khusus' , 'dosen_kebutuhan_khusus.dosen_id' , '=' , 'dosen.id')
            ->leftJoin('master_status_keaktifan_pegawai','master_status_keaktifan_pegawai.id', '=', 'dosen.status_pegawai')
            ->select('dosen.*','master_status_keaktifan_pegawai.title as status', 'dosen_keluarga.pekerjaan' ,'dosen_keluarga.tmt_pns' ,'dosen_keluarga.nip_pasangan','dosen_keluarga.nama_pasangan','dosen_keluarga.status_pernikahan', 'master_agama.title' , 'dosen_kebutuhan_khusus.kebutuhan_khusus' , 'dosen_kebutuhan_khusus.braile' , 'dosen_kebutuhan_khusus.isyarat')
            ->where('dosen.nidn_nup_nidk' , Auth::user()->id)->first();

        $sertifikasi = RiwayatSertifikasiModel::where('dosen_riwayat_sertifikasi.dosen_id' , $data['id'])->where('dosen_riwayat_sertifikasi.row_status' , 'active')->get();

        return view('/dosen/dosen_sertifikasi' , compact('data' , 'master' , 'sertifikasi'));
    }

    public function submitsertifikasi_dosen(Request $request){
        $data = $request->all();
        $validation = Validator::make($data, [
            'nomor' => 'required',
            'bidang_studi' => 'required',
            'jenis_sertifikasi' => 'required',
            'tahun_sertifikasi' => 'required',
            'no_sk_sertifikasi' => 'required'
        ]);

        $sertifikasi_id = $data['id_sertifikasi'];
        $data['dosen_id'] = $this->get_id_dosen();

        unset($data['id_sertifikasi']);

        if ($validation->fails()) {
            return json_encode(['status'=> 'error', 'msg'=> $validation->messages()]);
        }

        if($sertifikasi_id == '' || $sertifikasi_id == null){
            if(RiwayatSertifikasiModel::create($data)){
                return json_encode(['status'=> 'success', 'msg'=> 'Data berhasil ditambahkan']);
            }else{
                return json_encode(['status'=> 'error', 'msg'=> 'Terjadi kesalahan saat menyimpan data.']);
            }
        }else{
            if(RiwayatSertifikasiModel::where('id' , $sertifikasi_id)->update($data)){
                return json_encode(['status'=> 'success', 'msg'=> 'Data berhasil disimpan']);
            }else{
                return json_encode(['status'=> 'error', 'msg'=> 'Terjadi kesalahan saat menyimpan data.']);
            }
        }
    }

    public function penelitian_dosen(){
        $nik = Auth::user()->id;
        $master = array(
            'jurusan' => JurusanModel::where('row_status' , 'active')->get(),
            'kebutuhan' => KebutuhanKhususModel::where('row_status' , 'active')->get(),
            'agama' => AgamaModel::where('row_status' , 'active')->get(),
            'pekerjaan' => PekerjaanModel::where('row_status' , 'active')->get(),
            'status_pegawai' => StatusPegawaiModel::where('row_status' , 'active')->get(),
            'jenis_kelamin' => config('global.jenis_kelamin')
        );
        $data = DosenModel::join('master_agama', 'master_agama.id', '=', 'dosen.agama')
            ->leftJoin('dosen_keluarga' , 'dosen_keluarga.dosen_id' ,'=' , 'dosen.id')
            ->leftJoin('dosen_kebutuhan_khusus' , 'dosen_kebutuhan_khusus.dosen_id' , '=' , 'dosen.id')
            ->leftJoin('master_status_keaktifan_pegawai','master_status_keaktifan_pegawai.id', '=', 'dosen.status_pegawai')
            ->select('dosen.*','master_status_keaktifan_pegawai.title as status', 'dosen_keluarga.pekerjaan' ,'dosen_keluarga.tmt_pns' ,'dosen_keluarga.nip_pasangan','dosen_keluarga.nama_pasangan','dosen_keluarga.status_pernikahan', 'master_agama.title' , 'dosen_kebutuhan_khusus.kebutuhan_khusus' , 'dosen_kebutuhan_khusus.braile' , 'dosen_kebutuhan_khusus.isyarat')
            ->where('dosen.nidn_nup_nidk' , Auth::user()->id)->first();

        $penelitian = RiwayatPenelitianModel::where('dosen_riwayat_penelitian.dosen_id' , $data['id'])->where('dosen_riwayat_penelitian.row_status' , 'active')->get();

        return view('/dosen/dosen_penelitian' , compact('data' , 'master' , 'penelitian'));
    }

    public function submitpenelitian_dosen(Request $request){
        $data = $request->all();
        $validation = Validator::make($data, [
            'judul_penelitian' => 'required',
            'bidang_ilmu' => 'required',
            'lembaga' => 'required',
            'tahun' => 'required',
        ]);

        $penelitian_id = $data['id_penelitian'];
        $data['dosen_id'] = $this->get_id_dosen();

        unset($data['id_penelitian']);

        if ($validation->fails()) {
            return json_encode(['status'=> 'error', 'msg'=> $validation->messages()]);
        }

        if($penelitian_id == '' || $penelitian_id == null) {
            if (RiwayatPenelitianModel::create($data)) {
                return json_encode(['status' => 'success', 'msg' => 'Data berhasil ditambahkan']);
            } else {
                return json_encode(['status' => 'error', 'msg' => 'Terjadi kesalahan saat menyimpan data.']);
            }
        }else{
            if(RiwayatPenelitianModel::where('id' , $penelitian_id)->update($data)){
                return json_encode(['status'=> 'success', 'msg'=> 'Data berhasil disimpan']);
            }else{
                return json_encode(['status'=> 'error', 'msg'=> 'Terjadi kesalahan saat menyimpan data.']);
            }
        }

    }

    public function fungsional_dosen(){
        $nik = Auth::user()->id;
        $master = array(
            'jurusan' => JurusanModel::where('row_status' , 'active')->get(),
            'kebutuhan' => KebutuhanKhususModel::where('row_status' , 'active')->get(),
            'agama' => AgamaModel::where('row_status' , 'active')->get(),
            'pekerjaan' => PekerjaanModel::where('row_status' , 'active')->get(),
            'status_pegawai' => StatusPegawaiModel::where('row_status' , 'active')->get(),
            'jenis_kelamin' => config('global.jenis_kelamin')
        );
        $data = DosenModel::join('master_agama', 'master_agama.id', '=', 'dosen.agama')
            ->leftJoin('dosen_keluarga' , 'dosen_keluarga.dosen_id' ,'=' , 'dosen.id')
            ->leftJoin('dosen_kebutuhan_khusus' , 'dosen_kebutuhan_khusus.dosen_id' , '=' , 'dosen.id')
            ->leftJoin('master_status_keaktifan_pegawai','master_status_keaktifan_pegawai.id', '=', 'dosen.status_pegawai')
            ->select('dosen.*','master_status_keaktifan_pegawai.title as status', 'dosen_keluarga.pekerjaan' ,'dosen_keluarga.tmt_pns' ,'dosen_keluarga.nip_pasangan','dosen_keluarga.nama_pasangan','dosen_keluarga.status_pernikahan', 'master_agama.title' , 'dosen_kebutuhan_khusus.kebutuhan_khusus' , 'dosen_kebutuhan_khusus.braile' , 'dosen_kebutuhan_khusus.isyarat')
            ->where('dosen.nidn_nup_nidk' , Auth::user()->id)->first();

        $fungsional = RiwayatFungsionalModel::where('dosen_riwayat_fungsional.dosen_id' , $data['id'])->where('dosen_riwayat_fungsional.row_status' , 'active')->get();

        return view('/dosen/dosen_fungsional' , compact('data' , 'master' , 'fungsional'));
    }

    public function submitfungsional_dosen(Request $request){
        
        $data = $request->all();
        //print_r($data); exit;
        $validation = Validator::make($data, [
            'jabatan' => 'required',
            'sk_jabatan' => 'required',
            'tmt_jabatan' => 'required'
        ]);
        $fungsional_id = $data['id_fungsional'];
        $data['dosen_id'] = $this->get_id_dosen();
        
        unset($data['id_fungsional']);
        
        if ($validation->fails()) {
            return json_encode(['status'=> 'error', 'msg'=> $validation->messages()]);
        }

        if($fungsional_id == '' || $fungsional_id == null){
            if(RiwayatFungsionalModel::create($data)){
                return json_encode(['status'=> 'success', 'msg'=> 'Data berhasil ditambahkan']);
            }else{
                return json_encode(['status'=> 'error', 'msg'=> 'Terjadi kesalahan saat menyimpan data.']);
            }  
        }else{
            if(RiwayatFungsionalModel::where('id' , $fungsional_id)->update($data)){
                return json_encode(['status'=> 'success', 'msg'=> 'Data berhasil disimpan']);
            }else{
                return json_encode(['status'=> 'error', 'msg'=> 'Terjadi kesalahan saat menyimpan data.']);
            } 
           
        }
        
    }

    public function upload_profile(Request $request){

        $path = public_path('assets/images/dosen');
        $dimensions = ['245', '300', '500'];
        $post = $request->all();
        $image = $post['base64'];  // your base64 encoded
        //$image = str_replace('data:image/png;base64,', '', $image);
        //$image = str_replace('data:image/jpg;base64,', '', $image);
        $image = explode('base64,' , $image);
        $image = str_replace(' ', '+', $image[1]);
        $imageName = Auth::user()->id.'.jpg';
        $file = base64_decode($image);
        $canvas = InterventionImage::canvas(245, 245);
        $resizeImage  = InterventionImage::make($file)->resize(245, 245, function($constraint) {
            $constraint->aspectRatio();
        });

        $canvas->insert($resizeImage, 'center');
        $canvas->save($path. '/' . $imageName);

        if($canvas->save($path. '/' . $imageName)){
            return json_encode(["status"=> 'success', "message"=> "Profile sudah diubah."]);
        }else{
            return json_encode(["status"=> 'error', "message"=> "Terjadi kesalahan menyimpan data, coba lagi."]);
        }
        
    }

    public function activity(){
        $nik = Auth::user()->id;
        $master = array(
            'jurusan' => JurusanModel::where('row_status' , 'active')->get(),
            'kebutuhan' => KebutuhanKhususModel::where('row_status' , 'active')->get(),
            'agama' => AgamaModel::where('row_status' , 'active')->get(),
            'pekerjaan' => PekerjaanModel::where('row_status' , 'active')->get(),
            'status_pegawai' => StatusKeaktifanPegawaiModel::where('row_status' , 'active')->get(),
            'jenis_kelamin' => config('global.jenis_kelamin')
        );

        $idTable ="tbl_dosen_aktivitas_mengajar";

        $data = DosenModel::join('master_agama', 'master_agama.id', '=', 'dosen.agama')
            ->leftJoin('dosen_keluarga' , 'dosen_keluarga.dosen_id' ,'=' , 'dosen.id')
            ->leftJoin('dosen_kebutuhan_khusus' , 'dosen_kebutuhan_khusus.dosen_id' , '=' , 'dosen.id')
            ->leftJoin('master_status_keaktifan_pegawai','master_status_keaktifan_pegawai.id','dosen.status_pegawai')
            ->select('dosen.*','master_status_keaktifan_pegawai.title as status_keaktifan','dosen_keluarga.pekerjaan' ,'dosen_keluarga.tmt_pns' ,'dosen_keluarga.nip_pasangan','dosen_keluarga.nama_pasangan','dosen_keluarga.status_pernikahan', 'master_agama.title' , 'dosen_kebutuhan_khusus.kebutuhan_khusus' , 'dosen_kebutuhan_khusus.braile' , 'dosen_kebutuhan_khusus.isyarat')
            ->where('dosen.nidn_nup_nidk' , $nik)->first();
        return view('/dosen/dosen_activity' , compact('data','master','idTable' ));
    }

    public function activity_paging(Request $request){
        $post= $request->all();
        $where = ['dosen_id' => $post['dosen_id']];

        return Datatables::of(DB::table('view_aktivitas_mengajar')->where($where)->get())->addIndexColumn()->make(true);
    }

    public function pembimbing_akademik(){
        $nik = Auth::user()->id;
        $data = DosenModel::where('dosen.nidn_nup_nidk' , $nik)->first();
        $master = array(
            'status' => StatusMahasiswaModel::where('row_status' , 'active')->get(),
            'jurusan' => JurusanModel::where('row_status' , 'active')->get(),
            'angkatan' => MahasiswaModel::where('mahasiswa.row_status' , 'active')
                ->join('master_semester','master_semester.id', '=', 'mahasiswa.id_periode_masuk')
                ->select('master_semester.id_tahun_ajaran')
                ->distinct()
                ->orderBy('id_tahun_ajaran','desc')
                ->get(),
            'kelas' => KelasModel::where('row_status' , 'active')->get()
        );

        return view("dosen/pembimbing_akademik", compact('master', 'data'));
    }

    public function pembimbing_akademik_paging(Request $request){
        $post= $request->all();
        $where = ['pembimbing_akademik' => $post['dosen_id']];

        return Datatables::of(DB::table('mahasiswa')
            ->join('master_jurusan', 'master_jurusan.id', '=', 'mahasiswa.jurusan_id')
            ->join('master_status_mahasiswa', 'master_status_mahasiswa.id', '=', 'mahasiswa.status')
            ->join('master_kelas','master_kelas.id', '=', 'mahasiswa.kelas_id')
            ->join('master_semester', 'master_semester.id', '=', 'mahasiswa.id_periode_masuk')
            ->select('mahasiswa.nim as nim', 'master_status_mahasiswa.title as status', 'mahasiswa.nama','mahasiswa.jk', 'master_jurusan.title as jurusan', 'master_semester.id_tahun_ajaran as angkatan', 'master_kelas.title as kelas')
            ->where($where)
            ->get())->addIndexColumn()->make(true);
    }
    
}
