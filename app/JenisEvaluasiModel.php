<?php

        namespace App;

        use Illuminate\Database\Eloquent\Model;

        class JenisEvaluasiModel extends Model
        {

            protected $table = "master_jenis_evaluasi";

            protected $fillable = [
                "id","row_status","title","updated_at" ,"created_at","created_by", "update_by"
            ];
            public function scopeget_row(){
                return [
                    "id","row_status","title","updated_at" ,"created_at","created_by", "update_by"
                 ];
             }

        }