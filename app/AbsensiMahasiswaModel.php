<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AbsensiMahasiswaModel extends Model
{

    protected $table = "absensi_mahasiswa";

    protected $fillable = [
        'id','row_status','program_studi_id','kelas_perkuliahan_detail_id','semester_id','kelas_id','semester_kelas','mahsiswa_id','angkatan_id','tanggal_perkuliahan','pembahasan','catatan','created_by','created_at','modified_by','updated_at'
    ];



    public function scopeget_row(){
        return [
            'id','row_status','program_studi_id','kelas_perkuliahan_detail_id','semester_id','kelas_id','semester_kelas','mahsiswa_id','angkatan_id','tanggal_perkuliahan','pembahasan','catatan','created_by','created_at','modified_by','updated_at'
            ];
        }




            /**************************************/
            /*COPY THIS FUNCTION TO YOUR MIGRATION*/
            /**************************************/
            public function up(){
                Schema::create("absensi_mahasiswa", function (Blueprint $table) {
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
                Schema::dropIfExists("absensi_mahasiswa");
            }


        }