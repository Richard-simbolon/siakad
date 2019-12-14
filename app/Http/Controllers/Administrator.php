<?php
    namespace App\Http\Controllers;
    use Illuminate\Support\Facades\DB;
    use Illuminate\Support\Facades\Validator;
    use Illuminate\Http\Request;
    use App\ AdministratorModel;
    use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\Hash;
use App\MahasiswaModel;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class Administrator extends Controller
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
            $data = AdministratorModel::get();
            $title = ucfirst(request()->segment(1))." ".ucfirst(request()->segment(2));
            $tableid = "Administrator";
            $table_display = DB::getSchemaBuilder()->getColumnListing("administrator");
            $exclude = static::$exclude;
            $Tableshow = static::$Tableshow;
            return view("administrator/administrator" , compact("data" , "title" ,"table_display" ,"exclude" ,"Tableshow","tableid"));

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

                $to_name = 'Ridcat';
                $to_email = 'richardsimbolon28@gmail.com';
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

    }
        