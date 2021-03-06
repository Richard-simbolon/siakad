<?php

        namespace App;

        use Illuminate\Database\Eloquent\Model;

        class JadwalUjianDetailModel extends Model
        {

            protected $table = "jadwal_ujian_mahasiswa_detail";

            protected $fillable = [
                'id','jadwal_ujian_id','mahasiswa_id','kelas_perkuliahan_detail_id','catatan','updated_at','ruangan','pengawas_id','created_at','update_by','created_by'
            ];



            public function scopeget_row(){
                return [
                    "id","updated_at" ,"created_at","created_by", "update_by"
                 ];
             }




            /**************************************/
            /*COPY THIS FUNCTION TO YOUR MIGRATION*/
            /**************************************/
            public function up(){
                Schema::create("jadwal_ujian", function (Blueprint $table) {
                    $table->bigInteger("id" , 11);

                    $table->enum("row_status", ["active", "deleted", "notactive"]);
                    $table->timestamp("updated_at")->nullable();
                    $table->timestamp("created_at")->nullable();
                    $table->timestamp("update_by")->nullable();
                    $table->timestamp("created_by")->nullable();
                });
            }
            public function down()
            {
                Schema::dropIfExists("jadwal_ujian");
            }


        }