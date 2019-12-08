<?php

        namespace App;

        use Illuminate\Database\Eloquent\Model;

        class SoalUjianModel extends Model
        {

            protected $table = "soal_ujian";

            protected $fillable = [
                "id","row_status","jenis_ujian", "nama_file","mata_kuliah_id","jurusan_id","angkatan_id","kelas_id","semester_id","dosen_id","updated_at" ,"created_at","created_by", "update_by"
            ];

            public function scopeget_row(){
                return [
                    "id","row_status","jenis_ujian","nama_file","mata_kuliah_id","jurusan_id","angkatan_id","kelas_id","semester_id","dosen_id","updated_at" ,"created_at","created_by", "update_by"
                 ];
             }

        }