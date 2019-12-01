<?php

        namespace App;

        use Illuminate\Database\Eloquent\Model;

        class MahasiswaModel extends Model
        {

            protected $table = "mahasiswa";

            //protected $fillable = ['id,row_status,nama,nama_ibu,password,nik,nisn,nim,npwp,email,jk,agama,tempat_lahir,tangal_lahir,alamat,dusun,kelurahan,kecamatan,rt,rw,kode_pos,jenis_tinggal,is_penerima_kps,no_kps,kewarganegaraan,no_telepon,no_hp,alat_transportasi,created_date,created_by,modified_date,modified_by'];
            protected $guarded = [];

            public function scopeget_row(){
                return [
                    'id,row_status,nama,nama_ibu,password,nik,nisn,nim,pembimbing_akademik,npwp,email,jk,agama,tempat_lahir,tangal_lahir,alamat,dusun,kelurahan,kecamatan,rt,rw,kode_pos,jenis_tinggal,is_penerima_kps,no_kps,kewarganegaraan,no_telepon,no_hp,alat_transportasi,created_date,created_by,modified_date,modified_by'
                 ];
             }

            /**************************************/
            /*COPY THIS FUNCTION TO YOUR MIGRATION*/
            /**************************************/
            public function up(){
                Schema::create("mahasiswa", function (Blueprint $table) {
                    $table->bigIncrements("id")->unsigned();
                    $table->enum("row_status", ["active", "deleted", "notactive"]);
                    $table->timestamp("updated_at")->nullable();
                    $table->timestamp("created_at")->nullable();
                    $table->timestamp("update_by")->nullable();
                    $table->timestamp("created_by")->nullable();
                });
            }
            public function down()
            {
                Schema::dropIfExists("mahasiswa");
            }


        }
