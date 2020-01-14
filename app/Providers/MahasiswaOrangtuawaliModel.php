<?php

        namespace App;

        use Illuminate\Database\Eloquent\Model;

        class MahasiswaOrangtuawaliModel extends Model
        {

            protected $table = "mahasiswa_orang_tua_wali";
           // protected $fillable = ["id","updated_at" ,"created_at","created_by", "update_by"];
            protected $guarded = [];
            public function scopeget_row(){
                return [
                    "id","row_status","mahasiswa_id","pendidikan_id","kategori","nik","nama","tempat_lahir","tanggal_lahir","pekerjaan_id","penghasilan","updated_at" ,"created_at","created_by", "update_by"
                 ];
             }

            protected $fillable = [
                "id","row_status","mahasiswa_id","pendidikan_id","kategori","nik","nama","tempat_lahir","tanggal_lahir","pekerjaan_id","penghasilan","updated_at" ,"created_at","created_by", "update_by"
            ];

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
