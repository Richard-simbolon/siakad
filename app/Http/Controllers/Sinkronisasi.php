<?php
    namespace App\Http\Controllers;
    use App\SinkronisasiModel;
    use Illuminate\Support\Facades\DB;
    use Illuminate\Support\Facades\Validator;
    use Illuminate\Http\Request;
    use Yajra\DataTables\DataTables;
    use Illuminate\Support\Facades\Hash;
    use App\MahasiswaModel;
    use Illuminate\Support\Facades\Mail;
    use Illuminate\Support\Facades\Auth;
    use Illuminate\Support\Facades\Redirect;
    use Session;

class Sinkronisasi extends Controller
    {
        static $Tableshow = ["id" => ["table" => ["tablename" =>"null" , "field"=> "id"] , "record"=>"Id"],
            "nama" => ["table" => ["tablename" =>"null" , "field"=> "nama"] , "record"=>"Nama"],
            ];
        static $html = ["id"=>["type"=>"null" , "value"=>"null" , "validation" => ""] ,
            "nama"=>["type"=>"null" , "value"=>"null" , "validation" => ""] ,
            ];
        static $exclude = ["id","created_at","updated_at","created_by","update_by"];
        static $tablename = "Administrator";

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
            $data = SinkronisasiModel::get();
            $title = "Sinkronisasi Data";
            $tableid = "Sinkronisasi";
            $table_display = DB::getSchemaBuilder()->getColumnListing("sinkronisasi");
            $exclude = static::$exclude;
            $Tableshow = static::$Tableshow;
            return view("administrator/sinkronisasi" , compact("data" , "title" ,"table_display" ,"exclude" ,"Tableshow","tableid"));

        }

        public function create(){
            $title = "Tambah ".ucfirst(request()->segment(1))." ".ucfirst(request()->segment(2));
            return view("administrator/administrator_create" , compact("title"));

        }

        public function save(Request $request){
            $input = $request->all();
            $validation = Validator::make($input, [
                'nama' => 'required',
                'username' => 'required|unique:administrator',
                'email' => 'required|email',
                'password' => 'required',
                'confirm_password' => 'required|same:password',
            ]);
            $input['password'] = Hash::make($input['confirm_password']);
            unset($input['confirm_password']);
            if ($validation->fails()) {
                return json_encode(["status"=> "error", "message"=> $validation->messages()]);
            }
            
            $save  = AdministratorModel::firstOrCreate($input);
            
            if($save){
                return json_encode(["status"=> "success", "message"=> 'Data berhasil disimpan']);
            }else{
                return json_encode(["status"=> "error", "message"=> 'Terjadi kesalahan saat menyimpan data.']);
            }
        }


        public function update(Request $request){
            $input = $request->all();

           // print_r($input); exit;
           $id = $input['id'];
            if($input['password'] == '' || $input['password'] == null){
                $validation = Validator::make($input, [
                    'nama' => 'required',
                    'username' => 'required',
                    'email' => 'required|email'
                ]);
                unset($input['confirm_password']);
                unset($input['password']);
                
            }else{
                $validation = Validator::make($input, [
                    'nama' => 'required',
                    'email' => 'required|email',
                    'password' => 'required',
                    'confirm_password' => 'required|same:password',
                ]);
                $input['password'] = Hash::make($input['confirm_password']);
                unset($input['confirm_password']);
            }
            unset($input['username']);
                
            if ($validation->fails()) {
                return json_encode(["status"=> "error", "message"=> $validation->messages()]);
            }
            

            $save  = AdministratorModel::where('id' ,$id)->update($input);
            
            if($save){
                return json_encode(["status"=> "success", "message"=> 'Data berhasil disimpan']);
            }else{
                return json_encode(["status"=> "error", "message"=> 'Terjadi kesalahan saat menyimpan data.']);
            }
        }

        public function view($id){
            $data = AdministratorModel::where('id' , $id)->first();
            $title = "Tambah ".ucfirst(request()->segment(1))." ".ucfirst(request()->segment(2));
            return view("administrator/administrator_update" , compact("title" ,"data"));
        }

        public function delete(Request $request){
            //print_r($request->all());
            $post = $request->all();
            $data['row_status'] = 'deleted';
            if(AdministratorModel::where('id' , $post['id'])->update($data)){
                return json_encode(["status"=> "success", "message"=> 'Data berhasil dihapus.']);
            }else{
                return json_encode(["status"=> "error", "message"=> 'Terjadi kesalahan saat menghapus user']);
            }
        }

        public function paging(Request $request){
            return Datatables::of(AdministratorModel::where('row_status', '!=', 'deleted')->get())->addIndexColumn()->make(true);//return Datatables::of(AdministratorModel::all())->make(true);
        }

        function generate_key(Request $request){
            $post = $request->all();
            if($post['type'] == 'mahasiswa'){
                $data = MahasiswaModel::where('email' , $post['email'])->first();
            }
            if($data){

                $data = array("name"=>"Ogbonna Vitalis(sender_name)", "body" => "A test mail");

                Mail::send('emails.reminder', ['user' => $data], function ($m) use ($data) {
                    $m->from('hello@app.com', 'Your Application');
                    $m->to($data->email, $data->nama)->subject('Your Reminder!');
                });
            
            }
        }

        function change_password(Request $request){
            $input = $request->all();
            $data = AdministratorModel::where('id' , '=',Auth::user()->id)->first();
            if($data){
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
                    $data['password'] = Hash::make($input['konfirmasi']);
                    if($data->save()){
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

    
    function runWS($data, $type='json') {
        error_reporting(E_ALL ^ E_WARNING ^ E_NOTICE ^ E_DEPRECATED);
        session_start();
        $url = 'http://202.162.198.147:7072/ws/live2.php';
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_POST, 1);
        $headers = array();
        if ($type == 'xml')
            $headers[] = 'Content-Type: application/xml';
        else
            $headers[] = 'Content-Type: application/json';
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        if ($data) {
            if ($type == 'xml') {
                $data = stringXML($data);
            }else{
                /* contoh json:
                {"act":"GetToken","username":"agus","password":"abcdef"}
                */
                $data = json_encode($data);
            }
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        }
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        $result = curl_exec($ch);
        curl_close($ch);
        return $result;
    }
    
    function stringXML($data) {
        $xml = new SimpleXMLElement('<?xml version="1.0"?><data></data>');
        $this->array_to_xml($data, $xml);
        return $xml->asXML();
    }
    
    function array_to_xml( $data, &$xml_data ) {
        foreach( $data as $key => $value ) {
            if( is_array($value) ) {
                $subnode = $xml_data->addChild($key);
                array_to_xml($value, $subnode);
            } else {
            //$xml_data->addChild("$key",htmlspecialchars("$value"));
                $xml_data->addChild("$key",$value);
            }
        }
    }

    public function get_data_mahasiswa_need_update(){
        
        $token = $this->check_auth_siakad();
        $data = MahasiswaModel::where('is_sinc' ,'1')->get();
        if($data){
            foreach($data as $item){

                if(strlen($item->id_mahasiswa) > 5){
                    echo 'diupdate';
                }else{
                    //echo 'insert';
                    $this->InsertBiodataMahasiswa($item , $token);
                }
            }
        }
    }

    public function check_auth_siakad(){

        if(!Session::has('login_siakad')){
           Session::put('login_siakad', $this->GetToken());
        }
        return Session::get('login_siakad');
    }

    public function GetToken(){
        $username = '445003';
        $password = '445003123';
        $data =array('act'=>"GetToken", 'username'=>$username, 'password'=>$password);

        $result_string = $this->runWS($data, 'json');
        
        $result_string = json_decode($result_string , true);
        
        if($result_string){
           return $result_string['data']['token'];
        }else{
            echo false;
        }
    
    }

    public function GetBiodataMahasiswa($token){
        $data = array('act'=>"GetBiodataMahasiswa" , "token"=>$token, "filter"=> "","limit"=>3 , "offset" =>0);
        $result_string = $this->runWS($data, 'json');
        return json_decode($result_string , true);
    }

    public function InsertBiodataMahasiswa($item , $token){
               
        $jk = array('laki-laki'=>'L', 'perempuan'=>'P');
        $data['nama_mahasiswa'] = $item->nama;		    //varying(100)	not null	Nama Mahasiswa
        $data['jenis_kelamin'] = $jk[$item->jk];		        //character(1)	not null	L: Laki-laki, P: Perempuan, *: Belum ada informasi
        $data['jalan'] = $item->alamat;		                //character varying(80)		Jalan
        $data['rt'] = $item->rt;		                //numeric(2,0)		
        $data['rw'] = $item->rw;		                //numeric(2,0)		
        $data['dusun'] = $item->dusun;		                //character varying(60)		Nama Dusun
        $data['kelurahan'] = $item->kelurahan;		            //character varying(60)	not null	
        $data['kode_pos'] = $item->kode_pos;		            //character(5)		
        $data['nisn'] = $item->nisn;		                //character(10)		Nomor Induk Siswa Nasional
        $data['nik'] = $item->nik;		                //character(16)	not null	Nomor Induk Kependudukan, wajib di isi
        $data['tempat_lahir'] = $item->tempat_lahir;		        //character varying(32)	not null	
        $data['tanggal_lahir'] = $item->tanggal_lahir;		        //date	not null	yyyy-mm-dd
        $data['nama_ayah'] = '';		            //varying(100)		
        $data['tanggal_lahir_ayah'] = '';		//date		yyyy-mm-dd
        $data['nik_ayah'] = '';		            //character(16)		
        //$data['id_jenjang_pendidikan_ayah'] = 0;		//numeric(2,0)		Web Service: GetJenjangPendidikan
        $data['id_pekerjaan_ayah'] = '';		    //integer		Web Service: GetPekerjaan
        $data['id_penghasilan_ayah'] = '';		//integer		Web Service: GetPenghasilan
        $data['id_kebutuhan_khusus_ayah'] = 0;  //integer	not null	Default 0	
        $data['nama_ibu_kandung'] = $item->nama_ibu;		    //varying(100)	not null	
        $data['tanggal_lahir_ibu'] = '';		    //date		yyyy-mm-dd
        $data['nik_ibu'] = '';		            //character(16)		
        //$data['id_jenjang_pendidikan_ibu'] = 0;		//numeric(2,0)		Web Service: GetJenjangPendidikan
        $data['id_pekerjaan_ibu'] = '';		    //integer		Web Service: GetPekerjaan
        $data['id_penghasilan_ibu'] = '';	    //	integer		Web Service: GetPenghasilan
        $data['id_kebutuhan_khusus_ibu'] = 0;   //integer	not null	Default 0
        $data['nama_wali'] = '';		            //varying(100)		
        $data['tanggal_lahir_wali'] = '';        //date		yyyy-mm-dd
        //$data['id_jenjang_pendidikan_wali'] = 0;//		numeric(2,0)		Web Service: GetRecordset:jenjang_pendidikan
        $data['id_pekerjaan_wali'] = '';		    //integer		Web Service: GetPekerjaan
        $data['id_penghasilan_wali'] = '';	    //	integer		Web Service: GetPenghasilan
        $data['id_kebutuhan_khusus_mahasiswa'] = 0;//		integer	not null	Default 0
        $data['telepon'] = '';		            ///character varying(20)		
        $data['handphone'] = '';		            //character varying(20)		
        $data['email'] = '';	//character varying(60)	
        $data["penerima_kps"] = "0";
        $data["id_wilayah"] = "056000";
        $data["id_agama"] = "1";
        $data["kewarganegaraan"] = "ID";
        $datas = array('act'=>'InsertBiodataMahasiswa',
            'token'=>$token,
            'record'=>$data,
        );
        $result_string = $this->runWS($datas, 'json');
        $result_string = json_decode($result_string , true);
        if($result_string){
            MahasiswaModel::where('id' , $item->id)->update(array('id_mahasiswa' => $result_string['data']['id_mahasiswa']));
           print_r($result_string);
        }else{
            echo false;
        }
        

    }

    public function GetPekerjaan(){
        
    }





        

}
        