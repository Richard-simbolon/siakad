<?php

        namespace App;

        use Illuminate\Database\Eloquent\Model;

        class JenisPrestasiModel extends Model
        {

            protected $table = "master_jenis_prestasi";

            protected $fillable = [
                "id","row_status","title","updated_at" ,"created_at","created_by", "update_by"
            ];



            public function scopeget_row(){
                return [
                    "id","row_status","title","updated_at" ,"created_at","created_by", "update_by"
                 ];
             }


        }