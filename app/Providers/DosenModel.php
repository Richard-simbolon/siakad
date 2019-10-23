<?php

        namespace App;

        use Illuminate\Database\Eloquent\Model;

        class DosenModel extends Model
        {

            protected $table = "dosen";

            protected $fillable = [
                'id','row_status','nama','nik','tempat_lahir','tanggal_lahir','agama','jenis_kelamin','nidn_nup_nidk','nip','npwp','status','nama_ibu','ikatan_kerja','status_pegawai','jenis_pegawai','no_sk_cpns','tanggal_sk_cpns','no_sk_pengangkatan','tgl_sk_pengangkatan','lembaga_pengangkatan','pangkat_golongan','sumber_gaji','alamat','dusun','kelurahan','kecamatan','rt','rw','kode_pos','telepon','no_hp','email','created_by','created_date','modified_by','modified_dateYour '
            ];



            public function scopeget_row(){
                return [
                    "id","row_status","updated_at" ,"created_at","created_by", "update_by"
                 ];
             }




            /**************************************/
            /*COPY THIS FUNCTION TO YOUR MIGRATION*/
            /**************************************/
            public function up(){
                Schema::create("dosen", function (Blueprint $table) {
                    $table->bigIncrements("id")->unsigned();
            $table->enum("row_status" , 11);

                    $table->enum("row_status", ["active", "deleted", "notactive"]);
                    $table->timestamp("updated_at")->nullable();
                    $table->timestamp("created_at")->nullable();
                    $table->timestamp("update_by")->nullable();
                    $table->timestamp("created_by")->nullable();
                });
            }
            public function down()
            {
                Schema::dropIfExists("dosen");
            }


        }