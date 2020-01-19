<?php

namespace Illuminate\Routing;

use App\SemesterModel;
use App\SinkronisasiModel;
use BadMethodCallException;
use File;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Hash;
use Session;
use Illuminate\Support\Facades\DB;

abstract class Controller
{
    /**
     * The middleware registered on the controller.
     *
     * @var array
     */
    protected $middleware = [];
    protected $user;
    /**
     * Register middleware on the controller.
     *
     * @param  array|string|\Closure  $middleware
     * @param  array   $options
     * @return \Illuminate\Routing\ControllerMiddlewareOptions
     */

    public function __construct()
    {

        $this->middleware('auth');
    }
    
    public function generalsave($data)
    {
        print_r($data);
    }

    public function konversi_nilai($nilai = 0){
        if($nilai < 45){
            return ['key'=> 'E' , 'value' => 0];
        }elseif($nilai > 44 && $nilai<= 59){
            return ['key'=> 'D' , 'value' => 1];
        }elseif($nilai > 59 && $nilai<= 69){
            return ['key'=> 'C' , 'value' => 2];
        }elseif($nilai > 69 && $nilai<= 79){
            return ['key'=> 'B' , 'value' => 3];
        }elseif($nilai > 79 && $nilai<= 100){
            return ['key'=> 'A' , 'value' => 4];
        }else{
            return ['key'=> 'E' , 'value' => 0];
        }
    }

    public function send_password_mail($to = '' , $nama = '' , $password=''){
        if(!$to){
            return ;
        }
        $data = [];
        $data['nama'] = $nama;
        $data['password'] = $password;
        Mail::send('email.password', $data, function($message) use ($to) {
            $message->to($to)
            ->subject('Password SIAPDUDIK (Sistem Aplikasi Terpadu Pendidikan)');
            $message->from('polbangtan@noreply.com','polbangtan@noreply.com');
        });
    }

    public function generate_password(){
        $alphabet = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890';
        $pass = array(); //remember to declare $pass as an array
        $alphaLength = strlen($alphabet) - 1; //put the length -1 in cache
        for ($i = 0; $i < 8; $i++) {
            $n = rand(0, $alphaLength);
            $pass[] = $alphabet[$n];
        }
        $new_password = implode($pass);
        return array('pass' => $new_password , 'hash'=>Hash::make($new_password));
    }

    public function generate_ip($data , $semester_aktif){
        $data_group = [];
        foreach ($data as $key => $value) {
            $data_group[$value->semester_id][] = $value;
        }
        $i = 0;
        $j = 0;
        $nipg =[];
        $nipa =[];
        $t_sks = 0;
        foreach ($data_group as $keys =>$g) {
            $j++;
            $sks = 0;
            $nipk = 0;
            
            foreach ($g as $key => $item) {

                //echo $item->nama_mata_kuliah.'-';
                $i++;
                $sks += $item->bobot_mata_kuliah;
                $t_sks += $item->bobot_mata_kuliah;
                $nangka = 0;
                
                $nhuruf = 'E';
                $indexvsks = 0;
                $nhuruf = 'E';
                $nuts = $item->nilai_uts > 0 ? $item->nilai_uts : 0;
                $nuas = $item->nilai_uas > 0 ? $item->nilai_uas : 0;
                $ntgs = $item->nilai_tugas > 0 ? $item->nilai_tugas : 0;
                $nlapopkl = $item->nilai_laporan_pkl > 0 ? $item->nilai_laporan_pkl : 0;
                $nlapo = $item->nilai_laporan > 0 ? $item->nilai_laporan : 0;
                $nujian = $item->nilai_ujian > 0 ? $item->nilai_ujian : 0;

                if($item->tipe_mata_kuliah == 'praktek'){
                    $nangka = ( (($ntgs * 20) / 100) + (($nuts * 40) / 100) + (($nuas * 40)/100));
                }elseif ($item->tipe_mata_kuliah == 'teori') {
                    $nangka = ( (($ntgs * 30) / 100) + (($nuts * 30) / 100) + (($nuas * 40)/100));
                }elseif ($item->tipe_mata_kuliah == 'seminar') {
                    $nangka = ( (($ntgs * 40) / 100) + (($nuts * 30) / 100) + (($nuas * 30)/100));
                }elseif ($item->tipe_mata_kuliah == 'pkl') {
                    $nangka = ( (($ntgs * 20) / 100) + (($nuts * 20) / 100) + (($nuas * 40)/100) + (($nlapopkl * 20) / 100));
                }elseif ($item->tipe_mata_kuliah == 'skripsi') {
                    $nangka = ( (($ntgs * 30) / 100) + (($nuts * 20) / 100) + (($nuas * 10)/100) + (($nlapopkl * 10) / 100) + (($nujian * 20) / 100) + (($nlapo * 10) / 100));
                }
                if($nangka < 45){
                    $nhuruf = 'E';
                    $nipk += 0 * $item->bobot_mata_kuliah;
                    $indexvsks = 0 * $item->bobot_mata_kuliah;
                    $index = 0;
                }elseif($nangka > 44 && $nangka<= 59){
                    $nhuruf = 'D';
                    $nipk += 1 * $item->bobot_mata_kuliah;
                    $indexvsks = 1 * $item->bobot_mata_kuliah;
                    $index = 1;
                }elseif($nangka > 59 && $nangka<= 69){
                    $nhuruf = 'C';
                    $nipk += 2 * $item->bobot_mata_kuliah;
                    $indexvsks = 2 * $item->bobot_mata_kuliah;
                    $index = 2;
                }elseif($nangka > 69 && $nangka<= 79){
                    $nhuruf = 'B';
                    $nipk += 3 * $item->bobot_mata_kuliah;
                    $indexvsks = 3 * $item->bobot_mata_kuliah;
                    $index = 3;
                }elseif($nangka > 79 && $nangka<= 100){
                    $nhuruf = 'A';
                    $nipk += 4 * $item->bobot_mata_kuliah;
                    $indexvsks = 4 * $item->bobot_mata_kuliah;
                    $index = 4;
                }else{
                    $nhuruf = 'E';
                    $nipk += 0 * $item->bobot_mata_kuliah;
                    $indexvsks = 0 * $item->bobot_mata_kuliah;
                    $index = 0;
                }
            }
            $nipa = $nipk / $sks;
            $nipg[] = $nipk / $sks;
            //echo $t_sks; exit;
        }
        return [round(array_sum($nipg) / count($nipg) ,2) , $nipa ? $nipa : 0 , $t_sks ? $t_sks:0];
    }

    public function change_sync_status_kelas_perkuliahan($kelas_perkuliahan_id){
        DB::table('kelas_perkuliahan_mata_kuliah')->where('id' , $kelas_perkuliahan_id)->update(array('is_sinc'=>'0'));
    }

    public function getSemester(){
        return SemesterModel::where('status_semester','=', 'enable')->first();
    }
    public function generalcreate($data){
        return view('master/Agama');
    }

    public function store_memcached($key = null , $data = ''){
        Cache::forever($key , $data);
    }


    public function selectmaster($tablename){
        if(!file_exists(public_path().'/master/'.strtolower($tablename).'.php')){
          return ['msg' => "Silahkan tekan tombol refresh pada menu master"];
        }else{
            return file_get_contents(public_path().'/master/'.strtolower($tablename).'.php') ;
        }
    }

    public function success($msg= '' , $data=[]){
        return json_encode(array('status' => 'success' , 'msg'=>$msg , 'data' , $data));
    }

    public function failed($data){

    }

    function runWS($data, $type='json') {
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

    public function check_auth_siakad(){
        return $this->GetToken();
        return '8846530ba80694a4f08e49883c2018d1';
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
        if($result_string['error_code'] == 0){
           return $result_string['data']['token'];
        }else{
           return false;
        }
    
    }

    public function sinkron_log($code, $status, $count){
        $sinkronisasi = SinkronisasiModel::where('sync_code',$code)->first();
        $sinkronisasi->last_sync = date('Y-m-d H:m:s');
        $sinkronisasi->last_sync_status = $status;
        $sinkronisasi->last_sync_by = Auth::user()->nama;
        $sinkronisasi->jumlah_sync = $count;
        $sinkronisasi->save();
    }

    public function middleware($middleware, array $options = [])
    {
        foreach ((array) $middleware as $m) {
            $this->middleware[] = [
                'middleware' => $m,
                'options' => &$options,
            ];
        }

        //$this->setUserActivity();

        return new ControllerMiddlewareOptions($options);
    }


    public function setUserActivity(){
        date_default_timezone_set('Asia/Jakarta');
        $time=time();
        $time_check=$time-600;
        $type = Auth::user()->login_type;
        if(strtolower($type) == 'dosen' || strtolower($type) == 'mahasiswa') {
            if (Cache::get('underconstuctormode') == '1') {
                return false;
            }
        }
        if(session('last_activity') < $time_check){

            $last_activity = date("Y-m-d H:m:s");
            if(strtolower($type) == 'dosen'){
                DB::table('dosen')->where('nidn_nup_nidk','=', Auth::user()->id)->update(array("last_activity"=>$last_activity));
            }elseif (strtolower($type)== 'mahasiswa'){
                DB::table('mahasiswa')->where('nim','=', Auth::user()->id)->update(array("last_activity"=>$last_activity));
            }else{
                DB::table('administrator')->where('username','=', Auth::user()->id)->update(array("last_activity"=>$last_activity));
            }
            session(['last_activity' => time()]);
        }else{
            session(['last_activity' => time()]);
        }

        return true;
    }

    /**
     * Get the middleware assigned to the controller.
     *
     * @return array
     */
    public function getMiddleware()
    {
        return $this->middleware;
    }

    /**
     * Execute an action on the controller.
     *
     * @param  string  $method
     * @param  array   $parameters
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function callAction($method, $parameters)
    {
        return call_user_func_array([$this, $method], $parameters);
    }

    /**
     * Handle calls to missing methods on the controller.
     *
     * @param  string  $method
     * @param  array   $parameters
     * @return mixed
     *
     * @throws \BadMethodCallException
     */
    public function __call($method, $parameters)
    {
        throw new BadMethodCallException(sprintf(
            'Method %s::%s does not exist.', static::class, $method
        ));
    }
}
