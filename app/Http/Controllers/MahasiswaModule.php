<?php
namespace App\Http\Controllers;
use App\TugasAkhirModel;
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
use Intervention\Image\Facades\Image as InterventionImage;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;

class MahasiswaModule extends Controller
{
    static $Tableshow = ["id" => ["table" => ["tablename" =>"null" , "field"=> "id"] , "record"=>"Id"],
        ];
    static $html = ["id"=>["type"=>"null" , "value"=>"null" , "validation" => ""] ,
];
    static $exclude = ["id","created_at","updated_at","created_by","update_by"];
    static $tablename = "Mahasiswa";
    
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
            if($this->user->login_type != 'mahasiswa'){
                return abort(404);
            }else{
                return $next($request);
            }
        });
        
    }

    public function get_id_mahasiswa(){
        $id = MahasiswaModel::where('nim' , Auth::user()->id)->first();
        return $id->id;
    }

    public function profile()
    {
        $data = $this->getMahasiswa();

        $master = array(
            'agama' => AgamaModel::where('row_status' , 'active')->get()
        );

        $menu['submenu'] = "profile";
        $title = ucfirst(request()->segment(1))." ".ucfirst(request()->segment(2));
        $count=DB::table('mahasiswa_prestasi')->where('row_status', 'active')->where('mahasiswa_id' , $data['id'])->count();

        $exclude = static::$exclude;
        $Tableshow = static::$Tableshow;
        return view("data/profile_mahasiswa" , compact("data" , "title"  ,"exclude" ,"Tableshow", "master", "count" , "menu"));

    }

    public function  submitprofile(Request $request){
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

    public function alamat()
    {
        $data = $this->getMahasiswa();

        $master = array(
            'jenis_tinggal' => TinggalModel::where('row_status' , 'active')->get(),
            'alat_transportasi' => AlatTransportasiModel::where('row_status' , 'active')->get(),
        );

        $title = ucfirst(request()->segment(1))." ".ucfirst(request()->segment(2));
        $count=DB::table('mahasiswa_prestasi')->where('row_status', 'active')->where('mahasiswa_id' , $data['id'])->count();
        $menu['submenu'] = "alamat";
        $exclude = static::$exclude;
        $Tableshow = static::$Tableshow;
        return view("data/mahasiswa_alamat" , compact("data" , "title"  ,"exclude" ,"Tableshow", "master", "count", "menu"));

    }

    public function submitalamat(Request $request){
        $input = $request->all();
        $data = MahasiswaModel::where('id','=',$input['id'])->first();

        if($data){
            $data->nisn = $input['nisn'];
            $data->kewarganegaraan = $input['kewarganegaraan'];
            $data->alamat = $input['alamat'];
            $data->dusun = $input['dusun'];
            $data->rt = $input['rt'];
            $data->rw = $input['rw'];
            $data->kelurahan = $input['kelurahan'];
            $data->kecamatan = $input['kecamatan'];
            $data->kode_pos = $input['kode_pos'];
            $data->jenis_tinggal = $input['jenis_tinggal'];
            $data->alat_transportasi = $input['alat_transportasi'];
            $data->is_penerima_kps = $input['is_penerima_kps'];
            $data->no_kps = $input['no_kps'];

            if($data->save()){
                return $this->success("Data berhasil disimpan.");
            }else{
                return json_encode(["status"=> false, "msg"=> "Mohon maaf, terjadi kesalahan sistem"]);
            }
        }else{
            return json_encode(["status"=> false, "message"=> "Data tidak ditemukan"]);
        }
    }

    public function orangtua()
    {
        $data = $this->getMahasiswa();

        $orangtuawali = MahasiswaOrangtuawaliModel::where('mahasiswa_id' , $data['id'])->get();
        $master = array(
            'pekerjaan' => PekerjaanModel::where('row_status' , 'active')->get(),
            'penghasilan' => PenghasilanModel::where('row_status' , 'active')->get(),
            'pendidikan' => PendidikanModel::where('row_status' , 'active')->get(),
        );
        $menu['submenu'] = "orangtua";
        $title = ucfirst(request()->segment(1))." ".ucfirst(request()->segment(2));
        $count=DB::table('mahasiswa_prestasi')->where('row_status', 'active')->where('mahasiswa_id' , $data['id'])->count();

        $exclude = static::$exclude;
        $Tableshow = static::$Tableshow;
        return view("data/mahasiswa_orangtua" , compact("data","orangtuawali" , "title"  ,"exclude" ,"Tableshow", "master", "count", "menu"));

    }

    public function submitorangtua(Request $request){
        $data = $request->all();
        if(array_key_exists('mahasiswa_orang_tua_wali' , $data)){
            foreach($data['mahasiswa_orang_tua_wali'] as $key=>$val){
                $arrData = array(
                    "nik" => $data['mahasiswa_orang_tua_wali'][$key]['nik'],
                    "nama" => $data['mahasiswa_orang_tua_wali'][$key]['nama'],
                    "tanggal_lahir" => $data['mahasiswa_orang_tua_wali'][$key]['tanggal_lahir'],
                    "pendidikan_id" => $data['mahasiswa_orang_tua_wali'][$key]['pendidikan_id'],
                    "pekerjaan_id" => $data['mahasiswa_orang_tua_wali'][$key]['pekerjaan_id'],
                    "penghasilan" => $data['mahasiswa_orang_tua_wali'][$key]['penghasilan'],
                    "mahasiswa_id" => $data['mahasiswa_id'],
                    "kategori" => $data['mahasiswa_orang_tua_wali'][$key]['kategori']
                );
//                $where_detail['mahasiswa_id'] =  $data['mahasiswa_id'];
//                $where_detail['kategori'] = "'".$key ."'";
//                $where_detail['id'] =  $data['mahasiswa_orang_tua_wali'][$key]['id'];
//                $data['mahasiswa_orang_tua_wali'][$key]['mahasiswa_id'] = $data['mahasiswa_id'];
//                $data['mahasiswa_orang_tua_wali'][$key]['kategori'] = $key;

                $orangtua_wali = MahasiswaOrangtuawaliModel::where('id',$data['mahasiswa_orang_tua_wali'][$key]['id'])->first();;
                if($orangtua_wali){
                    $orangtua_wali->nik = $data['mahasiswa_orang_tua_wali'][$key]['nik'];
                    $orangtua_wali->nama = $data['mahasiswa_orang_tua_wali'][$key]['nama'];
                    $orangtua_wali->tanggal_lahir = $data['mahasiswa_orang_tua_wali'][$key]['tanggal_lahir'];
                    $orangtua_wali->pendidikan_id = $data['mahasiswa_orang_tua_wali'][$key]['pendidikan_id'];
                    $orangtua_wali->pekerjaan_id = $data['mahasiswa_orang_tua_wali'][$key]['pekerjaan_id'];
                    $orangtua_wali->penghasilan = $data['mahasiswa_orang_tua_wali'][$key]['penghasilan'];
                    $orangtua_wali->mahasiswa_id = $data['mahasiswa_id'];
                    $orangtua_wali->kategori = $data['mahasiswa_orang_tua_wali'][$key]['kategori'];
                    $orangtua_wali->save();
                }else{
                    MahasiswaOrangtuawaliModel::firstOrCreate($arrData);
                }
            }
            return $this->success("Data berhasil disimpan.");
        }else{
            return json_encode(["status"=> false, "message"=> "Data tidak ditemukan"]);
        }

    }

    public function wali()
    {
        $data = $this->getMahasiswa();

        $orangtuawali = MahasiswaOrangtuawaliModel::where('mahasiswa_id' , $data['id'])->get();
        $master = array(
            'pekerjaan' => PekerjaanModel::where('row_status' , 'active')->get(),
            'penghasilan' => PenghasilanModel::where('row_status' , 'active')->get(),
            'pendidikan' => PendidikanModel::where('row_status' , 'active')->get(),
        );
        $count=DB::table('mahasiswa_prestasi')->where('row_status', 'active')->where('mahasiswa_id' , $data['id'])->count();
        $title = ucfirst(request()->segment(1))." ".ucfirst(request()->segment(2));
        $menu['submenu'] = "wali";
        $exclude = static::$exclude;
        $Tableshow = static::$Tableshow;
        return view("data/mahasiswa_wali" , compact("data","orangtuawali", "title"  ,"exclude" ,"Tableshow", "master", "count", "menu"));

    }

    public function submitwali(Request $request){
        $data = $request->all();

        if(array_key_exists('mahasiswa_orang_tua_wali' , $data)){
            foreach($data['mahasiswa_orang_tua_wali'] as $key=>$val){
                $arrData = array(
                    "nama" => $data['mahasiswa_orang_tua_wali'][$key]['nama'],
                    "tanggal_lahir" => $data['mahasiswa_orang_tua_wali'][$key]['tanggal_lahir'],
                    "pendidikan_id" => $data['mahasiswa_orang_tua_wali'][$key]['pendidikan_id'],
                    "pekerjaan_id" => $data['mahasiswa_orang_tua_wali'][$key]['pekerjaan_id'],
                    "penghasilan" => $data['mahasiswa_orang_tua_wali'][$key]['penghasilan'],
                    "mahasiswa_id" => $data['mahasiswa_id'],
                    "kategori" => $data['mahasiswa_orang_tua_wali'][$key]['kategori']
                );
                $orangtua_wali = MahasiswaOrangtuawaliModel::where('id',$data['mahasiswa_orang_tua_wali'][$key]['id'])->first();;
                if($orangtua_wali){
                    $orangtua_wali->nama = $data['mahasiswa_orang_tua_wali'][$key]['nama'];
                    $orangtua_wali->tanggal_lahir = $data['mahasiswa_orang_tua_wali'][$key]['tanggal_lahir'];
                    $orangtua_wali->pendidikan_id = $data['mahasiswa_orang_tua_wali'][$key]['pendidikan_id'];
                    $orangtua_wali->pekerjaan_id = $data['mahasiswa_orang_tua_wali'][$key]['pekerjaan_id'];
                    $orangtua_wali->penghasilan = $data['mahasiswa_orang_tua_wali'][$key]['penghasilan'];
                    $orangtua_wali->mahasiswa_id = $data['mahasiswa_id'];
                    $orangtua_wali->kategori = $data['mahasiswa_orang_tua_wali'][$key]['kategori'];
                    $orangtua_wali->save();
                }else{
                    MahasiswaOrangtuawaliModel::firstOrCreate($arrData);
                }
            }
            return $this->success("Data berhasil disimpan.");
        }else{
            return json_encode(["status"=> false, "message"=> "Data tidak ditemukan"]);
        }
    }

    public function kebutuhankhusus()
    {
        $data = $this->getMahasiswa();

        $master = array(
            'jenis_tinggal' => TinggalModel::where('row_status' , 'active')->get(),
            'alat_transportasi' => AlatTransportasiModel::where('row_status' , 'active')->get(),
            'kebutuhan' => KebutuhanKhususModel::where('row_status' , 'active')->get(),
        );
        $kebutuhan_selected = MahasiswaKebutuhanModel::where('mahasiswa_id' , $data['id'])->first();
        $menu['submenu'] = "kebutuhan_khusus";
        $title = ucfirst(request()->segment(1))." ".ucfirst(request()->segment(2));
        $count=DB::table('mahasiswa_prestasi')->where('row_status', 'active')->where('mahasiswa_id' , $data['id'])->count();

        $exclude = static::$exclude;
        $Tableshow = static::$Tableshow;
        return view("data/mahasiswa_kebutuhan_khusus" , compact("data" , "title"  ,"exclude" ,"Tableshow", "master", "kebutuhan_selected", "count", "menu"));

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

            //print_r($data_kebutuhan_khusus);die();
            if(MahasiswaKebutuhanModel::where('mahasiswa_id' , $data['mahasiswa_id'])->first()){
                MahasiswaKebutuhanModel::where('mahasiswa_id' , $data['mahasiswa_id'])->update($data_kebutuhan_khusus);
            }else{
                MahasiswaKebutuhanModel::where('mahasiswa_id' , $data['mahasiswa_id'])->create($data_kebutuhan_khusus);
            }


            return json_encode(array('status' => true , 'message' => 'Data berhasil disimpan.'));
        } catch(\Exception $e){
            throw $e;
            return json_encode(array('status' => false , 'message' => 'Terjadi kesalahan saat menyimpan, silahkan coba lagi.'));
        }
    }

    public function prestasi()
    {
        $data = $this->getMahasiswa();

        $master = array(
            'jenis_tinggal' => TinggalModel::where('row_status' , 'active')->get(),
            'alat_transportasi' => AlatTransportasiModel::where('row_status' , 'active')->get(),
        );

        $title = ucfirst(request()->segment(1))." ".ucfirst(request()->segment(2));
        $count=DB::table('mahasiswa_prestasi')->where('row_status', 'active')->where('mahasiswa_id' , $data['id'])->count();
        $menu['submenu'] = "prestasi";
        $exclude = static::$exclude;
        $Tableshow = static::$Tableshow;
        return view("data/mahasiswa_prestasi" , compact("data" , "title"  ,"exclude" ,"Tableshow", "master", "count", "menu"));

    }

    public function get_prestasi($id)
    {
        $prestasi = DB::table('mahasiswa_prestasi')->where('id' , $id)->first();

        if($prestasi){
            return json_encode(["status"=> true, "data"=> $prestasi]);
        }else{
            return json_encode(["status"=> false, "message"=> "Data tidak ditemukan"]);
        }
    }

    public function prestasipaging(Request $request){
        $post = $request->all();
        return Datatables::of(DB::table('mahasiswa_prestasi')->where('row_status', 'active')->where('mahasiswa_id' , $post['id'])->get())->addIndexColumn()->make(true);
    }

    public function submitprestasi(Request $request){
        $data = $request->all();

        $validation = Validator::make($data, [
            'jenis_prestasi' => 'required',
            'tingkat_prestasi' => 'required',
            'nama_prestasi' => 'required',
            'tahun' => 'required|numeric',
            'penyelenggara' => 'required',
            'peringkat' => 'max:20',
        ]);
        $data['updated_at'] = date('Y-m-d H:i:s');
        $data['created_at'] = date('Y-m-d H:i:s');
        if ($validation->fails()) {
            return json_encode(array('status'=> false, 'message'=> $validation->messages()));
        }

        DB::beginTransaction();
        try{
            DB::table('mahasiswa_prestasi')->insert($data);
            DB::commit();
            return json_encode(array('status' => true , 'message' => 'Data berhasil disimpan.'));
        } catch(\Exception $e){

            DB::rollBack();
            throw $e;
            return json_encode(array('status' => false , 'message' => 'Terjadi kesalahan saat menyimpan, silahkan coba lagi.'));
        }
    }

    public function edit_prestasi(Request $request){
        $data = $request->all();
        try{

            $arr_data= array(
                "jenis_prestasi" => $data['jenis_prestasi'],
                "tingkat_prestasi" => $data['tingkat_prestasi'],
                "nama_prestasi" => $data['nama_prestasi'],
                "tahun" => $data['tahun'],
                "penyelenggara" => $data['penyelenggara'],
                "peringkat" => $data['peringkat'],
                "updated_at" => date('Y-m-d H:i:s'),
                "modified_by" => Auth::user()->nama
            );
            DB::table('mahasiswa_prestasi')->where('id' , $data['id'])->update($arr_data);

            return json_encode(array('status' => true , 'message' => 'Data berhasil dihapus.'));
        } catch(\Exception $e){

            throw $e;
            return json_encode(array('status' => false , 'message' => 'Terjadi kesalahan saat menyimpan, silahkan coba lagi.'));
        }
    }

    public function delete_prestasi($id){
        try{
            $arr_data= array(
                "row_status" => "deleted",
                "updated_at" => date('Y-m-d H:i:s'),
                "modified_by" => Auth::user()->nama
            );
            DB::table('mahasiswa_prestasi')->where('id' , $id)->update($arr_data);

            return json_encode(array('status' => true , 'message' => 'Data berhasil dihapus.'));
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
        $count=DB::table('mahasiswa_prestasi')->where('row_status', 'active')->where('mahasiswa_id' , $data['id'])->count();
        $menu['submenu'] = "ganti_password";
        $exclude = static::$exclude;
        $Tableshow = static::$Tableshow;

        return view("data/mahasiswa_ganti_password" , compact("data" , "title"  ,"exclude" ,"Tableshow", "count", "menu"));
    }

    public function submit_gantipassword(Request $request){
        $input = $request->all();
        $data = MahasiswaModel::where('id' , '=',$input['id'])->first();
        if($data){
            //$password_old = $data->password;
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
                if(MahasiswaModel::where('id' ,$this->get_id_mahasiswa())->update($password)){
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

    public function upload_profile(Request $request){

        $path = public_path('assets/images/mahasiswa');
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

    public function tugasakhir(){
        $data = $this->getMahasiswa();
        $tugas_akhir = TugasAkhirModel::where('mahasiswa_tugas_akhir.row_status','active')->where('mahasiswa_tugas_akhir.mahasiswa_id',Auth::user()->id)->first();
        $dosen = TugasAkhirModel::where('mahasiswa_tugas_akhir.row_status','active')->where('mahasiswa_tugas_akhir.mahasiswa_id',Auth::user()->id)
            ->join("mahasiswa_tugas_akhir_detail", "mahasiswa_tugas_akhir_detail.tugas_akhir_id","=", "mahasiswa_tugas_akhir.id")
            ->join("dosen", "dosen.id", "=", "mahasiswa_tugas_akhir_detail.dosen_id")
            ->select("dosen.nidn_nup_nidk","dosen.nama", "dosen.no_hp", "mahasiswa_tugas_akhir_detail.status_dosen")
            ->orderBy("mahasiswa_tugas_akhir_detail.status_dosen")
            ->get();

        return view("mahasiswa/tugas_akhir" , compact("data", "dosen","tugas_akhir" ));
    }

    public function getMahasiswa(){
        $data = MahasiswaModel::where('nim' , '=',Auth::user()->id)
            ->join('master_kelas', 'master_kelas.id', '=', 'mahasiswa.kelas_id')
            ->join('master_semester', 'master_semester.id', '=', 'mahasiswa.id_periode_masuk')
            ->join('master_jurusan', 'master_jurusan.id', '=', 'mahasiswa.jurusan_id')
            ->leftJoin('dosen', 'dosen.id' ,'=', 'mahasiswa.pembimbing_akademik')
            ->select('mahasiswa.*','dosen.nama as nama_dosen', 'master_kelas.title as kelas', 'master_semester.id_tahun_ajaran as angkatan', 'master_jurusan.title as jurusan')
            ->first();

        return $data;
    }

    public function kartuujian(){
        $data = MahasiswaModel::where('nim' , '=',Auth::user()->id)
            ->join('master_kelas', 'master_kelas.id', '=', 'mahasiswa.kelas_id')
            ->join('master_angkatan', 'master_angkatan.id', '=', 'mahasiswa.angkatan')
            ->join('master_jurusan', 'master_jurusan.id', '=', 'mahasiswa.jurusan_id')
            ->select('mahasiswa.*', 'master_kelas.title as kelas', 'master_angkatan.title as angkatan', 'master_jurusan.title as jurusan')
            ->first();

        return view("mahasiswa/kartu_ujian" , compact("data" ));
    }
}
